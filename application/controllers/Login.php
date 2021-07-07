<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library(array('session'));
        $this->load->helper('path');
        $this->load->helper('email');

        $this->load->model('LoginModel');

    }

    public function index()
    {
        $this->load->view('pages/login');
    }


    /*
        Fonction de connexion
     */
    public function login($a = 0)
{

        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
 
        $userIp=$this->input->ip_address();
     
        $secret = $this->config->item('google_secret');
   
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
         
        $status= json_decode($output, true);
        $data = new stdClass();

    if ($a == 0) 
    {
    $this->load->view('pages/login');
    } 

else 
{
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('login', 'Identifiant', 'required');
            $this->form_validation->set_rules('password', 'Mot de passe', 'required');

            if ($this->form_validation->run() == false) 
            {
                    $data->identifiant = $this->input->post('login');
                    $data->password = $this->input->post('password');
                    $this->load->view('pages/login', $data);
            } 

            else 
            {
                $identifiant = $this->input->post('login');
                $password = $this->input->post('password');

                $isExist = $this->LoginModel->getUserIdByemail($identifiant);
                $VerifStatut = $this->LoginModel->getUserStatutByemail($identifiant);

            if ($isExist)
            {
                if ($this->LoginModel->resolveUserLogin($identifiant, $password)) 
                    {
                        $userId = $this->LoginModel->getUserIdByemail($identifiant);
                        $user = $this->LoginModel->getUserById($userId);
                    if ($VerifStatut==1)
                    {
                       
                        //code6

                        $_SESSION['userid'] = (int)$user->id_user;
                        $_SESSION['login'] = (string)($user->prenom_user . ' ' . $user->nom_user);
                        $_SESSION['logged_in'] = (bool)true;
                        $_SESSION['email'] = (string)$user->email;
                        $_SESSION['idservice'] = (int)$user->id_service;
                        $_SESSION['libelleservice'] = (string)$user->libelle_service;
                        $_SESSION['fki_suc_us'] = (int)$user->fki_suc_us;
                        // $_SESSION['libellegroupe'] = (string)$user->libellegroupe;
                        // $_SESSION['ischef'] = (boolean)$user->ischef;
                        // $_SESSION['idchef'] = 1;
                        $_SESSION['profil'] = $user->fki_profil_us;
                        $_SESSION['logged'] = 1;

                        /*$_SESSION['droitmenu'] = (string)$user->menuprof;
                        $_SESSION['droitprofil'] = (string)$user->privprof;
                        $_SESSION['droitservice'] = (string)$user->privserv;
                        $_SESSION['droitemploye'] = (string)$user->privemp;
                        $_SESSION['droituser'] = (string)$user->privuser;
                        $_SESSION['droitcourrier'] = (string)$user->privcour;
                        $_SESSION['profil'] = (int)$user->fkidprofil;*/

                        // $_SESSION['courrierpriv'] = (int)$user->courrierpriv;
                        // $_SESSION['employepriv'] = (int)$user->employepriv;
                        // $_SESSION['servicepriv'] = (int)$user->servicepriv;
                        // $_SESSION['dossierpriv'] = (int)$user->dossierpriv;
                        // $_SESSION['groupepriv'] = (int)$user->groupepriv;
                        // $_SESSION['privpriv'] = (int)$user->privpriv;

//code6
                         $_SESSION['courrierpriv'] = (int)$user->courrier_priv;
                        $_SESSION['employepriv'] = (int)$user->user_priv;
                        $_SESSION['servicepriv'] = (int)$user->service_priv;
                        $_SESSION['dossierpriv'] = (int)$user->dossier_priv;
                        $_SESSION['groupepriv'] = (int)$user->group_priv;
                        $_SESSION['privpriv'] = (int)$user->priv_priv;


                        $this->session->set_userdata($_SESSION);


                        redirect('tb', 'refresh'); 
                    }

                    elseif ($VerifStatut==2) 
                    {
                        $data->msg = 'Vous êtes temporairement banni du système. Contactez votre Administrateur !';
                        $this->load->view('pages/login', $data);
                    }
                         


                    

                    } 

                    else 
                    {
                        $data->msg = 'Mot de passe erroné !';
                        $this->load->view('pages/login', $data);
                    }
                } 
                
                else 
                {
                    $data->msg = "Ce compte utilisateur n'existe pas !";
                    $this->load->view('pages/login', $data);
                }
            }
    }
}
    

    public function logout()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            foreach ($_SESSION as $value) {
                unset($value);
            }

            $_SESSION = array();

        }

        redirect(base_url());
        die();
    }

    /*
    PROFILE USER FORM
 */
    function profile($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
            redirect(base_url());
            die();
        }

        $data_l['title'] = 'Editer votre profile';
        $data_l['menu'] = '';

        $data_b['user'] = $this->login->getUserById($id);

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/profile', $data_b);
    }

    /*
        PROFILE USER
     */
    function profile_update($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
            redirect(base_url());
            die();
        }

        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $email = $this->input->post('email');
        $identifiant = $this->input->post('username');
        $password = $this->input->post('password');

        $this->LoginModel->updateProfile($id, $nom, $prenom, $identifiant, $email, $password);

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // remove session datas
            foreach ($_SESSION as $value) {
                unset($value);
            }

            $_SESSION = array();
        }

        // login failed
        $data = new stdClass();
        $data->msg = 'Profile bien mis à jour, veuillez vous reconnecter !';
        $this->load->view('pages/login', $data);
    }

    function users()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false || $_SESSION['typec'] != 'Super admin') {
            redirect(base_url());
            die();
        }

        $data_l['title'] = 'Les utilisateurs';
        $data_l['menu'] = 'usr';

        $data = array();
        $data_b['users'] = $this->LoginModel->getUsers();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/users', $data_b);
    }

    public function user_offOn($id)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false || $_SESSION['typec'] != 'Super admin') {
            redirect(base_url());
            die();
        }

        $this->LoginModel->updateUserState($id);
        $this->users();
    }

    function user($a = 0)
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false || $_SESSION['typec'] != 'Super admin') {
            redirect(base_url());
            die();
        }

        $data_l['title'] = 'Ajout de compte';
        $data_l['menu'] = 'usr';

        $data_b = array();

        if ($a == 1) {
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $email = $this->input->post('email');
            $identifiant = $this->input->post('username');
            $password = $this->input->post('password');
            $typec = $this->input->post('typec');

            if (!($this->LoginModel->getUserIdByUsername($identifiant))) {
                if ($this->LoginModel->createUser($nom, $prenom, $email, $identifiant, $password, $typec)) {
                    $data_b['msg'] = "Nouveau compte ajouté avec succès !";
                    $data_b['class'] = 'success';
                } else {
                    $data_b['msg'] = "Erreur lors de l'ajout du nouveau compte !";
                    $data_b['class'] = 'danger';
                }
            } else {
                $data_b['msg'] = "Un compte existe déjà avec cet identifiant !";
                $data_b['class'] = "red";
            }
        }

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/user', $data_b);
    }


    function deleteuser()
    {

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false || $_SESSION['typec'] != 'Super admin') {
            redirect(base_url());
            die();
        }

        $iduser = isset($_GET['id']) ? $_GET['id'] : '';

        $prod = null;
        if ($iduser != null && !empty($iduser)) {
            $user = $this->LoginModel->getUserById($iduser);
        } else {
            $msg = "Aucun utilisateur trouvé !";
            $sess_array = array(
                'type' => 'danger',
                'corps' => $msg
            );
            $this->session->set_flashdata('message', $sess_array);
            redirect('Login/users', 'refresh');
        }

        $this->db->trans_begin();

        $this->LoginModel->deleteUser($iduser);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "Erreur lors de la suppression de l'utilisateur !";
            $sess_array = array(
                'type' => 'danger',
                'corps' => $msg
            );
            $this->session->set_flashdata('message', $sess_array);
        } else {
            $this->db->trans_commit();
            $msg = "Suppression du compte effectuée avec succès !";
            $sess_array = array(
                'type' => 'success',
                'corps' => $msg
            );
            $this->session->set_flashdata('message', $sess_array);

        }/**/
        redirect('Login/users', 'refresh');
    }
}
