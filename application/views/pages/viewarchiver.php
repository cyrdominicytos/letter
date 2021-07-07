<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<style type="text/css">
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> COURRIERS <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Courriers</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

    <div class="row">

        <?php if (isset($msg)) { ?>

            <div class="col-md-2">
                
            </div>
            <div align="center" class="col-md-8 alert <?php echo $class; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><?php echo $msg; ?></strong>
            </div>
            <div class="col-md-2"></div>

            <hr/>
        <?php } ?>


        <form id="basicForm" method="post"
              action="<?php echo site_url(); ?>courrier/newcourrier"
              enctype="multipart/form-data" class="form-horizontal">


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">&minus;</a>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-7">
                        <h4 class="panel-title"><b style="color: #1e88e5;"> Détails du courrier <?php echo isset($liste_courrier['num_courrier']) ? $liste_courrier['num_courrier'] : '' ?></b></h4>
                    </div>
                        <div class="col-sm-5">
                        <a href="<?php echo site_url(); ?>courrier/print4?id=<?php echo $liste_courrier['id_dif']; ?>#home2">
                        <button  type="button" style="font-size: 14px;"  class="col-sm-5 btn btn-xs btn-warning">
                                    Imprimer fiche
                        </button>
                        </a>
                    </div>
                    </div>
                    </div>

        
                    <div class="panel-body">
                        
                        
                            <div class="form-group">

                                <div class="col-sm-3">
                                    <label>Expéditeur</label>
                                    <input type="text" value="<?php 
                                        $CI =& get_instance();
                                        $CI->load->database();
                                        $CI->load->model('CourrierModel');

                                       $exp = $CI->CourrierModel->getExpCourrierById($liste_courrier['courrier_exp']);
                                        
                                        echo strtoupper($exp->nomcomplet) ; 
                                    ?>" disabled=""  class="form-control">
                                    
                                </div>
                                <div class="col-sm-3">
                                    <label>Catégorie courrier</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['categorie_courrier']) ? $liste_courrier['categorie_courrier'] : '' ?>"  class="form-control" >
                                </div>
                                <div class="col-sm-3">
                                    <label>Type courrier</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['libelle_type']) ? $liste_courrier['libelle_type'] : '' ?>"  class="form-control" >
                                </div>

                                <div class="col-sm-3">
                                    <label>Service Destinataire</label>
                                    <input type="text" value="<?php 
                                        $CI =& get_instance();
                                        $CI->load->database();
                                        $CI->load->model('CourrierModel');

                                       $service_dinataire = $CI->CourrierModel->getServiceDestByIdservice($liste_courrier['service_dest']);
                                        
                                        echo $service_dinataire->libelle_service.' ('.$service_dinataire->code_service.')' ; 
                                    ?>" disabled=""  class="form-control">
                                </div>
                            </div>
                        
                        <?php 
                            if (isset($liste_courrier['id_appel']))
                            {
                                
                            ?>
                            
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Provenance de l’appel</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['provenance']) ? $liste_courrier['provenance'] : '' ?>"  class="form-control" >
                                </div>
                                <div class="col-sm-6">
                                    <label>Numéro appelant</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['numero']) ? $liste_courrier['numero'] : '' ?>"  class="form-control" >
                                </div>
                            </div>

                            
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label>Objet de l’appel</label>
                                        <textarea type="text" disabled="" name="obj_tel" rows="2" maxlength="100" 
                                               class="form-control"><?php echo isset($liste_courrier['objet_appel']) ? $liste_courrier['objet_appel'] : '' ?></textarea>
                                    </div>

                                    <div class="col-sm-6">
                                    <label>Mention</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['mention']) ? $liste_courrier['mention'] : '' ?>"  class="form-control" >
                                    </div>
                                </div>
                            

                            
                                <div class="form-group">
                                    
                                    <div class="col-sm-6">
                                    <label>Destination de l’appel</label>
                                    <input type="text" disabled="" value="<?php echo isset($liste_courrier['destination']) ? $liste_courrier['destination'] : '' ?>"  class="form-control" >
                                    </div>

                                    <div class="col-sm-6">
                                            <label>Action requise</label>
                                            <input type="text" disabled="" value="<?php echo isset($liste_courrier['action']) ? $liste_courrier['action'] : '' ?>" name="action" maxlength="100" 
                                               class="form-control">
                                        </div>
                                </div>
                            
        
    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <label>Message de l’appel</label>
                                        <textarea type="text" disabled="" name="mes_tel" maxlength="255" rows="4" 
                                               class="form-control" placeholder="Message de l’appel"><?php echo isset($liste_courrier['message_appel']) ? $liste_courrier['message_appel'] : '' ?></textarea> 
                                            </div>
                                    </div>
                                
                            
                            <?php
                                }
                                ?>

                            <?php 
                            if (isset($liste_courrier['id_facture']))
                            {
                                
                            ?> 

                            <div class="form-group" >

                                <div class="col-sm-6">
                                    <label>Provenance de la facture</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['provenance_fact']) ? $liste_courrier['provenance_fact'] : '' ?>" disabled="" name="origine_fact" maxlength="50" 
                                               class="form-control" placeholder="Provenance de la facture">
                                </div>
                                <div class="col-sm-6">
                                    <label>Montant</label>
                                    <input type="number" value="<?php echo isset($liste_courrier['montant_fact']) ? $liste_courrier['montant_fact'] : '' ?>" disabled="" name="montant" 
                                               class="form-control" placeholder="1234">
                                </div>
                            </div>

                            <div class="form-group">    
                                <div class="col-sm-6">
                                    <label>Type facture</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['type_facture']) ? $liste_courrier['type_facture'] : '' ?>" disabled="" name="montant" class="form-control" placeholder="1234">

                                </div>
                                <div class="col-sm-6">
                                    <label>Date d’échéance paiement</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['date_paie']) ? $liste_courrier['date_paie'] : '' ?>" disabled="" name="montant" class="form-control">
                                </div>
                            </div>

                            

                            <?php
                            }
                            ?>


                            
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Priorité courrier</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['priorite_courrier']) ? $liste_courrier['priorite_courrier'] : '' ?>" disabled="" name="montant" class="form-control">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <label>Dossier concerné</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['nom_dossier']) ? $liste_courrier['nom_dossier'] : '' ?>" disabled="" name="montant" class="form-control">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <?php 
                            if (!empty($liste_courrier['courier_lier']))
                            {
                                
                            ?>
                                <div class="col-sm-8">
                                    <label>Lier Courrier</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['courier_lier']) ? $liste_courrier['courier_lier'] : '' ?>" disabled="" name="montant" class="form-control">
                                    
                                </div>
                                <div class="col-sm-2" style="margin-top: 35px;">
                                    <span ><a href="<?php echo site_url(); ?>courrier/consulter_view?id=<?php echo $liste_courrier['courier_lier']; ?>#home2" style="color: #1e88e5;font-size: 20px;">Consulter</a></span>
                                </div>
                                <?php
                            }
                            ?>
                                
                            </div>

                            
                            

                            <div class="form-group">
                                
                                <div class="col-sm-12">
                                    <label>Objet courrier</label>
                                    <textarea disabled="" style="margin-left: 0px;" type="text" maxlength="100"  name="objetCourier" class="form-control"><?php 
                                    echo isset($liste_courrier['objet_courrier']) ? $liste_courrier['objet_courrier'] : '' 
                                    ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                    
                                <?php
                                    if ($liste_courrier['date_limite']!='00-00-0000') {
                                        
                                      
                                ?> 

                                        <div class="col-sm-6">
                                        
                                        <label>Date limite de traitement</label>
                                            <input type="text" value="<?php echo isset($liste_courrier['date_limite']) ? $liste_courrier['date_limite'] : '' ?>" disabled="" class="form-control">
                                                
                                        </div>
                                    <?php
                        }
                                    
                            ?>  
                            
                                <div class="col-sm-6">
                                    <label>Nature courrier</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['nature_courrier']) ? $liste_courrier['nature_courrier'] : '' ?>" disabled="" class="form-control">
                                    
                                </div>
                            </div>
                            
                        
                            <div class="form-group">
                                
                                <div class="col-sm-6">
                                    <label>Date du courrier</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['date_courrier']) ? $liste_courrier['date_courrier'] : '' ?>" disabled="" class="form-control">
                                        
                                        
                                </div>
                            

                                <div class="col-sm-6">
                                    <label>Date d'arrivée</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['date_arrivee']) ? $liste_courrier['date_arrivee'] : '' ?>" disabled="" class="form-control">
                                        
                                </div>
                            </div>
                            

                            <div class="form-group">

                                <div class="col-sm-6">
                                    <label>Confidentiel</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['confidentiel']) ? $liste_courrier['confidentiel'] : '' ?>" disabled="" class="form-control">
                                </div>

                                <div class="col-sm-6">

                                    <label>Mots clés</label>
                                    <input type="text" value="<?php echo isset($liste_courrier['mot_cle']) ? $liste_courrier['mot_cle'] : '' ?>" disabled="" class="form-control">

                                </div>
                                    
                                    
                                </div>

                            <div class="form-group">
                            <?php
                            if (!empty($liste_courrier['info'])) {
                            ?>  
                                <div class="col-sm-6">

                                    <label>Informations complémentaires</label>
                                    <input type="text" disabled="" maxlength="100" value="<?php echo isset($liste_courrier['info']) ? $liste_courrier['info'] : '' ?>"  class="form-control">
                                    
                                    
                                </div>

                                <div class="col-sm-6 " style="margin-top: 27px;">

                                    <?php

                                       if(isset($docs))
                                          if(array_key_exists($liste_courrier['id_courrier'],$docs))
                                            {
                                                ?>
                        <div class="btn-group col-sm-offset-5 col-sm-6">
                        <button type="button" class="btn btn-default dropdown-toggle col-sm-6" data-toggle="dropdown">
                            Pièce Jointe 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                             <?php
                                    
                                    foreach ($docs[$liste_courrier['id_courrier']] as $values)
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


                            <?php
                        }
                        else{

                                ?>
                                <div class="col-sm-7 col-sm-offset-5" style="margin-top: 10px;">

                                    <?php

                                       if(isset($docs))
                                          if(array_key_exists($liste_courrier['id_courrier'],$docs))
                                            {
                                                ?>
                        <div class="btn-group col-sm-6">
                        <button type="button" class="btn btn-default dropdown-toggle col-sm-6" data-toggle="dropdown">
                            Pièce Jointe 
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                             <?php
                                    
                                    foreach ($docs[$liste_courrier['id_courrier']] as $values)
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


                    <?php
                        }
                        ?>

                                
                            </div>

                            <?php
                                
                                        if (isset($dest)) {
                            ?>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    
                                    <table class="table table-striped" style="width: 100%; margin-top: 28px;" >
                                        
                                        <tr>
                                            <td colspan="4" style="text-align: center;">
                                            <span  style="color: #1e88e5;font-size: 20px;">Employé(s) Destinataire </span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                        
                                            <?php

                                        if (isset($dest)) {
                                            $i = 0;
                                            
                                            foreach ($dest as $item) 
                                            {
                                                if ($i<4) {
                                                ?>
                                                    <td style="text-align: center;"><span  style="color: black;font-size: 14px;"><?php echo $item['prenom_user'].' '.$item['nom_user'] ?></span></td>
                                                <?php
                                                    $i++;
                                                }else{
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                    <td><span  style="color: #1e88e5;font-size: 14px;"><?php echo $item['prenom_user'].' '.$item['nom_user'] ?></span></td>
                                                <?php
                                                    $i = 1;
                                                }
                                            }
                                        }
                                            ?>
                                            
                                        </tr>
                                        
                                    </table>

                                    
                                </div>

                                <?php

                                        if ( !empty($copie)) {
                                ?>
                                <div class="col-sm-6">
                                    
                                    <table class="table table-striped" style="width: 100%; margin-top: 28px;" >
                                        
                                        <tr>
                                            <td colspan="4" style="text-align: center;">
                                            <span  style="color: #1e88e5;font-size: 20px;">Employés En Copie</span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                        
                                            <?php

                                        if (isset($copie)) {
                                            $i = 0;
                                            
                                            foreach ($copie as $item) 
                                            {
                                                if ($i<4) {
                                                ?>
                                                    <td style="text-align: center;"><span  style="color: black;font-size: 14px;"><?php echo $item['prenom_user'].' '.$item['nom_user'] ?></span></td>
                                                <?php
                                                    $i++;
                                                }else{
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                    <td><span  style="color: #1e88e5;font-size: 14px;"><?php echo $item['prenom_user'].' '.$item['nom_user'] ?></span></td>
                                                <?php
                                                    $i = 1;
                                                }
                                            }
                                        }
                                            ?>
                                            
                                        </tr>
                                        
                                    </table>

                                    
                                </div>
                                <?php
                                    }
                                ?>

                            </div>
                        <?php
                        }
                        ?>

                            

                            
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
<script src="<?php echo base_url() ?>assets/api/datepicker/bootstrap-datepicker.js"></script>


<script src="<?php echo base_url() ?>assets/js/dropzone.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<script type="text/javascript"
        src="<?php echo base_url() ?>assets/api/jquery-multi-select/js/jquery.multi-select.js"></script>

<script type="text/javascript"
        src="<?php echo base_url() ?>assets/api/jquery-multi-select/js/jquery.quicksearch.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/api/form-components.js"></script>

<script src="<?php echo base_url(); ?>assets/js/scannerjs/dist/scanner.js"></script>


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

        jQuery('.datepicker').datepicker({
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
<script type="text/javascript" >
    // Need to upload scanned images to server or save them on hard disk? Please refer to the dev guide: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
    // For more scanning code samples, please visit https://github.com/Asprise/scannerjs.javascript-scanner-access-in-browsers-chrome-ie.scanner.js

    var scanRequest = {
        "use_asprise_dialog": true, // Whether to use Asprise Scanning Dialog
        "show_scanner_ui": false, // Whether scanner UI should be shown
        "twain_cap_setting": { // Optional scanning settings
            "ICAP_PIXELTYPE": "TWPT_RGB" // Color
        },
        "output_settings": [{
            "type": "return-base64",
            "format": "jpg"
        }]
    };

    /** Triggers the scan */
    function scan() {
        scanner.scan(displayImagesOnPage, scanRequest);
    }

    /** Processes the scan result */
    function displayImagesOnPage(successful, mesg, response) {
        if (!successful) { // On error
            console.error('Failed: ' + mesg);
            return;
        }
        if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
            console.info('User cancelled');
            return;
        }
        var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
        for (var i = 0;
             (scannedImages instanceof Array) && i < scannedImages.length; i++) {
            var scannedImage = scannedImages[i];
            var elementImg = scanner.createDomElementFromModel({
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            (document.getElementById('previewfile') ? document.getElementById('previewfile') : document.body).appendChild(elementImg);
        }
    }
</script>

<script>



function addDate(d, nb) {
// additionne nb jours à une date
var d1 = d.getTime(), d2 = new Date();
d1 += 24*3600*1000*nb
d2.setTime(d1)
return d2
}

document.getElementById("id_appel").style.display = "none";
document.getElementById("id_facture").style.display = "none";
function myFunction() 
{
  
var x = document.getElementById("changement").value;
var list_relance = <?php echo json_encode($type_delai_relance); ?>;
var list_traitement = <?php echo json_encode($type_delai_traitement); ?>;
 

if (list_traitement[x] !== undefined && list_traitement[x].length > 0)
{
var jour_traitement = list_traitement[x];

var d = new Date(); // date du jour

var d2 = addDate(d, jour_traitement); // additionne 5 jours

// alert(d2.toLocaleString()); // ou toute autre méthode sur les dates

document.getElementById("id2_limite").value = d2.toLocaleString();

// ('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second:'numeric' });

document.getElementById("id_limite").value = d2.toLocaleString();
    
}

if (list_relance[x] !== undefined && list_relance[x].length > 0)
{
var jour_relance = list_relance[x];

var d = new Date(); // date du jour

var d2 = addDate(d, jour_relance); // additionne 5 jours

// alert(d2.toLocaleString()); // ou toute autre méthode sur les dates

// document.getElementById("id_date_relance").value = d2.toLocaleString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit' });
    // , hour: '2-digit', minute: '2-digit', second:'numeric'
    document.getElementById("id_date_relance").value = d2.toLocaleString();

    
}
// alert(d2.toLocaleString('fr-CA', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second:'numeric' }));

// , hour: '2-digit', minute: '2-digit', second:'numeric'
document.getElementById("id_appel").style.display = "none";
document.getElementById("id_facture").style.display = "none";

 if (x=="11") {
document.getElementById("id_facture").style.display = "block";
}
if (x=="7") {
document.getElementById("id_appel").style.display = "block";
}

}

document.getElementById("date_limite").style.display = "none";
function limite()
{
    document.getElementById("date_limite").style.display = "none";
if (document.getElementById("limite_date").checked === true) {

    document.getElementById("date_limite").style.display = "block";
}

}

document.getElementById("id_diffusion").style.display = "block";


function diffusion(){

    var a = document.getElementById("diff").value;

    document.getElementById("id_diffusion").style.display = "block";

if (a=="oui") {
document.getElementById("id_diffusion").style.display = "none";
}

}

// myFunction();
// limite();
// diffusion()
</script>


</body>
</html>
