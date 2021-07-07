<div class="modal fade" id="newpays" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    Ajouter Pays
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color:black;">
                <div class="form-group">
                <div align="center" style="display: none; height: 15px;" id="id_msg_pays" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_pays" style="margin-top: -8px;"></p></b>
            
                </div>

                <div align="center" style="display: none;height: 15px;" id="id_msg_code" class="col-md-10 col-md-offset-1 alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_code" style="margin-top: -8px;"></p></b>
            
                </div>
                </div>
                <form id="basicForm" class="form-horizontal" method="post" action="<?php echo site_url(); ?>bureau/submit_pays">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="control-label" style="margin-left: 5px;"><b>Pays</b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="20" id="pays_id" placeholder="Ex: BENIN" name="pays" class="form-control" onchange="pays_existe();" required/>
                        </div>

                        <div class="col-sm-6">
                            <label class="control-label" style="margin-left: 5px;"><b>Code Pays</b><span style="color: red">*</span> </label>
                            <input type="text" maxlength="2" id="code_id" placeholder="Ex: BJ" name="code_pays" onchange="code_existe();" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 control-label"> </label>
                        <button style="text-align:center"  id="aj_pays" disabled="" type="submit" class="btn btn-xs btn-primary">
                            <!-- btn btn-primary btn-block -->
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>






<div class="modal fade" id="mydeletegroupe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                Etes vous sûr de supprimer cet élément ?

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Non</button>
                <a id='delgroupe' type="button" class="btn btn-danger conf_btn"
                   href=""> Oui</a>


            </div>
        </div>
    </div>
</div>


<div class="pageheader">
    <h2><i class="fa fa-table"></i> SUCCURSALE <span>GESTION DES SUCCURSALES</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">SUCCURSALE</li>
        </ol>
    </div>
</div>


<div class="contentpanel" style="color:black;">
    <?php
if ($this->session->flashdata('msg')) {
    echo $this->session->flashdata('msg');
}
?>
<div class="btn-demo">
        <a href="#" data-toggle="modal" class="btn btn-xs btn-darkblue" data-target="#newpays">
            <i class="fa fa-plus"></i> <span style="font-size: 15px;">Ajouter pays</span>
        </a>
