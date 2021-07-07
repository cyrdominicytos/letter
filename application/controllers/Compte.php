<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller
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


    }

    public function index()
    {
        $this->activer_compte($value="");
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

    public function submit_compte($value="")
    {
            if($_SESSION['email_to_active'])
        {
             $this->load->helper(array('form')); 

             $this->form_validation->set_rules('password', 'Password non identique', 'trim|matches[confirmation]', array('matches' => 'Les mots de passe saisirs ne sont pas identiques'));

             $this->form_validation->set_rules('confirmation', 'confirmation', 'trim|callback_username_check',
                array('username_check'=>"Vous devez saisir au moins 8 caractères (un mélange de majuscule,minuscule,lettre,chiffre et caractère spécial)")
            );

            if ($this->form_validation->run() == FALSE) 
            {
        
            $this->load->view('pages/active_compte');
            }
            else
            {   
                $mdp =password_hash($this->input->post('confirmation'),PASSWORD_DEFAULT);
                $data1 = array(
                'pass' =>$mdp,
                'statut'=>1
            );
                
                $this->db->where('email', $_SESSION['email_to_active']);
                $this->db->update('user', $data1);
                redirect(base_url());
                // $this->load->view('pages/active_compte');
            }

  } 
   

        
}

public function reset($value='')
{   
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

    $data_b['EmailExiste'] = $list;

   $this->load->view('pages/reset',$data_b);
}

public function submit_reset($value='')
{
    if ($this->input->post('login')!=="") 
    {
        
        $login = $this->input->post('login');

        $info_user = $this->login->getInfoUserByEmail($login);
        
        $nom = (string)$info_user->nom_user;
        $prenom = (string)$info_user->prenom_user;
       
            
                $mailData = [
                            'sitename'=>"AKASI-CashManager",
                            'title'=>"Réinitialisation de mot de passe",
                            'titleMessage' => 'Salut, '. $prenom.' '. $nom.' <br><br>Veuillez suivre le lien ci-dessous pour réinitialiser votre mot de passe.',
                              'option'=> 3,
                              
                              'destination' => $login,
                              'id' => $login
                        ];
                                    // helper('mail');
                                    mailTemplate3($mailData);
        
                                    redirect(base_url());
}
else
{
    $this->load->view('pages/login');
}

}



}