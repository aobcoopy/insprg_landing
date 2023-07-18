// JavaScript Document
var user = {
	add:function()
	{
		if($("#tx_Username").val()=='')
		{
			fn.check_tx_empty("#tx_Username","Please fill your data");
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
				url:"apps/user/xhr/add_user.php",
				type:"POST",
				dataType:"json",
				data:$("#form_user").serialize(),
				success: function(res){
					if(res.success==true)
					{
						$("#add_user").modal('hide');
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
			url: "apps/user/view/page_edit.php",
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
				url: "apps/user/xhr/edit_user.php",
				data: $("#form_edit_user").serialize(),
				type: "POST",
				dataType: "json",
				success: function(html){
					if(html.success==true)
					{
						$("#dialog_edit_user").modal('hide');
						$(".table").DataTable().draw();
					}
					else
					{
						fn.check_tx_empty("#tx_E_Username",html.msg);
						return false;
					}
				}	
			});
		}
	}
};


$.extend(fn,{user:user});


