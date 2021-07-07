<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> PROFIL <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Mon profile</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

	<div class="row">

		<?php if (isset($msg)) { ?>

			<div class="col-md-2"></div>
			<div align="center" class="col-md-8 alert <?php echo $class; ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $msg; ?></strong>
			</div>
			<div class="col-md-2"></div>

			<hr/>
		<?php } ?>

		<form id="basicForm" method="post" action="<?php echo site_url(); ?>user/upprofile?id=<?php echo $_GET['id']; ?>"
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
						<label class="col-sm-10 control-label"> </label>
						<button style="text-align:center" type="submit" class="col-sm-1 btn-xs btn-primary">
							Enregistrer
						</button>
						<br/>
						<div class="form-group">
							<label class="col-sm-1 control-label"> </label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset($user) ? $user->nomemp : ''; ?>" name="nomemp" class="form-control"/>
							</div>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset($user) ? $user->prenomemp : ''; ?>" name="prenomemp" class="form-control" required/>
							</div>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset($user) ? $user->username : ''; ?>" name="username" class="form-control"
									   required/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<input type="text" readonly value="<?php echo isset($user) ? $user->titreemp : ''; ?>" name="titreemp" class="form-control" required/>
							</div>
                            <div class="col-sm-4">
                                <input type="email" value="<?php echo isset($user) ? $user->emailemp : ''; ?>" name="emailemp" class="form-control" required/>
                            </div>
							<div class="col-sm-4">
                                <input type="hidden" name="passwordold" value="<?php echo isset($user) ? $user->password : ''; ?>" />
								<input type="password" name="password" placeholder="mot de passe" class="form-control"/>
							</div>

                            <input name="idemp" type="hidden" value="<?php echo $user->idemp ?>" />
                            <input name="fkidgroupe" type="hidden" value="<?php echo $user->idgroupe ?>" />
                            <input name="fkidservice" type="hidden" value="<?php echo $user->fkidservice ?>" />
                            <input name="fkidprofil" type="hidden" value="<?php echo $user->fkidprofil ?>" />
						</div>
                        <!--div class="form-group">
                            <div class="col-sm-4">
                                <select readonly="" name="fkidgroupe" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Groupe</option>
                                    <option value="<?php echo isset($groupe) ? $groupe->idgroupe : $groupe->idgroupe; ?>"><?php echo isset($groupe) ? $groupe->libellegroupe : $groupe->libellegroupe; ?></option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select readonly="" name="fkidservice" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Service</option>
                                    <?php
                                    if(isset($service) & count($service)>0) {
                                        foreach ($service as $item) { ?>
                                            <option value="<?php echo $item['idservice'] ?>"><?php echo $item['libelleservice'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="fkidprofil" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Profil</option>
                                    <option value="1">Super admin</option>
                                    <option value="2">Utilisateur</option>
                                </select>
                            </div>
                        </div-->
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
