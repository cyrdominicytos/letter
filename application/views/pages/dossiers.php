<div class="modal fade" id="editerdossier" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Editer Dossier
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
                <form id="basicForm1" class="form-horizontal" method="post" action="<?php echo site_url(); ?>courrier/submit_edit_dossier">
                	<div class="col-sm-12">
                    <div class="form-group" >
                        <div class="col-sm-4">
                            <label class="control-label">Dossier<span style="color: red">*</span></label>
                            <input type="text" maxlength="30" id="edit_dossier_name" onchange="edit_dossier_code_existe();" placeholder="Ex: Dossier_SBEE" name="edit_libelle_dossier" class="form-control" required/>
                            <input type="text" hidden="" name="ancien_code_name" id="ancien_code">
                            <input type="text" hidden="" name="edit_id" id="edit_dossier_id">
                            <input type="text" hidden="" name="suc_name" id="suc_id">
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label">Code<span style="color: red">*</span></label>
                            <input type="text" maxlength="15" id="edit_dossier_code_id" placeholder="Ex: Dossier_001" onchange="edit_dossier_code_existe();" name="code_dossier" class="form-control" required/>
                        </div>

                        <div class="col-sm-4">
                          <label class="control-label" style="margin-left: 8px;">Type<span style="color: red">*</span></label>
									<select name="typedossier" id="edit_dossier_type_id" onchange="edit_dossier_code_existe();" class="col-sm-12 select2" required>
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
                        <button style="text-align:center"  id="aj_dossier_editer" disabled="" type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Editer
                        </button>
                    </div>

                </form>
            </div>
           
        </div>
    </div>
</div>




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
                <form id="basicForm" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_dossier">
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

                        <div class="col-sm-4" >
                          <label class="control-label" style="margin-left: 8px;">Type<span style="color: red">*</span></label>
									<select name="typedossier" id="aj_dossier_type_id" onchange="dossier_code_existe();" class="col-sm-12 select2 form-control" required>
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
				<a id='deldossier' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a>
			</div>
		</div>
	</div>
</div>


<div class="pageheader">
	<h2><i class="fa fa-table"></i> DOSSIERS <span>GESTION DES DOSSIERS</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
			<li class="active">DOSSIERS</li>
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
		<a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newdossier">
			<i class="fa fa-plus"></i><span style="font-size: 15px;"> Créer un dossier</span>
		</a>
	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<div class="table-responsive">
				<table class="table table-striped" id="users">
					<thead>
					<tr>
						<th>#</th>
                        <th>CODES</th>
                        <th>DOSSIERS</th>
						<th>TYPES</th>
						<th>DATES</th>
						<th style="text-align:center">ACTIONS</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (isset($dossiers)) {
						$i = 1;
						foreach ($dossiers as $item) {
							?>
							<tr class="odd gradeX unread">
								<td class="center"><?php echo $i; ?></td>
                                <td class="center"><?php echo $item['code_dossier']; ?></td>
                                <td class="center"><?php echo $item['nom_dossier']; ?></td>
                                <td class="center"><?php echo $item['type_dossier']; ?></td>
                                <td class="center"><?php echo $item['date_dossier']; ?></td>
								<td class="center" style="text-align:center">
									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li>
                                            	<a data-id="<?php echo $item['id_dossier']; ?>" title="Editer" onclick="editer_dossier('<?php echo $item['nom_dossier']; ?>','<?php echo $item['code_dossier']; ?>',
                                            	'<?php echo $item['type_dossier']; ?>',
                                            	<?php echo $item['id_dossier']; ?>,<?php echo $item['fki_suc_dos']; ?>);"  href="" data-toggle="modal" >
                                            	
                                            	<!-- data-target="#editerservice" -->
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span>
                                                </a>
                                                
                                               
                                            </li>

											<li><a data-id="<?php echo $item['id_dossier']; ?>"
												   data-toggle="modal" title="Supprimer le dossier" id="DOSSIERDelete"
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

		jQuery("#users").on('click', '#DOSSIERDelete', function (e) {

			e.preventDefault();

			var rowid = jQuery(this).attr("data-id");

			var HREF = surl + 'courrier/deletedossier?id=' + rowid;

			jQuery('#deldossier').attr('href', HREF);//Show  fetched  data  from  database

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

	var dossier_existe = <?php echo json_encode($dossiers_existe); ?>;

	function refresh()	
	{
	window.location.reload()

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



	function editer_dossier(arg1,arg2,arg3,arg4,arg5) 
	{

		var argu1 = arg1;
		var argu2 = arg2;
		var argu3 = arg3;
		var argu4 = arg4;
		var argu5 = arg5;

		var dossier_id = document.getElementById("edit_dossier_name").value;
		var dossier_code_id = document.getElementById("edit_dossier_code_id").value;
		var dossier_type_id = document.getElementById("edit_dossier_type_id").value;

		document.getElementById("ancien_code").value = argu2;

		document.getElementById("edit_dossier_id").value = argu4;

		document.getElementById("suc_id").value = argu5;

		// alert(argu4);

		// alert(argu1);
		// alert(argu2);
		$("#editerdossier").modal('show');
		document.getElementById("bloc_editer").style.display = "none";
		if (empty(dossier_id)==false) {

			document.getElementById("edit_dossier_name").value=argu1;
		}
		if (empty(dossier_code_id)==false) {

			document.getElementById("edit_dossier_code_id").value=argu2;
		}
		if (empty(dossier_type_id)==false) {
			// alert(argu3);

			document.getElementById("edit_dossier_type_id").value = argu3;
			// document.getElementById("edit_dossier_type_id").selectedIndex=1;
			
		}
		

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

        function check_dossier_edit() 
        {
            var x1 = document.getElementById("edit_dossier_code_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();
            var code = document.getElementById("ancien_code").value;

          if(dossier_existe[x]==x && dossier_existe[x]!=code)
            {
            	
                document.getElementById("bloc_editer").style.display = "block";
                document.getElementById("msg_editer").innerHTML = "Ce code est déjà attribué à un dossier dans le système !! ";
                return false;
            }
            else
            {
            	
                document.getElementById("bloc_editer").style.display = "none";
                return true;
            }

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

        function edit_dossier_code_existe()
        {
            check_dossier_edit();
          if((check_dossier_edit()==true))
            {	
            	// alert('toto');
                var edit_dossier_id = document.getElementById("edit_dossier_name").value;
                var edit_dossier_code_id = document.getElementById("edit_dossier_code_id").value;
                var edit_dossier_type_id = document.getElementById("edit_dossier_type_id").value;

                empty(edit_dossier_id);
                empty(edit_dossier_code_id);
                empty(edit_dossier_type_id);


                if ((empty(edit_dossier_id)==true)&&(empty(edit_dossier_code_id)==true)&&(empty(edit_dossier_type_id)==true)) 
                {
                	// alert('bobo');
                    document.getElementById('aj_dossier_editer').disabled=false;
                }
                else
                {
                		
                       document.getElementById('aj_dossier_editer').disabled=true; 
                }

                
            }
            else
            {
            	
                document.getElementById('aj_dossier_editer').disabled=true;
            }
        }

    	function dossier_code_existe()
        {
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

</body>
</html>
