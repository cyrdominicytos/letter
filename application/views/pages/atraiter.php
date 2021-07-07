<div class="modal fade" id="mycourrierDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close"
						data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Suppression
				</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body" style="color:black;">
				<div id="deleteuser"></div>
				Etes vous sur de supprimer cet élément ?
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
				<a id='deluser' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mytransferer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close"
						data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Transférer
				</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body" style="color:black;">
				<form id="transferercourrier" class="form-horizontal" role="form"
					  action="" method="POST">
					<fieldset>
						<div id="formtransferer"></div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="com">Destinataire</label>
							<div class="col-sm-8">
								<select class="selectpicker" id="" name="fkIdDest">
									<?php
									if (isset($service) & count($service) > 0) {
										foreach ($service as $serv) {
											echo '<optgroup label="' . $serv['libelle_service'] . '">';
											if (isset($employe) & count($employe) > 0) {
												foreach ($employe as $item) {
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
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-5">
								<div class="col-md-7 col-md-push-3">
									<button type="submit" value="Enregister" class="btn btn-xs btn-primary">
										Transférer
									</button>
								</div>
							</div>

						</div>
					</fieldset>
				</form>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
				<!--a id='deluser' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a-->
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myarchiver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close"
						data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Archiver
				</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body" style="color:black;">
				<form id="archivercourrier" class="form-horizontal" role="form"
					  action="" method="POST">
					<fieldset>
						<div class="row">
							<div id="formarchiver"></div>
							Etes vous sur de vouloir archiver ce(s) courrier(s) ?
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-5">
									<div class="col-md-7 col-md-push-3">
										<button type="submit" value="Enregister" class="btn btn-xs btn-primary">
											Archiver
										</button>
									</div>
								</div>

							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
				<!--a id='deluser' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a-->
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
			<li class="active">A Traiter</li>
		</ol>
	</div>
</div>
<?php
echo validation_errors("<div class='alert alert-danger'>", "Erreur soumission formulaire </div>");

if ($this->session->flashdata('msg')) {
	echo $this->session->flashdata('msg');
}
?>
<?php if (isset($msg)) { ?>
	<div class="col-md-2"></div>
	<div align="center" class="col-md-8 alert <?php echo $class; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong><?php echo $msg; ?></strong>
	</div>
	<div class="col-md-2"></div>

	<hr/>
<?php }
?>

<div class="contentpanel" style="color:black;">

	<!--div class="btn-demo">
		<a href="<?php echo site_url(); ?>user/user" class="btn btn-xs btn-darkblue">
			<i class="fa fa-plus"></i> Créer un employé
		</a>
	</div-->

	<div class="panel panel-default">

		<div class="panel-body">
			<button id="transferer" data-id="" data-toggle="modal" data-target="#mytransferer"
					type="button" class="btn btn-xs btn-darkblue" disabled><i class="fa fa-reply"></i>
				Transférer
			</button>
			<button id="archiver" data-id="" data-toggle="modal" data-target="#myarchiver"
					type="button" class="btn btn-xs btn-darkblue" disabled><i class="fa fa-archive"></i>
				Archiver
			</button>
			<br>
			<br>
			<div class="table-responsive">
				<table class="table table-striped" id="users" data-page-length='25'>
					<thead>
					<tr>
						<th>#</th>
						<th style="text-align: center;">Id</th>
						<th style="text-align: center;">COURRIERS</th>
						<th style="text-align: center;">SERVICES</th>
						<th style="text-align: center;">TYPES</th>
						<th style="text-align: center;">PRIORITES</th>
						<th style="text-align: center;">DOSSIERS</th>
						<th style="text-align: center;">EXPEDITEURS</th>
						<th style="text-align: center;">DATES LIMITES</th>
						<th style="text-align: center;">PIECES</i></th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (isset($courriers)) {
						$i = 1;
						foreach ($courriers as $item) {
							?>
							<!-- <?php echo ($item['isread'] != 1) ? 'style="font-weight:bold;"' : ''; ?> -->
							<tr class="odd gradeX unread">
								<td class="center" style="text-align: center;"></td>
								<td class="center" style="text-align: center;"><?php echo $item['id_dif']; ?></td>
								<td class="center">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
										<?php echo $item['num_courrier'] ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<!--a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['fkIdcourier']; ?>#home2">
										<?php echo ($item['categorieCourier'] == 'D') ? 'Départ' : 'Arrivé'; ?>
									</a-->
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
										<?php echo $item['libelle_service'] ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
										<?php echo isset($item['libelle_type']) ? $item['libelle_type'] : ''; ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
										<?php echo strtoupper($item['priorite_courrier']); ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>">
										<?php echo $item['nom_dossier']; ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
										<?php 
                                        $CI =& get_instance();
                                        $CI->load->database();
                                        $CI->load->model('CourrierModel');

                                       $exp = $CI->CourrierModel->getExpCourrierById($item['courrier_exp']);
                                        
                                        echo strtoupper($exp->nomcomplet) ;
                                    ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
									<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>">
										<?php
                                        if ($item['date_limite']!='00-00-0000') {
                                            echo $item['date_limite'];
                                        }
                                        else{
                                            echo 'Pas de date limite';
                                        }
                                          
                                         ?>
									</a>
								</td>
								<td class="center" style="text-align: center;">
                                    <!-- <a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_courrier']; ?>#home2"> -->
                                    <div class="col-sm-12" style="margin-top: 2px;">

                                    <?php

                                       if(isset($docs))
                                          if(array_key_exists($item['id_courrier'],$docs))
                                            {
                                                ?>
                        <div class="btn-group  col-sm-12">
                        <button type="button" class="btn btn-default dropdown-toggle col-sm-12" data-toggle="dropdown">
                            Pièces 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                             <?php
                                    
                                    foreach ($docs[$item['id_courrier']] as $values)
                                        {
                                         ?>
                            <li>
                                <a href="<?php echo site_url(); ?>tb/download/<?php echo $values['chemin']; ?>">
                                                     <?php echo $values['chemin']; ?>
                                            </a>
                            </li>
                            <?php
                                            
                                            }
                                            ?>
                            
                        </ul>
                    </div>
                               
                        <?php
                               }
                                            

                          ?>
                                    
                                    
                        </div> 
                                    <!-- </a> -->
                                </td>
							</tr>
							<?php
							$i++;
						}
					}
					?>
					</tbody>
				</table>
			</div><!-- table-responsive -->

		</div><!-- panel-body -->
	</div><!-- panel -->

</div><!-- contentpanel -->

</div><!-- mainpanel -->

</section>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cookies.js"></script>

<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>


<script src="<?php echo base_url(); ?>assets/api/datatables-rowsgroup-master/dataTables.rowsGroup.js"></script>
<script>
    jQuery(document).ready(function () {

        "use strict";
        var burl = "<?php echo base_url(); ?>";
        var surl = "<?php echo site_url(); ?>";

        var oTable1 = jQuery('#users').DataTable({
            "language": {
                "url": burl + "assets/js/others/French.json"
            },
            "sPaginationType": "full_numbers",
            responsive: true,
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                targets: 1,
                visible: false
            }
            ],
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });

        /*oTable1.on('select', function (e, dt, type, indexes) {
            alert('ed');
            $('#transferer').removeAttr('disabled');
            $('#archiver').removeAttr('disabled');
        }).on('deselect', function (e, dt, type, indexes) {
            $('#transferer').prop('disabled', true);
            $('#archiver').prop('disabled', true);
        });*/

        $('#users tbody').on('click', 'tr', function () {

            $(this).toggleClass('selected');
            var d = oTable1.rows('.selected').data();

            if (d.length == 0) {
                $('#transferer').prop('disabled', true);
                $('#archiver').prop('disabled', true);
            } else {
                $('#transferer').removeAttr('disabled');
                $('#archiver').removeAttr('disabled');
            }
        });

        $('#archiver').click(function () {
            var d = oTable1.rows('.selected').data();
            $("#formarchiver").children().remove();
            $.each(d, function (index, element) {
                $("#formarchiver").append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'idCourierTraite[]')
                        .val(element[1])
                );
            });

            var HREF = surl + 'courrier/archivercourrier'
            jQuery("form[id='archivercourrier']").attr('action', HREF);//Show  fetched  data  from  database

            jQuery("#confirmModalY").click(function (e) {

            });
        });

        $('#transferer').click(function () {
            var d = oTable1.rows('.selected').data();
            $("#formtransferer").children().remove();
            $.each(d, function (index, element) {
                $("#formtransferer").append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'idCourierTraite[]')
                        .val(element[1])
                );
            });

            var HREF = surl + 'courrier/transferercourrier'
            jQuery("form[id='transferercourrier']").attr('action', HREF);//Show  fetched  data  from  database

            jQuery("#confirmModalY").click(function (e) {

            });
        });

        // Select2
        jQuery('select').select2({
            minimumResultsForSearch: -1
        });

        jQuery('select').removeClass('form-control');

        // Delete row in a table
        jQuery('.delete-row').click(function () {
            var c = confirm("Continue delete?");
            if (c)
                jQuery(this).closest('tr').fadeOut(function () {
                    jQuery(this).remove();
                });

            return false;
        });

        // Show aciton upon row hover
        jQuery('.table-hidaction tbody tr').hover(function () {
            jQuery(this).find('.table-action-hide a').animate({opacity: 1});
        }, function () {
            jQuery(this).find('.table-action-hide a').animate({opacity: 0});
        });


    });
</script>

</body>
</html>
