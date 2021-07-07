<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courrier extends CI_Controller
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

        if (!isset($_SESSION['logged']) || $_SESSION['logged'] === false) {
            redirect(base_url());
            die();
        }


    }

    Function remove_accents( $text, $charset='utf-8' )
        {
         $text = htmlentities( $text, ENT_NOQUOTES, $charset );
    
    $text = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $text );
    $text = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $text );
    $text = preg_replace( '#&[^;]+;#', '', $text );
    
    return $text;
        } 

    function sendmailing($msgResponse,$subjetResponse, $DestResponse, $docs)
    {

        //$mail = new PHPMailer(true);

        // PHPMailer object
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP


            $mail->Host = 'mail.akasigroup.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'support@akasigroup.com';                     // SMTP username
            $mail->Password = 'Akasi2015';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('support@akasigroup.com', 'LetterBox');

            $mail->addAddress($DestResponse, $DestResponse);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            if($docs != '') {

                $mail->addAttachment(base_url().'assets/docs/'.$docs);
            }
            /// Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subjetResponse;
            $mail->Body = <<<M
<p style="margin-bottom: 0.5cm;" align="justify"><span style="font-family: verdana,geneva;">
$msgResponse
<p style="margin-bottom: 0.5cm;" align="center"><span style="font-family: impact,chicago;">
Tous droits r&eacute;serv&eacute;s &copy; 2019 | LetterBox application.</span></p>
</p>
M;

            $mail->send();
            $msg1 = "<div class='alert alert-success'>Mail envoyé avec succès</div>";
            $this->session->set_flashdata('msg', $msg1);
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $msg1 = "<div class='alert alert-danger'>'Mail non envoyé. Mailer Error: {$mail->ErrorInfo}'</div>";
            $this->session->set_flashdata('msg', $msg1);
        }
    }

    function sendmailing2($exp, $fkIdDest)
    {

        //$mail = new PHPMailer(true);

        // PHPMailer object
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP


            $mail->Host = 'mail.akasigroup.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'support@akasigroup.com';                     // SMTP username
            $mail->Password = 'Akasi2015';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('support@akasigroup.com', 'LetterBox');

            $mail->addAddress($exp->email, $exp->prenom_user.' '.$exp->nom_user);     // Add a recipient

			if($fkIdDest != '') {
				foreach ($fkIdDest as $key => $item) {
					if($exp->id_user != $fkIdDest[$key]) {

						//$this->sendmailing3($this->courrier->getEmp($fkIdDest[$key]));
						$destcopie = $this->courrier->getUsersendmail($fkIdDest[$key]);
						$mail->addBCC($destcopie->email, $destcopie->prenom_user.' '.$destcopie->nom_user);

					}
				}
			}
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments

            /// Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $url = site_url();
			//$url = 'letterbox.akasigroup.com';
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = utf8_encode('Notification de réception de courrier sur LetterBox');
            $mail->Body = <<<M
<p style="margin-bottom: 0.5cm;" align="left"><span style="font-family: verdana,geneva;">Bonjour,</span>
<br>
<br>
Nous vous notifions que vous venez de recevoir un courrier sur la plateforme Letterbox. 
<br>
Veuillez vous connecter pour consulter votre compte.
</p>
<p style="margin-bottom: 0.5cm;" align="justify"><span style="font-family: verdana,geneva;">

<table style="border: none;">
<tr><td><strong>Lien  :</strong> </td><td><a href="$url">Letterbox</a></td></tr>
</table>


<br>
<br>Cordialement, <br> Votre équipe letterBox</span>

<p style="margin-bottom: 0.5cm;" align="center"><span style="font-family: impact,chicago;">Tous droits r&eacute;serv&eacute;s &copy; 2019 | LetterBox application.</span></p>
<p style="margin-bottom: 0.5cm;" align="justify"><span style="font-family: verdana,geneva;">

</p>
M;

            $mail->send();
            $msg1 = "<div class='alert alert-success'>Mail envoyé avec succès</div>";
            $this->session->set_flashdata('msg', $msg1);
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $msg1 = "<div class='alert alert-danger'>'Mail non envoyé. Mailer Error: {$mail->ErrorInfo}'</div>";
            $this->session->set_flashdata('msg', $msg1);
        }
    }


	function sendmailing3($exp)
	{

		//$mail = new PHPMailer(true);

		// PHPMailer object
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->CharSet = 'UTF-8';
			$mail->SMTPDebug = 0;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP


			$mail->Host = 'mail.akasigroup.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                                   // Enable SMTP authentication
			$mail->Username = 'support@akasigroup.com';                     // SMTP username
			$mail->Password = 'Akasi2015';                               // SMTP password
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('support@akasigroup.com', 'LetterBox');

			$mail->addAddress($exp->emailemp, $exp->nomemp.' '.$exp->prenomemp);     // Add a recipient
			//$mail->addAddress('ellen@example.com');               // Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			// Attachments

			/// Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			$url = 'letterbox.akasigroup.com';
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = utf8_encode('Notification de réception de courrier sur LetterBox');
			$mail->Body = <<<M
<p style="margin-bottom: 0.5cm;" align="left"><span style="font-family: verdana,geneva;">Bonjour,</span>
<br>
<br>
Nous vous notifions que vous venez de recevoir un courrier dont vous en copie sur la plateforme Letterbox. 
<br>
Veuillez vous connecter pour consulter votre compte.
</p>
<p style="margin-bottom: 0.5cm;" align="justify"><span style="font-family: verdana,geneva;">

<table style="border: none;">
<tr><td><strong>Lien  :</strong> </td><td><a href="$url">Letterbox</a></td></tr>
</table>


<br>
<br>Cordialement, <br> Votre équipe letterBox</span>

<p style="margin-bottom: 0.5cm;" align="center"><span style="font-family: impact,chicago;">Tous droits r&eacute;serv&eacute;s &copy; 2019 | LetterBox application.</span></p>
<p style="margin-bottom: 0.5cm;" align="justify"><span style="font-family: verdana,geneva;">

</p>
M;

			$mail->send();
			$msg1 = "<div class='alert alert-success'>Mail envoyé avec succès</div>";
			$this->session->set_flashdata('msg', $msg1);
		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$msg1 = "<div class='alert alert-danger'>'Mail non envoyé. Mailer Error: {$mail->ErrorInfo}'</div>";
			$this->session->set_flashdata('msg', $msg1);
		}
	}

    public function index()
    {
        //$this->tb();
    }


    function avalider()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'avalider';

        $data_b['courriers'] = $this->courrier->getCourrierAValider();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/avalider', $data_b);
    }

    function atraiter()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'atraiter';

        //$this->courrier->readcourrieratraiter();

        $surccusale = $_SESSION['fki_suc_us'];

        $document = $this->courrier->getAlldoc();

        $document_existe = [];

         if ($document) 
            {

                $i=0;
                
                foreach ($document as  $value)
                {
                    $document_existe[$value['fki_courrier_doc']] = $value['chemin'];
                            
                }

                
            }

        $data_b['document_existe'] = $document_existe;


        $liste_dossier = $this->courrier->getDossier($surccusale);

        $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

        $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

        $listservice = $this->bureau->getServiceByIdSuc($surccusale);

        $data_b['employe'] = $liste_destinataire;

        $data_b['dossier'] = $liste_dossier;

        $data_b['service'] = $listservice;


		// $data_b['service'] = $this->courrier->getService();
		// $data_b['dossier'] = $this->courrier->getDossier();
		// $data_b['employe'] = $this->courrier->getEmploye2();

        $document = $this->courrier->getAlldoc();

        $document_existe = [];

         if ($document) 
            {

                $i=0;
                
                foreach ($document as  $value)
                {
                    $document_existe[$value['fki_courrier_doc']] = $value['chemin'];
                            
                }

                
            }

        $data_b['document_existe'] = $document_existe;



        $data_b['courriers'] = $this->courrier->getAllCourrierAtraiter(); 

        // $this->courrier->getCourrierATraiter();

        //var_dump($data_b['courriers']);
        //die('e');





           $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        $data_b['document_existe'] = $document;
        // echo "<pre>";
        // var_dump($data_b['docs']);
        // echo "<pre>";

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/atraiter', $data_b);
    }

    function viewavalider()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'avalider';

        $id = $_GET['id'];
        $this->load->helper(array('form'));

        $this->form_validation->set_rules('numcourier', 'Numéro courrier', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_b['courriers'] = $this->courrier->getCourrierAValiderById($id);
            $data_b['service'] = $this->courrier->getService();
            $data_b['employe'] = $this->courrier->getEmploye2();

            $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/bootstrap-datepicker/css/datepicker.css',
            );

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/viewavalider', $data_b);
        } else {
            $prioriteCourier = $this->input->post('prioriteCourier');
            $objetCourier = $this->input->post('objetCourier');
            $destCourier = $this->input->post('destCourier');
            $dateLimittraiteCourier = $this->input->post('dateLimittraiteCourier');


            $numcourier = $this->input->post('numcourier');
            $categorieCourier = $this->input->post('categorieCourier');
            $typeCourier = $this->input->post('typeCourier');
            $dateCourier = $this->input->post('dateCourier');
            $natureCourier = $this->input->post('natureCourier');

            $expCourier = $this->input->post('expCourier');
            $serviceInit = $this->input->post('serviceInit');


            if ($_FILES["linkDoc"]['name']!= '')  {
                $target_dir = FCPATH . 'assets/docs/';

                $nomOrigine = $_FILES['linkDoc']['name'];
                $elementsChemin = pathinfo($nomOrigine);
                $extensionFichier = $elementsChemin['extension'];

                $nomDestination = "AKASILETTERBOX_". date("YmdHi") . '-' . $typeCourier . "." . $extensionFichier;

                $nomDestination = strtolower($nomDestination);
                if (move_uploaded_file($_FILES["linkDoc"]["tmp_name"], $target_dir . $nomDestination)) {
                    $linkDoc = $nomDestination;
                } else {
                    $linkDoc = "";
                }
            } else {
                $linkDoc = "";
            }


            $linkDocOld = $this->input->post('linkDocOld');

            if ($linkDoc == '') {
                $linkDoc = $linkDocOld;
            }


            $this->db->trans_begin();

            $this->courrier->updateCourrierByChef($id, $natureCourier, $dateCourier, $typeCourier, $categorieCourier, $numcourier,
                $linkDoc, $prioriteCourier, $objetCourier, $destCourier, $dateLimittraiteCourier, $expCourier, $serviceInit);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec</div>";
                $this->session->set_flashdata('msg', $msg);
            } else {
                $this->db->trans_commit();
                $this->sendmailing2($this->courrier->getEmp($destCourier));
                $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);
            }
            redirect('courrier/avalider');
        }
    }


    function savefiche()
    {
        $id = $_GET['id'];
        // var_dump($_SESSION['liste_dest']);
        // var_dump($_SESSION['liste_encopie']);
        // var_dump($id);
       
        $id_courrier = $id;
        $destCourier = $_SESSION['liste_dest'];
        // var_dump($destCourier);
        $count_dest = count($destCourier);
            
            $statut = 1;

            for($i=0;$i<$count_dest;$i++){

                if ($destCourier[$i] !='') {

                $id_dest = $destCourier[$i];
                $destinataire = $this->courrier->getEmailByUserId($id_dest);
                // $this->courrier->addDif($id_courrier,$statut,$id_dest);
                // $this->sendmailing2($this->courrier->getUsersendmail($id_dest), $fkIdDest);
                // $id_dif = $this->db->insert_id();
                $user_info = $this->courrier->getUsersendmail($id_dest);
                $mailData = [
                                'sitename'=>"AKASI-LetterBox",
                                'title'=>"Notification de réception de courrier sur LetterBox",
                                'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                          'option'=> 1,
                          
                          'destination' => $user_info->email
                          
                    ];
                               
                                mailTemplate1($mailData);
                
                    
                }

            }

           $fkIdDest = $_SESSION['liste_encopie'];

            if ($fkIdDest!='' ){
                
                $count_dest_dif = count($fkIdDest);

                $statut = 4;

                for($i=0;$i<$count_dest_dif;$i++){

                if ($fkIdDest[$i] !='') {

                $id_dest_dif = $fkIdDest[$i];
                $destinataire_diff = $this->courrier->getEmailByUserId($id_dest_dif);
                // $this->courrier->addDif($id_courrier,$statut,$id_dest_dif);

                $user_info = $this->courrier->getUsersendmail($id_dest_dif);
                $mailData = [
                                'sitename'=>"AKASI-LetterBox",
                                'title'=>"Notification de réception de courrier sur LetterBox",
                                'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier dont vous êtes en copie sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                          'option'=> 1,
                          
                          'destination' => $user_info->email,
                          // 'id' => $this->input->post('emailemp')
                    ];
                                // helper('mail');
                                mailTemplate1($mailData);
                    
                }
            
            }
        }


         $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);
                // redirect('courrier/courrier');
                $this->print($id);
    }


    function retour(){

    $id = $_GET['id'];
     // echo $id;
     $this->courrier->deleteFichedif($id);
     $this->courrier->deleteFicheCourrier($id);
     $this->courrier->deleteFicheAppel($id);
     $this->courrier->deleteFicheFacture($id);
     $this->courrier->deleteFichedoc($id);
     // $this->courrier->deleteFicheAppel($id);
     // $this->courrier->deleteFicheCourrier($id);
     // $msg = "<div class='alert alert-success'>Supprimer avec succès!</div>";
     //        $this->session->set_flashdata('msg', $msg);

    redirect('courrier/newcourrier1');
    }


    function deletefiche(){

    $id = $_GET['id'];
     // echo $id;
     $this->courrier->deleteFichedif($id);
     $this->courrier->deleteFicheCourrier($id);
     $this->courrier->deleteFicheAppel($id);
     $this->courrier->deleteFicheFacture($id);
     $this->courrier->deleteFichedoc($id);
     // $this->courrier->deleteFicheAppel($id);
     // $this->courrier->deleteFicheCourrier($id);
     $msg = "<div class='alert alert-success'>Supprimé avec succès!</div>";
            $this->session->set_flashdata('msg', $msg);

    redirect('courrier/courrier');
    }

    function viewatraiter()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'atraiter';

        $id = $_GET['id'];

        
        $this->load->helper(array('form'));

            $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

        $courrier = $this->courrier->getAllCourrierAtraiterById($id);

        // $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        // $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
        //         $data_b['dest'] = $destinataires;
        //         $data_b['copie'] = $listcopie;


        // $courrier = $this->courrier->getAllCourrierSaveById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierAtraiterById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelAtraiterById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureAtraiterById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($courrier);

        $id2 = $this->courrier->getIdCourrierByIddif($id);

        // var_dump($id2);
        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id2);


        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id2);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;


                $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;
		// $this->courrier->readcourrieratraiter1($id);

        // $data_b['courriers'] = $this->courrier->getCourrierATraiterById($id);
        // $data_b['service'] = $this->courrier->getService();
        // $data_b['employe'] = $this->courrier->getEmploye2();

        // $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
        // $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
            'assets/api/summernote/dist/summernote.css',
            'assets/api/summernote/dist/summernote-bs3.css'
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/viewatraiter', $data_b);

    }



    function archivercourrier() {

		$id_dif = $this->input->post('idCourierTraite');
        // var_dump($id_dif);

		$this->db->trans_begin();

        $i = 0;
        $id_dif2 = 0;
        foreach ($id_dif as $key => $value) {
                        $this->courrier->archiveCourrier($value);

           
        }

		// $this->courrier->archivercourrier($idCourierTraite);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$msg = "<div class='alert alert-danger'>Courrier non achivé</div>";
			$this->session->set_flashdata('msg', $msg);
		} else {
			$this->db->trans_commit();
			$msg = "<div class='alert alert-success'>Courrier archivé!</div>";
			$this->session->set_flashdata('msg', $msg);
		}
		redirect('courrier/atraiter#home2');
	}

	function transferercourrier() {

		$id_dif = $this->input->post('idCourierTraite');
		$fkIdDest = $this->input->post('fkIdDest');

        $count_dest = count($fkIdDest);
            
            // $statut = 1;

            for($i=0;$i<$count_dest;$i++){

                if ($fkIdDest[$i] !='') {

                $id_dest = $fkIdDest[$i];
                $destinataire = $this->courrier->getEmailByUserId($id_dest);
                // $this->courrier->addDif($id_courrier,$statut,$id_dest);
                // $this->sendmailing2($this->courrier->getUsersendmail($id_dest), $fkIdDest);
                // $id_dif = $this->db->insert_id();
                $user_info = $this->courrier->getUsersendmail($id_dest);
                $mailData = [
                                'sitename'=>"AKASI-LetterBox",
                                'title'=>"Notification de réception de courrier sur LetterBox",
                                'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Un ou plusieurs courriers vous ont été transférés sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                          'option'=> 1,
                          
                          'destination' => $user_info->email
                          
                    ];
                               
                                mailTemplate1($mailData);
                
                    
                }
            }

        $this->db->trans_begin();
       
        $id_courrier = 0;
        foreach ($id_dif as $key => $value) {
            
            $id_courrier = $this->courrier->getIdCourrierByIddif($value);
           
                $this->courrier->transfertCourrier($id_courrier, $fkIdDest);
           
        }

		// $this->courrier->transferercourrier($idCourierTraite, $fkIdDest);



		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$msg = "<div class='alert alert-danger'>Courrier non transféré</div>";
			$this->session->set_flashdata('msg', $msg);
		} else {
			$this->db->trans_commit();
			$msg = "<div class='alert alert-success'>Courrier(s) transféré(s)!</div>";
			$this->session->set_flashdata('msg', $msg);
		}
		redirect('courrier/atraiter#home2');
	}

    function viewencopie()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'encopie';

        $id = $_GET['id'];
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];
        

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

            $data_b['depart'] = $this->courrier->getDepart();
            $data_b['arrive'] = $this->courrier->getArrive();
        // $data_b['courriers'] = $this->courrier->getAllCourrierEncopieById($id);

            $id2 = $this->courrier->getIdCourrierByIddif($id);

        // var_dump($id2);
        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id2);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id2);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        $courrier = $this->courrier->getAllCourrierEncopieById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        
        // var_dump($courrier);
        $type = $this->courrier->getAllCourrierEncopieById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelEncopieById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureEncopieById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        

        $data_b['courriers'] = $this->courrier->getAllCourrierEncopie();


        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;
        // $data_b['courriers'] = $this->courrier->getCourrierEnCopieById($id);
        // $data_b['service'] = $this->courrier->getService();
        // $data_b['employe'] = $this->courrier->getEmploye2();


        // $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
        // $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
            'assets/api/summernote/dist/summernote.css',
            'assets/api/summernote/dist/summernote-bs3.css'
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/viewencopie', $data_b);

    }

    function viewenregistrer()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $_GET['id'];
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

        $courrier = $this->courrier->getAllCourrierSaveById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierSaveById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureView($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($courrier);


        // $data_b['courriers'] = $this->courrier->getAllCourrierSaveById($id);

        // $data_b['courriers'] = $this->courrier->getCourrierEnregistrerById($id);

        // $data_b['service'] = $this->courrier->getService();
        // $data_b['employe'] = $this->courrier->getEmploye2();

        // $data_b['dossier'] = $this->courrier->getDossier();
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        // $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
        // $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/vue_detaillee', $data_b);

    }




    function consulter_view()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $_GET['id'];
        
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

        $id_courrier=$this->courrier->getIdCourrierByNumCourrier($id);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id_courrier);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id_courrier);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

                // var_dump($destinataires);


        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            

        $courrier = $this->courrier->getAllCourrierConsultView($id)[0];
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();


        

        // $type = $this->courrier->getAllCourrierSaveById($id);
        $type = $this->courrier->getAllCourrierConsultView($id);
        foreach ($type as $key => $value) {
           
        //    //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConsultCallView($id)[0];
            } 
        //     //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConsultFactureView($id)[0];
                
            }
            
        }

        
        // var_dump($courrier);

        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;
        

        // $data_b['dossier'] = $this->courrier->getDossier();
        // $data_b['depart'] = $this->courrier->getDepart();
        // $data_b['arrive'] = $this->courrier->getArrive();
        $data_b['liste_courrier'] = $courrier;

        

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/consulter_courrier_lier', $data_b);

    }



    function viewenregistrer1()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $_GET['id'];
        
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

                // var_dump($destinataires);


        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            

        $courrier = $this->courrier->getAllCourrierSaveView($id)[0];
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();


        

        // $type = $this->courrier->getAllCourrierSaveById($id);
        $type = $this->courrier->getAllCourrierSaveView($id);
        foreach ($type as $key => $value) {
           
        //    //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierSaveCallView($id)[0];
            } 
        //     //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierSaveFactureView($id)[0];
                
            }
            
        }

        
        // var_dump($courrier);

        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;
        

        // $data_b['dossier'] = $this->courrier->getDossier();
        // $data_b['depart'] = $this->courrier->getDepart();
        // $data_b['arrive'] = $this->courrier->getArrive();
        $data_b['liste_courrier'] = $courrier;

        

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/vue_detaillee_save', $data_b);

    }



    function viewconfirmation()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $_GET['id'];
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

        $courrier = $this->courrier->getAllCourrierSaveById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierSaveById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureView($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($courrier);


        // $data_b['courriers'] = $this->courrier->getAllCourrierSaveById($id);

        // $data_b['courriers'] = $this->courrier->getCourrierEnregistrerById($id);

        // $data_b['service'] = $this->courrier->getService();
        // $data_b['employe'] = $this->courrier->getEmploye2();

        // $data_b['dossier'] = $this->courrier->getDossier();
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        // $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
        // $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
        );

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/vue_detaillee', $data_b);

    }


	function viewtransferer()
	{

		$data_l['title'] = 'Courriers';
		$data_l['menu'] = 'courriers';
		$data_l['submenu'] = 'transferer';

		$id = $_GET['id'];

		$this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

        $courrier = $this->courrier->getAllCourrierTransfererById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierTransfererById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelTransfererById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureTransfererById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($courrier[0]);




        $data_b['courriers'] = $this->courrier->getAllCourrierTransferer();

        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

         $id2 = $this->courrier->getIdCourrierByIddif($id);

        // var_dump($id2);
        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id2);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id2);

        $data_b['dest'] = $destinataires;
        $data_b['copie'] = $listcopie;

        
		// $data_b['courriers'] = $this->courrier->getCourrierTransfererById($id);

		//var_dump($data_b['courriers']);die('e');

		// $data_b['service'] = $this->courrier->getService();
		// $data_b['employe'] = $this->courrier->getEmploye2();

		// $data_b['dossier'] = $this->courrier->getDossier();
		$data_b['depart'] = $this->courrier->getDepart();
		$data_b['arrive'] = $this->courrier->getArrive();

		// $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
		// $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

		$data_l['css'] = array(
			'assets/css/bootstrap-timepicker.min.css',
			'assets/api/bootstrap-datepicker/css/datepicker.css',
		);

		$this->load->view('templates/left', $data_l);
		$this->load->view('templates/top');
		$this->load->view('pages/viewtransferer', $data_b);

	}

	function viewarchiver()
	{



		$data_l['title'] = 'Courriers';
		$data_l['menu'] = 'courriers';
		$data_l['submenu'] = 'archiver';

		$id = $_GET['id'];

		$this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;


        $courrier = $this->courrier->getAllCourrierArchiverById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        $data_b['courriers'] = $this->courrier->getAllCourrierArchiver();

        $type = $this->courrier->getAllCourrierArchiverById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelArchiverById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureArchiverById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($courrier[0]);

        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        // $data_b['courriers'] = $this->courrier->getAllCourrierSaveById($id);

        // $data_b['courriers'] = $this->courrier->getCourrierEnregistrerById($id);

        // $data_b['service'] = $this->courrier->getService();
        // $data_b['employe'] = $this->courrier->getEmploye2();

        // $data_b['dossier'] = $this->courrier->getDossier();
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        $id2 = $this->courrier->getIdCourrierByIddif($id);

        // var_dump($id2);
        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id2);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id2);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        // $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
        // $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

        $data_l['css'] = array(
            'assets/css/bootstrap-timepicker.min.css',
            'assets/api/bootstrap-datepicker/css/datepicker.css',
        );

		// $data_b['courriers'] = $this->courrier->getCourrierArchiverById($id);

		// $data_b['service'] = $this->courrier->getService();
		// $data_b['employe'] = $this->courrier->getEmploye2();

		// $data_b['dossier'] = $this->courrier->getDossier();
		// $data_b['depart'] = $this->courrier->getDepart();
		// $data_b['arrive'] = $this->courrier->getArrive();

		// $data_b['notes'] = $this->courrier->getNoteByCourrier($id);
		// $data_b['reponses'] = $this->courrier->getreponseByCourrier($id);

		// $data_l['css'] = array(
		// 	'assets/css/bootstrap-timepicker.min.css',
		// 	'assets/api/bootstrap-datepicker/css/datepicker.css',
		// );

		//var_dump($data_b['courriers'] );
		//die('r');

		$this->load->view('templates/left', $data_l);
		$this->load->view('templates/top');
		$this->load->view('pages/viewarchiver', $data_b);

	}






	function newnotecopie() {
        $fkIdCourierTraiter = $this->input->post('fkIdCourierTraiter');
        $fkIdCourier = $this->input->post('fkIdCourier');
        $fkIdInitiateurNote = $this->input->post('fkIdInitiateurNote');
        $objetNote = $this->input->post('objetNote');

        $this->db->trans_begin();

        $this->courrier->newnote($fkIdCourierTraiter, $fkIdCourier, $fkIdInitiateurNote, $objetNote);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('courrier/viewencopie?id='.$fkIdCourier.'#profile2');
    }

    function newnote() {

        $fkIdCourierTraiter = $this->input->post('fkIdCourierTraiter');
        $fkIdCourier = $this->input->post('fkIdCourier');
        $fkIdInitiateurNote = $this->input->post('fkIdInitiateurNote');
        $objetNote = $this->input->post('objetNote');

        $this->db->trans_begin();

        $this->courrier->newnote($fkIdCourierTraiter, $fkIdCourier, $fkIdInitiateurNote, $objetNote);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('courrier/aiter?id='.$fkIdCourier.'#profile2');
    }

    function newresponse() {
        $fkIdCourierTraiter = $this->input->post('fkIdCourierTraiter');
        $fkIdCourier = $this->input->post('fkIdCourier');
        $fkIdExpResponse = $this->input->post('fkIdExpResponse');
        $msgResponse = $this->input->post('msgResponse');
        $subjetResponse = $this->input->post('subjetResponse');
        $DestResponse = $this->input->post('DestResponse');

        if ($_FILES["piecejointeResponse"]['name']!= '') {
            $target_dir = FCPATH . 'assets/docs/';

            $nomOrigine = $_FILES['piecejointeResponse']['name'];
            $elementsChemin = pathinfo($nomOrigine);
            $extensionFichier = $elementsChemin['extension'];

            $nomDestination = "AKASILETTERBOX_" . date("YmdHi") . '_Piece' ."." . $extensionFichier;

            $nomDestination = strtolower($nomDestination);
            if (move_uploaded_file($_FILES["piecejointeResponse"]["tmp_name"], $target_dir . $nomDestination)) {
                $docs = $nomDestination;
            } else {
                $docs = "";
            }
        } else {
            $docs = "";
        }

        $this->db->trans_begin();

        $this->courrier->newresponse($fkIdCourierTraiter, $fkIdCourier, $fkIdExpResponse, $msgResponse,
            $subjetResponse, $DestResponse, $docs);



        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $this->sendmailing($msgResponse,$subjetResponse, $DestResponse, $docs);
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }
        redirect('courrier/viewatraiter?id='.$fkIdCourier.'#about2');
    }

    function modifier() {

        $id = $_GET['id'];

        $prioriteCourier = $this->input->post('prioriteCourier');
        $objetCourier = $this->input->post('objetCourier');
        $destCourier = $this->input->post('destCourier');
        $dateLimittraiteCourier = $this->input->post('dateLimittraiteCourier');


        $numcourier = $this->input->post('numcourier');
        $categorieCourier = $this->input->post('categorieCourier');
        $typeCourier = $this->input->post('typeCourier');
        $dateCourier = $this->input->post('dateCourier');
        $natureCourier = $this->input->post('natureCourier');

        $expCourier = $this->input->post('expCourier');
        $serviceInit = $this->input->post('serviceInit');

        $fkIdDossier = $this->input->post('fkIdDossier');
        $lieidCourierTraite = $this->input->post('lieidCourierTraite');

        if ($_FILES["linkDoc"]['name']!= '') {
            $target_dir = FCPATH . 'assets/docs/';

            $nomOrigine = $_FILES['linkDoc']['name'];
            $elementsChemin = pathinfo($nomOrigine);
            $extensionFichier = $elementsChemin['extension'];

            $nomDestination = "AKASILETTERBOX_". date("YmdHi") . '-' . $typeCourier . "." . $extensionFichier;

            $nomDestination = strtolower($nomDestination);
            if (move_uploaded_file($_FILES["linkDoc"]["tmp_name"], $target_dir . $nomDestination)) {
                $linkDoc = $nomDestination;
            } else {
                $linkDoc = "";
            }
        } else {
            $linkDoc = "";
        }


        $linkDocOld = $this->input->post('linkDocOld');

        if ($linkDoc == '') {
            $linkDoc = $linkDocOld;
        }


        $this->db->trans_begin();


        $this->courrier->updateCourrierByInitiateur($id, $natureCourier, $dateCourier, $typeCourier, $categorieCourier, $numcourier,
            $linkDoc, $prioriteCourier, $objetCourier, $destCourier, $dateLimittraiteCourier, $expCourier, $serviceInit, $fkIdDossier,
            $lieidCourierTraite);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
        } else {
            $this->db->trans_commit();
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);

			foreach ($destCourier as $key=>$item) {
				$this->sendmailing2($this->courrier->getEmp($destCourier[0]), $fkiddest='');
			}
        }
        redirect('courrier/courrier');
    }


    function encopie()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'encopie';


                $surccusale = $_SESSION['fki_suc_us'];

        $document = $this->courrier->getAlldoc();

        $document_existe = [];

         if ($document) 
            {

                $i=0;
                
                foreach ($document as  $value)
                {
                    $document_existe[$value['fki_courrier_doc']] = $value['chemin'];
                            
                }

                
            }

        $data_b['document_existe'] = $document_existe;
        

        $liste_dossier = $this->courrier->getDossier($surccusale);

        $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

        $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

        $listservice = $this->bureau->getServiceByIdSuc($surccusale);

        $data_b['employe'] = $liste_destinataire;

        $data_b['dossier'] = $liste_dossier;

        $data_b['service'] = $listservice;


        // $data_b['service'] = $this->courrier->getService();
        // $data_b['dossier'] = $this->courrier->getDossier();
        // $data_b['employe'] = $this->courrier->getEmploye2();

        $document = $this->courrier->getAlldoc();

        $document_existe = [];

         $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        $data_b['document_existe'] = $document;

        
        $data_b['courriers'] = $this->courrier->getAllCourrierEncopie();

        // $data_b['courriers'] = $this->courrier->getAllCourrierAtraiter();

        //$this->courrier->readcourrierencopie();
        // $data_b['courriers'] = $this->courrier->getCourrierEnCopie();

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/encopie', $data_b);
    }

	function transferer()
	{

		$data_l['title'] = 'Courriers';
		$data_l['menu'] = 'courriers';
		$data_l['submenu'] = 'transferer';

        $document = $this->courrier->getAlldoc();

        $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        $data_b['document_existe'] = $document;

		//$this->courrier->readcourrierencopie();
		$data_b['courriers'] = $this->courrier->getAllCourrierTransferer();

        // $data_b['courriers'] = $this->courrier->getCourrierTransferer();

		//var_dump($data_b['courriers']);
		//die('e');

		$this->load->view('templates/left', $data_l);
		$this->load->view('templates/top');
		$this->load->view('pages/transferer', $data_b);
	}

	function archiver()
	{

		$data_l['title'] = 'Courriers';
		$data_l['menu'] = 'courriers';
		$data_l['submenu'] = 'archiver';

        $document = $this->courrier->getAlldoc();

        $document_existe = [];

          $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        $data_b['document_existe'] = $document;
        // echo "<pre>";
        // var_dump($data_b['docs']);
        // echo "<pre>";
        
        $data_b['courriers'] = $this->courrier->getAllCourrierArchiver();

		
		// $data_b['courriers'] = $this->courrier->getCourrierArchiver();

		$this->load->view('templates/left', $data_l);
		$this->load->view('templates/top');
		$this->load->view('pages/archiver', $data_b);
	}


	function courrier()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        // $data_b['courriers'] = $this->courrier->getCourrierSave();

        $destinataires = $this->courrier->getAllDifSave();

                $temp =[];
                $dest =[];
                $a = 0;
                $b=0;


 foreach ($destinataires as  $value) {
                if($a== $value['fki_courrier_dif'] || $a==0){
                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user'] ];
                    $temp[$b] = $temp1;
                    $a= $value['fki_courrier_dif'];
                    $b++;

                // echo $value['prenom_user'];

                }else{
                
                    if(array_key_exists($a, $dest))
                    {
                        $dest[$a][count($dest[$a])]=  $temp[0];
                    }else{
                         $dest[$a] = $temp;
                    }

                    $temp = [];
                    $b = 0;

                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user']];
                    $temp[$b] = $temp1;
                    $a= $value['fki_courrier_dif'];
                    $b++;



                }



                }
                $dest[$a] = $temp;
                $data_b['dest'] = $dest;

                $listcopie = $this->courrier->getAllDifSavecopie2();
                // echo "<pre>";
                // var_dump($listcopie);
                // echo "<pre>";
                $temp =[];
                $copie =[];
                $d = 0;
                $e=0;


 foreach ($listcopie as  $value) {
                if($d== $value['fki_courrier_dif'] || $d==0){
                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user'] ];
                    $temp[$e] = $temp1;
                    $d= $value['fki_courrier_dif'];
                    $e++;

                    // echo $temp1['fullname'];
                // echo $value['prenom_user'];

                }else{
                
                    if(array_key_exists($d, $copie))
                    {
                        $copie[$e][count($copie[$d])]=  $temp[0];
                    }else{
                         $copie[$d] = $temp;
                    }

                    $temp = [];
                    $e = 0;

                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user']];
                    $temp[$e] = $temp1;
                    $d= $value['fki_courrier_dif'];
                    $e++;

                    // echo $temp1['fullname'];

                }

                // $copie[$d] = $temp;
                  // var_dump($temp);

                }
                $copie[$d] = $temp;
                $data_b['copie'] = $copie;

                // echo "<pre>";
                // var_dump($copie);
                // echo "<pre>";


 //    $listcopie = $this->courrier->getAllDifCopie();

 //                $temp =[];
 //                $copie =[];
 //                $a = 0;
 //                $b=0;


 // foreach ($listcopie as  $value) {
 //                if($a== $value['fki_courrier_dif'] || $a==0){
 //                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user'] ];
 //                    $temp[$b] = $temp1;
 //                    $a= $value['fki_courrier_dif'];
 //                    $b++;

 //                // echo $value['prenom_user'];

 //                }else{
                
 //                    if(array_key_exists($a, $copie))
 //                    {
 //                        $dest[$a][count($dest[$a])]=  $temp[0];
 //                    }else{
 //                         $dest[$a] = $temp;
 //                    }

 //                    $temp = [];
 //                    $b = 0;

 //                    $temp1 = ['fullname'=> $value['prenom_user'].' '.$value['nom_user']];
 //                    $temp[$b] = $temp1;
 //                    $a= $value['fki_courrier_dif'];
 //                    $b++;



 //                }



 //                }
 //                $copie[$a] = $temp;
 //                $data_b['copie'] = $copie;

                    // echo "<pre>";
                    // var_dump($dest);
                    // echo "<pre>";




        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;

        $data_b['document_existe'] = $document;

        $data_b['courriers'] = $this->courrier->getAllCourrierSave();

        // echo "<pre>";
        // var_dump($data_b['courriers']);
        // echo "<pre>";
        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/savecourrier', $data_b);
    }

    function valider()
    {
        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $surccusale = $_SESSION['fki_suc_us'];

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('typeCourier', 'Type courrier', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            
            $data_b['depart'] = $this->courrier->getDepart();
            $data_b['arrive'] = $this->courrier->getArrive();

            $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );

            

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }


            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');

            $this->load->view('pages/newcourrier',$data_b); 
            } 
        else{
            $prioriteCourier = $this->input->post('prioriteCourier');
            $objetCourier = $this->input->post('objetCourier');
            $categorieCourier = $this->input->post('categorieCourier');
            $typeCourier = $this->input->post('typeCourier');
            $destCourier = $this->input->post('destCourier');
            $lieidCourierTraite = $this->input->post('lieidCourierTraite');
            $natureCourier = $this->input->post('natureCourier');
            $confidentiel = $this->input->post('confidentiel');
            $info = $this->input->post('info');
            $mot_cle = $this->input->post('mot_cle');
            
            $expCourier = $this->input->post('expCourier');
            $serviceInit = $this->input->post('serviceInit');
            $fkIdDest = $this->input->post('fkIdDest');
            $fkIdDossier = $this->input->post('fkIdDossier');

            $expCourier = $this->input->post('expCourier');
            $serviceInit = $this->input->post('serviceInit');
            $fkIdDest = $this->input->post('fkIdDest');
            $fkIdDossier = $this->input->post('fkIdDossier');

            if ($this->input->post('id2_limite_name')!='') {
            $dateLimittraiteCourier = $this->input->post('id2_limite_name');
            }

            if ($this->input->post('origine_tel')!='') 
            {
                $origine_tel = $this->input->post('origine_tel');
                $tel = $this->input->post('tel');
                $obj_tel = $this->input->post('obj_tel');
                $mention = $this->input->post('mention');
                $des_tel = $this->input->post('des_tel');
                $action = $this->input->post('action');
                $mes_tel = $this->input->post('mes_tel');
  
            }

            if ($this->input->post('date_relance')!='') 
            {

            $date_relance = $this->input->post('date_relance');
            }


            if($this->input->post('origine_fact')!='') 
            {

                $origine_fact = $this->input->post('origine_fact');
                $montant = $this->input->post('montant');
                $type_facture = $this->input->post('type_facture');
                $date_echeant = $this->input->post('date_echeant');
   
            }

            $nature = substr($natureCourier,0,3);

            $codepays = $this->courrier->getSurccusaleCodePays();

            $id_max_courrier = $this->courrier->getIdMaxCourrier();
            $id_max_courrier = $id_max_courrier->id + 1;

            $numcourier = 'AKASI-'.$codepays->code_pays.'-'.date('Y-m-d').'-'.substr($categorieCourier,0,1).'-'.$this->courrier->getNbCourrier($categorieCourier).'-'.$nature.'-'.$id_max_courrier;

        $data1 = array(
            'prioriteCourier' => $this->input->post('prioriteCourier'),
            'num_courrier' => $numcourier,
            'objetCourier' => $this->input->post('objetCourier'),
            'categorieCourier' => $this->input->post('categorieCourier'),
            'typeCourier' => $this->input->post('typeCourier'),
            'destCourier' => $this->input->post('destCourier'),
            'doc' => ($this->input->post('doc')) ? ($this->input->post('doc')) :(['']) ,
            'lieidCourierTraite' => $this->input->post('lieidCourierTraite'),
            'natureCourier' => $this->input->post('natureCourier'),
            'confidentiel' => $this->input->post('confidentiel'),
            'info' => $this->input->post('info'),
            'mot_cle' => $this->input->post('mot_cle'),
            'expCourier' => $this->input->post('expCourier'),
            'serviceInit' => $this->input->post('serviceInit'),
            'fkIdDest' => $this->input->post('fkIdDest'),
            'fkIdDossier' => $this->input->post('fkIdDossier'),
            'expCourier' => $this->input->post('expCourier'),
            'serviceInit' => $this->input->post('serviceInit'),
            'fkIdDest' => ($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) :(['']) ,
            'fkIdDossier' => $this->input->post('fkIdDossier'),
            'dateLimittraiteCourier' => $this->input->post('id2_limite_name'),
            'origine_tel' => $this->input->post('origine_tel'),
                'tel' => $this->input->post('tel'),
                'obj_tel' => $this->input->post('obj_tel'),
                'mention' => $this->input->post('mention'),
                'des_tel' => $this->input->post('des_tel'),
                'action' => $this->input->post('action'),
                'mes_tel' => $this->input->post('mes_tel'),
                'origine_fact' => $this->input->post('origine_fact'),
                'montant' => $this->input->post('montant'),
                'type_facture' => $this->input->post('type_facture'),
                'date_echeant' => $this->input->post('date_echeant'),
                'date_courrier' => $this->input->post('date_courrier'),
                'date_arrivee' => $this->input->post('date_arrivee')

                            
        );



            $data_d['liste'] = $data1;
 
            $data_b['depart'] = $this->courrier->getDepart();
            $data_b['arrive'] = $this->courrier->getArrive();

            $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );

            

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;
            $data_b['liste'] = $data1;
            // $a = $data_d['liste']['mot_cle'];
            var_dump($data_b['liste']);
            // echo $a;
            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');

            $this->load->view('pages/confirmation',$data_b);

        }

    }

    function newcourrier()
    {
        if ($this->input->post('categorieCourier')) 
        {
           
        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $surccusale = $_SESSION['fki_suc_us'];

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('typeCourier', 'Type courrier', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            // $data_b['service'] = $this->courrier->getService();
            // $data_b['dossier'] = $this->courrier->getDossier();
            // $data_b['employe'] = $this->courrier->getEmploye2();

            $liste_dossier = $this->courrier->getDossier($surccusale);

        $list_dossier_existe = [];
            if ($liste_dossier) 
            {

                $i=0;
                
                foreach ($liste_dossier as  $value)
                {

                $list_dossier_existe[$value['code_dossier']] = $value['code_dossier'];
                            
                }

                
            }

        $data_b['dossiers_existe'] = $list_dossier_existe;

            $data_b['depart'] = $this->courrier->getDepart();
            $data_b['arrive'] = $this->courrier->getArrive();

            $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );

            

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }


            // echo "<pre>";
            // var_dump($listservice);
            // echo "<pre>";
            // echo "<pre>";
            // var_dump(count($liste_destinataire);
            // echo "<pre>";

            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');

            $this->load->view('pages/newcourrier',$data_b);
        } 
        else {
            $prioriteCourier = $this->input->post('prioriteCourier');
            $objetCourier = $this->input->post('objetCourier');
            $categorieCourier = $this->input->post('categorieCourier');
            $typeCourier = $this->input->post('typeCourier');
            $destCourier = $this->input->post('destCourier');
            $lieidCourierTraite = $this->input->post('lieidCourierTraite');
            $natureCourier = $this->input->post('natureCourier');
            $date_courrier = $this->input->post('date_courrier');
            $service_dest = $this->input->post('service_dest');
            $expediteur_courrier = $this->input->post('exp');
            $nature = substr($natureCourier,0,3);

            

            // list($d,$m,$y) = explode('/', $date_courrier);
            // $date_courrier = $y.'-'.$m.'-'.$d;

            
            $date_arrivee = $this->input->post('date_arrivee');

            // list($d,$m,$y) = explode('/', $date_arrivee);
            // $date_arrivee = $y.'-'.$m.'-'.$d;


            $confidentiel = $this->input->post('confidentiel');
            $info = $this->input->post('info');
            $mot_cle = $this->input->post('mot_cle');

            $codepays = $this->courrier->getSurccusaleCodePays();

            
            $expCourier = $this->input->post('expCourier');
            $serviceInit = $this->input->post('serviceInit');
            $fkIdDest = $this->input->post('fkIdDest');
            $fkIdDossier = $this->input->post('fkIdDossier');

            $dateLimittraiteCourier='';
            $date_relance='';
            if ($this->input->post('active_date')=='on') {

                if ($this->input->post('id2_limite_name')!='') {
            $dateLimittraiteCourier = $this->input->post('id2_limite_name');

            list($d,$h) = explode('à', $dateLimittraiteCourier);

            list($days,$month,$years) = explode('/', $d);
            
            $days = str_replace(" ", "", $days);
            $month = str_replace(" ", "", $month);
            $years = str_replace(" ", "", $years);

            $dateLimittraiteCourier = $years.'-'.$month.'-'.$days.' '.$h;
            
            }

            // if ($this->input->post('date_relance')!='') {

            $date_relance = $this->input->post('date_relance');

            list($d,$h) = explode('à', $date_relance);

            list($days,$month,$years) = explode('/', $d);
            
            $days = str_replace(" ", "", $days);
            $month = str_replace(" ", "", $month);
            $years = str_replace(" ", "", $years);

            $date_relance = $years.'-'.$month.'-'.$days.' '.$h;
            
            // $date_relance = $this->input->post('date_relance');
            // list($y,$m,$d) = explode('/', $date_relance);
            // $date_relance = $y.'-'.$m.'-'.$d;
            // date('Y-m-d H:i:s');
            // }
                
            }
            

            $this->db->trans_begin();

            $id_max_courrier = $this->courrier->getIdMaxCourrier();
            $id_max_courrier = $id_max_courrier->id + 1;

            $numcourier = 'AKASI-'.$codepays->code_pays.'-'.date('ymd').'-'.$this->courrier->getNbCourrier().'-'.$this->courrier->getServiceDest($service_dest).'-'.$nature.'-'.$id_max_courrier;

            $this->courrier->addCourriernew($lieidCourierTraite,$prioriteCourier,$objetCourier,$categorieCourier,$typeCourier,$natureCourier,$date_courrier,$date_arrivee,$confidentiel,$info,$mot_cle,$numcourier,$expCourier,$fkIdDossier,$dateLimittraiteCourier,$date_relance,$service_dest,$expediteur_courrier);

                $id_courrier = $this->db->insert_id();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec</div>";
                $this->session->set_flashdata('msg', $msg);
                } 
                else
                {

                $this->db->trans_commit();


                // foreach ($destCourier as $key=>$item) {
                   
                //     $this->sendmailing2($this->courrier->getEmp($destCourier[0]), $fkIdDest);
                // }

                // $msg = "<div class='alert alert-success'>Succès!</div>";
                // $this->session->set_flashdata('msg', $msg);
            }

            
        $destCourier = $this->input->post('destCourier');
        $count_dest = count($destCourier);
            
            $statut = 1;

            for($i=0;$i<$count_dest;$i++){

                if ($destCourier[$i] !='') {

                $id_dest = $destCourier[$i];
                $destinataire = $this->courrier->getEmailByUserId($id_dest);
                $this->courrier->addDif($id_courrier,$statut,$id_dest);
                // $this->sendmailing2($this->courrier->getUsersendmail($id_dest), $fkIdDest);
                // $id_dif = $this->db->insert_id();
                // $user_info = $this->courrier->getUsersendmail($id_dest);
                // $mailData = [
                //                 'sitename'=>"AKASI-LetterBox",
                //                 'title'=>"Notification de réception de courrier sur LetterBox",
                //                 'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                //           'option'=> 1,
                          
                //           'destination' => $user_info->email
                          
                //     ];
                               
                //                 mailTemplate1($mailData);
                
                    
                }

            }

           $fkIdDest = $this->input->post('fkIdDest');

            if ($fkIdDest!='' ){
                
                $count_dest_dif = count($fkIdDest);

                $statut = 4;

                for($i=0;$i<$count_dest_dif;$i++){

                if ($fkIdDest[$i] !='') {

                $id_dest_dif = $fkIdDest[$i];
                $destinataire_diff = $this->courrier->getEmailByUserId($id_dest_dif);
                $this->courrier->addDif($id_courrier,$statut,$id_dest_dif);

                // $user_info = $this->courrier->getUsersendmail($id_dest_dif);
                // $mailData = [
                //                 'sitename'=>"AKASI-LetterBox",
                //                 'title'=>"Notification de réception de courrier sur LetterBox",
                //                 'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier dont vous êtes en copie sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                //           'option'=> 1,
                          
                //           'destination' => $user_info->email,
                //           // 'id' => $this->input->post('emailemp')
                //     ];
                //                 // helper('mail');
                //                 mailTemplate1($mailData);
                    
                }
            
            }
        }


           

            // $this->sendmailing2($this->courrier->getEmp($destCourier[0]), $fkIdDest);

           

            // Debut data call

            if ($this->input->post('origine_tel')!='') 
            {
                $origine_tel = $this->input->post('origine_tel');
                $tel = $this->input->post('tel');
                $obj_tel = $this->input->post('obj_tel');
                $mention = $this->input->post('mention');
                $des_tel = $this->input->post('des_tel');
                $action = $this->input->post('action');
                $mes_tel = $this->input->post('mes_tel');

                $this->courrier->addCourrierAppel($origine_tel,$tel,$obj_tel,$mention,$des_tel,$action,$mes_tel,$id_courrier);
            }
            // Fin data call

            // Debut data facture

            if ($this->input->post('origine_fact')!='') 
            {

                $origine_fact = $this->input->post('origine_fact');
                $montant = $this->input->post('montant');
                $type_facture = $this->input->post('type_facture');
                $date_echeant = $this->input->post('date_echeant');

                // list($m,$d,$y) = explode('/', $date_echeant);
                // $date_echeant = $y.'-'.$m.'-'.$d;

                $this->courrier->addCourrierFacture($origine_fact,$montant,$type_facture,$date_echeant,$id_courrier);
                
            }
            // Fin data call



            // list($m,$d,$y) = explode('/', $dateLimittraiteCourier);
            // $dateLimittraiteCourier = $y.'-'.$m.'-'.$d;

            
    if ($_FILES['doc']['name'] != '') {
      $data = array();
 
      $count_doc = count($_FILES['doc']['name']);
 
      for($i=0;$i<$count_doc;$i++){
 
        if(($_FILES['doc']['name'][$i])!= ''){
          $ext = pathinfo($_FILES['doc']['name'][$i], PATHINFO_EXTENSION);
          $name = 'AKASI-' . rand(100000, 999999) .'-'. date("Y-m-d") . '.' . $ext;  
          $_FILES['file']['name'] = $name;
          $_FILES['file']['type'] = $_FILES['doc']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['doc']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['doc']['error'][$i];
          $_FILES['file']['size'] = $_FILES['doc']['size'][$i];
 
          $config['upload_path'] = './assets/docs/'; 
          $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|pdf|PDF|docx|csv';
          $config['max_size'] = '10000';
          // $config['file_name'] = 'AKASI/'.date('Y-m-d').'/'.$categorieCourier.'/'.$this->courrier->getNbCourrier($categorieCourier);
          $config['file_name'] = $name;
 
          $this->load->library('upload',$config); 
 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $this->courrier->addDoc($id_courrier,$name,$surccusale);
            // $arrData["image_name"] =$name;
            // $this->Image_model->save_image($arrData);
          }
        }
 
      }
    }




    ///


    $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $id_courrier;
       
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;
        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
        $courrier = $this->courrier->getAllCourrierConfById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        // var_dump($courrier);
        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        $type = $this->courrier->getAllCourrierConfById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConfAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConfFactureView($id);
                
            }
            
        }

        $data3 = array(
            'fkIdDest' =>($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) : (['']) ,
            'destCourier' =>($this->input->post('destCourier')) ? ($this->input->post('destCourier')) : (['']),
            'idcourrier' => $id 
             );
        // var_dump($data3);
        $data_b['liste'] = $data3;

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($data_b['liste_courrier']);
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        $_SESSION['liste_encopie'] = $this->input->post('fkIdDest');
        $_SESSION['liste_dest'] = $this->input->post('destCourier');



        $document = $this->courrier->getAlldoc();

                $temp =[];
                $docs =[];
                $i = 0;
                $j=0;
                 

                foreach ($document as  $value) {
                if($i== $value['fki_courrier_doc'] || $i==0){
                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;

                }else{
                    $docs[$i] = $temp; 
                    $temp = [];
                    $j = 0;

                    $temp1 = ['intitule'=> $value['chemin'], 'chemin'=> $value['chemin']];
                    $temp[$j] = $temp1;
                    $i= $value['fki_courrier_doc'];
                    $j++;



                }

                }
                $docs[$i] = $temp;

        $data_b['docs'] = $docs;
        
        // $data_l['css'] = array(
        //     'assets/css/bootstrap-timepicker.min.css',
        //     'assets/api/bootstrap-datepicker/css/datepicker.css',
        // );

        // $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top',$data_l);
        $this->load->view('pages/confirmation2', $data_b);

      
           
            // redirect('courrier/courrier');
        }
        }

        else{

            $id_max_courrier = $this->courrier->getIdMaxCourrier();
            $id = $id_max_courrier->id ;

            $this->courrier->deleteFichedif($id);
            $this->courrier->deleteFicheCourrier($id);
            $this->courrier->deleteFicheAppel($id);
            $this->courrier->deleteFicheFacture($id);
            $this->courrier->deleteFichedoc($id);
            // $this->courrier->deleteFichedif($id);
            // $this->courrier->deleteFicheCourrier($id);

            // redirect('courrier/newcourrier1');
        }
        
    }





    function newcourrier1()
    {

        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $surccusale = $_SESSION['fki_suc_us'];

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('typeCourier', 'Type courrier', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $liste_dossier = $this->courrier->getDossier($surccusale);

        $list_dossier_existe = [];
            if ($liste_dossier) 
            {

                $i=0;
                
                foreach ($liste_dossier as  $value)
                {

                $list_dossier_existe[$value['code_dossier']] = $value['code_dossier'];
                            
                }

                
            }

        $data_b['dossiers_existe'] = $list_dossier_existe;
            // $data_b['service'] = $this->courrier->getService();
            // $data_b['dossier'] = $this->courrier->getDossier();
            // $data_b['employe'] = $this->courrier->getEmploye2();
            $data_b['depart'] = $this->courrier->getDepart();
            $data_b['arrive'] = $this->courrier->getArrive();



            $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );

            

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }


            // echo "<pre>";
            // var_dump($listservice);
            // echo "<pre>";
            // echo "<pre>";
            // var_dump(count($liste_destinataire);
            // echo "<pre>";
            $liste_expediteur = $this->courrier->getExpediteur();
                        
        
            $data_b['expediteur'] = $liste_expediteur;

            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');

            $this->load->view('pages/newcourrier',$data_b);
        } 
        else {
$prioriteCourier = $this->input->post('prioriteCourier');
            $objetCourier = $this->input->post('objetCourier');
            $categorieCourier = $this->input->post('categorieCourier');
            $typeCourier = $this->input->post('typeCourier');
            $destCourier = $this->input->post('destCourier');
            $lieidCourierTraite = $this->input->post('lieidCourierTraite');
            $natureCourier = $this->input->post('natureCourier');
            $date_courrier = $this->input->post('date_courrier');
            $service_dest = $this->input->post('service_dest');
            $expediteur_courrier = $this->input->post('exp');
            $nature = substr($natureCourier,0,3);

            

            // list($d,$m,$y) = explode('/', $date_courrier);
            // $date_courrier = $y.'-'.$m.'-'.$d;

            
            $date_arrivee = $this->input->post('date_arrivee');

            // list($d,$m,$y) = explode('/', $date_arrivee);
            // $date_arrivee = $y.'-'.$m.'-'.$d;


            $confidentiel = $this->input->post('confidentiel');
            $info = $this->input->post('info');
            $mot_cle = $this->input->post('mot_cle');

            $codepays = $this->courrier->getSurccusaleCodePays();

            
            $expCourier = $this->input->post('expCourier');
            $serviceInit = $this->input->post('serviceInit');
            $fkIdDest = $this->input->post('fkIdDest');
            $fkIdDossier = $this->input->post('fkIdDossier');

$dateLimittraiteCourier='';
            $date_relance='';
            if ($this->input->post('active_date')=='on') {

                if ($this->input->post('id2_limite_name')!='') {
            $dateLimittraiteCourier = $this->input->post('id2_limite_name');

            list($d,$h) = explode('à', $dateLimittraiteCourier);

            list($days,$month,$years) = explode('/', $d);
            
            $days = str_replace(" ", "", $days);
            $month = str_replace(" ", "", $month);
            $years = str_replace(" ", "", $years);

            $dateLimittraiteCourier = $years.'-'.$month.'-'.$days.' '.$h;
            
            }

            // if ($this->input->post('date_relance')!='') {

            $date_relance = $this->input->post('date_relance');

            list($d,$h) = explode('à', $date_relance);

            list($days,$month,$years) = explode('/', $d);
            
            $days = str_replace(" ", "", $days);
            $month = str_replace(" ", "", $month);
            $years = str_replace(" ", "", $years);

            $date_relance = $years.'-'.$month.'-'.$days.' '.$h;
            
            // $date_relance = $this->input->post('date_relance');
            // list($y,$m,$d) = explode('/', $date_relance);
            // $date_relance = $y.'-'.$m.'-'.$d;
            // date('Y-m-d H:i:s');
            // }
                
            }

            $this->db->trans_begin();

            $id_max_courrier = $this->courrier->getIdMaxCourrier();
            $id_max_courrier = $id_max_courrier->id + 1;

            // $date =date('Y-m-d');
            // .substr($categorieCourier,0,1).

            $numcourier = 'AKASI-'.$codepays->code_pays.'-'.date('ymd').'-'.$this->courrier->getNbCourrier().'-'.$this->courrier->getServiceDest($service_dest).'-'.$nature.'-'.$id_max_courrier;

            $this->courrier->addCourriernew($lieidCourierTraite,$prioriteCourier,$objetCourier,$categorieCourier,$typeCourier,$natureCourier,$date_courrier,$date_arrivee,$confidentiel,$info,$mot_cle,$numcourier,$expCourier,$fkIdDossier,$dateLimittraiteCourier,$date_relance,$service_dest,$expediteur_courrier);

                $id_courrier = $this->db->insert_id();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $msg = "<div class='alert alert-danger'>Echec</div>";
                $this->session->set_flashdata('msg', $msg);
                } 
                else
                {

                $this->db->trans_commit();


                // foreach ($destCourier as $key=>$item) {
                   
                //     $this->sendmailing2($this->courrier->getEmp($destCourier[0]), $fkIdDest);
                // }

                // $msg = "<div class='alert alert-success'>Succès!</div>";
                // $this->session->set_flashdata('msg', $msg);
            }

            
        $destCourier = $this->input->post('destCourier');
        $count_dest = count($destCourier);
            
            $statut = 1;

            for($i=0;$i<$count_dest;$i++){

                if ($destCourier[$i] !='') {

                $id_dest = $destCourier[$i];
                $destinataire = $this->courrier->getEmailByUserId($id_dest);
                $this->courrier->addDif($id_courrier,$statut,$id_dest);
                // $this->sendmailing2($this->courrier->getUsersendmail($id_dest), $fkIdDest);
                // $id_dif = $this->db->insert_id();
                // $user_info = $this->courrier->getUsersendmail($id_dest);
                // $mailData = [
                //                 'sitename'=>"AKASI-LetterBox",
                //                 'title'=>"Notification de réception de courrier sur LetterBox",
                //                 'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                //           'option'=> 1,
                          
                //           'destination' => $user_info->email
                          
                //     ];
                               
                //                 mailTemplate1($mailData);
                
                    
                }

            }

           $fkIdDest = $this->input->post('fkIdDest');

            if ($fkIdDest!='' ){
                
                $count_dest_dif = count($fkIdDest);

                $statut = 4;

                for($i=0;$i<$count_dest_dif;$i++){

                if ($fkIdDest[$i] !='') {

                $id_dest_dif = $fkIdDest[$i];
                $destinataire_diff = $this->courrier->getEmailByUserId($id_dest_dif);
                $this->courrier->addDif($id_courrier,$statut,$id_dest_dif);

                // $user_info = $this->courrier->getUsersendmail($id_dest_dif);
                // $mailData = [
                //                 'sitename'=>"AKASI-LetterBox",
                //                 'title'=>"Notification de réception de courrier sur LetterBox",
                //                 'titleMessage' => 'Salut, '. $user_info->prenom_user.' '.$user_info->nom_user.' <br>Nous vous notifions que vous venez de recevoir un courrier dont vous êtes en copie sur la plateforme Letterbox.<br>Veuillez suivre le lien ci-dessous pour vous connecter à votre compte AKASI-LetterBox',
                //           'option'=> 1,
                          
                //           'destination' => $user_info->email,
                //           // 'id' => $this->input->post('emailemp')
                //     ];
                //                 // helper('mail');
                //                 mailTemplate1($mailData);
                    
                }
            
            }
        }


           

            // $this->sendmailing2($this->courrier->getEmp($destCourier[0]), $fkIdDest);

           

            // Debut data call

            if ($this->input->post('origine_tel')!='') 
            {
                $origine_tel = $this->input->post('origine_tel');
                $tel = $this->input->post('tel');
                $obj_tel = $this->input->post('obj_tel');
                $mention = $this->input->post('mention');
                $des_tel = $this->input->post('des_tel');
                $action = $this->input->post('action');
                $mes_tel = $this->input->post('mes_tel');

                $this->courrier->addCourrierAppel($origine_tel,$tel,$obj_tel,$mention,$des_tel,$action,$mes_tel,$id_courrier);
            }
            // Fin data call

            // Debut data facture

            if ($this->input->post('origine_fact')!='') 
            {

                $origine_fact = $this->input->post('origine_fact');
                $montant = $this->input->post('montant');
                $type_facture = $this->input->post('type_facture');
                $date_echeant = $this->input->post('date_echeant');

                list($m,$d,$y) = explode('/', $date_echeant);
                $date_echeant = $y.'-'.$m.'-'.$d;

                $this->courrier->addCourrierFacture($origine_fact,$montant,$type_facture,$date_echeant,$id_courrier);
                
            }
            // Fin data call



            // list($m,$d,$y) = explode('/', $dateLimittraiteCourier);
            // $dateLimittraiteCourier = $y.'-'.$m.'-'.$d;

            
    if ($_FILES['doc']['name'] != '') {
      $data = array();
 
      $count_doc = count($_FILES['doc']['name']);
 
      for($i=0;$i<$count_doc;$i++){
 
        if(($_FILES['doc']['name'][$i])!= ''){
          $ext = pathinfo($_FILES['doc']['name'][$i], PATHINFO_EXTENSION);
          $name = 'AKASI-' . rand(100000, 999999) .'-'. date("Y-m-d") . '.' . $ext;
           // 'AKASILETTERBOX_' . rand(100000, 999999) . date("Y-m-d") . '.' . $ext;  
          $_FILES['file']['name'] = $name;
          $_FILES['file']['type'] = $_FILES['doc']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['doc']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['doc']['error'][$i];
          $_FILES['file']['size'] = $_FILES['doc']['size'][$i];
 
          $config['upload_path'] = './assets/docs/'; 
          $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|pdf|PDF|docx|csv';
          $config['max_size'] = '10000';
          $config['file_name'] = $name;
          // 'AKASILETTERBOX/'.date('Y-m-d').'/'.$categorieCourier.'/'.$this->courrier->getNbCourrier($categorieCourier);
 
          $this->load->library('upload',$config); 
 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $this->courrier->addDoc($id_courrier,$name,$surccusale);
            // $arrData["image_name"] =$name;
            // $this->Image_model->save_image($arrData);
          }
        }
 
      }
    }




    ///


        $data_l['title'] = 'Courriers';
        $data_l['menu'] = 'courriers';
        $data_l['submenu'] = 'enregistrer';

        $id = $id_courrier;
       
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_l['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;
        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
        $courrier = $this->courrier->getAllCourrierConfById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        // var_dump($courrier);

        $type = $this->courrier->getAllCourrierConfById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConfAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConfFactureView($id);
                
            }
            
        }

        $data3 = array(
            'fkIdDest' =>($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) : (['']) ,
            'destCourier' =>($this->input->post('destCourier')) ? ($this->input->post('destCourier')) : (['']),
            'idcourrier' => $id 
             );
        // var_dump($data3);
        $data_b['liste'] = $data3;

        $data_b['liste_courrier'] = $courrier[0];
        // var_dump($data_b['liste_courrier']);
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        $_SESSION['liste_encopie'] = $this->input->post('fkIdDest');
        $_SESSION['liste_dest'] = $this->input->post('destCourier');
        
        // $data_l['css'] = array(
        //     'assets/css/bootstrap-timepicker.min.css',
        //     'assets/api/bootstrap-datepicker/css/datepicker.css',
        // );

        // $this->load->view('templates/left', $data_l);
        
        $this->load->view('pages/confirmation2', $data_b);
        $this->load->view('templates/top',$data_l);

      
           
            // redirect('courrier/courrier');
        }
    }


