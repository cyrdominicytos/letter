<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
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
        $this->load->database();
        $this->load->library(array('session'));
        $this->db->simple_query('SET NAMES utf8');
        $this->load->helper('path');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('mail');

        $this->load->model('LoginModel', 'login');

        if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false ) {
            redirect(base_url());
            die();
        }



    }

    public function index()
    {
        $this->users();
    }



    function remove_accents( $text, $charset='utf-8' )
        {
         $text = htmlentities( $text, ENT_NOQUOTES, $charset );
    
    $text = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $text );
    $text = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $text );
    $text = preg_replace( '#&[^;]+;#', '', $text );
    
    return $text;
        } 

    function privileges()
    {

        $data_l['title'] = 'Les Privilèges';
        $data_l['menu'] = 'privileges';
        $data_l['submenu'] = '';

        $data_b['privileges'] = $this->login->getPrivileges1();

        $listpriv = $this->login->getPrivileges();



        $listpriv_existe = [];

         if ($listpriv) 
            {

                $i=0;
                
                foreach ($listpriv as  $value)
                {
                    $listpriv_existe[$value['libelle_priv']] = $value['libelle_priv'];
                            
                }

                
            }
            $data_b['privexiste'] = $listpriv_existe;

            // var_dump($data_b['privexiste']);
        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/privileges', $data_b);
    }


    private function getval($inarr)
    {

        if (empty($inarr)) {
            $inarr = 0;
        }

        return $inarr;
    }

    function privilege(){

        $courrierpriv = $this->getval($this->input->post('courrierpriv'));
        $employepriv = $this->getval($this->input->post('employepriv'));
        $servicepriv = $this->getval($this->input->post('servicepriv'));
        $dossierpriv = $this->getval($this->input->post('dossierpriv'));
        $groupepriv = $this->getval($this->input->post('groupepriv'));
        $privpriv = $this->getval($this->input->post('privpriv'));
        $libellepriv = $this->input->post('libellepriv');

         $libellepriv1 = $this->remove_accents($libellepriv);
       // $code1 = $this->remove_accents($code);
        
        $libellepriv2 = strtoupper($libellepriv1);

        



        $this->db->trans_begin();

        $this->login->createPriv($libellepriv2, $courrierpriv, $employepriv, $servicepriv, $dossierpriv, $groupepriv, $privpriv);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('user/privileges');


    }

    function editpriv(){

        $id = $_GET['id'];

        //die('ddd');
        $courrierpriv = $this->getval($this->input->post('courrierpriv'));
        $employepriv = $this->getval($this->input->post('employepriv'));
        $servicepriv = $this->getval($this->input->post('servicepriv'));
        $dossierpriv = $this->getval($this->input->post('dossierpriv'));
        $groupepriv = $this->getval($this->input->post('groupepriv'));
        $privpriv = $this->getval($this->input->post('privpriv'));
        // $libellepriv = $this->input->post('libellepriv');



        $this->db->trans_begin();

        $this->login->updatePriv($id, $courrierpriv, $employepriv, $servicepriv,
            $dossierpriv, $groupepriv, $privpriv);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('user/privileges');


    }


    function users()
    {

        $data_l['title'] = 'Les utilisateurs';
        $data_l['menu'] = 'users';
        $data_l['submenu'] = '';

        $data_b['users'] = $this->login->getUsers();
        $data_b['priv'] = $this->login->getPrivileges();


        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/users', $data_b);
    }


    function reactiverUser($value="")
    {
        $iduser = isset($_GET['id']) ? $_GET['id'] : '';

        $user = null;
        if ($iduser != null && !empty($iduser)) {
            $user = $this->login->getUserById($iduser);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('user', 'refresh');
        }

        $this->db->trans_begin();

        $this->login->ReactiverUserbyId($iduser);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('user', 'refresh');
    }


    function deleteuser()
    {
        $iduser = isset($_GET['id']) ? $_GET['id'] : '';

        $user = null;
        if ($iduser != null && !empty($iduser)) {
            $user = $this->login->getUserById($iduser);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('user', 'refresh');
        }

        $this->db->trans_begin();

        $this->login->deleteUser($iduser);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('user', 'refresh');
    }

    function deletepriv() {
        $ipriv = isset($_GET['id']) ? $_GET['id'] : '';

        $priv = null;
        if ($ipriv != null && !empty($ipriv)) {
            $priv = $this->login->getPrivById($ipriv);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun profil trouvé!</div>";
            $this->session->set_flashdata('msg', $msg);
            redirect('user/privileges', 'refresh');
        }

        $this->db->trans_begin();

        $this->login->deletePriv($ipriv);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('user/privileges', 'refresh');
    }

    /*
    PROFILE USER FORM
    */
    function profile($value="")
    {
        $data_l['title'] = 'Editer votre profile';
        $data_l['menu'] = 'users';
        $data_l['submenu'] = '';

        $id = $_GET['id'];

        // $data_b['user'] = $this->login->getUserById($id);
           
        $data_b['groupe'] = $this->login->getAllSurccusale();
            
        $data_b['priv'] = $this->login->getPrivileges();

        $data_b['service'] = $this->login->getAllService();

        $data_b['user'] = $this->login->getUserById($id);


        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/mon_profil', $data_b);
    }

    function upprofile($a=0)
    {

        $data_l['title'] = 'Editer votre profile';
        $data_l['menu'] = 'users';
        $data_l['submenu'] = '';

        $id = $_GET['id'];

        if ($id == 1) {


            $nomemp = $this->input->post('nomemp');
            $prenomemp = $this->input->post('prenomemp');
            $emailemp = $this->input->post('emailemp');
            $titreemp = $this->input->post('titreemp');
            $fkidservice = $this->input->post('fkidservice');
            $fkidprofil = $this->input->post('fkidprofil');
            $fkidgroupe = $this->input->post('fkidgroupe');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $passwordold = $this->input->post('passwordold');

            $idemp = $this->input->post('idemp');

            if($password=='') {
                $password = $passwordold;
            }


            $this->db->trans_begin();

            $this->login->updateUser($id, $idemp, $nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice, $fkidprofil, $fkidgroupe, $username, $password);

            /**/
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec!</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);

            }/**/

            redirect("tb", "refresh");
        }
    }


    function user($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomemp', 'nom user', 'trim|required');
        $this->form_validation->set_rules('prenomemp', 'prénom user', 'trim|required');

        $list_mail = $this->login->getListEmail();

            if ($list_mail) 
            {

                $i=0;
                $list = [];
                foreach ($list_mail as  $value)
                {
                    $list[$value['email']] = $value['email'];
                            
                }
            }

         $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les utilisateurs';
            $data_l['menu'] = 'users';
            $data_l['submenu'] = '';

            // $data_b['groupe'] = $this->login->getGroupeByUser();
            $data_b['groupe'] = $this->login->getAllSurccusale();
            $data_b['office'] = $this->login->getServiceByUserSurccusale1();
            $data_b['priv'] = $this->login->getPrivileges1();
            $data_b['EmailExiste'] = $list;

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/user', $data_b);

        if ($this->form_validation->run() == FALSE) {
        } 
        else
        {
            $nomemp = $this->input->post('nomemp');
            $prenomemp = $this->input->post('prenomemp');
            $emailemp = $this->input->post('emailemp');
            $titreemp = $this->input->post('titreemp');
            $fkidservice = $this->input->post('fkidservice');
            $fkidprofil = $this->input->post('fkidprofil');
            $fkidgroupe = $this->input->post('fkidgroupe');

            // $mailexist = $this->login->MailExist($emailemp);
            // if ($mailexist == false) {

                $this->db->trans_begin();

            $this->login->CreateUser($nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice, $fkidprofil, $fkidgroupe);

            /**/
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec!</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);

                $mailData = [
                                'sitename'=>"AKASI-LetterBox",
                                'title'=>"Activation de compte",
                                'titleMessage' => 'Salut, '. $this->input->post('prenomemp').' '. $this->input->post('nomemp').' <br><br>Veuillez suivre le lien ci-dessous pour activer votre compte d\'utilisateur AKASI-LetterBox',
                          'option'=> 1,
                          
                          'destination' => $this->input->post('emailemp'),
                          'id' => $this->input->post('emailemp')
                    ];
                                // helper('mail');
                                mailTemplate2($mailData);
            }/**/
                
    
            // else
            // {
                // $this->db->trans_rollback();
                // $msg = "<div class='alert alert-danger'>Echec! Cet email est déjà attribué à un utilisateur</div>";
                // $this->session->set_flashdata('msg', $msg);
            // }

            
            redirect('user');


        }

    }

