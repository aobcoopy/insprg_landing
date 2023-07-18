// JavaScript Document
var customers = {
	add:function()
	{
		if($("#tx_customersname").val()=='')
		{
			fn.check_tx_empty("#tx_customersname","Please fill your data");
		}
		else if($("#tx_Password").val()=='')
		{
			fn.check_tx_empty("#tx_Password","Please fill your data");
		}
		else if($("#tx_Firstname").val()=='')
		{
			fn.check_tx_empty("#tx_Firstname","Please fill your data");
		}
		else if($("#tx_Lastname").val()=='')
		{
			fn.check_tx_empty("#tx_Lastname","Please fill your data");
		}
		else if($("#tx_Mobile").val()=='')
		{
			fn.check_tx_empty("#tx_Mobile","Please fill your data");
		}
		else if($("#tx_Email").val()=='')
		{
			fn.check_tx_empty("#tx_Email","Please fill your data");
		}
		else
		{
			$.ajax({
				url:"apps/customers/xhr/add_customers.php",
				type:"POST",
				dataType:"json",
				data:$("#form_customers").serialize(),
				success: function(res){
					if(res.success==true)
					{
						$("#add_customers").modal('hide');
						$(".table").DataTable().draw();
						$(".form-control").val('');
					}
					else
					{
						alert(res.msg);
						return false;
					}
				}
			});
		}
	},
	change:function(id)
	{
		$.ajax({
			url: "apps/customers/view/page_edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	},
	save_change:function()
	{
		if($("#tx_E_Firstname").val()=='')
		{
			fn.check_tx_empty("#tx_E_Firstname","Please fill your data");
		}
		else if($("#tx_E_Lastname").val()=='')
		{
			fn.check_tx_empty("#tx_E_Lastname","Please fill your data");
		}
		else if($("#tx_E_Mobile").val()=='')
		{
			fn.check_tx_empty("#tx_E_Mobile","Please fill your data");
		}
		else if($("#tx_E_Email").val()=='')
		{
			fn.check_tx_empty("#tx_E_Email","Please fill your data");
		}
		else
		{
			$.ajax({
				url: "apps/customers/xhr/edit_customers.php",
				data: $("#form_edit_customers").serialize(),
				type: "POST",
				dataType: "json",
				success: function(html){
					if(html.success==true)
					{
						$("#dialog_edit_customers").modal('hide');
						$(".table").DataTable().draw();
					}
					else
					{
						fn.check_tx_empty("#tx_E_customersname",html.msg);
						return false;
					}
				}	
			});
		}
	}
};


$.extend(fn,{customers:customers});