function printt()
{
    $id = $_GET['id'];
      // $id = $id_courrier;
       
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dest = ($this->courrier->getUserByCourrier($id)) ? ($this->courrier->getUserByCourrier($id)[0]) : ([]);

            $liste_copie = ($this->courrier->getUserEnCopieByCourrier($id)) ? ($this->courrier->getUserEnCopieByCourrier($id)[0]) :([]); 

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;


        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
        $courrier = $this->courrier->getAllCourrierConfprintById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        // var_dump($courrier);

        $type = $this->courrier->getAllCourrierConfprintById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConfprintAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConfprintFactureView($id);
                
            }
            
        }

        $data3 = array(
            'fkIdDest' =>($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) : (['']) ,
            'destCourier' =>($this->input->post('destCourier')) ? ($this->input->post('destCourier')) : (['']),
            'idcourrier' => $id 
             );
        // var_dump($data3);
        $data_b['liste'] = $data3;

        $data_b['liste_courrier'] = $courrier[0];

        $data_b['listdes'] = $liste_dest;
        $data_b['listcopie'] = $liste_copie;

        
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        // echo "<pre>";
        // var_dump($data_b['listdes']);
        // echo "<pre>";
        // var_dump($data_b['listcopie']);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        $_SESSION['liste_encopie'] = $this->input->post('fkIdDest');
        $_SESSION['liste_dest'] = $this->input->post('destCourier');
        
        
        // $data_l['css'] = array(
        //     'assets/css/bootstrap-timepicker.min.css',
        //     'assets/api/bootstrap-datepicker/css/datepicker.css',
        // );

        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);



}



