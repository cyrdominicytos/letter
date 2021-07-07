<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> EMPLOYES <span>GESTION DES UTILISATEURS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Mon Profil</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

	<div class="row">


        <div align="center" style="display: none;" id="id_msg" class="col-md-12 alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
            <b><p id="msg_user"></p></b>
            
        </div>
		<!-- <?php if (isset($msg)) { ?>

			<div class="col-md-2"></div>
			<div align="center" class="col-md-8 alert <?php echo $class; ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $msg; ?></strong>
			</div>
			<div class="col-md-2"></div>

			<hr/>
		<?php } ?> -->

		<form id="basicForm" method="post" action="<?php echo site_url(); ?>user/edituser?id=<?php echo $_GET['id'] ?>"
			  class="form-horizontal">

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="minimize">&minus;</a>
						</div>
						<h4 class="panel-title">Mon profil</h4>
					</div>

					<div class="panel-body">
						
						<!-- <br/> -->
						<div class="form-group">
							
							<div class="col-sm-6 ">
                                <label class="control-label">Nom</label>
								<input type="text" disabled="" maxlength="50" required="" value="<?php echo isset($user) ? $user->nom_user : ''; ?>" placeholder="Nom" name="nomemp" class="form-control"/>
							</div>

							<div class="col-sm-6">
                                <label class="control-label">Prénom(s)</label>
								<input type="text" disabled="" maxlength="50" value="<?php echo isset($user) ? $user->prenom_user : ''; ?>" required="" placeholder="Prénom" name="prenomemp" class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
                                <label class="control-label">Poste</label>
								<input type="text" disabled="" maxlength="50" value="<?php echo isset($user) ? $user->titre : ''; ?>" placeholder="Poste" name="titreemp" class="form-control" required/>
							</div>

                            <div class="col-sm-6">
                                <label class="control-label">Adresse Email</label>
                                <input type="email" disabled="" maxlength="50" value="<?php echo isset($user) ? $user->email : ''; ?>" placeholder="Email" name="emailemp" class="form-control" id="verif_mail" onchange="mailexiste()" required/>
                                <input type="email" value="<?php echo isset($user) ? $user->email : ''; ?>" hidden="" name="ancien_email_name" id="ancien_email_id">
                            </div>
							<!-- <div class="col-sm-4">
								<input type="password" name="password" placeholder="mot de passe" class="form-control"
									   required/>
							</div> -->
						</div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label">Succursale</label>
                                <select name="fkidgroupe" disabled="" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Choisissez...</option>
                                    <!--option value="<?php echo isset($groupe) ? $groupe->idgroupe : $groupe->idgroupe; ?>"><?php echo isset($groupe) ? $groupe->libellegroupe : $groupe->libellegroupe; ?></option-->
                                    <?php
                                    if(isset($groupe) & count($groupe)>0) {
                                        foreach ($groupe as $item) { ?>
                                            <option value=<?= $item['id_suc'] ?> <?=  ($item['id_suc'] == $user->id_suc) ? ('selected'): ('') ?>>
                                            	<?php echo $item['libelle_suc'] ?>
                                            		
                                            </option>
                                        <?php }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Service</label>
                                <select  name="fkidservice" disabled="" class="select2" required data-placeholder="Choisissez...">
                                    <!-- id="fkidservice" -->
                                    <option value="">Choisissez...</option>
                                    <?php
                                    if(isset($service) ) {
                                        foreach ($service as $item) { ?>
                                            <option value=<?= $item['id_service'] ?> <?=  ($item['id_service'] == $user->id_service) ? ('selected'): ('') ?>>
                                            	<?php echo $item['libelle_service'].' ('.$item['code_service'].')' ?>
                                            		
                                            </option>
                                        <?php }
                                    }
                                    ?>

                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label">Profil</label>
                                <select name="fkidprofil" disabled="" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Choisissez...</option>
                                    <!--option value="1">Super admin</option>
                                    <option value="2">Utilisateur</option-->
                                    <?php
                                    if(isset($priv) & count($priv)>0) {
                                        foreach ($priv as $item) { ?>
                                            <option value=<?= $item['id_priv'] ?> <?=  ($item['id_priv'] == $user->id_priv) ? ('selected'): ('') ?>>
                                            	<?php echo $item['libelle_priv'] ?>
                                            		
                                            </option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>

                               <!--      <div class="col-sm-2 col-sm-offset-2">
                                <br><br> -->
                                <!-- <label class="control-label"> SFFSFSFS</label> -->
                                <!-- <button style="text-align:center" id="id_save" type="submit" class="col-sm-12 btn btn-primary btn-hover btn-sm">
                                    Editer
                                </button>

                                </div>
 -->                                
                        </div>

                            

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


<script src="<?php echo base_url() ?>assets/js/dropzone.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<script type="text/javascript">
     var email = <?php echo json_encode($EmailExiste); ?>;
     document.getElementById("id_msg").style.display = "none";

    // document.getElementById('id_save').disabled=true;
    function mailexiste()
    {

      var x = document.getElementById("verif_mail").value; 
      var ancien_email = document.getElementById("ancien_email_id").value; 

      
      if(email[x]==x && email[x]!=ancien_email)
        {
        document.getElementById('id_save').disabled=true;
        document.getElementById("id_msg").style.display = "block";
        document.getElementById("msg_user").innerHTML = "L'adresse email que vous avez saisi est déjà attribué à un utilisateur. ";
        }
    else
        {
        document.getElementById("id_msg").style.display = "none";
        document.getElementById('id_save').disabled=false;
        }
    }


   
</script>

<script>
    $("select[name='fkidgroupe']").on('change', function () { // lorsqu'on change de valeur dans la liste

        var idgroupe = $(this).val(); // valeur sélectionnée

        //var _url = "$_SERVER['HTTP_HOST']";
        var HREF = surl+'bureau/getService?id='+idgroupe;


        $("#fkidservice").find('option').remove();

        var posting = $.post(HREF);

        posting.done(function (data) {

            $.each(data, function (index, element) {

                $("#fkidservice").append($('<option>', {
                    value: element.idservice,
                    text: element.libelleservice
                }, '</option>'));
            });
            $("#fkidservice").append($('<option>', {
                value: '',
                text: 'Service',
            }, '</option>'));
            if ($(("#fkidservice") + ' option').length > 0) {
                firstopt = $(("#fkidservice") + ' option')[0];
                $(firstopt).selected = true;
                $(firstopt).attr('selected', 'selected');

            }
            $("#fkidservice").trigger('change');
        });

    });
</script>

<script>
	jQuery(document).ready(function () {

		"use strict";

		jQuery('#tags').tagsInput({width: 'auto'});

		// Select2
		jQuery(".select2").select2({
			width: '100%',
			minimumResultsForSearch: -1
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




</body>
</html>
