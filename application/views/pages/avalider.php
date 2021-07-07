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
            <li class="active">COURRIERS</li>
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
                <table class="table table-striped" id="users">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Courrier</th>
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th>Priorité</th>
                        <th>Dossier</th>
                        <th>Expéditeur</th>
                        <th><i class="fa fa-paperclip"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($courriers)) {
                        $i = 1;
                        foreach ($courriers as $item) {
                            ?>
                            <tr class="odd gradeX unread">
                                <td class="center"><?php echo $i; ?></td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo $item['numcourier'] ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo ($item['categorieCourier'] == 'D') ? 'Départ' : 'Arrivé'; ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo isset($item['typeCourier']) ? $item['typeCourier'] : ''; ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo $item['prioriteCourier']; ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo $item['nomdossier']; ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo $item['nomemp'] . ' ' . $item['prenomemp']; ?>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $item['idcourier']; ?>">
                                        <?php echo ($item['linkDoc'] != '') ? '<i class="fa fa-paperclip"></i>' : ''; ?>
                                    </a>
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