function printatraiter()
{
    $id_dif = $_GET['id'];
      $id = $id_dif;
     $id_courrier = $this->courrier->getIdCourrierByIddif($id_dif);
  
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];
          

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
          


       
         $courrier = $this->courrier->getAllCourrierAtraiterById($id);

        // $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        // $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
        //         $data_b['dest'] = $destinataires;
        //         $data_b['copie'] = $listcopie;


        // $courrier = $this->courrier->getAllCourrierSaveById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierAtraiterById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelAtraiterById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureAtraiterById($id);
                
            }
            
        }

       
       
        $data_b['liste_courrier'] = $courrier[0];

       

        
      
        // echo "<pre>";
        // var_dump($courrier);
        // echo "<pre>";
        // var_dump($data_b['listcopie']);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id_courrier);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id_courrier);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;


        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);



}



function print3()
{
    $id = $_GET['id'];
      // $id = $id_courrier;
       
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dest = ($this->courrier->getUserByCourrier($id)) ? ($this->courrier->getUserByCourrier($id)[0]) : ([]);

            $liste_copie = ($this->courrier->getUserEnCopieByCourrier($id)) ? ($this->courrier->getUserEnCopieByCourrier($id)[0]) :([]); 

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;


        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
        $courrier = $this->courrier->getAllCourrierConfById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        // var_dump($courrier);

        $type = $this->courrier->getAllCourrierConfById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConfAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConfFactureView($id);
                
            }
            
        }

        $data3 = array(
            'fkIdDest' =>($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) : (['']) ,
            'destCourier' =>($this->input->post('destCourier')) ? ($this->input->post('destCourier')) : (['']),
            'idcourrier' => $id 
             );
        // var_dump($data3);
        $data_b['liste'] = $data3;

        $data_b['liste_courrier'] = $courrier[0];

        $data_b['listdes'] = $liste_dest;
        $data_b['listcopie'] = $liste_copie;
        // var_dump($courrier[0]);
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        // echo "<pre>";
        // var_dump($data_b['listdes']);
        // echo "<pre>";
        // var_dump($data_b['listcopie']);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        $_SESSION['liste_encopie'] = $this->input->post('fkIdDest');
        $_SESSION['liste_dest'] = $this->input->post('destCourier');
        
        
        // $data_l['css'] = array(
        //     'assets/css/bootstrap-timepicker.min.css',
        //     'assets/api/bootstrap-datepicker/css/datepicker.css',
        // );

        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);



}


