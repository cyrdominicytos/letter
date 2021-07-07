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



	<?php if (isset($msg)) { ?>

		<div class="col-md-2"></div>
		<div align="center" class="col-md-8 alert alert-danger">
			<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
			<b><?php echo $msg; ?></b>
		</div>
		<div class="col-md-2"></div>

		<hr/>
	<?php } ?>

	<div class="signinpanel">

		<div class="row">
			<div class="col-md-5">
				<img style="width:400px; min-height: 400px;" src="<?php echo base_url() ?>assets/img/letterbox.png" alt=""/>
			</div><!-- col-sm-7 -->

			<div class="col-md-6 col-md-offset-1" >

				<form style="border: none;" method="post" action="<?php echo site_url(); ?>Login/login/1">
					<div class="form-group col-md-12">
						
						<div class="form-group col-md-12">
							<h4><strong style="font-weight: bold;color: black;">Se connecter</strong></h4>
					<p>Bienvenue sur la plateforme <span style="font-weight: bold;">AKASI LetterBox</span></p>
						</div>
						
					<div class="form-group col-md-12">
						<label for="login">Adresse email</label>
						<input required maxlength="50"  style="margin-top: 0px"; id="login" name="login" type="email" class="form-control"
						   placeholder="Saisissez votre adresse email"/>
					</div>
					<div class="form-group col-md-12">
						<label>Mot de passe</label>
						<input maxlength="50" required style="margin-top: 0px"; name="password" type="password" class="form-control pword"
						   placeholder="Saisissez votre mot de passe"/>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-6">
							<!-- <span><input type="checkbox" style="margin-right: 5px;" name="checkbox" ><i></i>Se souvenir de moi</span> -->
						</div>
						<div class="col-md-6">
									<span>
										<a href="<?php echo site_url(); ?>compte/reset/" style="color: #2196f3;">Mot de passe oublié?</a>
									</span>
						</div>
								
					</div>

					<div class="form-group col-md-12">

                     <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="<?php echo $this->config->item('google_key') ?>" data-expired-callback="recaptchaExpired"></div>

                    <!--  <input hidden="" id='recaptcha_check_empty' required="true" tabindex='-1',style='width:50px;height:0;opacity:0;pointer-events:none;position:absolute;bottom:0;'> -->

                	</div>
                	
                	

					<!-- <div class="form-group col-md-12">
						<small>Mot de passe oublié?</small>
					</div> -->
						
					<div class="form-group col-md-12">
						<button disabled="" class="btn btn-success btn-block" id="envoie"  style="background-color: #2a72b5;">Se connecter</button>
					</div>


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


	
function recaptchaCallback() 
{
	// $('#recaptcha_check_empty').val(1);
    $('#envoie').removeAttr('disabled');
};

function recaptchaExpired() 
{
	// $('#recaptcha_check_empty').val(1);
    $('#envoie').attr('disabled','disabled');
    // alert("Your Recaptcha has expired, please verify it again !");
};

// function verifrecaptch()
// {

//     if(grecaptcha && grecaptcha.getResponse().length > 0)
// {
//      //the recaptcha is checked
//      // Do what you want here
//      alert('Well, recaptcha is checked !');
// }
// else
// {
//     //The recaptcha is not cheched
//     //You can display an error message here
//     alert('Oops, you have to check the recaptcha !');
// }

// }

</script>

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




</body>
</html>
