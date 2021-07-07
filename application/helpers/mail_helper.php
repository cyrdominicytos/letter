<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function sendMail($default, $args)
{
    ini_set("SMTP", "mail.akasigroup.com");
   // $ci =& get_instance();
    $options = "";
    $message = $args['message'];//$this->mailTemplateHtml($args, $options);
    $headers = "MIME-Version: 1.0 \n";

    $headers .= "Content-type:text/html; charset=utf-8 \n";

    $headers .= "From: $default  \n";

    $headers .= "Disposition-Notification-To: $default  \n";
    $headers .= "X-Priority: 1  \n";

    $headers .= "X-MSMail-Priority: High \n";
    //@mail($args['destination'], $args['title'], $message, $headers);
    @mail('akasigroup.usa@gmail.com', $args['title'], $message, $headers);
//     echo $message;
}


function mailTemplate1($data)
{
	
                      $mail['title'] = $data['title'];
         
                      $data['sitename'] = 'AKASI-LetterBox';

					  $mail['message'] = '<b style="color: blue;font-family:Arial,Helvetica,sans-serif;"> LetterBox</b> <b style="font-family:Arial,Helvetica,sans-serif;">'.$data['title'].'<br><br>'.$data['titleMessage'].'<br><br>


                      	  <style>
                      	  	table {
							border:3px solid #6495ed;
							border-collapse:collapse;
							width:90%;
							margin:auto;
							}
							thead, tfoot {
							background-color:#D0E3FA;
							background-image:url(sky.jpg);
							border:1px solid #6495ed;
							}
							tbody {
							background-color:#FFFFFF;
							border:1px solid #6495ed;
							}
							th {
							font-family:monospace;
							border:1px dotted #6495ed;
							padding:5px;
							background-color:#EFF6FF;
							width:25%;
							}
							td {
							font-family:sans-serif;
							font-size:80%;
							border:1px solid #6495ed;
							padding:5px;
							text-align:left;
							}
							caption {
							font-family:sans-serif;
							}

							.button {
							  font: bold 11px Arial;
							  color: #000000;

							      border: 1px solid #aa8d56;

							      color: #aa8d56;

							      outline: medium none;

							      padding: 15px;
							  
							      text-transform: none;



							}


							.btn-danger{
							background: red none repeat scroll 0 0;
							}


							.btn-succes{
								background: green none repeat scroll 0 0;
							}

							.btn-primary{
								background: blue none repeat scroll 0 0;
							}
							     
							     .btn-danger:hover {

							     Background-color:  #aa8d56;

							     Color: #ffffff;

							}                 	  

						</style>

							<br><br>
							';

							$mail['message'] .=  (isset($data['option']) && $data['option']== 1) ? ('<b style="color:black;font-weight: 600;font-size:12px;text-align:center,">*Actions requises.</b>
							<br><br>
							<div style="margin-left:100px">
							<a href="'.site_url().'/tb"  style="color:green;">Se Connecter</a>
							</div>
							
							<br><br>
							Date et Heure: '.date("Y-m-d H:i:s")

							.'<br><br><b style="color:blue">
							<div>
							======================
							</div>
							Equipe du projet LetterBox</b>') :('');
							


                            $mail['destination'] = $data['destination'];
                            sendMail($data['sitename'] . ' <no-reply@akasigroup.com>', $mail);
							
                           

}




function mailTemplate2($data)
{
	
                      $mail['title'] = $data['title'];
         
                      $data['sitename'] = 'AKASI-LetterBox';

					  $mail['message'] = '<b style="color: blue;font-family:Arial,Helvetica,sans-serif;"> LetterBox</b> <b style="font-family:Arial,Helvetica,sans-serif;">'.$data['title'].'<br><br>'.$data['titleMessage'].'<br><br>


                      	  <style>
                      	  	table {
							border:3px solid #6495ed;
							border-collapse:collapse;
							width:90%;
							margin:auto;
							}
							thead, tfoot {
							background-color:#D0E3FA;
							background-image:url(sky.jpg);
							border:1px solid #6495ed;
							}
							tbody {
							background-color:#FFFFFF;
							border:1px solid #6495ed;
							}
							th {
							font-family:monospace;
							border:1px dotted #6495ed;
							padding:5px;
							background-color:#EFF6FF;
							width:25%;
							}
							td {
							font-family:sans-serif;
							font-size:80%;
							border:1px solid #6495ed;
							padding:5px;
							text-align:left;
							}
							caption {
							font-family:sans-serif;
							}

							.button {
							  font: bold 11px Arial;
							  color: #000000;

							      border: 1px solid #aa8d56;

							      color: #aa8d56;

							      outline: medium none;

							      padding: 15px;
							  
							      text-transform: none;



							}


							.btn-danger{
							background: red none repeat scroll 0 0;
							}


							.btn-succes{
								background: green none repeat scroll 0 0;
							}

							.btn-primary{
								background: blue none repeat scroll 0 0;
							}
							     
							     .btn-danger:hover {

							     Background-color:  #aa8d56;

							     Color: #ffffff;

							}                 	  

						</style>

							<br><br>
							';

							$mail['message'] .=  (isset($data['option']) && $data['option']== 1) ? ('<b style="color:black;font-weight: 600;font-size:12px;text-align:center,">*Actions requises.</b>
							<br><br>
							<div style="margin-left:100px">
							<a href="'.site_url().'/compte/activer_compte/'.($data['id']).'"  style="color:green;">Activer Compte</a>
							</div>
							
							<br><br>
							Date et Heure: '.date("Y-m-d H:i:s")

							.'<br><br><b style="color:blue">
							<div>
							======================
							</div>
							Equipe du projet LetterBox</b>') :('');
							


                            $mail['destination'] = $data['destination'];
                            sendMail($data['sitename'] . ' <no-reply@akasigroup.com>', $mail);
							
                           

}

function mailTemplate3($data)
{
	
                      $mail['title'] = $data['title'];
         			   
         			  $data['sitename'] = 'AKASI-LetterBox';

					  $mail['message'] = '<b style="color: blue;font-family:Arial,Helvetica,sans-serif;"> LetterBox</b> <b style="font-family:Arial,Helvetica,sans-serif;">'.$data['title'].'<br><br>'.$data['titleMessage'].'<br><br>


                      	  <style>
                      	  	table {
							border:3px solid #6495ed;
							border-collapse:collapse;
							width:90%;
							margin:auto;
							}
							thead, tfoot {
							background-color:#D0E3FA;
							background-image:url(sky.jpg);
							border:1px solid #6495ed;
							}
							tbody {
							background-color:#FFFFFF;
							border:1px solid #6495ed;
							}
							th {
							font-family:monospace;
							border:1px dotted #6495ed;
							padding:5px;
							background-color:#EFF6FF;
							width:25%;
							}
							td {
							font-family:sans-serif;
							font-size:80%;
							border:1px solid #6495ed;
							padding:5px;
							text-align:left;
							}
							caption {
							font-family:sans-serif;
							}

							.button {
							  font: bold 11px Arial;
							  color: #000000;

							      border: 1px solid #aa8d56;

							      color: #aa8d56;

							      outline: medium none;

							      padding: 15px;
							  
							      text-transform: none;



							}


							.btn-danger{
							background: red none repeat scroll 0 0;
							}


							.btn-succes{
								background: green none repeat scroll 0 0;
							}

							.btn-primary{
								background: blue none repeat scroll 0 0;
							}
							     
							     .btn-danger:hover {

							     Background-color:  #aa8d56;

							     Color: #ffffff;

							}                 	  

						</style>

							<br><br>
							';

							$mail['message'] .=  (isset($data['option']) && $data['option']== 3) ? ('<b style="color:black;font-weight: 600;font-size:12px;text-align:center,">*Actions requises.</b>
							<br><br>
							<div style="margin-left:100px">
							<a href="'.site_url().'/compte/activer_compte/'.($data['id']).'"  style="color:green;">Réinitialiser mot de passe</a>
							</div>
							
							<br><br>
							Date et Heure: '.date("Y-m-d H:i:s")

							.'<br><br><b style="color:blue">
							<div>
							======================
							</div>
							Equipe du projet LetterBox</b>') :('');
							


                            $mail['destination'] = $data['destination'];
                            sendMail($data['sitename'] . ' <no-reply@akasigroup.com>', $mail);
							
                           

}

?>