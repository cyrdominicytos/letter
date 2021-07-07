<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/letterbox2.png" type="image/jpg">

	<title>LetterBox</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

	<link href="<?php echo base_url() ?>assets/css/style.default.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
	<script src="<?php echo base_url()?>assets/js/respond.min.js"></script>
	<![endif]-->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="signin" style="background-color: white;">



	<div align="center" style="display: none;" id="id_msg" class="col-md-10 col-md-offset-1 alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
            <b><p id="msg_user"></p></b>
            
    </div>

	<div class="signinpanel">

		<div class="row">
			<div class="col-md-5">
				<img style="width:400px; min-height: 400px;" src="<?php echo base_url() ?>assets/img/letterbox.png" alt=""/>
			</div><!-- col-sm-7 -->

			<div class="col-md-6 col-md-offset-1" >

				<form style="border: none;" method="post" action="<?php echo site_url(); ?>compte/submit_reset/">
					<div class="form-group col-md-12">
						
						<div class="form-group col-md-12">
							<h4>Bienvenue sur la plateforme <span style="font-weight: bold;">AKASI LetterBox</span></h4>
							<!-- <p><b style="font-weight: bold;color: black;">Réinitialiser mot de passe</b></p> -->
							<p>Saisissez votre adresse email pour recevoir des instructions pour réinitialiser votre mot de passe</p>
					
						</div>
						
					<div class="form-group col-md-12">
						<label for="login">Adresse email</label>
						<input required  style="margin-top: 0px" maxlength="50" onchange="mailexiste();" id="email_reset" name="login" type="email" class="form-control uname"
						   placeholder="Saisissez votre adresse email"/>
					</div>
					<div class="form-group col-md-12">

                    <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="<?php echo $this->config->item('google_key') ?>" data-expired-callback="recaptchaExpired"></div>

                	</div>
						
					<div class="form-group col-md-12">
						<button  class="btn btn-success btn-block" id="id_reset" disabled="" style="background-color: #2a72b5;">Réinitialiser mot de passe</button>
					</div>
					<div class="m-3 text-left text-muted"><p class=""><a href="<?php echo site_url(); ?>tb"class="text-primary ml-2"><i class="fa fa-arrow-circle-left"></i> Retour </a></p></div>

					
					</div>
			
					
					

				</form>
			</div><!-- col-sm-5 -->

		</div><!-- row -->
	</div><!-- signin -->



<script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.cookies.js"></script>

<script src="<?php echo base_url() ?>assets/js/toggles.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/retina.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
<script>
	jQuery(document).ready(function () {

		// Please do not use the code below
		// This is for demo purposes only
		var c = jQuery.cookie('change-skin');
		if (c && c == 'greyjoy') {
			jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
		} else if (c && c == 'dodgerblue') {
			jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
		} else if (c && c == 'katniss') {
			jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
		}
	});
</script>

<script type="text/javascript">

    var email = <?php echo json_encode($EmailExiste); ?>;
    document.getElementById("id_msg").style.display = "none";

     function empty(value) 
        {
       
            var p = value;

            if (p.length === 0 || !p.trim()) 
            {
                // alert('toto');
                return false;
            }
            else
            {
                // alert('tata');
                return true;
            }

        }

    function recaptchaCallback() 
	{
		// $('#recaptcha_check_empty').val(1);
	var x = document.getElementById("email_reset").value;
	if (empty(x)==true) {

		if (mailexiste()==true) {
			$('#id_reset').removeAttr('disabled');
		}

	}
		
	    
	};

	function recaptchaExpired() 
	{
		// $('#recaptcha_check_empty').val(1);
	    $('#id_reset').attr('disabled','disabled');
	    // alert("Your Recaptcha has expired, please verify it again !");
	};


    // document.getElementById('id_reset').disabled=true;
    function mailexiste()
    {

      var x = document.getElementById("email_reset").value; 
      
      if(email[x]!==x)
        {
        document.getElementById('id_reset').disabled=true;
        document.getElementById("id_msg").style.display = "block";
        document.getElementById("msg_user").innerHTML = "L'adresse email que vous avez saisi n'existe pas dans le système !! ";
        return false;
        }
    else
        {
        	if (grecaptcha && grecaptcha.getResponse().length > 0) {

        		document.getElementById('id_reset').disabled=false;
        	}
        	else
        	{
        		document.getElementById('id_reset').disabled=true;
        	}
        	document.getElementById("id_msg").style.display = "none";
        // document.getElementById('id_reset').disabled=false;
        	return true;
        }
    }


   
</script>




</body>
</html>
