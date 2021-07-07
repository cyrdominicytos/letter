$(document).ready(function () {

	/* Defaults */
	if ($.fn.dataTable.isDataTable('#listcom')) {

	} else {
		$('#listcom').DataTable({
			retrieve: true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"pageLength": 100,
			"bFilter": false,
			"language": {
				"url": "French.json"
			},
			responsive: true,
		});
	}


});
