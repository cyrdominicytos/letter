<div class="modal fade" id="mydeletepriv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
            <div class="modal-body" style="color: black;">
                Etes vous sur de supprimer cet élément ?

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
                <a id='delpriv' type="button" class="btn btn-danger conf_btn"
                   href=""> Oui</a>


            </div>
        </div>
    </div>
</div>


<div class="pageheader">
    <h2><i class="fa fa-table"></i> PRIVILEGES <span>GESTION DES PRIVILEGES</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">PRIVILEGES</li>
        </ol>
    </div>
</div>
<br>


<div class="contentpanel" style="color:black;">

    <div class="btn-demo">
        <!--a href="<?php echo site_url(); ?>commercial/addtaux" class="btn btn-xs btn-darkblue">
            <i class="fa fa-plus"></i> Nouveau taux
        </a--->
        <div class="row">
            <form id="formgroupe" method="post" action="<?php echo site_url() ?>user/privilege">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-btns">
                                <a href="" class="minimize">&minus;</a>
                            </div>
                            <h4 class="panel-title">Ajouter un privilège</h4>
                        </div>

                        <div class="panel-body">

                            <div align="center" style="display: none; height: 15px;" id="id_msg_priv" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                            <b><p id="msg_priv" style="margin-top: -8px;"></p></b>
            
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label>Libellé:</label>
                                    <input type="text" id="priv_id" maxlength="50" required="" onchange="priv_existe();" placeholder="Libellé" name="libellepriv" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label>Courrier:</label>
                                    <input type="checkbox" name='courrierpriv' value="1" checked class="checked"/>
                                </div>
                                <div class="col-sm-2">
                                    <label>Employé:</label>
                                    <input type="checkbox" name='employepriv' value="1" class="checked"/>
                                </div>
                                <div class="col-sm-2">
                                    <label>Service:</label>
                                    <input type="checkbox" name='servicepriv' value="1" class="checked"/>
                                </div>
                                <div class="col-sm-2">
                                    <label>Dossier:</label>
                                    <input type="checkbox" name='dossierpriv' value="1" class="checked"/>
                                </div>
                                <div class="col-sm-2">
                                    <label>Succursale:</label>
                                    <input type="checkbox" name='groupepriv' value="1" class="checked"/>
                                </div>
                                <div class="col-sm-2">
                                    <label>Privilège:</label>
                                    <input type="checkbox" name='privpriv' value="1" class="checked"/>
                                </div>
                                <br/><br/><br/>
                                <label class="col-sm-10 control-label"> </label>
                            <button style="margin-left: 80%;" id="aj_priv" disabled="" type="submit" class="col-sm-2 btn btn-xs btn-primary">
                                Enregistrer
                            </button>
                            
                            </div>
                        </div><!-- panel-body -->
                    </div><!-- panel -->
                </div><!-- col-md-6 -->
            </form>
        </div>
    </div>

    <br>

    <div class="panel panel-default">

        <div class="panel-body">
            <?php
            echo validation_errors("<div class='alert alert-danger'>", "Erreur soumission formulaire </div>");

            if ($this->session->flashdata('msg')) {
                echo $this->session->flashdata('msg');
            }
            ?>
            <div class="table-responsive">

                <table class="table table-striped" id="listpriv">
                    <thead>
                    <tr>
                        <!--th>#</th-->
                        <th>Libellé</th>
                        <th>Courrier</th>
                        <th>Employé</th>
                        <th>Service</th>
                        <th>Dossier</th>
                        <th>Succursale</th>
                        <th>Privilège</th>
                        <th width="100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($privileges)) {
                        $i = 1;
                        foreach ($privileges as $item) {
                            ?>

                            <tr class="odd gradeX">
                                <form class="main" method="post"
                                      action="<?php echo site_url() . "user/editpriv?id=" . $item['id_priv']; ?>">
                                    <!--td class="center"><?php echo $i; ?></td-->
                                    <td class="center"><input disabled="" type="text" value="<?php echo $item['libelle_priv']; ?>"
                                                              name="libellepriv"/></td>
                                    <td class="center"><input type="checkbox" <?php if ($item['courrier_priv'])
                                            echo "checked=checked"; ?> name='courrierpriv' value="1" class="checked"/>
                                    </td>
                                    <td class="center"><input type="checkbox" <?php if ($item['user_priv'])
                                            echo "checked=checked"; ?> name='employepriv' value="1" class="checked"/>
                                    </td>
                                    <td class="center"><input type="checkbox" <?php if ($item['service_priv'])
                                            echo "checked=checked"; ?> name='servicepriv' value="1" class="checked"/>
                                    </td>
                                    <td class="center"><input type="checkbox" <?php if ($item['dossier_priv'])
                                            echo "checked=checked"; ?> name='dossierpriv' value="1" class="checked"/>
                                    </td>
                                    <td class="center"><input type="checkbox" <?php if ($item['group_priv'])
                                            echo "checked=checked"; ?> name='groupepriv' value="1" class="checked"/>
                                    </td>
                                    <td class="center"><input type="checkbox" <?php if ($item['priv_priv'])
                                            echo "checked=checked"; ?> name='privpriv' value="1" class="checked"/></td>
                                    <td class="center">
                                        <button style="text-align:center" type="submit" class="btn-xs btn-primary">
                                            Editer
                                        </button>
                                        <!-- <a href="#" class="btn btn-danger btn-xs"
                                           data-id="<?php echo $item['id_priv']; ?>" data-toggle="modal"
                                           title="Supprimer" id="deletepriv" data-target="#mydeletepriv">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                                    </td>
                                    <!--td style="text-align:left">
									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="#"
                                                   data-id="<?php echo $item['idpriv']; ?>" data-toggle="modal"
                                                   title="Supprimer" id="deletepriv" data-target="#mydeletepriv">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Supprimer</a>
                                            </li>
										</ul>
									</div>
								</td-->

                                </form>
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
<script src="<?php echo base_url() ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cookies.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dropdown.js"></script>


<script src="<?php echo base_url(); ?>assets/js/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<?php
if (isset($js)) {
    foreach ($js as $script) {
        ?>
        <script type="text/javascript" src="<?php echo base_url() . $script; ?>"></script>
        <?php
    }
}
?>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script>
    jQuery(document).ready(function () {

        "use strict";

        jQuery("#listpriv").on('click', '#deletepriv', function (e) {

            e.preventDefault();

            var rowid = jQuery(this).attr("data-id");

            var HREF = surl + 'user/deletepriv?id=' + rowid;

            jQuery('#delpriv').attr('href', HREF);//Show  fetched  data  from  database

            jQuery("#confirmModalY").click(function (e) {

            });

        });


        var _baseurl = "<?php echo base_url(); ?>";

        jQuery('#listpriv').dataTable(
            {
                "language": {
                    "url": _baseurl + "assets/js/others/French.json"
                },
                "sPaginationType": "full_numbers"
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

<script >
    
        var privexiste1 = <?php echo json_encode($privexiste); ?>;

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

    function check_priv() 
        {
            var x1 = document.getElementById("priv_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();
            // var y = privexiste1[x2].toUpperCase();

          if(privexiste1[x]==x)
            {
                
                document.getElementById("id_msg_priv").style.display = "block";
                document.getElementById("msg_priv").innerHTML = "Le libellé de ce privilège existe déjà dans le système !! ";
                return false;
            }
            else
            {
    
                document.getElementById("id_msg_priv").style.display = "none";
                return true;
            }

        }



     function priv_existe()
        {
            
            var x = document.getElementById("priv_id").value;
                
            

          if(check_priv()==true && empty(x)==true)
            {   
                
            document.getElementById('aj_priv').disabled=false;                
                
            }

            else
            {
                
                document.getElementById('aj_priv').disabled=true;
            }
        }




</script>


</body>
</html>
