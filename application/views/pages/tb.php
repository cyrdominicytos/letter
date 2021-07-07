<div class="pageheader">
	<h2><i class="fa fa-home"></i> Tableau de bord <span>GESTION DE COURRIERS</span></h2>
	<div class="breadcrumb-wrapper">
		<span class="label">Vous êtes ici :</span>
		<ol class="breadcrumb">
			<!-- <li><a href="<?php echo site_url(); ?>tb">tableau de bord</a></li> -->
			<li class="active">Tableau de bord</li>
		</ol>
	</div>
</div>

<div class="contentpanel">
	<div class="row">
		<div class="col-sm-6 col-md-9">
			<div class="panel panel-success panel-stat">
				<div class="panel-heading"style="background-color: white;">
					<!-- <div class="stat"style="border: 1px solid;"> -->
						<div class="row">
							<!-- <div class="col-xs-4">
								<img src="<?php echo base_url() ?>assets/images/is-document.png" alt=""/>
							</div> -->
							<div class="col-xs-12" style="margin-bottom: 30px;">
								<small class="stat-label" style="color: #000;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;text-align: center; ">Mes courriers</small>
								<h1></h1>
							</div>
						</div>
						<div class="mb15"></div>
						<div class="row" >
							<div class="col-xs-3" style="margin-top: -15px;">
								<h4 style="color: #000; text-align: center;font-weight: bolder;font-size: 25px"><?php echo isset($nbatraiter) ? $nbatraiter : 0; ?></h4>
								<small class="stat-label" style="margin-top: 25px; color: #fc4b6c;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;text-align: center; ">Courriers à traiter</small>
								
							</div>
							<div class="col-xs-3" style="margin-top: -15px;">
								<h4 style="color: #000; text-align: center;font-weight: bolder;font-size: 25px"><?php echo isset($nbmyservice) ? $nbmyservice : 0; ?></h4>
								<small class="stat-label"style="margin-top: 25px; color: #1e88e5;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;text-align: center; ">Courriers de mon service</small>
								
							</div>
							<div class="col-xs-3" style="margin-top: -15px;">
								<h4 style="color: #000; text-align: center;font-weight: bolder;font-size: 25px"><?php echo isset($nbenregistre) ? $nbenregistre : 0; ?></h4>
								<a href="<?php echo site_url() ?>courrier/courrier"><small class="stat-label" style="margin-top: 25px; color: #ffb22b;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;text-align: center; " >Courriers
										enregistrés</small>
									</a>
							</div>
							<div class="col-xs-3" style="margin-top: -15px;">
								<h4 style="color: #000;text-align: center;font-weight: bolder;font-size: 25px"><?php echo isset($nbencopie) ? $nbencopie : 0; ?></h4>
								<a href="<?php echo site_url() ?>courrier/encopie"><small class="stat-label" style="margin-top: 25px; color: #00ad45;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;text-align: center; ">Courriers
										en copies</small>
									</a>
							</div>
						</div>
					<!-- </div> -->
				</div>
			</div>
		</div>
		<!-- <div class="col-sm-6 col-md-3">
			<div class="panel panel-primary  panel-stat">
				<div class="panel-heading">
					<div class="stat">
						<div class="row">
							<div class="col-xs-4">
								<img src="<?php echo base_url() ?>assets/images/is-document.png" alt=""/>
							</div>
							<div class="col-xs-8">
								<small class="stat-label">Mes courriers</small>
								<h1></h1>
							</div>
						</div>
						<div class="mb15"></div>
						<div class="row">
							<div class="col-xs-6">
								<a href="<?php echo site_url() ?>courrier/courrier"><small class="stat-label">Courriers
										enregistrés</small>
									<h4><?php echo isset($nbenregistre) ? $nbenregistre : 0; ?></h4></a>
							</div>
							<div class="col-xs-6">
								<a href="<?php echo site_url() ?>courrier/encopie"><small class="stat-label">Courriers
										en copies</small>
									<h4><?php echo isset($nbencopie) ? $nbencopie : 0; ?></h4></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<script>
            var atraiter = <?php echo $nbatraiter; ?>;
            var encopie = <?php echo $nbencopie; ?>;
            var enregistre = <?php echo $nbenregistre; ?>;
		</script>
		<div class="col-sm-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-headng">
					<div class="col-lg-12">
						<center><small style="color: #000;font-family: Bookman Old Style;font-weight: bold;font-size: 14px;">VUE D'ENSEMBLE</small></center>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div id="donut-chart2" class="ex-donut-chart"></div>
						</div>
					</div>
				</div><!-- panel-body -->
			</div><!-- panel -->
		</div>
	</div>
	<!--div class="row">
		<script>



		</script>
		<div class="col-md-3">
			<section class="widget large">
				<header>
					<h4><i class="fa fa-home"></i> Top sources</h4>
				</header>
				<div class="body">
					<div id="sources-chart-pie" class="chart pie-chart">
						<svg></svg>
					</div>
				</div>
				<footer id="data-chart-footer" class="pie-chart-footer col-sm-12">
				</footer>
			</section>
		</div>
		<div class="col-md-9">
			<section class="widget large">
				<header>
					<h4><i class="fa fa-bar-chart-o"></i> Graphe en Batton évolution</h4>
				</header>
				<div id="sources-chart-bar" class="body chart">
					<svg></svg>
				</div>
			</section>
		</div>
	</div-->
	<div class="row">
		<label class="form-control">Liste des courriers à traiter dont la date limite de traitement est proche :</label>
		<div class="table-responsive">
			<table class="table table-striped" id="note" style="color: black">
				<thead>
				<tr>
					<!--th>#</th-->
					<th style="text-align: center;">COURRIERS</th>
					<th style="text-align: center;">DATES LIMITES</th>
					<th style="text-align: center;">PRIORITES</th>
					<th style="text-align: center;">JOURS RESTANTS</th>
				</tr>
				</thead>
				<tbody>
				<?php
				if (isset($urgent)) {
					$i = 1;
					foreach ($urgent as $item) {
						?>
						<tr>
							<td class="center" style="text-align: center;">
								<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
									<?php echo $item['num_courrier']; ?>
								</a>
							</td>
							<td class="center" style="text-align: center;">
								<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
									<?php echo $item['date_limite'] ?>
								</a>
							</td>
							<td class="center" style="text-align: center;">
								<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2">
									<?php echo $item['priorite_courrier']; ?>
								</a>
							</td>
							<td class="center" style="text-align: center;">
								<a href="<?php echo site_url(); ?>courrier/viewatraiter?id=<?php echo $item['id_dif']; ?>#home2"><?php echo $item['jr']; ?>
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
	</div>

</div>

<!--div class="contentpanel">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body panel-body-primary panel-body-top-br">
                    <div class="panel-desc">
                        <span class="text-dark"><i class="ion ion-arrow-graph-up-right"></i> Stock market index:</span>
                        <span class="text-primary">36,174</span>
                    </div>
                    <div id="site_statistics" style="height:180px;"></div>
                </div>
            </div>
        </div>
    </div>
</div-->


</div><!-- mainpanel -->


<script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/toggles.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/retina.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.cookies.js"></script>

<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot/jquery.flot.spline.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/morris.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/raphael-2.1.0.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>

<script>
	jQuery(document).ready(function () {

		"use strict";
		var burl = "<?php echo base_url(); ?>";
		var surl = "<?php echo site_url(); ?>";


		// Select2
		jQuery('select').select2({
			minimumResultsForSearch: -1
		});

		jQuery('select').removeClass('form-control');

		// Delete row in a table
		

		// Show aciton upon row hover


	});
</script>
</body>
</html>