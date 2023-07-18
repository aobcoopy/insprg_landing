var fn={
	check_tx_empty : function(txt,msg){
		alert(msg);
		$(txt).focus();
		return false;
	},
	login:function(){
		if($("#tx_Username").val()=='')
		{
			fn.check_tx_empty("#tx_Username","Please fill your data");
		}
		else if($("#tx_Password").val()=='')
		{
			fn.check_tx_empty("#tx_Password","Please fill your data");
		}
		else
		{
			$.ajax({
				url:"libs/actions/check_login.php",
				type:"POST",
				dataType:"json",
				data:$("#login").serialize(),
				success: function(res){
					if(res)
					{
						window.location.reload();
					}
					else
					{
						$(".alert-danger").show();
					}
				}
			});
		}
	},
	logout:function(){
		$.ajax({
				url:"libs/actions/check_logout.php",
				type:"POST",
				dataType:"json",
				data:$("#login").serialize(),
				success: function(res){
					if(res)
					{
						window.location.reload();
					}
					else
					{
						
					}
				}
			});
	},
	engine : {
		datatable : {
			button : function(class_color,class_icon,func,title='',name=''){
				var s = '';
				s += '<button class="btn '+class_color+' btn-rounded btn-condensed btn-sm" title="'+title+'" onclick="'+func+'">';
				s += '<span class="fa '+class_icon+'"></span>';
				s += name;
				s += '</button>';
				return s;
			},
			checkbox : function(chk_group,val,selected){
				var s = '';
				s += '<label class="label-checkbox">';
					s += '<input type="checkbox" name="'+chk_group+'" value="'+val+'"'+(selected?' checked':'')+'>';
					s += '<span class="custom-checkbox"></span>';
				s += '</label>';
				return s;
			},
			add_selectable : function(tblName,chkName){
				
				$("#"+tblName+" tbody").on('click', 'td:not(:last-child)', function () {
					var me = $(this).parent();
					var id = me[0].id;
					var index = $.inArray(id, $("#"+tblName+"").data("selected"));
					
					if ( index === -1 ) {
						$("#"+tblName+"").data( "selected").push( id );
						$(me).find('input[name='+chkName+']').prop('checked', true);
						$(me).addClass('table-primary');
					} else {
						$("#"+tblName+"").data( "selected").splice( index, 1 );
						$(me).find('input[name='+chkName+']').prop('checked', false);
						$(me).removeClass('table-primary');
					}
			 
					$(me).toggleClass('selected');
				} );
				
				
				$('#'+chkName+'').click(function(){

					var AllChecked = true;
					$('input[name='+chkName+']').each(function(){
						if(!$(this).is(':checked')){
							AllChecked = false;
						}
					});
					
					if(AllChecked){
						$('input[name='+chkName+']').prop('checked', false).parent().parent().removeClass('selected');
						$('input[name='+chkName+']').each(function(){
							var tr = $(this).parent().parent().parent();
							var id = tr[0].id;
							var index = $.inArray(id, $("#"+tblName+"").data( "selected"));
							if ( index != -1 ) {
							   $("#"+tblName+"").data( "selected").splice( index, 1 );
								tr.removeClass("selected");
							}
						});
					}else{
						$('input[name='+chkName+']').prop('checked', true).parent().parent().addClass('selected table-primary');
						$('input[name='+chkName+']').each(function(){
							var tr = $(this).parent().parent().parent();
							var id = tr[0].id;
							var index = $.inArray(id, $("#"+tblName+"").data( "selected"));
							if ( index === -1 ) {
								$("#"+tblName+"").data( "selected").push( id );
								tr.addClass("selected table-primary");
							}
						});
					}
					
				});
			}
		}
	},
};