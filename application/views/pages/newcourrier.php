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


<div class="modal fade" id="newdossier" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" onclick="refresh();">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Fermer</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Ajouter Dossier
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="display: none; height: 15px;" id="id_msg_dossier" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_dossier" style="margin-top: -8px;"></p></b>
            
                </div>
                </div>
                <form id="basicForm1" class="form-horizontal" method="post" action="<?php echo site_url(); ?>courrier/submit_dossier_plus">
                	<div class="col-sm-12">
                    <div class="form-group" >
                        <div class="col-sm-4" >
                            <label class="control-label">Dossier<span style="color: red">*</span></label>
                            <input type="text" maxlength="30" id="aj_dossier_id" onchange="dossier_code_existe();" placeholder="Ex: Dossier_SBEE" name="libelle_dossier" class="form-control" required/>
                        </div>

                        <div class="col-sm-4" >
                            <label class="control-label">Code<span style="color: red">*</span></label>
                            <input type="text" maxlength="15" id="aj_dossier_code_id" placeholder="Ex: Dossier_001" onchange="dossier_code_existe();" name="code_dossier" class="form-control" required/>
                        </div>

                        <div class="col-sm-4">
                          <label class="control-label" style="margin-left: 8px;">Type<span style="color: red">*</span></label>
									<select name="typedossier" id="aj_dossier_type_id" onchange="dossier_code_existe();" class="col-sm-12 select2" required>
										<option value="">CHOISISSEZ...</option>
										<option value="COURRIER">COURRIER</option>
										<option value="AUTRE">AUTRE</option>
									</select>

                        </div>

                    </div>
                    </div>
                    	<br><br><br><br>
                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  id="aj_dossier" disabled="" type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
           
        </div>
    </div>
</div>


<div class="modal fade" id="newexp" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" onclick="refresh();">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Fermer</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Ajouter Expéditeur
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="display: none; height: 15px;" id="id_msg_dossier" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_dossier" style="margin-top: -8px;"></p></b>
            
                </div>
                </div>
                <form id="basicForm2" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_expediteur_plus">
                	<div class="col-sm-12">
                    <div class="form-group" >
                        <div class="col-sm-4">
                            <label class="control-label">Nom complet<span style="color: red">*</span></label>
                            <input type="text" maxlength="50" name="nomcomplet" class="form-control" required/>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Email</label>
                            <input type="email" maxlength="50" name="email_exp" class="form-control"/>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Téléphone</label>
                            <input type="number" min="0" minlength="8" maxlength="20" name="num_exp" class="form-control"/>
                        </div>


                    </div>
                    </div>
                    	<br><br><br><br>
                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
           
        </div>
    </div>
