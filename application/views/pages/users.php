<div class="modal fade" id="myuserDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
				<a id='deluser' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a>
			</div>
		</div>
	</div>
</div>


<div class="pageheader">
	<h2><i class="fa fa-table"></i> UTILISATEURS <span>GESTION DES UTILISATEURS</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
			<li class="active">UTILISATEURS</li>
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
		<a href="<?php echo site_url(); ?>user/user" class="btn btn-xs btn-darkblue">
			<i class="fa fa-plus"></i><span style="font-size: 15px;"> Créer un employé</span>
		</a>
	</div>


	<div class="panel panel-default">

		<div class="panel-body">

			<div class="table-responsive">
				<table class="table table-striped" id="users">
					<thead>
					<tr>
						<th>#</th>
						<th>Nom & prénom</th>
						<!-- <th>Username</th> -->
						<th>Email</th>
						<th>Titre</th>
						<th>Profil</th>
						<th>Service</th>
						<th>Statut</th>
						<!--th>Groupe</th-->
						<th style="text-align:center">Actions</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (isset($users)) {
						$i = 1;
						foreach ($users as $item) {
							?>
							<tr class="odd gradeX unread">
								<td class="center"><?php echo $i; ?></td>
                                <td class="center"><?php echo $item['nom_user'].' '.$item['prenom_user']; ?></td>
								<!-- <td class="center"><?php echo $item['username']; ?></td> -->
								<td class="center"><?php echo $item['email']; ?></td>
								<td class="center"><?php echo $item['titre']; ?></td>
								<td class="center"><?php
								  $libelle_priv= strtolower($item['libelle_priv']); 	echo ucwords($libelle_priv);
								 ?></td>
								<td class="center"><?php
									$nameservice =strtolower($item['libelle_service']);
									$code_service = strtolower($item['code_service']);
								 echo ucwords($nameservice).' ('.ucwords($code_service).')'; ?></td>
								<td class="center">
									<?php 
									if ($item['statut']==1) {
										echo "Actif";
									}
									elseif ($item['statut']==2) {
										echo "Banni";
									}
									elseif ($item['statut']==3) {
										echo "En attente";
									} 
									?>
										
									</td>
								<!--td class="center"><?php echo $item['libellegroupe']; ?></td-->
								<td class="center" style="">

									<?php 
									if ($item['statut']==1) {
									?>	

									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li><a  title="Editer utilisateur"  href="<?php echo site_url()  ?>user/edituser?id=<?php echo $item['id_user']?>">
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span></a></li>
											<li><a data-id="<?php echo $item['id_user']; ?>"
												   data-toggle="modal" title="Bannir utilisateur" id="USERDelete"
												   data-target="#myuserDelete" href="#">
                                                    <span class="glyphicon glyphicon-trash"> Supprimer</span></a></li>
										</ul>
									</div>


									<?php
									}
									elseif ($item['statut']==2) {

									?>

									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li><a  title="Editer utilisateur"  href="<?php echo site_url()  ?>user/edituser?id=<?php echo $item['id_user']?>">
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span></a></li>
											<li><a  title="Activer utilisateur"href="<?php echo site_url()  ?>user/reactiverUser?id=<?php echo $item['id_user']?>" href="#">
                                                    <span class="fa fa-check"> Activer</span></a></li>
										</ul>
									</div>


									<?php	
									}
									elseif ($item['statut']==3) {
									?>

									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li><a  title="Editer utilisateur"  href="<?php echo site_url()  ?>user/edituser?id=<?php echo $item['id_user']?>">
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span></a></li>
											<li><a data-id="<?php echo $item['id_user']; ?>"
												   data-toggle="modal" title="Bannir utilisateur" id="USERDelete"
												   data-target="#myuserDelete" href="#">
                                                    <span class="glyphicon glyphicon-trash"> Supprimer</span></a></li>
										</ul>
									</div>


									<?php
									} 
									?>

									
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

		jQuery("#users").on('click', '#USERDelete', function (e) {

			e.preventDefault();

			var rowid = jQuery(this).attr("data-id");

			var HREF = surl + 'user/deleteuser?id=' + rowid;

			jQuery('#deluser').attr('href', HREF);//Show  fetched  data  from  database

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
