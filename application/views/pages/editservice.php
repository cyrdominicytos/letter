<div class="modal fade" id="mynewemploye" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Ajout d'employé
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">

                <form id="basicForm" method="post" action="<?php echo site_url(); ?>bureau/user/1"
                      class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input type="text" placeholder="Nom" name="nomemp" class="form-control"/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Prénom" name="prenomemp" class="form-control" required/>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" placeholder="nom d'utilisateur" name="username" class="form-control"
                                   required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input type="text" placeholder="Poste" name="titreemp" class="form-control" required/>
                        </div>
                        <div class="col-sm-4">
                            <input type="email" placeholder="Email" name="emailemp" class="form-control" required/>
                        </div>
                        <div class="col-sm-4">
                            <input type="password" name="password" placeholder="mot de passe" class="form-control"
                                   required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center" type="submit" class="btn-xs btn-primary">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <!---div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
                <a id='delservice' type="button" class="btn btn-danger conf_btn"
                   href=""> Oui</a>
            </div-->
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> SERVICES <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Services</li>
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

        <form id="basicForm" method="post" action="<?php echo site_url(); ?>bureau/editservice?id=<?php echo $_GET['id'] ?>"
              class="form-horizontal">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">&minus;</a>
                        </div>
                        <h4 class="panel-title">Editer un service</h4>
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
                                <input type="text" value="<?php echo isset($service) ? $service->libelleservice : ''; ?>" name="libelleservice"
                                       class="form-control"/>
                            </div>
                            <div class="col-sm-4">
                                <select name="fkidgroupe" class="select2" required data-placeholder="Choisissez...">
                                    <?php
                                    if (isset($groupe) & count($groupe) > 0) {
                                        foreach ($groupe as $item) {
                                            if($service->fkidgroupe == $item['idgroupe']) $sel ='selected';
                                            else $sel = '';
                                            ?>
                                            <option <?php echo $sel; ?> value="<?php echo $item['idgroupe'] ?>"><?php echo $item['libellegroupe'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="chefservicefkidemp" class="select2" required data-placeholder="Choisissez...">
                                    <?php
                                    if (isset($employe) & count($employe) > 0) {
                                        foreach ($employe as $item) {
                                            if($service->chefservicefkidemp == $item['idemp']) $sel2 ='selected="selected"';
                                            else $sel2 = '';
                                            ?>
                                            <option <?php echo $sel2; ?> value="<?php echo $item['idemp'] ?>"><?php echo $item['nomemp'].' '.$item['prenomemp'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                                <br>
                                <br>
                                <a class="btn btn-warning btn-xs" data-toggle="modal" title="Ajout d'un utilisateur"
                                   id="EMPLOYENew"
                                   data-target="#mynewemploye" href="#">
                                    <span class="fa fa-plus"> Nouveau employé</span></a>
                            </div>
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
    jQuery(document).ready(function () {

        "use strict";

        jQuery('#tags').tagsInput({width: 'auto'});

        // Select2
        jQuery(".select2").select2({
            width: '100%',
            minimumResultsForSearch: -1
        });

        jQuery("#EMPLOYENew").on('click', function (e) {

            e.preventDefault();

            jQuery("#confirmModalY").click(function (e) {

            });

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
