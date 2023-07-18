<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);
	
	$id = $_REQUEST['id'];
	$room = $dbc->GetRecord("properties","*","id='".$id."'");
	
	function expdate($startdate,$datenum)
	{
		$startdatec = strtotime($startdate); // ทำให้ข้อความเป็นวินาที
		$tod = $datenum * 86400; // รับจำนวนวันมาคูณกับวินาทีต่อวัน
		$ndate = $startdatec + $tod; // นับบวกไปอีกตามจำนวนวันที่รับมา
		return $ndate; // ส่งค่ากลับ
	}

?>
<?php $day = date("Y-m-d");?>
<?php $dayNext = expdate($day,'1');?>
<style>
.iip
{
	width:100% !important;
	background:#eee !important;
	padding::5px !important;
}
.input-min-width-95p {
	min-width:95%;
	border-radius: 1px;
    margin-bottom: 0px;
    border-color: #fff;
    padding: 8px 12px;
    height: auto;
    box-shadow: none;
    color: #4b565b;
	background:#EEEEEE;
	-webkit-appearance: none;
  -moz-appearance: none;
}
@media screen and (max-width:992px)
{
	#dpd1,#dpd2
	{
		padding:11px 10px 11px 10px;
		color: #9c9c9c;
		width:100% !important;
		/*background:none;*/
		border:1px solid #ced4d7 !important;
		-webkit-appearance:none; /* remove the strong OSX influence from Webkit */
	}
}
.mb5 {
    margin-bottom: 5px !important;
}

</style>
<div id="enbox_main"  class="enbox_2">
    <h2 class="mg-sec-left-titles enti_2"><center><strong>Enquire Now</strong></center></h2><br>
    <div class="vi_name  text-center"><?php echo $_REQUEST['name'];?></div>
    <form id="form_contact_website" class="clearfix">
        <input type="hidden" name="txtID" value="<?php echo $room['id'];?>">
        
                
        <div class=" col-md-6 col-sm-6 col-xs-6 nopad " style="padding-right:2px;">
            <label for="full-name"><!--Check In--></label>
            <input type="text" class="form-control ip iip input-min-width-95p mb5" id="dpd1" name="checkin" placeholder="Check In*" >
            <button type="button" class="butides calenin_1" ><i class="fa fa-calendar" aria-hidden="true"></i></button>
        </div>
        <div class=" col-md-6 col-sm-6 col-xs-6 nopad " style="padding-left:2px;"><!-- -->
            <label for="full-name"><!--Check Out--></label>
            <input type="text" class="form-control ip required mb5" id="dpd2" name="checkout" placeholder="Check Out*" >
            <button  type="button" class="butides calenout_1"><i class="fa fa-calendar" aria-hidden="true"></i></button>
        </div>
        
        <div class=" col-md-6 col-sm-6 col-xs-6 nopad " style="padding-right:2px;"> 
            <!--<label for="full-name">Full Name</label>-->
            <input type="text" class="form-control ip mb5" name="cbbGuest" id="cbbGuest_new" placeholder="No. Adults*">
        </div>
        <div class="  col-md-6 col-sm-6 col-xs-6 nopad " style="padding-left:2px;"><!--col-md-6 nopad-->
            <!--<label for="full-name">Full Name</label>-->
            <input type="text" class="form-control ip mb5" name="cbbChildren" id="cbbChildren" placeholder="No. Children (3-12 yrs)">
        </div>
        <?php
		if($_REQUEST['pages']=='forrent')
		{
			$style = 'style="margin-bottom:0px !important;"';
		}
		else
		{
			$style = 'style="margin-bottom:0px !important;"';	
		}
		?>
        <div class="mg-contact-form-input col-md-12 col-sm-12 col-xs-12 nopad" <?php echo $style;?>>
            <!--<div class="ipsc22">-->	
            <!--<label for="full-name">Full Name</label>-->
            <select class="form-control ips mb5" id="no_bed_new" name="no_bed"  placeholder="No. Bedroom*">
                <option value="0">No. Bedroom*</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="10+">10+</option>
            </select>
            <!--</div>-->
        </div>
        <div class="mg-contact-form-input mb5">
            <!--<label for="full-name">Full Name</label>-->
            <input type="text" class="form-control ip mb5" id="full_name_new" name="full_name" placeholder="Full Name*">
        </div>
        <div class="mg-contact-form-input mb5">
            <!--<label for="email">E-mail</label>-->
            <input type="text" class="form-control ip mb5" id="txemail_new" name="txemail" onBlur="lower_text_2(this)"  placeholder="E-mail*">
        </div>
        <div class="mg-contact-form-input mb5">
            <!--<label for="subject">Phone</label>-->
            <input type="text" class="form-control ip mb5" id="txsubject" name="txsubject" placeholder="Phone Number (optional)">
        </div>
        <div class="mg-contact-form-input mb5">
            <!--<label for="subject">Message</label>-->
            <textarea class="form-control ip mb5" id="txmessage" name="txmessage" rows="3" placeholder="Message (optional)"></textarea>
        </div>
        <!-- <a onClick="goog_report_conversion('<?php echo $link;?>')"  >     ,goog_report_conversion('<?php echo $link;?>')-->
        <button type="button" onClick="prop_contact_new()" class="btn btn-dark-main baa " style="font-family:pr;background: #f05b46;padding: 9px;" >SEND</button>
        <!--</a>-->
       <!-- <input type="button" onClick="prop_contact()" class="btn btn-dark-main " style="font-family:pr;" value="Send">-->
    </form>
    <span class="textalert"></span>
    <div class="footbox"></div>