</div>





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
						<h4 class="panel-title">Nouveau courrier</h4>
					</div>

					<div class="panel-body">
						
					
						<!-- <label class="col-sm-1 control-label"> </label> -->
						<!-- <div class="col-sm-12"> -->
							<div class="form-group">
								
								<div class="col-sm-6">
									<label>Catégorie courrier: <span style="color: red">*</span></label>
									<select class="select2" required
											data-placeholder="Choisissez..." name="categorieCourier">
										<option value="DEPART">DEPART</option>
										<option value="ARRIVE">ARRIVE</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label>Type courrier: <span style="color: red">*</span></label>
									<select class="select2" required name="typeCourier" id="changement" onchange="myFunction();">
										<option value="">Choisissez...</option>
                                    <?php
                                    if(isset($liste_type_courrier)) {
                                        foreach ($liste_type_courrier as $item) { ?>
                                            <option value="<?php echo $item['id_type'] ?>"><?php echo $item['libelle_type'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
									<input type="text" hidden="" id="id_date_relance" name="date_relance">
								</div>

								<div class="col-sm-3">
									<label>Service Destinataire: <span style="color: red">*</span></label>
									<select class="select2" required name="service_dest">
										<option value="">Choisissez...</option>
                                    <?php
                                    if(isset($listservice)) {
                                        foreach ($listservice as $item) { ?>
                                            <option value="<?php echo $item['id_service'] ?>"><?php echo $item['libelle_service'].' ('.$item['code_service'].')' ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
									<!-- <input type="text" hidden="" id="id_date_relance" name="date_relance"> -->
								</div>
							</div>

							<div id="id_appel">

								<div class="form-group">
								<div class="col-sm-6">
									<label>Provenance de l’appel: <span style="color: red">*</span></label>
									<input type="text" name="origine_tel" maxlength="70" required
											   class="form-control" placeholder="Provenance de l’appel">
								</div>

								<div class="col-sm-6">
									<label>Numéro appelant: <span style="color: red">*</span></label>
									<input type="number" min="0" minlength="8" maxlength="20" name="tel" required
											   class="form-control" placeholder="Numéro appelant">
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-6">
									<label>Objet de l’appel: <span style="color: red">*</span></label>
									<textarea type="text" name="obj_tel" rows="2" maxlength="100" required
											   class="form-control" placeholder="Objet de l’appel"></textarea>
								</div>

								<div class="col-sm-6">
									<label>Mention: <span style="color: red">*</span></label>
									<select class="select2" required name="mention">
										<option value="REGULIER">Régulière</option>
										<option value="URGENTE">Urgente</option>
										
									</select>
								</div>

								</div>

								

								<div class="form-group">
								<div class="col-sm-6">
									<label>Destination de l’appel : <span style="color: red">*</span></label>
									<input type="text" name="des_tel" maxlength="50" required
											   class="form-control" placeholder="Destination de l’appel">
								</div>

								<div class="col-sm-6">
									<label>Action requise : <span style="color: red">*</span></label>
									<input type="text" name="action" maxlength="50" required class="form-control" placeholder="Action requise">
								</div>
							</div>

								<div class="form-group">
								<div class="col-sm-12" style="margin-bottom: 18px;">
									<label>Message de l’appel: <span style="color: red">*</span></label>
									<textarea type="text" name="mes_tel" maxlength="255" rows="4" required
											   class="form-control" placeholder="Message de l’appel"></textarea> 
								</div>
							</div>
								
							</div>

							<div  id="id_facture">

								<div class="form-group">
								<div class="col-sm-6">
									<label>Provenance de la facture: <span style="color: red">*</span></label>
									<input type="text" name="origine_fact" maxlength="50" required
											   class="form-control" placeholder="Provenance de la facture">
								</div>
								<div class="col-sm-6">
									<label>Montant: <span style="color: red">*</span></label>
									<input type="number" maxlength="20" min="1" name="montant" required
											   class="form-control" placeholder="1234">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6">
									<label>Type facture: <span style="color: red">*</span></label>
									<select class="select2" required name="type_facture">
										<option value="Électricité">Électricité</option>
										<option value="Gaz">Gaz</option>
										<option value="Eau">Eau</option>
										<option value="Téléphone">Téléphone</option>
										<option value="Internet">Internet</option>
										<option value="Autre">Autre prestation</option>
										
									</select>
								</div>
								<div class="col-sm-6" style="margin-bottom: 10px;">
									<label>Date d’échéance paiement: <span style="color: red">*</span></label>
									
										<input type="date" style="max-height: 40px; height: 40px;" name="date_echeant" required
											   class="form-control ">
										
									</div>
								</div>
								</div>

							<!-- </div> -->


							<!-- <div class="form-group">
							</div> -->
							<div class="form-group">
								<div class="col-sm-3">
									<label>Priorité courrier: <span style="color: red">*</span></label>
									<select name="prioriteCourier" class="select2" required
											data-placeholder="Choisissez...">
										<option value="Urgente">Urgente
										</option>
										<option value="Normale">Normale
										</option>
									</select>
								</div>
								<div class="col-sm-3">
									<label>Lier Courrier: <span style="color: red">*</span></label>
									<select name="lieidCourierTraite" class="select2" required
											data-placeholder="Choisissez...">
										<option value="">Sélectionner</option>
										<option value="0">Aucun</option>
										<optgroup label="Départs">
											 <?php if (isset($depart) & count($depart) > 0) {
												foreach ($depart as $item) {
													echo '<option value="' . $item['num_courrier'] . '">' . $item['num_courrier'] . '</option>';
												}
											} ?> 
										</optgroup>
										<optgroup label="Arrivés">
											 <?php if (isset($arrive) & count($arrive) > 0) {
												foreach ($arrive as $item) {
													echo '<option value="' . $item['num_courrier'] . '">' . $item['num_courrier'] . '</option>';
												}
											} ?> 
										</optgroup>
									</select>
								</div>
								
								<?php if ($_SESSION['dossierpriv'] == 1) { ?>
								<div class="col-sm-4">
									<label>Dossier concerné: <span style="color: red">*</span></label>
									<select name="fkIdDossier" class="select2" required>
										<option value="">Choisissez...</option>
										<?php
                                    if(isset($liste_dossier)) {
                                        foreach ($liste_dossier as $item) { ?>
                                            <option value="<?php echo $item['id_dossier'] ?>"><?php echo $item['nom_dossier'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
								</div>
								<div class="btn-demo col-sm-2" style="margin-top: 30px;">
									<a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newdossier">
									<i class="fa fa-plus"></i><span style="font-size: 15px;"> Dossier(s)</span>
									</a>
								</div>
								<?php
								}
								else
								{
								?>
										<div class="col-sm-6">
									<label>Dossier concerné: <span style="color: red">*</span></label>
									<select name="fkIdDossier" class="select2" required>
										<option value="">Choisissez...</option>
										<?php
                                    if(isset($liste_dossier)) {
                                        foreach ($liste_dossier as $item) { ?>
                                            <option value="<?php echo $item['id_dossier'] ?>"><?php echo $item['nom_dossier'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
								</div>
								<?php
								}
								?>
							</div>
							<!-- <div class="form-group">
								
							</div> -->
							<div class="form-group">
								
								<?php if ($_SESSION['dossierpriv'] == 1) { ?>

								<div class="col-sm-4">
									<label>Expéditeur: <span style="color: red">*</span></label>
									<select name="exp" class="select2" required>
										<option value="">Choisissez...</option>
										<?php
                                    if(isset($expediteur)) {
                                        foreach ($expediteur as $item) { ?>
                                            <option value="<?php echo $item['id_exp'] ?>"><?php echo $item['nomcomplet'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
								</div>
								<div class="btn-demo col-sm-2" style="margin-top: 30px;">
									<a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newexp">
									<i class="fa fa-plus"></i><span style="font-size: 15px;"> Expéditeur(s)</span>
									</a>
								</div>
								<?php
								}
								else
								{
									?>
										<div class="col-sm-6">
									<label>Expéditeur: <span style="color: red">*</span></label>
									<select name="exp" class="select2" required>
										<option value="">Choisissez...</option>
										<?php
                                    if(isset($expediteur)) {
                                        foreach ($expediteur as $item) { ?>
                                            <option value="<?php echo $item['id_exp'] ?>"><?php echo $item['nomcomplet'] ?></option>
                                        <?php }
                                    }
                                    ?>
									</select>
								</div>
									<?php

								}
								?>
								<div class="col-sm-6">
									<label>Destinataire courrier: <span style="color: red">*</span></label>
									<input type="hidden" name="expCourier"
										   value="<?php echo isset($_SESSION) ? $_SESSION['userid'] : '' ?>"/>

									<input type="hidden" name="serviceInit"
										   value="<?php echo isset($_SESSION) ? $_SESSION['idservice'] : '' ?>"/>
									<select name="destCourier[]" id="tableau_dest" class="select2" required multiple
											data-placeholder="Choisissez...">

										 <?php
										if (isset($listservice)) {

											foreach ($listservice as $serv) {
												echo '<optgroup label="' . $serv['libelle_service'] . '">';
												if (isset($liste_destinataire)) {
													foreach ($liste_destinataire as $item) {
														if ($item['fki_service_us'] == $serv['id_service'] && $item['id_user'] != $_SESSION['userid']) { ?>
															<option
																value="<?php echo $item['id_user'] ?>"><?php echo $item['nom_user'] . ' ' . $item['prenom_user'] ?></option>
															<?php
														}
													}
												}
												echo '</optgroup>';
											}

										}
										?> 
									</select>
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
                                    <textarea type="text" maxlength="100" placeholder="Objet courrier" name="objetCourier" required
											  style="resize: none;" class="form-control"></textarea>
								</div>
							</div>

							<div class="form-group">
								
								<div class="col-sm-6">
									<div class="form-group">
										<div class="col-sm-4">
										<label>Activer date limite:</label><br>
										<label class="switch">
										  <input type="checkbox" name="active_date" id="limite_date" onclick="limite();">
										  <span class="slider round"></span></label>
									</div>
									<div class="col-sm-8" id="date_limite">
										
										<label>Date limite de traitement: <span style="color: red">*</span></label>
										<!-- <div class="input-group"> -->
											<input type="date" style="max-height: 40px; height: 40px;" id="id_limite" disabled="" name="dateLimittraiteCourier" required
												   class="form-control">
											<!-- <span class="input-group-addon"><i
													class="glyphicon glyphicon-calendar"></i></span> -->
											<input type="text" hidden="" id="id2_limite" name="id2_limite_name">
										
									<!-- </div> -->
									</div>
								</div>
							</div>
								<div class="col-sm-6">
									<label>Nature courrier: <span style="color: red">*</span></label>
									<select class="select2" required
											data-placeholder="Choisissez..." name="natureCourier">
										<option value="NUMERIQUE">NUMERIQUE</option>
										<option value="PHYSIQUE">PHYSIQUE</option>
									</select>
								</div>
							</div>
							
						
							<div class="form-group">
								
								<div class="col-sm-6">
									<label>Date du courrier: <span style="color: red">*</span></label>
									
										
										<input type="date" id="datecreation" onchange="limiter_date();" name="date_courrier" required
											   class="form-control" >
									
								</div>

								<div class="col-sm-6">
									<label>Date d'arrivée: <span style="color: red">*</span></label>
									
										
										<input type="date" onchange="limiter_date2();" id="datearrive"  name="date_arrivee" required
											   class="form-control " >
										
									
								</div>
							</div>

							<div class="form-group">

								<div class="col-sm-6">
									<label>Confidentiel: <span style="color: red">*</span></label>
									<select class="select2" id="diff" required name="confidentiel" onchange="diffusion();">
										<option value="non">Non</option>
										<option value="oui">Oui</option>
										
									</select>
								</div>
								<div class="col-sm-6">

									<label>Mots clés: <span style="color: red">*</span></label>
									<input type="text" required="" name="mot_cle" maxlength="20"class="form-control" placeholder="Mots clés">
									
								</div>
							</div>

								<div class="form-group">
								<div class="col-sm-6">

									<label>Informations complémentaires: </label>
									<input type="text" name="info" maxlength="50" class="form-control" placeholder="Informations complémentaires">
									
								</div>

								<div class="col-sm-6">
									<label>Pièce jointe: </label>
									<input type="file" id="fichier" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" max-file-size="8"  placeholder="Pièce jointe" name='doc[]' multiple 
										   class="form-control" />
								</div>
							</div>
								
								
								

							<div class="form-group">
								
								<!--col-md-9 start-->
								<div class="col-sm-12" id="id_diffusion">
									<label>Liste de diffusion : </label>
									<select multiple="multiple" class="multi-select" id="my_multi_select2"
											name="fkIdDest[]">
										 <?php
										if (isset($listservice) & count($listservice) > 0) {
											foreach ($listservice as $serv) {
												echo '<optgroup label="' . $serv['libelle_service'] . '">';
												if (isset($liste_destinataire) & count($liste_destinataire) > 0) {
													foreach ($liste_destinataire as $item) {
														if ($item['fki_service_us'] == $serv['id_service'] && $item['id_user'] != $_SESSION['userid']) { ?>
															<option
																value="<?php echo $item['id_user'] ?>"><?php echo $item['nom_user'] . ' ' . $item['prenom_user'] ?></option>
															<?php
														}
													}
												}
												echo '</optgroup>';
											}

										}
										?> 
									</select>
								</div>
								<!--col-md-9 end-->
							</div>
<div class="col-sm-12">
							 	<!-- <iframe id="previewfile" src="" width="100%" height="500" align="middle">
							 		
							 	</iframe> -->
							 </div>
							 <div class="col-sm-12">

								<button style="text-align:center;font-size: 16px; margin-top: 80PX" type="submit" name="valider"  class="col-sm-4 col-sm-offset-4 btn btn-xs btn-primary">
									Valider
								</button>
								<!-- <button class="col-sm-2 col-sm-offset-2 btn btn-success btn-xs" type="button" style="text-align:center; margin-top: 80PX" onclick="scan();">Scan
								</button> -->
							 </div>

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




<script type="text/javascript">

	var dossier_existe = <?php echo json_encode($dossiers_existe); ?>;

	function refresh()	
	{
	window.location.reload()

	}

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

	String.prototype.remove_accent = function()
    {

        var accent = [
            /[\300-\306]/g, /[\340-\346]/g, // A, a
            /[\310-\313]/g, /[\350-\353]/g, // E, e
            /[\314-\317]/g, /[\354-\357]/g, // I, i
            /[\322-\330]/g, /[\362-\370]/g, // O, o
            /[\331-\334]/g, /[\371-\374]/g, // U, u
            /[\321]/g, /[\361]/g, // N, n
            /[\307]/g, /[\347]/g, // C, c
        ];
        var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
         
        var str = this;
        for(var i = 0; i < accent.length; i++){
            str = str.replace(accent[i], noaccent[i]);
        }
         
        return str;

    }


        function check_dossier() 
        {
            var x1 = document.getElementById("aj_dossier_code_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

          if(dossier_existe[x]==x)
            {
            	
                document.getElementById("id_msg_dossier").style.display = "block";
                document.getElementById("msg_dossier").innerHTML = "Ce code est déjà attribué à un dossier dans le système !! ";
                return false;
            }
            else
            {
            	
                document.getElementById("id_msg_dossier").style.display = "none";
                return true;
            }

        }

        

    	function dossier_code_existe()
        {
        	// alert('f');
            check_dossier();
          if((check_dossier()==true))
            {	
            	// alert('toto');
                var dossier_id = document.getElementById("aj_dossier_id").value;
                var dossier_code_id = document.getElementById("aj_dossier_code_id").value;
                var dossier_type_id = document.getElementById("aj_dossier_type_id").value;

                empty(dossier_id);
                empty(dossier_code_id);
                empty(dossier_type_id);


                if ((empty(dossier_id)==true)&&(empty(dossier_code_id)==true)&&(empty(dossier_type_id)==true)) 
                {
                	// alert('bobo');
                    document.getElementById('aj_dossier').disabled=false;
                }
                else
                {
                		
                       document.getElementById('aj_dossier').disabled=true; 
                }

                
            }
            else
            {
            	
                document.getElementById('aj_dossier').disabled=true;
            }
        }


</script>



<script>

	var uploadField = document.getElementById("fichier");

uploadField.onchange = function() {
    if(this.files[0].size > 1073741824){
       alert("Taille du fichier doit êtes inférieur à 1GB");
       this.value = "";
    };
};




	var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			 if(dd<10){
			        dd='0'+dd
			    } 
			    if(mm<10){
			        mm='0'+mm
			    } 

			today = yyyy+'-'+mm+'-'+dd;
			// document.getElementById("datecreation").setAttribute("max", today);

			datecreation.max = today;
			datearrive.max = today;


	function limiter_date()
	{
		  var datearrive = document.getElementById('datearrive');
		  var datecreation = document.getElementById('datecreation');
		  var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			 if(dd<10){
			        dd='0'+dd
			    } 
			    if(mm<10){
			        mm='0'+mm
			    } 

			today = yyyy+'-'+mm+'-'+dd;
			// document.getElementById("datecreation").setAttribute("max", today);

			datecreation.max = today;
		  
		  datearrive.min = datecreation.value;

		  datearrive.max = today;
		
		

	}

	function limiter_date2()
	{
		  var datearrive = document.getElementById('datearrive');
		  var datecreation = document.getElementById('datecreation');

		  var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			 if(dd<10){
			        dd='0'+dd
			    } 
			    if(mm<10){
			        mm='0'+mm
			    } 

			today = yyyy+'-'+mm+'-'+dd;
		
		  datecreation.max = datearrive.value;
		
		

	}
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

// document.getElementById("id_limite").value = d2.toLocaleString();
document.getElementById("id_limite").value = d2.toLocaleString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit'});
	
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
