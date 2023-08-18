$(document).ready(function(){

	$("#addNewGuest").click(function(){
		var customer_name = $('input[name=customer_name]').val();
		var mobile_no = $('input[name=mobile_no]').val();
        var customerEmail = $('input[name=customerEmail]').val();
        var customerAddress = $('textarea[name=customerAddress]').val();
		var error = 0;
		if(customer_name == '') {
			error = 1;
            var cl1 = ".customer_err_msg";
            var cl2 = ".customer_err_msg_contnr";
            $(cl1).text("The Customer Name field is required.!");
            $(cl2).show(200).delay(6000).hide(200,function(){
            });
		} else {
			$('input[name=customer_name]').css('border', '1px solid #ccc');
		}
		if(mobile_no == '') {
            error = 1;
            var cl1 = ".customer_mobile_err_msg";
            var cl2 = ".customer_mobile_err_msg_contnr";
            $(cl1).text("The Mobile No field is required.!");
            $(cl2).show(200).delay(6000).hide(200,function(){
            });
		} else {
			$('input[name=mobile_no]').css('border', '1px solid #ccc');
		}

		if(error == 0) {
			$.ajax({
				url:baseURL+'Sale/addNewCustomerByAjax',
				method:"GET",
				data: {
					customer_name:customer_name,
					mobile_no:mobile_no,
                    customerEmail:customerEmail,
                    customerAddress:customerAddress
				},
				success:function(data){
					data=JSON.parse(data);
                    var customer_ids=data.customer_id;
                    $.ajax({
			                url:baseURL+'Sale/getCustomerList',
			                method:"GET",
			                data: { },
			                success:function(data){
			                	$("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
			                }
			            });
					$('input[name=customer_name]').val('');
					$('input[name=mobile_no]').val('');
					$('.close').click();

				}
			});
		}

	});

});



/////////////////////////////////////////////////
/////////////////ADDING FIELD
///////////////////////////////////////////////



