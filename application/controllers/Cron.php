<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller
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
        $this->load->helper('mail');
        $this->load->library('form_validation');

        $this->load->model('CourrierModel', 'courrier');
        $this->load->model('BureauModel', 'bureau');
        $this->load->model('LoginModel', 'login');

        require_once FCPATH . 'application/libraries/phpmailer/PHPMailerAutoload.php';

        // if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
        //     redirect(base_url());
        //     die();
        // }


    }

    function relancecourrier()
    {
        $courrier = $this->courrier->getAllCourrierSave1();
        foreach ($courrier as $key => $value) {

            if ($value['relance']==date('Y-m-d')) {

                $user_info = $this->courrier->getUsersendmail($value['fki_user_dif']);

                $mailData = [
                                'sitename'=>"AKASI-LetterBox",
                                'title'=>"Notification de relance de courrier sur LetterBox",
                                'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions concernant la relance du courrier<b style="color: blue;font-family:Arial,Helvetica,sans-serif;"> ' .$value['num_courrier']. '</b> dont la date limite de traitement est le ' .$value['limite']. '.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                          'option'=> 1,
                          
                          'destination' => $user_info->email
                          
                    ];
                               
                                mailTemplate1($mailData);

               // var_dump($value['relance']);
            }
            
        }

         // var_dump($courrier);

    } 


}