public function activer_compte($value="")
{
    $_SESSION['email_to_active'] = $value;
    

    $this->load->view('pages/active_compte');
   

}

function username_check(string $str)
{
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $str))
            return true;

        else
            return false;
        
            
}

// function isUserValide(string $str, string $fields, array $data)
// {
//         $userModel = new Utilisateur();
//         $user = $userModel->where('email', $data['email'])->first(); 
//         if(!$user)
//             return false;
//         return  password_verify($data['pwd'], $user['pwd']);
// }

public function submit_compte($value="")
{
  if($_SESSION['email_to_active'])
  {
     $this->load->helper(array('form')); 

     $this->form_validation->set_rules('password', 'Password non identique', 'trim|matches[confirmation]', array('matches' => 'Les mots de passe saisirs ne sont pas identiques'));

     $this->form_validation->set_rules('confirmation', 'confirmation', 'trim|callback_username_check',
        array('username_check'=>"Vous devez saisir au moins 8 caractère (un mélange de majuscule,minuscule,lettre,chiffre et caractère spécial)")
    );

    if ($this->form_validation->run() == FALSE) 
    {
        
            $data['msg'] = 'NO  !';
            $this->load->view('pages/active_compte',$data);
    }
    else
    {

        $data['msg'] = 'OK  !';
            $this->load->view('pages/active_compte',$data);
    }

  } 
   

        
}

    function edituser($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomemp', 'nom user', 'trim|required');
        $this->form_validation->set_rules('prenomemp', 'prénom user', 'trim|required');

         $list_mail = $this->login->getListEmail();

            if ($list_mail) 
            {

                $i=0;
                $list = [];
                foreach ($list_mail as  $value)
                {
                    $list[$value['email']] = $value['email'];
                            
                }
            }

        $id = $_GET['id'];

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les utilisateurs';
            $data_l['menu'] = 'users';
            $data_l['submenu'] = '';

            $data_b['user'] = $this->login->getUserById($id);
            //$data_b['groupe'] = $this->login->getGroupeByUser();
            // $data_b['groupe'] = $this->login->getAllGroupe();
            $data_b['groupe'] = $this->login->getAllSurccusale();
            //var_dump($data_b['user']);
            //die('e');
            // $data_b['service'] = $this->login->getServiceByUserService();
            $data_b['priv'] = $this->login->getPrivileges1();

            $data_b['service'] = $this->login->getServiceByUserSurccusale1();
            $data_b['EmailExiste'] = $list;

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/editeruser', $data_b);

        } else {
            // $nomemp = $this->input->post('nomemp');
            // $prenomemp = $this->input->post('prenomemp');
            // $emailemp = $this->input->post('emailemp');
            // $titreemp = $this->input->post('titreemp');
            // $fkidservice = $this->input->post('fkidservice');
            // $fkidgroupe = $this->input->post('fkidgroupe');

            $nomemp = $this->input->post('nomemp');
            $prenomemp = $this->input->post('prenomemp');
            $emailemp = $this->input->post('emailemp');
            $titreemp = $this->input->post('titreemp');
            $fkidservice = $this->input->post('fkidservice');
            $fkidprofil = $this->input->post('fkidprofil');
            $fkidgroupe = $this->input->post('fkidgroupe');

            $this->db->trans_begin();

            $this->login->updateUser2($id, $nomemp, $prenomemp, $emailemp, $titreemp, $fkidservice,$fkidgroupe,$fkidprofil);

            /**/
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec!</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);

            }/**/
            redirect('user');


        }

    }



}