function printEncopie()
{
    $id = $_GET['id'];
      // $id = $id_courrier;
    
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

           

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
          


        $courrier = $this->courrier->getAllCourrierEncopieById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        
        // var_dump($courrier);
        $type = $this->courrier->getAllCourrierEncopieById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelEncopieById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureEncopieById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
       
        $id_courrier = $this->courrier->getIdCourrierByIddif($id);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id_courrier);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id_courrier);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;
  
        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);

}



function printTransferer()
{
    $id = $_GET['id'];
      // $id = $id_courrier;
    
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

           

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
          


$courrier = $this->courrier->getAllCourrierTransfererById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        

        $type = $this->courrier->getAllCourrierTransfererById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelTransfererById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureTransfererById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
        // echo "<pre>";
        // var_dump($courrier[0]);
        // echo "<pre>";
       
        $id_courrier = $this->courrier->getIdCourrierByIddif($id);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id_courrier);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id_courrier);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

       
        
        
      

        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);



}


function print4()
{
    $id = $_GET['id'];
      // $id = $id_courrier;
    
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

           

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
          


        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
          $courrier = $this->courrier->getAllCourrierArchiverById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        $data_b['courriers'] = $this->courrier->getAllCourrierArchiver();

        $type = $this->courrier->getAllCourrierArchiverById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierAppelArchiverById($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierFactureArchiverById($id);
                
            }
            
        }

        $data_b['liste_courrier'] = $courrier[0];
       
        $id_courrier = $this->courrier->getIdCourrierByIddif($id);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id_courrier);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id_courrier);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

       
        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $this->load->view('pages/print2', $data_b);

}



