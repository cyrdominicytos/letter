<div class="modal fade" id="editerservice"  data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Editer Service
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="height: 15px;" id="bloc_editer" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_editer" style="margin-top: -8px;"></p></b>
            
                </div>

                <div align="center" style="height: 15px;" id="bloc_code" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_editer_code" style="margin-top: -8px;"></p></b>
            
                </div>
                </div>
                <form id="basicForm1" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_edit_service">
                    <div class="form-group">
                        <div class="col-sm-6 ">
                            <label class="control-label" style="margin-left: 5px;"><b>Libellé </b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="30" id="editer_service_name" placeholder="Ex: Informatique" name="service_edit" class="form-control" onchange="service_existe_edit();" required/>
                            <input type="text" hidden="" name="service_edit_name" id="service_edit_id">
                            <input type="text" hidden="" name="ancien_service_edit" id="ancien_service_edit">
                        </div>

                        <div class="col-sm-6 ">
                            <label class="control-label" style="margin-left: 5px;"><b>Code </b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="10" id="editer_code_name" placeholder="Ex: Info" name="code_edit" class="form-control" onchange="code_existe_edit();" required/>
                            <!-- <input type="text" hidden="" name="code_edit_name" id="code_edit_id"> -->
                            <input type="text" hidden="" name="ancien_code_edit" id="ancien_code_edit">
                        </div>

                       
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  id="edit_service" disabled="" type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Editer service
                        </button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

<!-- Editer un service -->


<div class="modal fade" id="newservice" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Ajouter Service
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="display: none; height: 15px;" id="id_msg_service" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_service" style="margin-top: -8px;"></p></b>
            
                </div>

                <div align="center" style="display: none; height: 15px;" id="id_msg_code" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_code" style="margin-top: -8px;"></p></b>
            
                </div>

                </div>
                <form id="basicForm" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_service">
                    <div class="form-group">
                        <div class="col-sm-6 ">
                            <label class="control-label" style="margin-left: 5px;"><b>Libellé </b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="30" id="service_id" placeholder="Ex: Informatique" name="service" class="form-control" onchange="service_existe();" required/>
                        </div>

                        <div class="col-sm-6 ">
                            <label class="control-label" style="margin-left: 5px;"><b>Code </b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="10" id="code_id" placeholder="Ex: Info" name="code" class="form-control" onchange="code_existe();" required/>
                        </div>

                       
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  id="aj_service" disabled="" type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>




<div class="modal fade" id="myserviceDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
				<a id='delservice' type="button" class="btn btn-danger conf_btn"
				   href=""> Oui</a>
			</div>
		</div>
	</div>
</div>


