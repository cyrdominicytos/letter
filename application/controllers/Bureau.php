<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bureau extends CI_Controller
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

        $this->load->model('BureauModel', 'bureau');

        if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false ) {
            redirect(base_url());
            die();
        }



    }

    public function index()
    {
        //$this->tb();
    }

    Function remove_accents( $text, $charset='utf-8' )
        {
         $text = htmlentities( $text, ENT_NOQUOTES, $charset );
    
    $text = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $text );
    $text = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $text );
    $text = preg_replace( '#&[^;]+;#', '', $text );
    
    return $text;
        } 


    function groupes()
    {

        $data_l['title'] = 'GROUPES';
        $data_l['menu'] = 'groupes';
        $data_l['submenu'] = '';

        $data = array();
        //$data_b['nbenattente'] = $this->>tb->nbregion();

        $listsurccusale = $this->bureau->getSurccusale();

        $listsuc = [];

         if ($listsurccusale) 
            {

                $i=0;
                
                foreach ($listsurccusale as  $value)
                {
                    $listsuc[$value['libelle_suc']] = $value['libelle_suc'];
                            
                }

                
            }

        $list_pays = $this->bureau->getListPays();
        $listp = [];
        $listc = [];
            if ($list_pays) 
            {

                $i=0;
                
                foreach ($list_pays as  $value)
                {
                    $listp[$value['libelle_pays']] = $value['libelle_pays'];

                    $listc[$value['code_pays']] = $value['code_pays'];
                            
                }

                
            }

        $data_b['pays_existe'] = $listp;
        $data_b['code_existe'] = $listc;
        $data_b['list_pays'] = $list_pays;
        $data_b['surccusale_existe'] = $listsuc;
        $data_b['listsurccusale'] = $this->bureau->getSurccusale();
        $data_b['site_pays'] = $this->bureau->getSurccusalePays();

        // $data_b['groupes'] = $this->bureau->getGroupe();

// var_dump($listp);
        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/groupes', $data_b);
    }

    function getService() {

        $idgroupe = $_GET['id'];

        $usr_result1 = $this->bureau->getServiceByIdgroupe($idgroupe);


        $elt = array();
        foreach ($usr_result1 as $result) {
            array_push($elt, array(
                "idservice" => $result['idservice'],
                "libelleservice" => $result['libelleservice'],
            ));
        }
        header('Content-type: application/json');

        echo json_encode($elt);

    }

    function addgroupe() {

        $libellegroupe = $this->input->post('libellegroupe');

        $this->db->trans_begin();

        $this->bureau->addGroupe($libellegroupe);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('bureau/groupes');
    }


    function deletegroupe() {

        $id = $_GET['id'];

        $this->db->trans_begin();

        $this->bureau->deleteGroupe($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('bureau/groupes');
    }


    function services()
    {

        $data_l['title'] = 'Services';
        $data_l['menu'] = 'services';
        $data_l['submenu'] = '';

        $data = array();
        //$data_b['nbenattente'] = $this->>tb->nbregion();



        $Id_Surccusale = $_SESSION['fki_suc_us'];


        $listservice = $this->bureau->getServiceByIdSuc($Id_Surccusale);

        $listcode = $this->bureau->getServiceByIdSuc($Id_Surccusale);

        $service_existe = [];

         if ($listservice) 
            {

                $i=0;
                
                foreach ($listservice as  $value)
                {
                    $service_existe[$value['libelle_service']] = $value['libelle_service'];
                            
                }

                
            }



            $code_existe = [];

         if ($listcode) 
            {

                $i=0;
                
                foreach ($listcode as  $value)
                {
                    $code_existe[$value['code_service']] = $value['code_service'];
                            
                }

                
            }


        $data_b['service_existe'] = $service_existe;
        $data_b['code_existe'] = $code_existe;
        $data_b['services'] = $this->bureau->getServiceByIdSuc($Id_Surccusale);




        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/services', $data_b);
    }


    function service($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('libelleservice', 'Libelle service', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['title'] = 'Les services';
            $data_l['menu'] = 'services';
            $data_l['submenu'] = '';

            $Id_Surccusale = $_SESSION['fki_suc_us'];
            $data_b['groupe'] = $this->bureau->getSurccusale();
            $data_b['employe'] = $this->bureau->getUser($Id_Surccusale);

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/service', $data_b);

        } else {
            $libelleservice = $this->input->post('libelleservice');
            $fkidgroupe = $this->input->post('fkidgroupe');
            $chefservicefkidemp = $this->input->post('chefservicefkidemp');

            $this->db->trans_begin();

            $this->bureau->createService($libelleservice, $fkidgroupe, $chefservicefkidemp);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec de l'enregistrement du courrier</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Courrier enregistré avec succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('bureau/services');


        }

    }

    function editservice($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('libelleservice', 'Libelle service', 'trim|required');

        $id = $_GET['id'];

        if ($this->form_validation->run() == FALSE) {

            $data_l['title'] = 'Les services';
            $data_l['menu'] = 'services';
            $data_l['submenu'] = '';

            $data_b['service'] = $this->bureau->getServiceById($id);
            $data_b['groupe'] = $this->bureau->getGroupe();
            $data_b['employe'] = $this->bureau->getEmploye2();


            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/editservice', $data_b);

        } else {
            $libelleservice = $this->input->post('libelleservice');
            $fkidgroupe = $this->input->post('fkidgroupe');
            $chefservicefkidemp = $this->input->post('chefservicefkidemp');

            $this->db->trans_begin();

            $this->bureau->updateService($id, $libelleservice, $fkidgroupe, $chefservicefkidemp);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('bureau/services');


        }

    }

    /*add new emp by service create*/

    public function user($a=0) {
        $nomemp = $this->input->post('nomemp');
        $prenomemp = $this->input->post('prenomemp');
        $emailemp = $this->input->post('emailemp');
        $titreemp = $this->input->post('titreemp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->trans_begin();

        $this->bureau->createUser($nomemp, $prenomemp, $emailemp, $titreemp, $username, $password);

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
        redirect('bureau/service');
    }



    function deleteservice() {

        $id = $_GET['id'];
        $surccusale = $_SESSION['fki_suc_us'];

        $this->db->trans_begin();

        $this->bureau->deleteService($id,$surccusale);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('bureau/services');
    }


function submit_surccusale($value='')
{
    if ($this->input->post('surccusale')!=="")
    {
        $surccusale = $this->input->post('surccusale');
        $pays = $this->input->post('pays_suc');

       $surccusale1 = $this->remove_accents($surccusale);
       // $code1 = $this->remove_accents($code);
        
        $surccusale2 = strtoupper($surccusale1);
        // $code2 = strtoupper($code1);

        $site = $this->bureau->addsite($surccusale2,$pays);

        if ($site == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('bureau/groupes');
    }
}


 function submit_pays($value='')
{
    if ($this->input->post('pays')!=="")
    {
        $libellepays = $this->input->post('pays');
        $code = $this->input->post('code_pays');

       $libellepays1 = $this->remove_accents($libellepays);
       $code1 = $this->remove_accents($code);
        
        $libellepays2 = strtoupper($libellepays1);
        $code2 = strtoupper($code1);

        $pays = $this->bureau->addPaysCode($libellepays2,$code2);

        if ($pays == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('bureau/groupes');
    }
}


function submit_expediteur_plus($value='')
{
    if ($this->input->post('nomcomplet')!=="")
    {
        $nomcomplet = $this->input->post('nomcomplet');
        $email_exp = $this->input->post('email_exp');
        $tel_exp = $this->input->post('num_exp');

        // $surccusale = $_SESSION['fki_suc_us'];

        // $service = $this->bureau->addservice($libelleservice2,$surccusale);
        $expediteur = $this->bureau->add_expediteur($nomcomplet,$email_exp,$tel_exp);

        if ($expediteur == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('courrier/newcourrier1');
    }
}




function submit_expediteur($value='')
{
    if ($this->input->post('nomcomplet')!=="")
    {
        $nomcomplet = $this->input->post('nomcomplet');
        $email_exp = $this->input->post('email_exp');
        $tel_exp = $this->input->post('num_exp');

        // $surccusale = $_SESSION['fki_suc_us'];

        // $service = $this->bureau->addservice($libelleservice2,$surccusale);
        $expediteur = $this->bureau->add_expediteur($nomcomplet,$email_exp,$tel_exp);

        if ($expediteur == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('courrier/expediteur_courrier');
    }
}


function submit_dossier($value='')
{
    if ($this->input->post('libelle_dossier')!=="")
    {
        $libelle_dossier = $this->input->post('libelle_dossier');
        $code_dossier = $this->input->post('code_dossier');
        $typedossier = $this->input->post('typedossier');

        $surccusale = $_SESSION['fki_suc_us'];

        $code_dossier1 = $this->remove_accents($code_dossier);
         
        $code_dossier2 = strtoupper($code_dossier1);

        $libelle_dossier1 = $this->remove_accents($libelle_dossier);
         
        $libelle_dossier2 = strtoupper($libelle_dossier1);

        // $service = $this->bureau->addservice($libelleservice2,$surccusale);
        $dossier = $this->bureau->add_dossier($libelle_dossier2,$code_dossier2,$typedossier,$surccusale);

        if ($dossier == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('courrier/dossiers');
    }
}


function submit_service($value='')
{
    if ($this->input->post('service')!=="")
    {
        $libelleservice = $this->input->post('service');
        
        $libelleservice1 = $this->remove_accents($libelleservice);
       
        
        $libelleservice2 = strtoupper($libelleservice1);


        $codeservice = $this->input->post('code');

        $codeservice1 = $this->remove_accents($codeservice);
       
        
        $codeservice2 = strtoupper($codeservice1);



        $surccusale = $_SESSION['fki_suc_us'];

        $service = $this->bureau->addservice($libelleservice2,$codeservice2,$surccusale);

        if ($service == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('bureau/services');
    }
}

function submit_edit_service($value='')
{
    if ($this->input->post('service_edit')!=="")
    {
        $libelleservice = $this->input->post('service_edit');
        $codeservice = $this->input->post('code_edit');
        $service_id = $this->input->post('service_edit_name');

        $libelleservice1 = $this->remove_accents($libelleservice);
        $codeservice1 = $this->remove_accents($codeservice);
       
        
        $libelleservice2 = strtoupper($libelleservice1);
        $codeservice2 = strtoupper($codeservice1);




        $surccusale = $_SESSION['fki_suc_us'];

        $service = $this->bureau->edit_service($libelleservice2,$service_id,$codeservice2,$surccusale);

        if ($service == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('bureau/services');
    }
}


}
