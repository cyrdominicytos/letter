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


<div class="pageheader">
    <h2><i class="fa fa-table"></i> COURRIERS <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">En Copie</li>
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

            <div class="table-responsive">
                <table class="table table-striped" id="users" data-page-length='25'>
                    <thead>
                    <tr>
                        <th style="text-align: center;">#</th>
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
                            <tr class="odd gradeX unread">
                                <td class="center" style="text-align: center;"><?php echo $i; ?></td>
                                <td class="center" style="text-align: center;">
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
                                        <?php echo $item['num_courrier'] ?>
                                    </a>
                                </td>
                                <td class="center" style="text-align: center;">
                                    <!--a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['fkIdcourier']; ?>">
                                        <?php echo ($item['categorieCourier'] == 'D') ? 'Départ' : 'Arrivé'; ?>
                                    </a-->
									<a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>#home2">
										<?php 
                                        $CI =& get_instance();
                                        $CI->load->database();
                                        $CI->load->model('CourrierModel');

                                       $service_dinataire = $CI->CourrierModel->getServiceDestByIdservice($item['service_dest']);
                                        
                                        echo $service_dinataire->libelle_service.' ('.$service_dinataire->code_service.')' ; 
                                    ?>
									</a>
                                </td>
                                <td class="center" style="text-align: center;">
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
                                        <?php echo isset($item['libelle_type']) ? $item['libelle_type'] : ''; ?>
                                    </a>
                                </td>
                                <td class="center" style="text-align: center;">
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
                                        <?php echo strtoupper($item['priorite_courrier']); ?>
                                    </a>
                                </td>
                                <td class="center" style="text-align: center;">
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
                                        <?php echo $item['nom_dossier']; ?>
                                    </a>
                                </td>

                                <td class="center" style="text-align: center;">
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
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
                                    <a href="<?php echo site_url(); ?>courrier/viewencopie?id=<?php echo $item['id_dif']; ?>">
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
