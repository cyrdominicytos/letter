<div class="modal fade" id="editerExp" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Editer Expéditeur
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="height: 15px;" id="bloc_editer" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_editer" style="margin-top: -8px;"></p></b>
            
                </div>
                </div>
                <form id="basicForm1" class="form-horizontal" method="post" action="<?php echo site_url(); ?>courrier/submit_edit_exp">
                	<div class="col-sm-12">
                    <div class="form-group" >
                        <div class="col-sm-4">
                            <label class="control-label">Nom complet<span style="color: red">*</span></label>
                            <input type="text" maxlength="50" id="edit_exp_name"  name="nomcomplet_edit" class="form-control" required/>
                            <input type="text" hidden="" name="ancien_nomcomplet" id="ancien_nomcomplet">
                            <input type="text" hidden="" name="ancien_email" id="ancien_email">
                            <input type="text" hidden="" name="edit_exp_id" id="edit_exp_id">
                            
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Email</label>
                            <input type="email" maxlength="50" id="email_exp_edit" name="email_exp_edit" class="form-control"/>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Téléphone</label>
                            <input type="number" min="0" minlength="8" maxlength="20" name="num_exp_edit" id="num_exp_edit" class="form-control"/>
                        </div>

                    </div>
                    </div>
                    	<br><br><br><br>
                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  id="aj_dossier_editer"  type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Editer
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
                <form id="basicForm" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_expediteur">
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





<div class="modal fade" id="mydossierDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
				Etes vous sûr de supprimer cet élément ?
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
				<a id='delExpediteur' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a>
			</div>
		</div>
	</div>
</div>


<div class="pageheader">
	<h2><i class="fa fa-table"></i> EXPEDITEURS <span>GESTION DES EXPEDITEURS</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
			<li class="active">EXPEDITEURS</li>
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

	
	<div class="btn-demo">
		<a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newexp">
			<i class="fa fa-plus"></i><span style="font-size: 15px;"> Créer un expéditeur</span>
		</a>
	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<div class="table-responsive">
				<table class="table table-striped" id="users">
					<thead>
					<tr>
						<th>#</th>
                        <th>NOM COMPLET</th>
                        <th>EMAIL</th>
						<th>TELEPHONE</th>
						<th style="text-align:center">ACTIONS</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (isset($expediteur)) {
						$i = 1;
						foreach ($expediteur as $item) {
							?>
							<tr class="odd gradeX unread">
								<td class="center"><?php echo $i; ?></td>
                                <td class="center"><?php echo $item['nomcomplet']; ?></td>
                                <td class="center"><?php echo $item['email_exp']; ?></td>
                                <td class="center"><?php echo $item['tel_exp']; ?></td>
								<td class="center" style="text-align:center">
									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li>
                                            	<a data-id="<?php echo $item['id_exp']; ?>" title="Editer" onclick="editer_expediteur('<?php echo $item['nomcomplet']; ?>','<?php echo $item['email_exp']; ?>',<?php echo $item['tel_exp']; ?>,<?php echo $item['id_exp']; ?>);"  href="" data-toggle="modal" >
                                            	
                                            	<!-- data-target="#editerservice" -->
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span>
                                                </a>
                                                
                                               
                                            </li>

											<li><a data-id="<?php echo $item['id_exp']; ?>"
												   data-toggle="modal" title="Supprimer le dossier" id="ExpediteurDelete"
												   data-target="#mydossierDelete" href="#">
                                                    <span class="glyphicon glyphicon-trash"> Supprimer</span></a></li>
										</ul>
									</div>
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


<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>


<script src="<?php echo base_url(); ?>assets/api/datatables-rowsgroup-master/dataTables.rowsGroup.js"></script>
<script>
	jQuery(document).ready(function () {

		"use strict";
		var burl = "<?php echo base_url(); ?>";
		var surl = "<?php echo site_url(); ?>";

		jQuery('#users').dataTable(
			{
				"language": {
					"url": burl + "assets/js/others/French.json"
				},
				"sPaginationType": "full_numbers"
			});

		jQuery("#users").on('click', '#ExpediteurDelete', function (e) {

			e.preventDefault();

			var rowid = jQuery(this).attr("data-id");

			var HREF = surl + 'courrier/deleteExp?id=' + rowid;

			jQuery('#delExpediteur').attr('href', HREF);//Show  fetched  data  from  database

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

<script type="text/javascript">

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
	
function editer_expediteur(arg1,arg2,arg3,arg4) 
	{

		var argu1 = arg1;
		var argu2 = arg2;
		var argu3 = arg3;
		var argu4 = arg4;

		var edit_exp_name = document.getElementById("edit_exp_name").value;
		var email_exp_edit = document.getElementById("email_exp_edit").value;
		var num_exp_edit = document.getElementById("num_exp_edit").value;

		document.getElementById("ancien_nomcomplet").value = argu1;

		document.getElementById("ancien_email").value = argu2;

		document.getElementById("edit_exp_id").value = argu4;

		

		// alert(argu4);

		// alert(argu1);
		// alert(argu2);
		$("#editerExp").modal('show');
		document.getElementById("bloc_editer").style.display = "none";
		if (empty(edit_exp_name)==false) {

			document.getElementById("edit_exp_name").value=argu1;
		}
		if (empty(email_exp_edit)==false) {

			document.getElementById("email_exp_edit").value=argu2;
		}
		if (empty(num_exp_edit)==false) {
			// alert(argu3);

			document.getElementById("num_exp_edit").value = argu3;
			// document.getElementById("edit_dossier_type_id").selectedIndex=1;
			
		}
		

}


</script>


</body>
</html>