</div>
    <!-- <div class="btn-demo"> -->
        
        <!-- <div class="row"> -->
            <div class="panel panel-default">
                <div class="panel-body">

                    <div align="center" style="display: none; height: 15px;" id="id_msg_suc" class="col-md-10 col-md-offset-1  alert alert-danger">
                    <!-- <button type="button" style="margin-top: -8px;" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                    <b><p id="msg_suc" style="margin-top: -8px;"></p></b>
            
                    </div>

            <form id="formgroupe" method="post" action="<?php echo site_url() ?>bureau/submit_surccusale">

                <div class="form-group">

                    <div class="col-sm-12">
                            
                            <div class="col-sm-3 col-sm-offset-2 ">
                                <label class="control-label" style="margin-left: 5px;"><b>Succursale</b><span style="color: red">*</span> </label>
                                <input type="text" onchange="suc_existe();" id="suc_id" maxlength="30" required="" placeholder="Ex: AKASI-BENIN" name="surccusale" class="form-control"/>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label" style="margin-left: 10px;"><b>Pays</b><span style="color: red">*</span></label>
                                <select  name="pays_suc" id="pays_suc" onchange="check_pays_sur();"  
                                 class=" select2 col-sm-12 form-control" required data-placeholder="Choisissez...">
                                    
                                    <option value="">Choisissez...</option>
                                    <?php
                                    if(isset($list_pays)) {
                                        foreach ($list_pays as $item) { ?>
                                            <option value="<?php echo $item['id_pays'] ?>"><?php echo $item['libelle_pays'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="col-sm-2" style="">
                                <button type="submit" disabled="" id="aj_suc" style="margin-top: 32px;" class="btn btn-success btn-sm col-sm-6"><b style="font-size: 15px;">Ajouter</b></button>
                            </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <!-- </div> -->
    <!-- </div> -->

    <br>
 <div class="panel panel-default">

        <form name="listeforme" action="" method="post" style="margin-left: 86.5%;margin-top: 10px;" >
        <span class="float-right ">
            <select style="margin-top: 10px;width: 150px;" class="custom-select" name="liste_forme1" id="liste_forme1" onchange="lister();">
            <option value="1">Lister Pays et Sites</option>
            <option value="2">Lister Sites</option>
            <option value="3">Lister Pays</option>
            </select>
        </span>
        </form>
<!-- option1 -->
        <div class="panel-body" id="liste1">
          <h4 style="text-align: center;font-weight: bold;margin-top: -10px;"> Lister Pays et Sites</h4>
            <div class="table-responsive">
                 

                <table class="table table-striped listgroupe">
                    <thead>
                    <tr>
                        <th style="text-align: left;">#</th>
                        <th style="text-align: center;">Succursales</th>
                        <th style="text-align: center;">Pays</th>
                        <th style="text-align: center;">Codes</th>
                        <!-- <th width="100px;">Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($site_pays)) {
                        $i = 1;
                        foreach ($site_pays as $item) {
                            ?>
                            <tr class="odd gradeX">
                                <td style="text-align: left;"><?php echo $i; ?></td>
                                <td style="text-align: center;"><?php echo $item['libelle_suc']; ?></td>
                                <td style="text-align: center;"><?php echo $item['libelle_pays']; ?></td>
                                <td style="text-align: center;"><?php echo $item['code_pays']; ?></td>
                               <!-- <td  class="center">
									<div class="btn-group">
										<button type="button" class="btn-sm btn-brown dropdown-toggle"
												data-toggle="dropdown">
											Actions <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="#"
                                                   data-id="<?php echo $item['id_suc']; ?>" data-toggle="modal"
                                                   title="Supprimer" id="deletegroupe" data-target="#mydeletegroupe">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Supprimer</a>
                                            </li>
										</ul>
									</div>
								</td> -->
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
<!-- option2 -->
                
                <div class="panel-body" id="liste2">
          <h4 style="text-align: center;font-weight: bold;margin-top: -10px;"> Lister Sites</h4>
            <div class="table-responsive">
                 

                <table class="table table-striped listgroupe">
                    <thead>
                    <tr>
                        <th style="text-align: left;">#</th>
                        <th style="text-align: center;">Succursale</th>
                        <!-- <th width="100px;">Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($listsurccusale)) {
                        $i = 1;
                        foreach ($listsurccusale as $item) {
                            ?>
                            <tr class="odd gradeX">
                                <td style="text-align: left;"><?php echo $i; ?></td>
                                <td style="text-align: center;"><?php echo $item['libelle_suc']; ?></td>
                               
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div><!-- table-responsive -->

        </div>

<!-- option2 -->

        <!-- option 3 -->

        <div class="panel-body" id="liste3">
          <h4 style="text-align: center;font-weight: bold;margin-top: -10px;"> Lister Pays</h4>
            <div class="table-responsive">
                 

                <table class="table table-striped listgroupe">
                    <thead>
                    <tr>
                        <th style="text-align: left;">#</th>
                        <th style="text-align: center;">Pays</th>
                        <th style="text-align: center;">Code</th>
                        <!-- <th width="100px;">Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($list_pays)) {
                        $i = 1;
                        foreach ($list_pays as $item) {
                            ?>
                            <tr class="odd gradeX">
                                <td style="text-align: left;"><?php echo $i; ?></td>
                                <td style="text-align: center;"><?php echo $item['libelle_pays']; ?></td>
                                <td style="text-align: center;"><?php echo $item['code_pays']; ?></td>
                               
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div><!-- table-responsive -->

        </div>

        <!-- option 3 -->



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

        jQuery("#listgroupe").on('click', '#deletegroupe', function (e) {

            e.preventDefault();

            var rowid = jQuery(this).attr("data-id");

            var HREF = surl + 'bureau/deletegroupe?id=' + rowid;

            jQuery('#delgroupe').attr('href', HREF);//Show  fetched  data  from  database

            jQuery("#confirmModalY").click(function (e) {

            });

        });


        var _baseurl = "<?php echo base_url(); ?>";

        jQuery('.listgroupe').dataTable(
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

<script type="text/javascript">

    var pays = <?php echo json_encode($pays_existe); ?>;
    var code = <?php echo json_encode($code_existe); ?>;
    var surccusale = <?php echo json_encode($surccusale_existe); ?>;

    document.getElementById("liste1").style.display = "block";
    document.getElementById("liste2").style.display = "none";
    document.getElementById("liste3").style.display = "none";

    document.getElementById("id_msg_pays").style.display = "none";
    document.getElementById("id_msg_code").style.display = "none";
    document.getElementById("id_msg_suc").style.display = "none";

    document.getElementById('aj_pays').disabled=true;
    document.getElementById('aj_suc').disabled=true;

    function refresh()  {
window.location.reload()

}
    
    function lister() 
    {   
        var listesite1 = document.getElementById("liste_forme1").value;

            if (listesite1==1) 
            {
                
                    document.getElementById("liste1").style.display = "block";
                    document.getElementById("liste2").style.display = "none";
                    document.getElementById("liste3").style.display = "none";
            }
            else if (listesite1==2) 
            {
                    
                    document.getElementById("liste1").style.display = "none";
                    document.getElementById("liste2").style.display = "block";
                    document.getElementById("liste3").style.display = "none";
            }
            else if (listesite1==3) 
            {
                    
                    document.getElementById("liste1").style.display = "none";
                    document.getElementById("liste2").style.display = "none";
                    document.getElementById("liste3").style.display = "block";
            }

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

        //  function empty2() 
        // {
        //     var s = document.getElementById("suc_id").value;
        //     if (s.length === 0 || !s.trim()) 
        //     {
        //         return false;
        //     }
        //     else
        //     {
        //         return true;
        //     }
        // }

        // function emptyX() 
        // {
        //     var x = document.getElementById("pays_id").value;
        //     if (x.length === 0 || !x.trim()) 
        //     {
        //         return false;
        //     }
        //     else
        //     {
        //         return true;
        //     }
        // }


        // function emptyY() 
        // {
        //     var y = document.getElementById("code_id").value;
        //     if (y.length === 0 || !y.trim()) 
        //     {
        //         return false;
        //     }
        //     else
        //     {
        //         return true;
        //     }
        // }

        function check_pays_sur() 
        {
             suc_existe();
           
        }

        function check_sur() 
        {
            var suc = document.getElementById("suc_id").value;
            var suc1 = suc.remove_accent();  
            var suc2 = suc1.toUpperCase();

          if(surccusale[suc2]==suc2)
            {
                document.getElementById("id_msg_suc").style.display = "block";
                document.getElementById("msg_suc").innerHTML = "La succursale existe déjà dans le système !! ";
                return false;
            }
            else
            {
                document.getElementById("id_msg_suc").style.display = "none";
                return true;
            }

         }

     
        function check_pays() 
        {
            var x1 = document.getElementById("pays_id").value;
            var x2 = x1.remove_accent();  
            var x = x2.toUpperCase();

          if(pays[x]==x)
            {
                document.getElementById("id_msg_pays").style.display = "block";
                document.getElementById("msg_pays").innerHTML = "Ce pays existe déjà dans le système !! ";
                return false;
            }
            else
            {
                document.getElementById("id_msg_pays").style.display = "none";
                return true;
            }

        }

        function check_code() 
        {
            var y1 = document.getElementById("code_id").value; 
            var y2 = y1.remove_accent();
            var y = y2.toUpperCase();
          
            if(code[y]==y)
            {
                document.getElementById("id_msg_code").style.display = "block";
                // document.getElementById("id_msg_pays").style.display = "block";
                document.getElementById("msg_code").innerHTML = "Ce code est déjà attribué à un pays dans le système !! ";
                return false;
            }
            else
            {
                document.getElementById("id_msg_code").style.display = "none";
                return true;
            }

        }

        function pays_existe()
        {
            check_pays();
            check_code();
            
          if((check_pays()==true) && (check_code()==true))
            {
                var x = document.getElementById("pays_id").value;
                var y = document.getElementById("code_id").value;
                empty(x);
                empty(y);

                if ((empty(x)==true && empty(y)==true)) 
                {
                    // alert(emptyX());
                    document.getElementById('aj_pays').disabled=false;
                }
                else
                    {
                       document.getElementById('aj_pays').disabled=true; 
                    }

                
            }
            else
            {
                document.getElementById('aj_pays').disabled=true;
            }
        }

        function code_existe()
        {

            pays_existe();
        
        }


        function suc_existe()
        {
            check_sur();
            
          if(check_sur()==true)
            {
                var s = document.getElementById("suc_id").value;
                var p = document.getElementById("pays_suc").value;
                // alert('baba');
                empty(s);
                empty(p);
                

               if ((empty(s)==true && empty(p)==true))
                {
                    // alert('bobo');
                        document.getElementById('aj_suc').disabled=false;
                } 
                else
                {
                    // alert('bibi');
                    document.getElementById('aj_suc').disabled=true;
                }
                
            }

            else
            {
                document.getElementById('aj_suc').disabled=true;
            }
        }


   
</script>


</body>
</html>
