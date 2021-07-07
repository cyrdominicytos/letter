<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/letterbox2.png" type="image/jpg">

    <title><?php if (isset($title)) {
            echo $title;
        } else {
            echo 'Flamme Divine';
        } ?></title>

    <link href="<?php echo base_url() ?>assets/css/style.default.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/select.dataTables.min.css" rel="stylesheet">

    <!--link href="<?php echo base_url() ?>assets/api/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/api/datetimepicker/bootstrap-datetimepicker-standalone.css" rel="stylesheet"-->

    <!--link href="<?php echo base_url() ?>assets/api/jquerydatablecheckbox/css/dataTables.checkboxes.css" rel="stylesheet"-->
    <!--link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"-->

    <link href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">


    <!--link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- My own script -->
    <script type="text/javascript">
        var surl = "<?php echo site_url(); ?>";
        var burl = "<?php echo base_url(); ?>";
    </script>

    <?php

    if (isset($css))
        foreach ($css as $value) {
            echo '<link href="' . base_url() . $value . '" rel="stylesheet" type="text/css">';
        }

    ?>

</head>

<body>
<!-- Preloader -->
<!--div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div-->

<section style="color:white;">

    <div class="leftpanel" style="color:white;">

        <div class="logopanel">
            <!--h1><span>[</span> bracket <span>]</span></h1-->
            <img style="width:150px;" src="<?php echo base_url() ?>assets/img/letterbox2.png" alt=""/>
        </div><!-- logopanel -->

        <div class="leftpanelinner" style="color:white;">

            <!-- This is only visible to small devices -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <img alt="" src="<?php echo base_url() ?>assets/img/no-image.jpg" class="media-object">
                    <div class="media-body">
                        <h4><?php echo $_SESSION['login']; ?></h4>
                        <span>Gestion des courriers</span>
                    </div>
                </div>

                
            </div>

            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li>&nbsp;</li>
                <li <?php if ($menu == 'tb') { ?> class="active" <?php } ?> >
                    <a href="<?php echo site_url(); ?>tb"><i class="fa fa-home"></i>
                        <span>Tableau de bord</span></a>
                </li>
                <?php if ($_SESSION['courrierpriv'] == 1) { ?>
                <li <?php if ($menu == 'courriers') { ?> class="nav-parent nav-active active" <?php } else { ?>class="nav-parent" <?php } ?>  ><a href=""><i class="fa fa-laptop"></i> <span>Courriers</span></a>
                    <ul class="children" <?php if($menu=='courriers') echo 'style="display: block"'; ?>>
                        <!-- <?php if($_SESSION['ischef'] == true) { ?> -->
                            <!--li <?php if($submenu=='avalider') echo 'class="active"' ?>><a href="<?php echo site_url(); ?>courrier/avalider"><i class="fa fa-check-circle-o"></i>A Valider</a></li-->
                        <!-- <?php } ?> -->
                        <!-- <?php echo site_url(); ?>courrier/atraiter#home2 -->
                        <li <?php if($submenu=='atraiter') echo 'class="active"' ?>><a href="<?php echo site_url(); ?>courrier/atraiter#home2"><i class="fa fa-download"></i>A Traiter</a></li>

                        <!-- <?php echo site_url(); ?>courrier/courrier -->
                        <li <?php if($submenu=='enregistrer') echo 'class="active"' ?>>
                        <a href="<?php echo site_url(); ?>courrier/courrier">
                        <i class="fa fa-plus-circle"></i>Enregistrés</a></li>

                        <!-- <?php echo site_url(); ?>courrier/encopie -->
                        <li <?php if($submenu=='encopie') echo 'class="active"' ?>>
                        <a href="<?php echo site_url(); ?>courrier/encopie"><i class="fa fa-copy"></i>En Copie</a></li>

                        <!-- <?php echo site_url(); ?>courrier/transferer -->
                        <li <?php if($submenu=='transferer') echo 'class="active"' ?>><a href="<?php echo site_url(); ?>courrier/transferer"><i class="fa fa-reply"></i>Tranférés</a></li>

                        <!-- <?php echo site_url(); ?>courrier/archiver -->
                        <li <?php if($submenu=='archiver') echo 'class="active"' ?>><a href="<?php echo site_url(); ?>courrier/archiver"><i class="fa fa-archive"></i>Archivés</a></li>
                    </ul>
                </li>
                <?php
                 }
                ?>

                <!--li <?php if ($menu == 'courriers') { ?> class="active" <?php } ?> >
                    <a href="<?php echo site_url(); ?>courrier">
                        <i class="fa fa-envelope-o"></i> <span>Les Courriers</span></a>
                </li-->

                    
                <?php if ($_SESSION['employepriv'] == 1) { ?>
                    <h5 class="sidebartitle">ADMINISTRATION</h5>
                    <li <?php if ($menu == 'users') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>user">
                            <i class="fa fa-users"></i> <span>Employés</span></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['dossierpriv'] == 1) { ?>
                    <li <?php if ($menu == 'expediteur') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>courrier/expediteur_courrier">
                            <i class="fa fa-users"></i> <span>Expéditeurs</span></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['servicepriv'] == 1) { ?>
                    <li <?php if ($menu == 'services') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>bureau/services">
                            <i class="fa fa-building-o"></i> <span>Services</span></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['dossierpriv'] == 1) { ?>
                    <li <?php if ($menu == 'dossiers') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>courrier/dossiers">
                            <i class="fa fa-bullhorn"></i> <span>Dossiers</span></a>
                    </li>

                    <li <?php if ($menu == 'Type_Courriers') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>courrier/typecourrier">
                            <i class="fa fa-bullhorn"></i> <span>Types Courriers</span></a>
                    </li>

                <?php } ?>
                <?php if ($_SESSION['groupepriv'] == 1) { ?>
                    <li <?php if ($menu == 'groupes') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>bureau/groupes">
                            <i class="fa fa-users"></i> <span>Succursales</span></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['privpriv'] == 1) { ?>
                    <li <?php if ($menu == 'privileges') { ?> class="active" <?php } ?> >
                        <a href="<?php echo site_url(); ?>user/privileges">
                            <!-- <?php echo site_url(); ?>user/privileges -->
                            <i class="fa fa-unlock-alt"></i> <span>Privilèges</span></a>
                    </li>
                <?php } ?>
            </ul>

            <!--div class="infosummary">
                <h5 class="sidebartitle">Information Summary</h5>
                <ul>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Daily Traffic</span>
                            <h4>630, 201</h4>
                        </div>
                        <div id="sidebar-chart" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Average Users</span>
                            <h4>1, 332, 801</h4>
                        </div>
                        <div id="sidebar-chart2" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Disk Usage</span>
                            <h4>82.2%</h4>
                        </div>
                        <div id="sidebar-chart3" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">CPU Usage</span>
                            <h4>140.05 - 32</h4>
                        </div>
                        <div id="sidebar-chart4" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Memory Usage</span>
                            <h4>32.2%</h4>
                        </div>
                        <div id="sidebar-chart5" class="chart"></div>
                    </li>
                </ul>
            </div--><!-- infosummary -->

        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->





