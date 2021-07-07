$(document).ready(function () {

	var sum = 0;

	var table = $('#example').DataTable({
		dom: 'Bfrtip',
		"processing": true,
		ajax: {
			url: _url + 'customerlog/getlistcustomerrecouvrementtoday',
			"type": "GET",
			"data": function (d) {
				return $.extend({}, d, {
					"kit": $("select[id=kit]").val(),
					"com": $("select[id=com]").val(),
					"recouvre": $("select[id=recouvre]").val(),
					"datetimedeb": $("input[id=datetimedeb]").val(),
					"datetimeend": $("input[id=datetimeend]").val(),
				});
			}
		},
		"fixedHeader" : {
			header : true,
			footer : true
		},
		buttons: [
			{
				extend: 'print',
				footer: true,
				customize: function ( win ) {
					$(win.document.body)
						.css( 'font-size', '10pt' )
						.prepend(
							'<img src="<?php echo base_url() ?>assets/img/fldf.png" style="position:absolute; top:0; left:0;" />'
						);

					$(win.document.body).find( 'table' )
						.addClass( 'compact' )
						.css( 'font-size', 'inherit' );
				},
				messageTop: function () {
					//if (printCounter === 1) {
					return 'Total : '+totalrec.toLocaleString()+' F CFA';
					//} else {
					//	return 'You have printed this document ' + printCounter + ' times';
					//}
				},
				exportOptions: {
					columns: [0, 1, 2, 3, 4],
					footer: true
				},

			},
			{
				extend: 'pdfHtml5',
				//title: 'Total : '+totalrec.toLocaleString(),
				pageSize: 'A4',
				footer: true,
				exportOptions: {
					columns: [0, 1, 2, 3, 4],
					footer: true
				},
				customize: function (doc) {
					//Remove the title created by datatTables
					doc.defaultStyle.fontSize = '9';
					doc.content.splice(0, 1);
					var now = new Date();
					var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
					var logo = 'data:image/jpeg;base64,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BRRRQAUUUUAFFFFABRRQTigCCe7S2iaSSQRooyzMcAV/OD/wWU/b6k/bn/atvG0m8abwL4KMmleHwhzHcDcBPefWZgMH+4kYODur9Pf+DgT9vM/sx/syf8ID4fvFh8ZfEqGW1LxNiTT9MHy3EvHKtJkRL04aQg5jr8Cc7xznPbJ6DsP88V+zeGPD9r5rWWu0P1a9dl8z8j8Q88vJZdSei1l+i+W/zPqj/gi9+z8P2hv+Cjnw9spoPO0vw3dP4kvjjhUtF8yPI/um4+zrz2fHev6UUGIwK/H7/g1u+BuX+KHxInhDKv2Xw3YS45/5+blT+dof8iv2Cr5fxHx7xGbuitqaS+e7/P8AA+j4BwKoZYqrWs3f5bL8iSiiivgT7kKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAE3Cszxb4w07wP4Z1DWdWvIbDS9KtZLy7uZTiO3hjUu7sewVQSfYVoYwK/Mv8A4OQ/212+FXwH0v4RaHeeXrfxA/0nVfKYeZBpcT4Kk9R50wC8ZykUqn71elkuW1MxxtPCU95PXyW7fyR5ecZlDA4SeKn9laevRfeflD/wUB/a71D9uD9qjxP4/vmmSxup/suj2snWysIyVgj9A23Lv23yORmvFaDxTgp9GznAwOtf1fhcLSwuHjh6asoKy9EfzTiMRUxFaVWprKTv95/RZ/wQQ+EC/Cv/AIJn+DZmh8u78WXN5r1yBxu8ydkiP4wRQn8fpX2dXB/sxfDRfg1+zp4F8JLH5P8AwjegWOmEdPmhgjjP45U/U13+K/kzNsU8TjauI/mlJ/jof01leH9hg6VHtFL8NRaKKK4T0AooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAoooJxQBneJPEtj4S8PX2raldQ2Om6ZBJdXVxKdsdvFGpZ3Y9gqgkn0Ffy5ft7/ALVd7+2h+1b4w+IF0032PVLww6Xbvx9msIspbx47EIAzAdXZz3r9j/8Ag4k/bB/4UP8Asex+A9LuDH4g+KEzWLiNj5kWnRbWuWz/ALZaKE56rNJ6V+B69a/bfC3JOSjPMqi1l7sfRbv5tW+R+O+I2b89aOApvSOsvV7L5L8xK9A/ZY8Ef8LP/ad+HPhtl3Lr3ijTtPYHlSst1HGf0Y15/jmvpL/gj/4TXxl/wUs+EFmy7hDrn24DrzbxSXAP4GIH8K/Tc3qujga1RbqMn80j89yymquKp031kl97P6aI02qOOwzzzmpPN/wpuNtcvr3xR0jw54nXS9QnFnNKiyRySDEcgJI+92OQeuK/jPMs4weXwVXG1FTi2leTsrvZXfc/qehRqVPdppt9lvodYGzSbhUMF1HPGrxyKyt0KnINP3D1613U6inHmi7ry1IemjJKKKK0AKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAJxTWkUg8/nSsflr58/4Kf/tRf8MhfsR+OvGNvN5OsLZf2do+D8xvbj91Ey+uwsZSP7sTeldGFw88RWhQp7yaS+bsc+KxMMPRlXntFNv5H4Z/8Fof2sf+Gtf28/FV1ZXX2jw/4SP/AAjWkFW3I8dsziWVSOMPOZmB7qUz0FfJ9OL7zuZmZurZ7n/OKbX9a5ZgIYLCQwsFpFW/rzP5hzDGTxWInXqPWTuL/F+NfZX/AAQI0ddT/wCCpnw8kxxYwapcj8dOuIx+r18aDrX3H/wbvW4l/wCCmnhtm+8uj6k3/kAj/wBmrz+KZNZPif8Ar3L8ju4cSeZ0L/zR/M/oYOc14x+1zoHn6dpWoBR+5ka3dsdQw3D/ANBP517QRiuO+Oug/wBv/C7VI0GZIYzOnsUIb+QI/Gv4H8XsheccIY7BRV5cjlG380PeXzbVj+sMgxf1bMaVXpez9Hoz588A/FnWvh/KotrhpbX+O2l+aNvoM/L9Rj3zXv3wy+Nul/ESHYrfZbxR88Dn5m91P8X86+XcfLnt0otZpLWdZI2kikjOVkRtrA+xr/Pzw28ds/4Uqxw9SbrYa9nCTbsuvK3rH028j9YzrhXC49OpBcs+66+p9teeu3O7j1pdwrxT4N/tE/2hNHpevSKjn5Ybo8B/ZvQ+/wD+uvZvOUqp3cNyD61/oxwPx9lPFeXrH5VUv/NF/FF9mvy6Pofj+ZZXiMDWdLEK3bsyaiiivtjzwooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAazZr8a/wDg6C/aY/tDxb4A+FFjOfL06F/E2poDlWlkL29svHdUFySPSVfav2SdwMnsOTX8un/BSD9oRv2pf22/iN4ySb7Rp99q72unOD8ps7cLb25HpujjVj/tMT61+heGuWLEZp7eS92km/m9F+r+R8F4gZg6GXexi9ajt8lq/wBF8zw6iiiv6KPwgBwa+3v+Dem7Ft/wU68Jrnm40zUo8fS1Zv8A2WviGvrr/ghbrf8AYn/BVD4XuzBY55NRtm567tMugB/31t/GvB4oi5ZTiEt+SX5HtcPyUczoN/zR/NH9Ijrk1XvLYXFpNHIm9ZAVI9QRirQOaRhuWv5MrUlUg6ctmrH9NxlZ3R8XeIdLbRNZu7NlZWtZ2iYHvhj/ADxVWu8/aT0L+yPifdSDiPUI0nUehxsP6r+tcHX+N/HWRyyfiDGZa1/DqSS9L6P5rU/onKsWsTg6db+ZL7+oHGwrtx0xivYPgR8czp0tvoutTZt2wltcu2TH6Kx9PQ9vp08foQ7E27Sen4Yrt4A48zPhTM45ll03/fj0lHqmv6a6GebZTSx+HdGsvR9U+6PtpZ1YcHI9cUu4V5D+zl8XG8SWg0TUJc3luoMEjHmVB2PuP1Fet7uM1/qxwRxpgOKMppZtl7vGS1XWMusX5r8Vqfg+ZZfVwWIlh626/FdySiiivsDhCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAPBv+ClHx6b9mz9hb4neLoLg21/p+iy2unyA7WS8uMW8BHuJZEP4V/L0hByrdD3PQenHp3r9xP+Dnf4z/APCIfsse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';
					doc.pageMargins = [43, 43, 18, 18];
					doc.styles.tableHeader.fontSize = 9;
					doc['header'] = (function () {
						return {
							columns: [
								{
									image: logo,
									width: 70
								},
								{
									alignment: 'left',
									italics: true,
									text: 'La Flamme Divine',
									fontSize: 9,
									margin: [18, 0]
								},
								{
									alignment: 'right',
									fontSize: 9,
									text: 'Total : '+totalrec.toLocaleString()+' F CFA'
								}
							],
							margin: 18
						}
					});
					doc['footer'] = (function (page, pages) {
						return {
							columns: [
								{
									alignment: 'left',
									text: ['Créer le : ', {text: jsDate.toString()}]
								},
								{
									alignment: 'right',
									text: ['P', {text: page.toString()}, '/', {text: pages.toString()}]
								}
							],
							margin: 3
						}
					});
					var objLayout = {};
					objLayout['hLineWidth'] = function (i) {
						return .5;
					};
					objLayout['vLineWidth'] = function (i) {
						return .5;
					};
					objLayout['hLineColor'] = function (i) {
						return '#aaa';
					};
					objLayout['vLineColor'] = function (i) {
						return '#aaa';
					};
					objLayout['paddingLeft'] = function (i) {
						return 4;
					};
					objLayout['paddingRight'] = function (i) {
						return 4;
					};
					doc.content[0].layout = objLayout;
				}

			}
		],
		"columns": [
			/*{title: "Nom client", data: "nameCustomer"},
			{title: "Prénom client", data: "surnameCustomer"},
			{title: "Sexe", data: "sexeCustomer"},
			{title: "Adresse", data: "adresseCustomer"},
			{title: "Recouvrement", data: "sommetotal"},
			{title: "Actions",}*/

			{title: "Nom client", data: "namecustomer"},
			{title: "N° contrat", data: "contrat"},
			{title: "nom Kit", data: "nomkit"},
			{title: "Quantité", data: "Qte"},
			{title: "Total", data: "sommeTotal"},
			//{title: "A Recouvré", data: "montantaSolde"},
			{title: "Actions"}
		],
		"columnDefs": [{
			"targets": 5,
			render: function (data, type, row, meta) {
				return '<div class="dropdown"> ' +
					'<div class="btn btn-sm btn-brown more-btn"> Actions ' +
					'<span class="caret"></span> ' +
					'</div><ul class="dropdown-menu">' +
					'<li>' +
					'<a style="color:black;" target="_blank" href="' + _url + 'customer/viewcust?id=' + row.idCustomer + '"><i class="fa fa-eye"> </i> Détails</a> ' +
					'</li> ' +
					'</ul> ' +
					'</div>';
			}
		}],
		'rowsGroup': [0],
		"language": {
			"url": __url + "assets/js/others/French.json"
		},
		retrieve: true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true,
		"bFilter": false,
		"pageLength": 10,
		footerCallback: function (row, data, start, end, display) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function (i) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '') * 1 :
					typeof i === 'number' ?
						i : 0;
			};


			data = api.column(4).cache('search');
			totalrec = data.length ?
				data.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}) :
				0;

			// Total over this page
			pageTotalrec = api
				.column(4, {page: 'current'})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);


			// Total over this page
			/*pageTotal = api
				.column(4, {page: 'current'})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over all pages

			data = api.column(4).cache('search');
			total = data.length ?
				data.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}) :
				0;*/

			$('#totalrecouvrer').html(
				'Total : ' + totalrec.toLocaleString() + ' F CFA'
			);
			/*$('#totalarecouvrer').html(
				'Total à recouvré : ' + total.toLocaleString() + ' F CFA'
			);*/

			$('.tr').html(
				pageTotalrec.toLocaleString() + ' ( ' + totalrec.toLocaleString() + ')'
			);
			/*$('.tar').html(
				pageTotal.toLocaleString() + ' ( ' + total.toLocaleString() + ')'
			);*/

			// Update footer by showing the total with the reference of the column index
			//$( api.column( 4).footer() ).html('Total');


		}
	});

	jQuery.fn.dataTable.Api.register('sum()', function () {
		return this.flatten().reduce(function (a, b) {
			return (a * 1) + (b * 1); // cast values in-case they are strings
		});
	});


	var foot = $("#example").find('tfoot');
	foot = $('<tfoot>').appendTo("#example");
	foot.html('<tr><th colspan="4">Total</th><th class="tr"></th><th></th></tr>');

	jQuery("#search").click(function () {
		table.ajax.reload(null, false);
	});


});
