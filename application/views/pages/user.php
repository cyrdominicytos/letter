<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dropzone.css"/>

<div class="pageheader">
    <h2><i class="fa fa-table"></i> EMPLOYES <span>GESTION DES COURRIERS</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">Vous êtes ici :</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>tb">Letterbox</a></li>
            <li class="active">Nouveaux</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

	<div class="row">


        <div align="center" style="display: none;" id="id_msg" class="col-md-12 alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
            <b><p id="msg_user"></p></b>
            
        </div>
		<!-- <?php if (isset($msg)) { ?>

			<div class="col-md-2"></div>
			<div align="center" class="col-md-8 alert <?php echo $class; ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $msg; ?></strong>
			</div>
			<div class="col-md-2"></div>

			<hr/>
		<?php } ?> -->

		<form id="basicForm" method="post" action="<?php echo site_url(); ?>user/user/1"
			  class="form-horizontal">

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="minimize">&minus;</a>
						</div>
						<h4 class="panel-title">Ajouter un employé</h4>
					</div>

					<div class="panel-body">
						
						<!-- <br/> -->
						<div class="form-group">
							
							<div class="col-sm-6 ">
                                <label class="control-label">Nom<span style="color: red">*</span> </label>
								<input type="text" maxlength="50" required="" placeholder="Nom" id="nom_user" name="nomemp" onchange="check_send();" class="form-control"/>
							</div>

							<div class="col-sm-6">
                                <label class="control-label">Prénom(s)<span style="color: red">*</span></label>
								<input type="text" maxlength="50" required="" placeholder="Prénom" id="prenom_user" name="prenomemp" onchange="check_send();" class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
                                <label class="control-label">Poste<span style="color: red">*</span></label>
								<input type="text" maxlength="50" placeholder="Poste" name="titreemp" id="poste_user" class="form-control" onchange="check_send();" required/>
							</div>

                            <div class="col-sm-6">
                                <label class="control-label">Adresse Email<span style="color: red">*</span></label>
                                <input type="email" maxlength="50" placeholder="Email" name="emailemp" class="form-control" id="verif_mail" onchange="check_send()" required/>
                            </div>
							<!-- <div class="col-sm-4">
								<input type="password" name="password" placeholder="mot de passe" class="form-control"
									   required/>
							</div> -->
						</div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label">Succursale<span style="color: red">*</span></label>
                                <select name="fkidgroupe" id="suc_user" class="select2" onchange="check_send();" required data-placeholder="Choisissez...">
                                    <option value="">Choisissez...</option>
                                    <!--option value="<?php echo isset($groupe) ? $groupe->idgroupe : $groupe->idgroupe; ?>"><?php echo isset($groupe) ? $groupe->libellegroupe : $groupe->libellegroupe; ?></option-->
                                    <?php
                                    if(isset($groupe) & count($groupe)>0) {
                                        foreach ($groupe as $item) { ?>
                                            <option value="<?php echo $item['id_suc'] ?>"><?php echo $item['libelle_suc'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Service<span style="color: red">*</span></label>
                                <select  name="fkidservice" id="service_user" class="select2" onchange="check_send();" required data-placeholder="Choisissez...">
                                    <!-- id="fkidservice" -->
                                    <option value="">Choisissez...</option>
                                    <?php
                                    if(isset($office) ) {
                                        foreach ($office as $item) { ?>
                                            <option value="<?php echo $item['id_service'] ?>"><?php echo $item['libelle_service'].' ('.$item['code_service'].')' ?></option>
                                        <?php }
                                    }
                                    ?>

                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label">Profil<span style="color: red">*</span></label>
                                <select name="fkidprofil" id="profil_user" class="select2" onchange="check_send();" required data-placeholder="Choisissez...">
                                    <option value="">Choisissez...</option>
                                    <!--option value="1">Super admin</option>
                                    <option value="2">Utilisateur</option-->
                                    <?php
                                    if(isset($priv) & count($priv)>0) {
                                        foreach ($priv as $item) { ?>
                                            <option value="<?php echo $item['id_priv'] ?>"><?php echo $item['libelle_priv'] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>

                                    <div class="col-sm-2 col-sm-offset-2">
                                <br><br>
                                <!-- <label class="control-label"> SFFSFSFS</label> -->
                                <button style="text-align:center" disabled="" id="id_save" type="submit" class="col-sm-12 btn btn-primary btn-hover btn-sm">
                                    Enregistrer
                                </button>

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

<script type="text/javascript">
     var email = <?php echo json_encode($EmailExiste); ?>;

     var x = document.getElementById("verif_mail").value;

     document.getElementById("id_msg").style.display = "none";

     document.getElementById('id_save').disabled=true;

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

    function mailexiste()
    {

      var x = document.getElementById("verif_mail").value;
       
      
      if(email[x]==x)
        {
        // document.getElementById('id_save').disabled=true;
        document.getElementById("id_msg").style.display = "block";
        document.getElementById("msg_user").innerHTML = "L'adresse email que vous avez saisie est déjà attribuée à un utilisateur. ";
        return false;
        }
    else
        {
        document.getElementById("id_msg").style.display = "none";
        // document.getElementById('id_save').disabled=false;
        return true;
        }
    }


    function save_user()
    {

        var mail = document.getElementById("verif_mail").value;
        empty(mail);
        var nom_user = document.getElementById("nom_user").value;
        empty(nom_user);
        var prenom_user = document.getElementById("prenom_user").value;
        empty(prenom_user);
        var poste_user = document.getElementById("poste_user").value;
        empty(poste_user);
        var suc_user = document.getElementById("suc_user").value;
        empty(suc_user);
        var service_user = document.getElementById("service_user").value;
        empty(service_user);
        var profil_user = document.getElementById("profil_user").value;
        empty(profil_user);

    if ((empty(mail)==true)&&(empty(nom_user)==true)&&(empty(prenom_user)==true)&&(empty(poste_user)==true)&&(empty(suc_user)==true)&&(empty(service_user)==true)&&(empty(profil_user)==true)) 
    {
        return true;
        // document.getElementById('id_save').disabled=false;

    }

    else
    {
        return false;
        // document.getElementById('id_save').disabled=true;
    }



    }


    function checkEmail(email) {
             var re = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
             return re.test(email);
         }
         function validate() {
             var email = document.getElementById("verif_mail").value;
         
             if (checkEmail(email)) {
                 // alert('Adresse e-mail valide');
                 return true
             } else {
                 // alert('Adresse e-mail non valide');
                 return false;
             }
             
         }


    function check_send()
    {
        save_user();
        mailexiste();
        validate();
        if (save_user()==true && mailexiste()==true && validate()==true) 
        {

            document.getElementById('id_save').disabled=false;
        }
        else
        {
            document.getElementById('id_save').disabled=true;
        }

    }




   
</script>

<script>
    $("select[name='fkidgroupe']").on('change', function () { // lorsqu'on change de valeur dans la liste

        var idgroupe = $(this).val(); // valeur sélectionnée

        //var _url = "$_SERVER['HTTP_HOST']";
        var HREF = surl+'bureau/getService?id='+idgroupe;


        $("#fkidservice").find('option').remove();

        var posting = $.post(HREF);

        posting.done(function (data) {

            $.each(data, function (index, element) {

                $("#fkidservice").append($('<option>', {
                    value: element.idservice,
                    text: element.libelleservice
                }, '</option>'));
            });
            $("#fkidservice").append($('<option>', {
                value: '',
                text: 'Service',
            }, '</option>'));
            if ($(("#fkidservice") + ' option').length > 0) {
                firstopt = $(("#fkidservice") + ' option')[0];
                $(firstopt).selected = true;
                $(firstopt).attr('selected', 'selected');

            }
            $("#fkidservice").trigger('change');
        });

    });
</script>

<script>
	jQuery(document).ready(function () {

		"use strict";

		jQuery('#tags').tagsInput({width: 'auto'});

		// Select2
		jQuery(".select2").select2({
			width: '100%',
			minimumResultsForSearch: -1
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
