<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<style type="text/css">
	/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="pageheader">
	<h2><i class="fa fa-table"></i> COURRIERS <span>GESTION DES COURRIERS</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
			<li class="active">Courriers</li>
		</ol>
	</div>
</div>

<div class="contentpanel">

	<div class="row">

		<?php if (isset($msg)) { ?>

			<div class="col-md-2">
				
			</div>
			<div align="center" class="col-md-8 alert <?php echo $class; ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $msg; ?></strong>
			</div>
			<div class="col-md-2"></div>

			<hr/>
		<?php } ?>


		<form id="basicForm" method="post"
			  action="<?php echo site_url(); ?>courrier/newcourrier"
			  enctype="multipart/form-data" class="form-horizontal">


			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="minimize">&minus;</a>
						</div>
						<h4 class="panel-title"><b style="color: #1e88e5;"> Détails du courrier <?php echo isset($liste_courrier['num_courrier']) ? $liste_courrier['num_courrier'] : '' ?></b></h4>
					</div>

		
					<div class="panel-body">
						
						

						<!-- <label class="col-sm-1 control-label"> </label> -->
						<div class="col-sm-12">
							<div class="form-group">
								
								<div class="col-sm-6">
									<label>Catégorie courrier: <span style="color: red">*</span></label>
									<select disabled="" class="select2" required
											data-placeholder="Choisissez..." name="categorieCourier">
										<option <?php if($liste_courrier['categorie_courrier'] == 'DEPART') echo 'selected' ?> value="DEPART">DEPART</option>
										<option <?php if($liste_courrier['categorie_courrier'] == 'ARRIVE') echo 'selected' ?> value="ARRIVE">ARRIVE</option>
									</select>
								</div>

								<div class="col-sm-6">
									<label>Type courrier: <span style="color: red">*</span></label>
									<select disabled="" class="select2" required name="typeCourier" id="changement" onchange="myFunction();">
										<option value="">Choisissez...</option>
                                    <?php
                                    if(isset($liste_type_courrier)) {
                                        foreach ($liste_type_courrier as $item) { ?>
                                            <option <?php if($liste_courrier['id_type']==$item['id_type'] ) echo 'selected' ?> value="<?php echo $item['id_type'] ?>"><?php echo $item['libelle_type'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
									<input type="text" hidden="" id="id_date_relance" name="date_relance">
								</div>
							</div>

							<?php 
							if (isset($liste_courrier['id_appel']))
							{
							 	
							?> 

							<div class="form-group" >
								
								<div class="col-sm-6">
									<label>Provenance de l’appel: <span style="color: red">*</span></label>
									<input type="text" disabled="" value="<?php echo isset($liste_courrier['provenance']) ? $liste_courrier['provenance'] : '' ?>" name="origine_tel" maxlength="50" required
											   class="form-control" placeholder="Provenance de l’appel">
								</div>

								<div class="col-sm-6">
									<label>Numéro appelant: <span style="color: red">*</span></label>
									<input type="number" disabled="" value="<?php echo isset($liste_courrier['numero']) ? $liste_courrier['numero'] : '' ?>" maxlength="20" name="tel" required
											   class="form-control" placeholder="Numéro appelant">
								</div>
								<div class="col-sm-12">
									<label>Objet de l’appel: <span style="color: red">*</span></label>
									<textarea type="text" disabled="" name="obj_tel" rows="2" maxlength="100" required
											   class="form-control" placeholder="Objet de l’appel"><?php echo isset($liste_courrier['objet_appel']) ? $liste_courrier['objet_appel'] : '' ?></textarea>
								</div>

								<div class="col-sm-12">
									<label>Mention: <span style="color: red">*</span></label>
									<select disabled="" class="select2" required name="mention">
										<option <?php if($liste_courrier['mention']=="regulier" ) echo 'selected' ?> value="regulier">Régulier</option>
										<option <?php if($liste_courrier['mention']=="urgente" ) echo 'selected' ?> value="urgente">Urgente</option>
										
									</select>
								</div>

								<div class="col-sm-6">
									<label>Destination de l’appel : <span style="color: red">*</span></label>
									<input type="text" disabled="" value="<?php echo isset($liste_courrier['destination']) ? $liste_courrier['destination'] : '' ?>" name="des_tel" maxlength="50" required
											   class="form-control" placeholder="Destination de l’appel">
								</div>

								<div class="col-sm-6">
									<label>Action requise : <span style="color: red">*</span></label>
									<input type="text" disabled="" value="<?php echo isset($liste_courrier['action']) ? $liste_courrier['action'] : '' ?>" name="action" maxlength="100" required
											   class="form-control" placeholder="Action requise">
								</div>

								<div class="col-sm-12">
									<label>Message de l’appel: <span style="color: red">*</span></label>
									<textarea type="text" disabled="" name="mes_tel" maxlength="255" rows="4" required
											   class="form-control" placeholder="Message de l’appel"><?php echo isset($liste_courrier['message_appel']) ? $liste_courrier['message_appel'] : '' ?></textarea> 
								</div>
								
							</div>
							<?php
								}
								?>

							<?php 
							if (isset($liste_courrier['id_facture']))
							{
							 	
							?> 

							<div class="form-group" >

								<div class="col-sm-6">
									<label>Provenance de la facture: <span style="color: red">*</span></label>
									<input type="text" value="<?php echo isset($liste_courrier['provenance_fact']) ? $liste_courrier['provenance_fact'] : '' ?>" disabled="" name="origine_fact" maxlength="50" required
											   class="form-control" placeholder="Provenance de la facture">
								</div>
								<div class="col-sm-6">
									<label>Montant: <span style="color: red">*</span></label>
									<input type="number" value="<?php echo isset($liste_courrier['montant_fact']) ? $liste_courrier['montant_fact'] : '' ?>" disabled=""  maxlength="20" min="1" name="montant" required
											   class="form-control" placeholder="1234">
								</div>
								<div class="col-sm-12">
									<label>Type facture: <span style="color: red">*</span></label>
									<select class="select2" disabled="" required name="type_facture">
										<option <?php if($liste_courrier['type_facture']=="Électricité" ) echo 'selected' ?> value="Électricité">Électricité</option>
										<option <?php if($liste_courrier['type_facture']=="Gaz" ) echo 'selected' ?> value="Gaz">Gaz</option>
										<option <?php if($liste_courrier['type_facture']=="Eau" ) echo 'selected' ?> value="Eau">Eau</option>
										<option <?php if($liste_courrier['type_facture']=="Téléphone" ) echo 'selected' ?> value="Téléphone">Téléphone</option>
										<option <?php if($liste_courrier['type_facture']=="Internet" ) echo 'selected' ?> value="Internet">Internet</option>
										<option <?php if($liste_courrier['type_facture']=="Autre" ) echo 'selected' ?> value="Autre">Autre prestation</option>
										
									</select>
								</div>
								<div class="col-sm-12">
									<label>Date d’échéance paiement: <span style="color: red">*</span></label>
									<div class="input-group">
										<input type="text" value="<?php echo isset($liste_courrier['date_paie']) ? $liste_courrier['date_paie'] : '' ?>"  disabled="" name="date_echeant" required
											   class="form-control datepicker" placeholder="mm/dd/yyyy">
										<span class="input-group-addon"><i
												class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>

							</div>

							<?php
							}
							?>


							<!-- <div class="form-group">
							</div> -->
							<div class="form-group">
								<div class="col-sm-6">
									<label>Priorité courrier: <span style="color: red">*</span></label>
									<select disabled="" name="prioriteCourier" class="select2" required
											data-placeholder="Choisissez...">
										<option <?php if($liste_courrier['priorite_courrier'] == 'Urgente') echo 'selected' ?> value="Urgente">Urgente
										</option>
										<option <?php if($liste_courrier['priorite_courrier'] == 'Normale') echo 'selected' ?> value="Normale">Normale
										</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label>Dossier concerné: <span style="color: red">*</span></label>
									<select disabled="" name="fkIdDossier"  class="select2" required>
										<option value="">Choisissez...</option>
										<?php
                                    if(isset($liste_dossier)) {
                                        foreach ($liste_dossier as $item) { ?>
                                            <option <?php if($liste_courrier['fki_dossier']==$item['id_dossier'] ) echo 'selected' ?> value="<?php echo $item['id_dossier'] ?>"><?php echo $item['nom_dossier'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
								</div>
							</div>
							<!-- <div class="form-group">
								
							</div> -->
							<div class="form-group">
								<div class="col-sm-6">
									<label>Lier Courrier: <span style="color: red">*</span></label>
									<select disabled="" name="lieidCourierTraite" class="select2" required
											data-placeholder="Choisissez...">
										<option value="">Sélectionner</option>
										<option value="0">Aucun</option>
										<optgroup label="Départs">
											 <?php if (isset($depart) & count($depart) > 0) {
												foreach ($depart as $item) {

												?>
                                            <option <?php if($liste_courrier['courier_lier']==$item['id_courrier'] ) echo 'selected' ?> value="<?php echo $item['id_courrier'] ?>"><?php echo $item['num_courrier'] ?></option>
                                       		 <?php 

												}
											} 
											?> 
										</optgroup>
										<optgroup label="Arrivés">
											 <?php if (isset($arrive) & count($arrive) > 0) {
												foreach ($arrive as $item) {
													?>
                                            <option <?php if($liste_courrier['courier_lier']==$item['id_courrier'] ) echo 'selected' ?> value="<?php echo $item['id_courrier'] ?>"><?php echo $item['num_courrier'] ?></option>
                                       		 <?php 

												}
												}
					
											?> 
										</optgroup>
									</select>
								</div>
								<div class="col-sm-6">
									<label>Destinataire courrier: <span style="color: red">*</span></label>
									<input type="text" class="form-control" value="<?php echo isset($liste_courrier['fki_user_dif']) ? $liste_courrier['prenom_user'].' '.$liste_courrier['nom_user'] : '' ?>" disabled="" name="expCourier"/>

			
									
								</div>
							</div>

							<!--div class="form-group">
								<label>Date courrier: </label>
								<div class="col-sm-12">
									<input  type="text"
										   name="dateCourier"
										   class="form-control"/>
								</div>
							</div-->
							<!-- <div class="form-group">
								
							</div> -->
							<!--form-group end-->

							<div class="form-group">
								
								<div class="col-sm-12">
									<label>Objet courrier: <span style="color: red">*</span></label>
                                    <textarea disabled="" style="margin-left: 0px;" type="text" maxlength="100"  name="objetCourier" class="form-control"><?php 
									echo isset($liste_courrier['objet_courrier']) ? $liste_courrier['objet_courrier'] : '' 
									?></textarea>
								</div>
							</div>

							<div class="form-group">
								
										
								<?php
									if (isset($liste_courrier['date_limite'])) {
									 	
									  
								?> 

									<div class="col-sm-6" style="margin-top:3px;">
										
										<label>Date limite de traitement: <span style="color: red">*</span></label>
										<div class="input-group">
											<input type="text" value="<?php echo isset($liste_courrier['date_limite']) ? $liste_courrier['date_limite'] : '' ?>" id="id_limite" disabled="" name="dateLimittraiteCourier" required
												   class="form-control datepicker" placeholder="mm/dd/yyyy">
											<span class="input-group-addon"><i
													class="glyphicon glyphicon-calendar"></i></span>
												
									</div>
									</div>
							<?php
						}
									
							?>
								<div class="col-sm-6">
									<label>Nature courrier: <span style="color: red">*</span></label>
									<select class="select2" disabled="" required
											data-placeholder="Choisissez..." name="natureCourier">
										<option <?php if($liste_courrier['nature_courrier']=="NUMERIQUE" ) echo 'selected' ?> value="NUMERIQUE">NUMERIQUE</option>
										<option <?php if($liste_courrier['nature_courrier']=="PHYSIQUE" ) echo 'selected' ?> value="PHYSIQUE">PHYSIQUE</option>
									</select>
								</div>
							</div>
							
						
							<div class="form-group">
								
								<div class="col-sm-6">
									<label>Date du courrier: <span style="color: red">*</span></label>
									<div class="input-group">
										
										<input type="text" disabled="" value="<?php echo isset($liste_courrier['date_courrier']) ? $liste_courrier['date_courrier'] : '' ?>" name="date_courrier" required
											   class="form-control datepicker" placeholder="mm/dd/yyyy">
										<span class="input-group-addon"><i
												class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>

								<div class="col-sm-6">
									<label>Date d'arrivée: <span style="color: red">*</span></label>
									<div class="input-group">
										
										<input type="text" disabled="" value="<?php echo isset($liste_courrier['date_arrivee']) ? $liste_courrier['date_arrivee'] : '' ?>" name="date_arrivee" required
											   class="form-control datepicker" placeholder="mm/dd/yyyy">
										<span class="input-group-addon"><i
												class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>

							<div class="form-group">

								<div class="col-sm-12">
									<label>Confidentiel: <span style="color: red">*</span></label>
									<select disabled="" class="select2" id="diff" required name="confidentiel" onchange="diffusion();">
										<option <?php if($liste_courrier['confidentiel']=="non" ) echo 'selected' ?> value="non">Non</option>
										<option <?php if($liste_courrier['confidentiel']=="oui" ) echo 'selected' ?> value="oui">Oui</option>
										
									</select>
								</div>

								
								<div class="col-sm-12">

									<label>Informations complémentaires: <span style="color: red">*</span></label>
									<input type="text" disabled=""  value="<?php echo isset($liste_courrier['info']) ? $liste_courrier['info'] : '' ?>" name="info" maxlength="50" required
											   class="form-control" placeholder="Informations complémentaires">
									
								</div>
								<div class="col-sm-12">

									<label>Mots clés: <span style="color: red">*</span></label>
									<input type="text" disabled="" value="<?php echo isset($liste_courrier['mot_cle']) ? $liste_courrier['mot_cle'] : '' ?>" name="mot_cle" maxlength="50" required
											   class="form-control" placeholder="Mots clés">
									
								</div>
								
								<!-- <div class="col-sm-12">
									<label>Pièce jointe: </label>
									<input type="file" placeholder="Pièce jointe" name='doc[]' multiple 
										   class="form-control" />
								</div> -->
									<!-- onchange="loadFile(event)" -->
							</div>

							
<div class="col-sm-12">
							 	<!-- <iframe id="previewfile" src="" width="100%" height="500" align="middle">
							 		
							 	</iframe> -->
							 </div>
							<!--  <div class="col-sm-12">

								<button style="text-align:center; margin-top: 80PX" type="submit"  class="col-sm-2 col-sm-offset-3 btn btn-xs btn-primary">
									Enregistrer
								</button>
								<button class="col-sm-2 col-sm-offset-2 btn btn-success btn-xs" type="button" style="text-align:center; margin-top: 80PX" onclick="scan();">Scan
								</button>
							 </div> -->

						</div>
						<!-- <div class="col-sm-offset-1 col-sm-7">
							 
							

							
						</div> -->
					</div><!-- panel-body -->
					


				</div><!-- panel -->
			</div><!-- col-md-6 -->

		</form>

	</div><!--row -->

</div><!-- contentpanel -->

</div><!-- mainpanel -->


</section>

<script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/toggles.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/retina.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.cookies.js"></script>


<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.tagsinput.min.js"></script>


<script src="<?php echo base_url() ?>assets/api/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/api/moment/min/fr.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/api/datepicker/bootstrap-datepicker.js"></script>


<script src="<?php echo base_url() ?>assets/js/dropzone.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<script type="text/javascript"
		src="<?php echo base_url() ?>assets/api/jquery-multi-select/js/jquery.multi-select.js"></script>

<script type="text/javascript"
		src="<?php echo base_url() ?>assets/api/jquery-multi-select/js/jquery.quicksearch.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/api/form-components.js"></script>

<script src="<?php echo base_url(); ?>assets/js/scannerjs/dist/scanner.js"></script>


<script>

    //var output = document.getElementById('previewfile');
    //output.src = URL.createObjectURL(burl+'assets/docs'+$("#linkDocOld").val());

    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var previewfile = document.getElementById('previewfile');
            previewfile.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<script>
    jQuery(document).ready(function () {

        "use strict";

        jQuery('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            language: 'fr'
        });

        // Select2
        jQuery(".select2").select2({
            width: '100%',
            minimumResultsForSearch: -1
        });

        jQuery("#EMPLOYENew").on('click', function (e) {

            e.preventDefault();

            jQuery("#confirmModalY").click(function (e) {

            });

        });

        // Basic Form
        jQuery("#basicForm").validate({
            highlight: function (element) {
                jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            }
        });


    });
</script>
<script type="text/javascript" >
    // Need to upload scanned images to server or save them on hard disk? Please refer to the dev guide: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
    // For more scanning code samples, please visit https://github.com/Asprise/scannerjs.javascript-scanner-access-in-browsers-chrome-ie.scanner.js

    var scanRequest = {
        "use_asprise_dialog": true, // Whether to use Asprise Scanning Dialog
        "show_scanner_ui": false, // Whether scanner UI should be shown
        "twain_cap_setting": { // Optional scanning settings
            "ICAP_PIXELTYPE": "TWPT_RGB" // Color
        },
        "output_settings": [{
            "type": "return-base64",
            "format": "jpg"
        }]
    };

    /** Triggers the scan */
    function scan() {
        scanner.scan(displayImagesOnPage, scanRequest);
    }

    /** Processes the scan result */
    function displayImagesOnPage(successful, mesg, response) {
        if (!successful) { // On error
            console.error('Failed: ' + mesg);
            return;
        }
        if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
            console.info('User cancelled');
            return;
        }
        var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
        for (var i = 0;
             (scannedImages instanceof Array) && i < scannedImages.length; i++) {
            var scannedImage = scannedImages[i];
            var elementImg = scanner.createDomElementFromModel({
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            (document.getElementById('previewfile') ? document.getElementById('previewfile') : document.body).appendChild(elementImg);
        }
    }
</script>

<script>



function addDate(d, nb) {
// additionne nb jours à une date
var d1 = d.getTime(), d2 = new Date();
d1 += 24*3600*1000*nb
d2.setTime(d1)
return d2
}

document.getElementById("id_appel").style.display = "none";
document.getElementById("id_facture").style.display = "none";
function myFunction() 
{
  
var x = document.getElementById("changement").value;
var list_relance = <?php echo json_encode($type_delai_relance); ?>;
var list_traitement = <?php echo json_encode($type_delai_traitement); ?>;
 

if (list_traitement[x] !== undefined && list_traitement[x].length > 0)
{
var jour_traitement = list_traitement[x];

var d = new Date(); // date du jour

var d2 = addDate(d, jour_traitement); // additionne 5 jours

// alert(d2.toLocaleString()); // ou toute autre méthode sur les dates

document.getElementById("id2_limite").value = d2.toLocaleString();

// ('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second:'numeric' });

document.getElementById("id_limite").value = d2.toLocaleString();
	
}

if (list_relance[x] !== undefined && list_relance[x].length > 0)
{
var jour_relance = list_relance[x];

var d = new Date(); // date du jour

var d2 = addDate(d, jour_relance); // additionne 5 jours

// alert(d2.toLocaleString()); // ou toute autre méthode sur les dates

// document.getElementById("id_date_relance").value = d2.toLocaleString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit' });
	// , hour: '2-digit', minute: '2-digit', second:'numeric'
	document.getElementById("id_date_relance").value = d2.toLocaleString();

	
}
// alert(d2.toLocaleString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second:'numeric' }));

// , hour: '2-digit', minute: '2-digit', second:'numeric'
document.getElementById("id_appel").style.display = "none";
document.getElementById("id_facture").style.display = "none";

 if (x=="11") {
document.getElementById("id_facture").style.display = "block";
}
if (x=="7") {
document.getElementById("id_appel").style.display = "block";
}

}

document.getElementById("date_limite").style.display = "none";
function limite()
{
	document.getElementById("date_limite").style.display = "none";
if (document.getElementById("limite_date").checked === true) {

    document.getElementById("date_limite").style.display = "block";
}

}

document.getElementById("id_diffusion").style.display = "block";


function diffusion(){

	var a = document.getElementById("diff").value;

	document.getElementById("id_diffusion").style.display = "block";

if (a=="oui") {
document.getElementById("id_diffusion").style.display = "none";
}

}

// myFunction();
// limite();
// diffusion()
</script>


</body>
</html>
