<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> COURRIERS <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Courrier</li>
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

        <form id="basicForm" method="post"
              action="<?php echo site_url(); ?>courrier/viewavalider?id=<?php echo $courriers->idcourier; ?>"
              enctype="multipart/form-data" class="form-horizontal">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">&minus;</a>
                        </div>
                        <h4 class="panel-title">Détails du courrier</h4>
                    </div>

                    <div class="panel-body">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center" type="submit" class="col-sm-1 btn-xs btn-primary">
                            Enregistrer
                        </button>
                        <br/>

                        <label class="col-sm-1 control-label"> </label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Numéro courrier: </label>
                                <div class="col-sm-12">
                                    <input readonly type="text"
                                           value="<?php echo isset($courriers->numcourier) ? $courriers->numcourier : '' ?>"
                                           name="numcourier"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Catégorie courrier: </label>
                                <div class="col-sm-12">
                                    <input readonly type="text"
                                           value="<?php echo ($courriers->categorieCourier == 'D') ? 'Départ' : 'Arrivé' ?>"
                                           name="categorieCourier"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Type courrier: </label>
                                <div class="col-sm-12">
                                    <input readonly type="text"
                                           value="<?php echo isset($courriers->typeCourier) ? $courriers->typeCourier : '' ?>"
                                           name="typeCourier"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Priorité courrier: </label>
                                <div class="col-sm-12">
                                    <select name="prioriteCourier" class="select2" required
                                            data-placeholder="Choisissez...">
                                        <option <?php if ($courriers->prioriteCourier == 'Urgente') echo 'selected'; ?>
                                                value="Urgente">Urgente
                                        </option>
                                        <option <?php if ($courriers->prioriteCourier == 'Normal') echo 'selected'; ?>
                                                value="Normal">Normal
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!--div class="form-group">
                                <label>Date courrier: </label>
                                <div class="col-sm-12">
                                    <input readonly type="text"
                                           value="<?php echo isset($courriers->dateCourier) ? str_replace('-', '/', $courriers->dateCourier) : '' ?>"
                                           name="dateCourier"
                                           class="form-control"/>

                                </div>
                            </div-->
                            <div class="form-group">
                                <label>Date courrier: </label>
                                <div class="col-sm-12">
                                    <input class="form-control form-control-inline input-medium default-date-picker"
                                           value="<?php echo isset($courriers->dateCourier) ? str_replace('-', '/', $courriers->dateCourier) : '' ?>"
                                           name="dateCourier"
                                           size="16" type="text" value=""/>
                                    <span class="help-block">Select date</span></div>
                            </div>

                            <div class="form-group">
                                <label>Destinataire courrier: </label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="expCourier"
                                           value="<?php echo isset($courriers->expCourier) ? $courriers->expCourier : '' ?>"/>

                                    <input type="hidden" name="serviceInit"
                                           value="<?php echo isset($courriers->serviceInit) ? $courriers->serviceInit : '' ?>"/>
                                    <select name="destCourier" class="select2" required
                                            data-placeholder="Choisissez...">

                                        <?php
                                        if (isset($service) & count($service) > 0) {
                                            foreach ($service as $serv) {
                                                echo '<optgroup label="' . $serv['libelleservice'] . '">';
                                                if (isset($employe) & count($employe) > 0) {
                                                    foreach ($employe as $item) {
                                                        if ($item['fkidservice'] == $serv['idservice']) { ?>
                                                            <option <?php if ($item['idemp'] == $courriers->destCourier) echo 'selected'; ?>
                                                                    value="<?php echo $item['idemp'] ?>"><?php echo $item['nomemp'] . ' ' . $item['prenomemp'] ?></option>
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
                            </div>
                            <div class="form-group">
                                <label>Nature courrier: </label>
                                <div class="col-sm-12">
                                    <input readonly type="text"
                                           value="<?php echo isset($courriers->natureCourier) ? $courriers->natureCourier : '' ?>"
                                           name="natureCourier" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Objet courrier: </label>
                                <div class="col-sm-12">
                                    <textarea placeholder="Libelle service" name="objetCourier"
                                              class="form-control"><?php echo isset($courriers->objetCourier) ? $courriers->objetCourier : '' ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date limite courrier: </label>
                                <div class="col-sm-12">
                                    <input class="form-control default-date-picker"
                                           value="<?php echo isset($courriers->dateLimittraiteCourier) ? str_replace('-', '/', $courriers->dateLimittraiteCourier) : '' ?>"
                                           name="dateLimittraiteCourier"
                                           type="text"/>
                                    <!--input type="text" name="dateLimittraiteCourier" value="<?php echo isset($courriers->dateLimittraiteCourier) ? str_replace('-', '/', $courriers->dateLimittraiteCourier) : '' ?>"
                                               class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pièce jointe: </label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="linkDocOld"
                                           value="<?php echo isset($courriers->linkDoc) ? $courriers->linkDoc : '' ?>"/>
                                    <input type="file" placeholder="Pièce jointe" name="linkDoc"
                                           class="form-control" onchange="loadFile(event)"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-1 col-sm-7"
                             style="border:1px solid black; border-left: 1px solid gray;">
                            <!--iframe id="previewfile" src="" width="100%" height="800" align="middle"></iframe-->
                            <!--iframe id="previewfile" src="<?php echo base_url() ?>assets/docs/<?php echo $courriers->linkDoc ?>" width="100%" height="600" align="middle"></iframe-->
                            <label>Pièce jointe: </label>
                            <!--iframe id="previewfile" src="" width="100%" height="800" align="middle"></iframe-->
                            <?php if($courriers->linkDoc != '') { ?>
                                <iframe id="previewfile" src="<?php echo base_url() ?>assets/docs/<?php echo $courriers->linkDoc ?>" width="100%" height="600" align="middle"></iframe>
                            <?php } ?>
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


<script src="<?php echo base_url() ?>assets/api/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/api/moment/min/fr.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/api/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script src="<?php echo base_url() ?>assets/js/dropzone.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url() ?>assets/api/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/api/form-components.js"></script>

<script>

    //var output = document.getElementById('previewfile');
    //output.src = URL.createObjectURL(burl+'assets/docs'+$("#linkDocOld").val());

    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var previewfile = document.getElementById('previewfile');
            previewfile.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<script>
    jQuery(document).ready(function () {

        "use strict";

        jQuery('#datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            language: 'fr'
        });

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
