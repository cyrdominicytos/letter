<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tb extends CI_Controller
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

        $this->load->model('TbModel', 'tb');

        if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false ) {
            redirect(base_url());
            die();
        }



    }

    public function index()
    {
        $this->tb();
    }



    function tb()
    {
        $this->load->helper(array('form'));
        $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );

        $data_l['title'] = 'Tableau de bord';
        $data_l['menu'] = 'tb';
        $data_l['submenu'] = '';

        $data = array();
        //$data_b['nbenattente'] = $this->>tb->nbregion();


        $data_b['nbatraiter'] = $this->tb->nbatraiter();

        $data_b['nbmyservice'] = $this->tb->nbmyservice();

        $data_b['nbenregistre'] = $this->tb->nbenregistre();

        $data_b['nbencopie'] = $this->tb->nbencopie();

        $data_b['urgent'] = $this->tb->urgent();

		/*$data_b['chartdata'] ='{label: "A traiter", value: '.$data_b["nbatraiter"].'},
		{label: "Enregistrer", value: '.$data_b["nbenregistre"].'},
		{label: "En copie", value: '.$data_b["nbencopie"].'}';*/
        


        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/tb', $data_b);
        // $this->load->view('templates/footer', $data_b);
    }



public function download($img2)
{
    $this->load->helper('download');
    /*make sure here $img2 contains full path of image file*/
// echo base_url().'assets/docs/'.$img2;
    $data = file_get_contents(base_url().'assets/docs/'.$img2, TRUE);
    force_download($img2, $data);

    // force_download(base_url().'assets/docs/'.$img2, NULL);
}
    /*
        liste de region
     */
    function regions()
    {

        $data_l['title'] = 'Les régions';
        $data_l['menu'] = 'regions';

        $data = array();
        $data_b['regions'] = $this->tb->getRegions();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/regions', $data_b);
    }


    function region($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('libelleRegion', 'Libelle région', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['title'] = 'Les régions';
            $data_l['menu'] = 'regions';

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/region');

        } else {
            $libelleRegion = $this->input->post('libelleRegion');

            $this->db->trans_begin();

            $this->tb->save_region($libelleRegion);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement du courrier</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Courrier enregistré avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region');


        }

    }


    /*
		liste de region
	 */
    function sections()
    {

        $data_l['title'] = 'Les section';
        $data_l['menu'] = 'sections';

        $data = array();
        $data_b['sections'] = $this->tb->getSections();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/sections', $data_b);
    }


    // function change_suc()
    // {
    //     if ($this->input->post('idsuc')!='') {
            
    //        $_SESSION['fki_suc_us']= $this->input->post('idsuc');

    //     }

    // }


    function section($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('libelleSection', 'Libelle section', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['title'] = 'Les régions';
            $data_l['menu'] = 'regions';

            $data_b['regions'] = $this->tb->getRegions();

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/section', $data_b);

        } else {
            $libelleSection = $this->input->post('libelleSection');
            $fkIdRegion = $this->input->post('fkIdRegion');

            $this->db->trans_begin();

            $this->tb->save_section($libelleSection, $fkIdRegion);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>enregistrement effectué avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region/sections');


        }

    }

    function eglises()
    {

        $data_l['title'] = 'Les section';
        $data_l['menu'] = 'eglise';

        $data = array();
        $data_b['eglises'] = $this->tb->getEglises();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/eglises', $data_b);
    }

    function eglise($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('libelleEglise', 'Libelle église', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['title'] = 'Les églises';
            $data_l['menu'] = 'eglise';

            $data_b['sections'] = $this->tb->getSections2();

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/eglise', $data_b);

        } else {
            $libelleEglise = $this->input->post('libelleEglise');
            $fkIdSection = $this->input->post('fkIdSection');

            $this->db->trans_begin();

            $this->tb->save_eglise($libelleEglise, $fkIdSection);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>enregistrement effectué avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region/eglises');


        }

    }

    function pasteurs()
    {

        $data_l['title'] = 'Les section';
        $data_l['menu'] = 'pasteurs';

        $data = array();
        $data_b['pasteurs'] = $this->tb->getPasteurs();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/pasteurs', $data_b);
    }

    function deleteeglise()
    {
        $ideglise = isset($_GET['id']) ? $_GET['id'] : '';

        $this->db->trans_begin();

        $this->tb->deleteEglise($ideglise);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echecv!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('region/eglises', 'refresh');
    }

    function deletesection()
    {
        $idsection = isset($_GET['id']) ? $_GET['id'] : '';

        $this->db->trans_begin();

        $this->tb->deleteSection($idsection);

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
        redirect('region/sections', 'refresh');
    }



    function deletepasteur()
    {
        $idpasteur = isset($_GET['id']) ? $_GET['id'] : '';

        $this->db->trans_begin();

        $this->tb->deletePasteur($idpasteur);

        /**/
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echecv!</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

        }/**/
        redirect('region/pasteurs', 'refresh');
    }



    function pasteur($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomPasteur', 'nom pasteur', 'trim|required');
        $this->form_validation->set_rules('prenomPasteur', 'prénom pasteur', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les pasteurs';
            $data_l['menu'] = 'pasteurs';

            $data_b['eglises'] = $this->tb->getEglises2();

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/pasteur', $data_b);

        } else {
            $nomPasteur = $this->input->post('nomPasteur');
            $prenomPasteur = $this->input->post('prenomPasteur');
            $contactPasteur = $this->input->post('contactPasteur');
            $fkIdEglise = $this->input->post('fkIdEglise');
            $date = $this->input->post('datetimedeb');

            list($datetimedeb, $datetimeend) = explode(" - ", $date);


            list($m, $d, $y) = explode("/", $datetimedeb);

            $datetimedeb = $y . '-' . $m . '-' . $d;

            list($mend, $dend, $yend) = explode("/", $datetimeend);

            $datetimeend = $yend . '-' . $mend . '-' . $dend;


            $this->db->trans_begin();

            $this->tb->save_pasteur($nomPasteur, $prenomPasteur, $contactPasteur, $fkIdEglise, $datetimedeb, $datetimeend);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>enregistrement effectué avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region/pasteurs');


        }

    }


    function editpasteur() {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomPasteur', 'nom pasteur', 'trim|required');
        $this->form_validation->set_rules('prenomPasteur', 'prénom pasteur', 'trim|required');

        $idpasteur = $_GET['id'];
        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les pasteurs';
            $data_l['menu'] = 'pasteurs';


            $data_b['eglises'] = $this->tb->getEglises2();
            $data_b['pasteur'] = $this->tb->getPasteur($idpasteur);

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/editpasteur', $data_b);

        } else {
            $nomPasteur = $this->input->post('nomPasteur');
            $prenomPasteur = $this->input->post('prenomPasteur');
            $contactPasteur = $this->input->post('contactPasteur');
            $fkIdEglise = $this->input->post('fkIdEglise');
            $date = $this->input->post('datetimedeb');

            list($datetimedeb, $datetimeend) = explode(" - ", $date);


            list($m, $d, $y) = explode("/", $datetimedeb);

            $datetimedeb = $y . '-' . $m . '-' . $d;

            list($mend, $dend, $yend) = explode("/", $datetimeend);

            $datetimeend = $yend . '-' . $mend . '-' . $dend;


            $this->db->trans_begin();

            $this->tb->update_pasteur($idpasteur,$nomPasteur, $prenomPasteur, $contactPasteur,
                $fkIdEglise, $datetimedeb, $datetimeend);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>enregistrement effectué avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region/pasteurs');


        }
    }

    function affecter($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('fkIdEglise', 'nom église', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les pasteurs';
            $data_l['menu'] = 'pasteurs';

            $data_b['eglises'] = $this->tb->getEglises2();
            $data_b['pasteur'] = $this->tb->getPasteur($_GET['idPasteur']);

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/affecter', $data_b);

        } else {
            $nomPasteur = $this->input->post('nomPasteur');
            $prenomPasteur = $this->input->post('prenomPasteur');
            $contactPasteur = $this->input->post('contactPasteur');
            $fkIdEglise = $this->input->post('fkIdEglise');
            $date = $this->input->post('datetimedeb');

            list($datetimedeb, $datetimeend) = explode(" - ", $date);


            list($m, $d, $y) = explode("/", $datetimedeb);

            $datetimedeb = $y . '-' . $m . '-' . $d;

            list($mend, $dend, $yend) = explode("/", $datetimeend);

            $datetimeend = $yend . '-' . $mend . '-' . $dend;


            $this->db->trans_begin();

            $this->tb->affecter_pasteur($_GET['id'], $_GET['idPasteur'], $nomPasteur, $prenomPasteur, $contactPasteur, $fkIdEglise, $datetimedeb, $datetimeend);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>enregistrement effectué avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('region/pasteurs');


        }

    }
    function users()
    {

        $data_l['title'] = 'Les section';
        $data_l['menu'] = 'users';

        $data = array();
        $data_b['users'] = $this->tb->getUsers();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/users', $data_b);
    }

    function deleteuser()
    {
        $iduser = isset($_GET['id']) ? $_GET['id'] : '';

        $prod = null;
        if ($iduser != null && !empty($iduser)) {
            $user = $this->tb->getUserById($iduser);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('region/users', 'refresh');
        }

        $this->db->trans_begin();

        $this->tb->deleteUser($iduser);

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
        redirect('region/users', 'refresh');
    }

    /*
    PROFILE USER FORM
    */
    function profile()
    {
        $data_l['title'] = 'Editer votre profile';
        $data_l['menu'] = 'users';

        $id = $_GET['id'];

        $data_b['user'] = $this->tb->getUserById($id);

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/profile', $data_b);
    }

    function upprofile()
    {

        $data_l['title'] = 'Editer votre profile';
        $data_l['menu'] = 'users';

        $id = $_GET['id'];

        if ($id == 1) {
            $nomUser = $this->input->post('nomUser');
            $prenomUser = $this->input->post('prenomUser');
            $contactUser = $this->input->post('contactUser');
            $identifiant = $this->input->post('username');
            $password = $this->input->post('password');
            $passwordold = $this->input->post('passwordold');
            //$profilUser = $this->input->post('profilUser');

            if($password=='') {
                $password = $passwordold;
            }

            $this->db->trans_begin();

            $this->tb->updateProfile($id,$nomUser, $prenomUser, $contactUser, $identifiant, $password);

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

            redirect("region/users", "refresh");
        }
    }


    function user($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomUser', 'nom user', 'trim|required');
        $this->form_validation->set_rules('prenomUser', 'prénom user', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les utilisateurs';
            $data_l['menu'] = 'users';


            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/user');

        } else {
            $nomUser = $this->input->post('nomUser');
            $prenomUser = $this->input->post('prenomUser');
            $contactUser = $this->input->post('contactUser');
            $identifiant = $this->input->post('username');
            $password = $this->input->post('password');
            $profilUser = $this->input->post('profilUser');

            $this->db->trans_begin();

            $this->tb->createUser($nomUser, $prenomUser, $contactUser, $identifiant, $password, $profilUser);

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
            redirect('region/users');


        }

    }

}