function print($value)
{
    // $id = $_GET['id'];
    $id = $value;
    // var_dump($_SESSION['liste_dest']);
    // var_dump($_SESSION['liste_dest']);

$data_b['title'] = 'Courriers';
        $data_b['menu'] = 'courriers';
        $data_b['submenu'] = 'enregistrer';

        // $id = $id_courrier;
       
        $this->load->helper(array('form'));

        $surccusale = $_SESSION['fki_suc_us'];

            $liste_dest = ($this->courrier->getUserByCourrier($id)) ? ($this->courrier->getUserByCourrier($id)[0]) : ([]);

            $liste_copie = ($this->courrier->getUserEnCopieByCourrier($id)) ? ($this->courrier->getUserEnCopieByCourrier($id)[0]) :([]); 

            $liste_dossier = $this->courrier->getDossier($surccusale);

            $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

            $liste_destinataire = $this->courrier->getUsersBySurccusale($surccusale);

            $listservice = $this->bureau->getServiceByIdSuc($surccusale);

            $type_delai_traitement = [];
            $type_delai_relance = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $type_delai_traitement[$value['id_type']] = $value['delai_traitement'];
                $type_delai_relance[$value['id_type']] = $value['delai_relance'];
                            
                }

                
            }

        $data_b['css'] = array(
                'assets/css/bootstrap-timepicker.min.css',
                'assets/api/jquery-multi-select/css/multi-select.css',
            );
            $data_b['liste_type_courrier'] = $liste_type_courrier;
            $data_b['liste_dossier'] = $liste_dossier;
            $data_b['liste_destinataire'] = $liste_destinataire;
            $data_b['listservice'] = $listservice;
            
            $data_b['type_delai_traitement'] = $type_delai_traitement;
            $data_b['type_delai_relance'] = $type_delai_relance;


        // echo $id;
        //     var_dump($id_courrier);
        //     echo $id_courrier;
        $courrier = $this->courrier->getAllCourrierConfById($id);
        // $data_b['courriers'] = $this->courrier->getAllCourrierSave();
        // var_dump($courrier);

        $type = $this->courrier->getAllCourrierConfById($id);
        foreach ($type as $key => $value) {
           
           //Donnees Appels
           if ($value['id_type']==7) 
            {
                
            $courrier = $this->courrier->getAllCourrierConfAppelView($id);
            } 
            //Donnees facture
            elseif ($value['id_type']==11) {

                
            $courrier = $this->courrier->getAllCourrierConfFactureView($id);
                
            }
            
        }

        $data3 = array(
            'fkIdDest' =>($this->input->post('fkIdDest')) ? ($this->input->post('fkIdDest')) : (['']) ,
            'destCourier' =>($this->input->post('destCourier')) ? ($this->input->post('destCourier')) : (['']),
            'idcourrier' => $id 
             );
        // var_dump($data3);
        $data_b['liste'] = $data3;

        $data_b['liste_courrier'] = $courrier[0];

        $data_b['listdes'] = $liste_dest;
        $data_b['listcopie'] = $liste_copie;
        // var_dump($data_b['liste_courrier']);
        $data_b['depart'] = $this->courrier->getDepart();
        $data_b['arrive'] = $this->courrier->getArrive();

        // echo "<pre>";
        // var_dump($data_b['listdes']);
        // echo "<pre>";
        // var_dump($data_b['listcopie']);

        $destinataires = $this->courrier->getAllDifSavebyIdCourrier($id);

        $listcopie = $this->courrier->getAllDifCopiebyIdCourrier($id);


        
                $data_b['dest'] = $destinataires;
                $data_b['copie'] = $listcopie;

        $_SESSION['liste_encopie'] = $this->input->post('fkIdDest');
        $_SESSION['liste_dest'] = $this->input->post('destCourier');
        
        // $data_l['css'] = array(
        //     'assets/css/bootstrap-timepicker.min.css',
        //     'assets/api/bootstrap-datepicker/css/datepicker.css',
        // );

        // $this->load->view('templates/left', $data_l);
        // $this->load->view('templates/top',$data_l);
        $msg = "<div class='alert alert-success'>Succès!</div>";
                $this->session->set_flashdata('msg', $msg);
        $this->load->view('pages/print', $data_b);



}









    function typecourrier() {
        $data_l['title'] = 'TYPE_COURRIERS';
        $data_l['menu'] = 'Type_Courriers';
        $data_l['submenu'] = '';

        $surccusale = $_SESSION['fki_suc_us'];

        $liste_type_courrier = $this->courrier->getTypeCourrier($surccusale);

        $list_type_existe = [];
            if ($liste_type_courrier) 
            {

                $i=0;
                
                foreach ($liste_type_courrier as  $value)
                {

                $list_type_existe[$value['libelle_type']] = $value['libelle_type'];
                            
                }

                
            }

        $data_b['type_existe'] = $list_type_existe;
        $data_b['type_courrier'] = $liste_type_courrier;

    // var_dump($list_type_existe);
        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/type_courrier', $data_b);
    }


    function submit_type($value='')
{
    if ($this->input->post('libelle_type')!=="")
    {
        $libelle_type = $this->input->post('libelle_type');
        $traitement = $this->input->post('traitement');
        $relance = $this->input->post('relance');

        $surccusale = $_SESSION['fki_suc_us'];

        // $code_dossier1 = $this->remove_accents($code_dossier);
         
        // $code_dossier2 = strtoupper($code_dossier1);

        $libelle_type1 = $this->remove_accents($libelle_type);
         
        $libelle_type2 = strtoupper($libelle_type1);

        // $service = $this->bureau->addservice($libelleservice2,$surccusale);
        $type = $this->bureau->add_type($libelle_type2,$traitement,$relance,$surccusale);

        if ($type == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('courrier/typecourrier');
    }
}


    
     function submit_edit_type($value='')
    {
    if ($this->input->post('edit_libelle_type')!=="")
    {

        $edit_type_id = $this->input->post('libelle_id');

        $edit_libelle_type = $this->input->post('edit_libelle_type');

        $traitement = $this->input->post('traitement_edit');

        $relance = $this->input->post('relance_edit');

        $surccusale = $this->input->post('suc_name');

        $edit_libelle_type1 = $this->remove_accents($edit_libelle_type);
         
        $edit_libelle_type2 = strtoupper($edit_libelle_type1);
       


        $type = $this->courrier->edit_type($edit_libelle_type2,$traitement,$relance,$edit_type_id,$surccusale);

        if ($type == true) {
            $msg = "<div class='alert alert-success'>Succès!</div>";
            $this->session->set_flashdata('msg', $msg);
        }

        else{

            $msg = "<div class='alert alert-danger'>Echec</div>";
            $this->session->set_flashdata('msg', $msg);
            
        }
        redirect('courrier/typecourrier');
    }
}



    
    function deletetype()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if ($id != null && !empty($id)) {
            $type = $this->courrier->gettypebyId($id);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('courrier/dossiers', 'refresh');
        }

        $surccusale = $_SESSION['fki_suc_us'];
        $this->db->trans_begin();

        $this->courrier->deletetype($id,$surccusale);

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
        redirect('courrier/typecourrier', 'refresh');
    }



    function expediteur_courrier() {
        $data_l['title'] = 'Expediteurs';
        $data_l['menu'] = 'expediteur';
        $data_l['submenu'] = '';
        $liste_expediteur = $this->courrier->getExpediteur();
                        
        
        $data_b['expediteur'] = $liste_expediteur;

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/expediteur', $data_b);
    }



    function dossiers() {
        $data_l['title'] = 'Dossiers';
        $data_l['menu'] = 'dossiers';
        $data_l['submenu'] = '';

        $surccusale = $_SESSION['fki_suc_us'];
        $liste_dossier = $this->courrier->getDossier($surccusale);

        $list_dossier_existe = [];
            if ($liste_dossier) 
            {

                $i=0;
                
                foreach ($liste_dossier as  $value)
                {

                $list_dossier_existe[$value['code_dossier']] = $value['code_dossier'];
                            
                }

                
            }

        $data_b['dossiers_existe'] = $list_dossier_existe;
        $data_b['dossiers'] = $liste_dossier;

        $this->load->view('templates/left', $data_l);
        $this->load->view('templates/top');
        $this->load->view('pages/dossiers', $data_b);
    }

    function dossier($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomdossier', 'Nom', 'trim|required');
        $this->form_validation->set_rules('typedossier', 'Type', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les Dossiers';
            $data_l['menu'] = 'dossiers';
            $data_l['submenu'] = '';

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/dossier');

        } else {
            $nomdossier = $this->input->post('nomdossier');
            $typedossier = $this->input->post('typedossier');

            $this->db->trans_begin();

            $this->courrier->createDossier($nomdossier, $typedossier);

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
            redirect('courrier/dossiers');


        }

    }



    function submit_dossier_plus($value='')
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
        redirect('courrier/newcourrier1');
    }
}
    

    function submit_edit_exp($value='')
    {
    if ($this->input->post('nomcomplet_edit')!=="")
    {

        $edit_exp_id = $this->input->post('edit_exp_id');

        $nomcomplet_edit = $this->input->post('nomcomplet_edit');

        $email_exp_edit = $this->input->post('email_exp_edit');

        $num_exp_edit = $this->input->post('num_exp_edit');

        // var_dump($num_exp_edit);

        
        // $code_dossier1 = $this->remove_accents($code_dossier);
         
        // $code_dossier2 = strtoupper($code_dossier1);

        // $edit_libelle_dossier1 = $this->remove_accents($edit_libelle_dossier);
         
        // $edit_libelle_dossier2 = strtoupper($edit_libelle_dossier1);


        $edit_expediteur = $this->courrier->edit_exp($nomcomplet_edit,$email_exp_edit,$num_exp_edit,$edit_exp_id);

        if ($edit_expediteur == true) {
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


    function submit_edit_dossier($value='')
    {
    if ($this->input->post('edit_libelle_dossier')!=="")
    {

        $edit_dossier_id = $this->input->post('edit_id');

        $edit_libelle_dossier = $this->input->post('edit_libelle_dossier');

        $typedossier = $this->input->post('typedossier');

        $code_dossier = $this->input->post('code_dossier');

        $surccusale = $this->input->post('suc_name');

        $code_dossier1 = $this->remove_accents($code_dossier);
         
        $code_dossier2 = strtoupper($code_dossier1);

        $edit_libelle_dossier1 = $this->remove_accents($edit_libelle_dossier);
         
        $edit_libelle_dossier2 = strtoupper($edit_libelle_dossier1);


        $dossier = $this->courrier->edit_dossier($edit_libelle_dossier2,$code_dossier2,$typedossier,$edit_dossier_id,$surccusale);

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


    function editdossier($a = 0)
    {

        $this->load->helper(array('form'));

        $this->form_validation->set_rules('nomdossier', 'Nom', 'trim|required');
        $this->form_validation->set_rules('typedossier', 'Type', 'trim|required');

        $id = $_GET['id'];

        if ($this->form_validation->run() == FALSE) {

            $data_l['css'] = array(
                //'assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css',
                'assets/api/daterangepicker/daterangepicker-bs3.css',
            );
            $data_l['title'] = 'Les Dossiers';
            $data_l['menu'] = 'dossiers';
            $data_l['submenu'] = '';

            $data_d['dossier'] = $this->courrier->getdossierbyId($id);

            $this->load->view('templates/left', $data_l);
            $this->load->view('templates/top');
            $this->load->view('pages/editdossier', $data_d);

        } else {
            $nomdossier = $this->input->post('nomdossier');
            $typedossier = $this->input->post('typedossier');

            $this->db->trans_begin();

            $this->courrier->updateDossier($id, $nomdossier, $typedossier);

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
            redirect('courrier/dossiers');


        }

    }


    function deleteExp()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if ($id != null && !empty($id)) {
            $expediteur = $this->courrier->getexpediteurbyId($id);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('courrier/expediteur_courrier', 'refresh');
        }

        // $surccusale = $_SESSION['fki_suc_us'];
        $this->db->trans_begin();

        $this->courrier->deleteExpediteur($id);

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
        redirect('courrier/expediteur_courrier', 'refresh');
    }


    function deletedossier()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if ($id != null && !empty($id)) {
            $dossier = $this->courrier->getdossierbyId($id);
        } else {
            $msg = "<div class='alert alert-danger'>Aucun utilisateur trouvé!</div>";
            redirect('courrier/dossiers', 'refresh');
        }

        $surccusale = $_SESSION['fki_suc_us'];
        $this->db->trans_begin();

        $this->courrier->deletedossier($id,$surccusale);

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
        redirect('courrier/dossiers', 'refresh');
    }


}