<div class="pageheader">
	<h2><i class="fa fa-table"></i> SERVICES <span>GESTION DES SERVICES</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
			<li class="active">SERVICES</li>
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
		<a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newservice">
			<i class="fa fa-plus"></i><span style="font-size: 15px;"> Créer un service</span>
		</a>
	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<div class="table-responsive">
				<table class="table table-striped" id="users">
					<thead>
					<tr>
						<th>#</th>
                        <th>SERVICES</th>
						<!-- <th>Responsable</th> -->
						<th>SUCCURSALES</th>
						<th style="text-align:center;">ACTIONS</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (isset($services)) {
						$i = 1;
						foreach ($services as $item) {
							?>
							<tr class="odd gradeX unread">
								<td class="center"><?php echo $i; ?></td>
                                <td class="center"><?php echo $item['libelle_service'].' ('.$item['code_service'].')'; ?></td>
                                
                                <td class="center"><?php echo $item['libelle_suc']; ?></td>
								<td style="text-align:center;" >
									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<!-- <?php echo site_url()  ?>bureau/editservice?id=<?php echo $item['id_service']?> -->
										<ul class="dropdown-menu" role="menu">
                                            <li>
                                            	<a data-id="<?php echo $item['id_service']; ?>" title="Editer" onclick="editer_service('<?php echo $item['libelle_service']; ?>','<?php echo $item['code_service']; ?>',<?php echo $item['id_service']; ?>);"  href="" data-toggle="modal" >
                                            	
                                            	<!-- data-target="#editerservice" -->
                                                    <span class="glyphicon glyphicon-pencil"> Editer</span>
                                                </a>
                                                
                                               
                                            </li>

											<li>
												<a data-id="<?php echo $item['id_service']; ?>"
												   data-toggle="modal" title="Supprimer le service" id="SERVICEDelete"
												   data-target="#myserviceDelete" href="#">
                                                    <span class="glyphicon glyphicon-trash"> Supprimer</span>
                                                </a>
                                            </li>
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

		jQuery("#users").on('click', '#SERVICEDelete', function (e) {

			e.preventDefault();

			var rowid = jQuery(this).attr("data-id");

			var HREF = surl + 'bureau/deleteservice?id=' + rowid;

			jQuery('#delservice').attr('href', HREF);//Show  fetched  data  from  database

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
	
	var service = <?php echo json_encode($service_existe); ?>;

    var code = <?php echo json_encode($code_existe); ?>;

function refresh()	{
window.location.reload()

}


function editer_service(arg1,arg3,arg2) 
{

	var argu1 = arg1;
	var argu2 = arg2;
    var argu3 = arg3;

	var arg = document.getElementById("editer_service_name").value;
    var argcode = document.getElementById("editer_code_name").value;


 	document.getElementById("ancien_service_edit").value=arg1;

    document.getElementById("ancien_code_edit").value=arg3;

	// alert(argu1);
	// alert(argu2);
	$("#editerservice").modal('show');
	document.getElementById("bloc_editer").style.display = "none";
    document.getElementById("bloc_code").style.display = "none";
	if (empty(arg)==false) {

		document.getElementById("editer_service_name").value=arg1;
	}
    if (empty(argcode)==false) {

        document.getElementById("editer_code_name").value=arg3;
    }

	document.getElementById("service_edit_id").value=arg2;
	// document.getElementById("msg_editer").innerHTML = arg1;
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

    function check_service_edit() 
        {
            var x1 = document.getElementById("editer_service_name").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

            var ancien_service = document.getElementById("ancien_service_edit").value;
            

          if(service[x]==x && service[x]!=ancien_service )
            {
            	
                document.getElementById("bloc_editer").style.display = "block";
                document.getElementById("msg_editer").innerHTML = "Le libellé de ce service existe déjà dans le système !! ";
                return false;
            }
            else
            {
            	
                document.getElementById("bloc_editer").style.display = "none";
                return true;
            }

        }


        function check_code_edit() 
        {
            var x1 = document.getElementById("editer_code_name").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

            var ancien_code = document.getElementById("ancien_code_edit").value;
            

          if(code[x]==x && code[x]!=ancien_code )
            {
                
                document.getElementById("bloc_code").style.display = "block";
                document.getElementById("msg_editer_code").innerHTML = "Ce code est déjà attribué à un service dans le système !! ";
                return false;
            }
            else
            {
                
                document.getElementById("bloc_code").style.display = "none";
                return true;
            }

        }


        function service_existe_edit()
        {
            check_service_edit();
            check_code_edit();
            
          if((check_service_edit()==true) && (check_code_edit()==true))
            {	
            	
                var x = document.getElementById("editer_service_name").value;
                empty(x);
                var y = document.getElementById("editer_code_name").value;
                empty(y);

                if (empty(x)==true && empty(y)==true) 
                {
                	
                    document.getElementById('edit_service').disabled=false;
                }
                else
                {
                		
                       document.getElementById('edit_service').disabled=true; 
                }

                
            }
            else
            {
            	
                document.getElementById('edit_service').disabled=true;
            }
        }


        function code_existe_edit()
        {
            service_existe_edit();

        }


    	function check_service() 
        {
            var x1 = document.getElementById("service_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

          if(service[x]==x)
            {
            	
                document.getElementById("id_msg_service").style.display = "block";
                document.getElementById("msg_service").innerHTML = "Le libellé de ce service existe déjà dans le système !! ";
                return false;
            }
            else
            {
            	
                document.getElementById("id_msg_service").style.display = "none";
                return true;
            }

        }


        function check_code() 
        {
            var x1 = document.getElementById("code_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

          if(code[x]==x)
            {
                
                document.getElementById("id_msg_code").style.display = "block";
                document.getElementById("msg_code").innerHTML = "Ce code est déjà attribué à un service dans le système !! ";
                return false;
            }
            else
            {
                
                document.getElementById("id_msg_code").style.display = "none";
                return true;
            }

        }


        function service_existe()
        {
            check_service();
            check_code();
          if((check_service()==true) && (check_code()==true))
            {	
            	
                var x = document.getElementById("service_id").value;
                empty(x);
                var y = document.getElementById("code_id").value;
                empty(y);

                if (empty(x)==true && empty(y)==true) 
                {
                	
                    document.getElementById('aj_service').disabled=false;
                }
                else
                {
                		
                       document.getElementById('aj_service').disabled=true; 
                }

                
            }
            else
            {
            	
                document.getElementById('aj_service').disabled=true;
            }
        }

        function code_existe()
        {

            service_existe();
        }

</script>

</body>
</html>