</div>
   <!--<table class="table">
        <thead>
          <tr>
            <th>Check in: <input type="text" class="span2" value="" id="dpd1"></th>
            <th>Check out: <input type="text" class="span2" value="" id="dpd2"></th>
          </tr>
        </thead>
      </table>   -->      


<script>
$(document).ready(function(e) {
	
	//setTimeout(function(){
//		$("#dpd1").focus();	
//	},1000);
//	setTimeout(function(){
//		$("#dpd2").focus();	
//		$("#dpd1").focus();	
//		alert(1);
//	},1100);
	
	$(window).resize(function(){
        if($(window).width()<976)
		{
			$("#dpd1,#dpd2").attr('type','date');
		}
		else
		{
			$("#dpd1,#dpd2").attr('type','text');
		}
    });
	
	if($(window).width()<976)
	{
		$("#dpd1,#dpd2").attr('type','date');
		$("#dpd1").val('<?php echo $day;?>');
		$("#dpd2").val('<?php echo date("Y-m-d",$dayNext);?>');
	}
	else
	{
		$("#dpd1,#dpd2").attr('type','text');
		
		 var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		 
		var checkin = $('#dpd1').datepicker({
		  onRender: function(date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate() + 1);
			checkout.setValue(newDate);
		  }
		  checkin.hide();
		  $('#dpd2')[0].focus();
		}).data('datepicker');
		var checkout = $('#dpd2').datepicker({
		  onRender: function(date) {
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  checkout.hide();
		}).data('datepicker');
		
		
		
		$(".calenin_1").click(function(e) {
				$('#dpd1').focus();
			});
			
			$(".calenout_1").click(function(e) {
				$('#dpd2').focus();
			});
		
			}	
			
	
	
	
  
// var nowTemp = new Date();
//	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
//	 
//	var checkin = $('#checkin_1').datepicker({
//	  onRender: function(date) {
//		return date.valueOf() < now.valueOf() ? 'disabled' : '';
//	  }
//	}).on('changeDate', function(ev) {
//	  if (ev.date.valueOf() > checkout.date.valueOf()) {
//		var newDate = new Date(ev.date)
//		newDate.setDate(newDate.getDate() + 1);
//		checkout.setValue(newDate);
//	  }
//	  checkin.hide();
//	  $('#checkout_1')[0].focus();
//	}).data('datepicker');
//	var checkout = $('#checkout_1').datepicker({
//	  onRender: function(date) {
//		return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
//	  }
//	}).on('changeDate', function(ev) {
//	  checkout.hide();
//	}).data('datepicker');
//	
//	$(".calenin_1").click(function(e) {
//        $('#checkin_1').focus();
//    });
//	
//	$(".calenout_1").click(function(e) {
//        $('#checkout_1').focus();
//    });
	
	//$(".cin").click(function(e) {
//        $('#checkin_mo').focus();
//    });
//	
//	$(".cout").click(function(e) {
//        $('#checkout_mo').focus();
//    });


});

function lower_text_2(str)
{
	var text = $(str).val();
	var res = text.toLowerCase();
	$(str).val(res);
}
function prop_contact_new()
{
	if($("#full_name_new").val()=='')
	{
		//alert("* Please fill your data");
		$(".textalert").text("* Please fill your data");
		$("#full_name_new").focus();
		$("#full_name_new").css({"border-color":"red"});
		return false;
	}
	else if($("#txemail_new").val()=='')
	{
		$(".textalert").text("* Please fill your data");//alert("* Please fill your data");
		$("#txemail_new").focus();
		$("#txemail_new").css({"border-color":"red"});
		return false;
	}
	else if($("#no_bed_new").val()=='0')
	{
		$(".textalert").text("* Please fill your data");//alert("* Please fill your data");
		$("#no_bed_new").focus();
		$("#no_bed_new").css({"border-color":"red"});
		return false;
	}
	else if($("#cbbGuest_new").val()=='')
	{
		$(".textalert").text("* Please fill your data");//alert("* Please fill your data");
		$("#cbbGuest_new").focus();
		$("#cbbGuest_new").css({"border-color":"red"});
		return false;
	}
	else if($("#dpd1").val()=='')
	{
		$(".textalert").text("* Please fill your data");//alert("* Please fill your data");
		$("#dpd1").focus();
		$("#dpd1").css({"border-color":"red"});
		return false;
	}
	else if($("#dpd2").val()=='')
	{
		$(".textalert").text("* Please fill your data");//alert("* Please fill your data");
		$("#dpd2").focus();
		$("#dpd2").css({"border-color":"red"});
		return false;
	}
	else
	{
		var Email=/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/
		if(!document.getElementById("txemail_new").value.match(Email))
		{
		   $(".textalert").text("* Email format is not valid");//alert('Email format is not valid');
		   document.getElementById("txemail_new").focus();
		   return false;
		}
		else
		{
			$.ajax({
				url:"/libs/actions/action-property-contact.php",
				type:"POST",
				dataType:"json"	,
				data:$("#form_contact_website").serialize(),
				success: function(res){
					
					if(res.status==true)
					{
									$(".ip").val('');
									window.location = "/thanks/<?php echo $room['destination'];?>.html";//"<?php //echo $url_link;?>thanks/<?php //echo $room['destination'];?>.html";
									$(".textalert").text("Successful");
									$(".textalert").css({"color":"green"});
					}
					else
					{
						alert(res.msg);
						return false;
					}
				}
			});
		}
	}
}

</script>









