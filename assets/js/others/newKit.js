$(document).ready(function () {
	/*
        $('#newKit').on('click', function () { // lorsqu'on change de valeur dans la liste
    
            $.ajax({
                type: "POST",
                url: _url + 'customer/newKit',
                data: 3,
                success: function (response) {
                    $('#moreKit').html(response);
                },
                error: function (response) {
                    console.log( response );
                }
            });
        });*/

	var max_fields = 10; //maximum input boxes allowed
	//var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var wrapper1 = $("#moreKit"); //Fields wrapper
	var add_button = $(".add_field_button"); //Add button ID
	var countries = [];

	var x = 1; //initlal text box count
	$(add_button).click(function (e) { //on add input button click
		e.preventDefault();
		if (x < max_fields) { //max input box allowed
			x++; //text box increment
			/*$.each($("#fkidKit option:selected"), function(){
				countries.push($(this).val());
			});
			alert("You have selected the country - " + countries.join(", "));*/
			var arr = $('select[name="fkidKit[]"]').map(function () {
				return this.value; // $(this).val()
			}).get();
			arr = JSON.stringify(arr);
			$.ajax({
				type: "POST",
				url: _url + 'customer/newKit',
				data: ({arr: arr}),
				success: function (response) {
					//$('#moreKit').html(response);
					//$(moreKit).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
					$('#moreKit').append(response);
				},
				error: function (response) {
					console.log(response);
				}
			});
		}
	});

	$(wrapper1).on("click", ".remove_field", function (e) { //user click on remove text
		e.preventDefault();
		$(this).parent('div').remove();
		x--;
	})

});
