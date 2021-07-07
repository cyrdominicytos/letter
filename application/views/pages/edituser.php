<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> EMPLOYES <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Nouveaux</li>
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

		<form id="basicForm" method="post" action="<?php echo site_url(); ?>user/edituser?id=<?php echo $_GET['id'] ?>"
			  class="form-horizontal">

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="minimize">&minus;</a>
						</div>
						<h4 class="panel-title">Editer un employé</h4>
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
                                <input type="text" value="<?php echo isset($user) ? $user->titreemp : ''; ?>" name="titreemp" class="form-control" required/>
                            </div>
						</div>
                        <div class="form-group">

                            <div class="col-sm-4">
                                <input type="email" value="<?php echo isset($user) ? $user->emailemp : ''; ?>" name="emailemp" class="form-control" required/>
                            </div>
                            <div class="col-sm-4">
                                <select name="fkidgroupe" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Groupe</option>
                                    <!--option selected value="<?php echo isset($groupe) ? $groupe->idgroupe : $groupe->idgroupe; ?>"><?php echo isset($groupe) ? $groupe->libellegroupe : $groupe->libellegroupe; ?></option-->
                                    <?php
                                    if(isset($groupe) & count($groupe)>0) {
                                        foreach ($groupe as $item) {
                                        	if( isset($user) && $user->fkidgroupe == $item['idgroupe'] ) $sel = 'selected';
                                        	else $sel = '';
                                        	?>
                                            <option <?php echo $sel ?> value="<?php echo $item['idgroupe'] ?>"><?php echo $item['libellegroupe'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select id="fkidservice" name="fkidservice" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Service</option>
                                    <!--
                                    <?php
                                    if(isset($service) & count($service)>0) {
                                        foreach ($service as $item) {
                                            if($user->fkidservice == $item['idservice']) $sel ='selected';
                                            else $sel = '';
                                            ?>
                                            <option <?php echo $sel; ?> value="<?php echo $item['idservice'] ?>"><?php echo $item['libelleservice'] ?></option>
                                        <?php }
                                    }
                                    ?> -->
                                </select>
                            </div>
                            <!--div class="col-sm-4">
                                <select name="fkidprofil" class="select2" required data-placeholder="Choisissez...">
                                    <option value="">Profil</option>
                                    <option value="1">Super admin</option>
                                    <option value="2">Utilisateur</option>
                                </select>
                            </div-->
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
<script>




    var idgroupe =  $("select[name='fkidgroupe']").val();
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

    $("select[name='fkidgroupe']").on('change', function () { // lorsqu'on change de valeur dans la liste

        var idgroupe = $(this).val(); // valeur sélectionnée
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
