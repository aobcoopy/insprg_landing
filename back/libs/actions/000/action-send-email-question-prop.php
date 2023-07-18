<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
    include_once "../../inc/sendmail.inc.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);
	
	$fullname = $_REQUEST['q_full_name'];
	$email = $_REQUEST['q_txemail_p'];
	$phone = $_REQUEST['countryCode_ques'].'-'.$_REQUEST['q_phone'];
	$message = $_REQUEST['q_txmessage'];
	$villa_name = $_REQUEST['q_tx_name'];
	$strTo = $_REQUEST['q_txemail_p'];//.",aobcoopy@gmail.com";
	//$link = '<a href="https://www.inspiringvillas.com/?page=propertydetail&id='.$_REQUEST['tx_id'].'"><button>View Detail</button></a>';
	
	
	$data = array(
		'#id' => 'DEFAULT',
		'#type' => '1',
		'#property' => $_REQUEST['q_tx_id'],
		'name' => $_REQUEST['q_full_name'],
		'email' => $_REQUEST['q_txemail_p'],
		'phone' => $_REQUEST['countryCode_ques'].'-'.$_REQUEST['q_phone'],
		'message' => $_REQUEST['q_txmessage'],
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		'#status' => '0'
	);
	
	
	if($dbc->Insert("contact_us",$data))
	{
		$prop = $dbc->GetRecord("properties,destinations","properties.id,properties.name AS pname,destinations.name AS dname","destinations.id = properties.destination AND properties.id='".$_REQUEST['q_tx_id']."'");
		//echo ">>>>".$prop['pname'].">>>>".$prop['dname'];
		$vname = explode("|",$prop['pname']);
		
		
		$villa_name_1 = $vname[0].', '.$prop['dname'];
		$posiotion_text = strrpos($vname[0]," ");
		$complete_text = substr_replace($vname[0],",",$posiotion_text);
		$vil_name = $complete_text." ".$prop['dname'];//.' '.$des['name'];
		
		
		
		$strTo = $strTo;//.",aobcoopy@gmail.com";
		$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
		$strHeader.= "From: rsvn@inspiringvillas.com";
		$strSubject = "Enquiry ".$vil_name."";//"Thank you for a Question ";
		
		$strMessage = "<style type='text/css'>
		
		body{
            width: 100%; 
            background-color: #FFFFFF; 
            margin:0; 
            padding:0; 
            -webkit-font-smoothing: antialiased;
			-webkit-text-size-adjust:none;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
            mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,h1,h2,h3,h4{
	        margin-top:0;
			margin-bottom:0;
			padding-top:0;
			padding-bottom:0;
        }
        
        
        html{
            width: 100%; 
        }
		
		a:link, span.MsoHyperlink {
			mso-style-priority:99;
			color:blue;
			text-decoration:underline;
		}
		
        /* iOS BLUE LINKS */
		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}
		.fix {
		 display:none;
		 display:none!important;
		}
		
		
	</style>
	
	<div style='padding:0px; background:#fff; border:0px solid #CDCDCD;width:600px;margin:auto;'>
			<img src='https://www.inspiringvillas.com/upload/email/p1.png' width='100%'>
			<center>
				<h2>Thank you for your request</h2>
			</center>
			<div class='detail' style='font-size: 15px;padding:0px 10px;'><br>
				We have already placed your request with the Villa Owner and will get back to you very soon.
				A villa specialist will contact you shortly to help you plan your stay.<br><br>
				
				<strong>Why choose Inspiring Villas?</strong><br><br>
				
				-Experienced Villa Specialists providing a complete concierge service<br>
				-Best Price Guaranteed Always with no booking fees & no hidden charges<br>
				-<strong>$150 credit on any excursion you book with us for your villa stay</strong>
				<br><br><br>
				
                <div class='l' style='width: 50%;float: left;height: 90px;'>
                    <strong>Best Regards</strong>,<br><br> 
                    
                    Inspiring Villas Team 
                </div>
        
                <div class='r' style=' width: 50%;float: right;height: 90px;'>
                    <img src='https://www.inspiringvillas.com/upload/PATA-Member-Logo-H.jpg' style='width: 110px;    margin-left: 180px; '>
                </div>
				
				
			</div>
		   <a href='https://www.inspiringvillas.com/search-rent/thailand/all-beach/all-price/all-bedrooms/all-collections/all-sort.html' style='cursor:pointer'>
		   <button class='fine' style='background: #112845; width: 100%;color: #fff;border: none;padding: 10px;margin-bottom:15px;cursor:pointer;'>FIND MORE THAILAND VILLAS</button>
		   </a>
		   
		   <a href='https://www.inspiringvillas.com/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/all-collections/all-sort.html' target='_blank'>
		   <img src='https://www.inspiringvillas.com/upload/email/p21.png' width='100%' style='margin-bottom:15px;'>
		   </a>
		   
   			<a href='https://www.inspiringvillas.com//search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/all-collections/all-sort.html' target='_blank'>
			<img src='https://www.inspiringvillas.com/upload/email/p31.png' width='100%' style='margin-bottom:15px;'>
			</a>
			
			
			
			<button class='fine' style='background: #112845; width: 100%;color: #fff;border: none;padding: 10px;margin-bottom:15px;cursor:pointer;'>
				<div type='button' style='border-top: 1px solid #ffffff;border-bottom: 1px solid #ffffff;padding: 15px;font-size: 18px;'>OUR VILLA COLLECTIONS</div>
			</button>
			
			<a href='https://www.inspiringvillas.com/luxury-villas/talay-nai-harn-villa/nai-harn-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/01.png' width='100%' style='margin-bottom:15px;'>
			</a>
			
			<a href='https://www.inspiringvillas.com/luxury-villas/villa-viva-panwa/cape-panwa-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/02.png' width='100%' style='margin-bottom:15px;'>
			</a>
			
			<a href='https://www.inspiringvillas.com/luxury-villas/villa-thousand-cliffs/nai-harn-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/03.png' width='100%' style='margin-bottom:15px;'>
			</a>
			
			<a href='https://www.inspiringvillas.com/luxury-villas/villa-thousand-hills/nai-harn-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/05.png' width='100%' style='margin-bottom:15px;'>
			</a>
            
            <a href='https://www.inspiringvillas.com/luxury-villas/villa-yang/kamala-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/06.png' width='100%' style='margin-bottom:15px;'>
			</a>
            
            <a href='https://www.inspiringvillas.com/luxury-villas/villa-makata/kata-beach-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/07.png' width='100%' style='margin-bottom:15px;'>
			</a>

            <a href='https://www.inspiringvillas.com/luxury-villas/villa-chan-grajang/surin-phuket-thailand.html' target='_blank'>
				<img src='https://www.inspiringvillas.com/upload/email/10.png' width='100%' style='margin-bottom:15px;'>
			</a>
			
		   <div class='foot' style='background: #3a3a3a; padding: 20px; color:#fff;font-size: 14px;'>
				<center>
					<a href='' style='padding: 10px;'><img src='https://www.inspiringvillas.com/upload/email/facebook_icon.png'></a>
					<a href='' style='padding: 10px;'><img src='https://www.inspiringvillas.com/upload/email/twitter_icon.png'></a>
					<a href='' style='padding: 10px;'><img src='https://www.inspiringvillas.com/upload/email/instagram_icon.png'></a>
					<a href='' style='padding: 10px;'><img src='https://www.inspiringvillas.com/upload/email/hyperlink_icon.png'></a>
					<a href='' style='padding: 10px;'><img src='https://www.inspiringvillas.com/upload/email/skype_icon.png'></a>
					<hr style='margin-top:15px;'>
					<div style='margin-top:15px;padding:10px 0px 15px 0px;'>
						<strong>Contact Us</strong><br><br>
						Skype <a href='skype:Inspiringvillas?call' target='_blank' style=' color:#fff;'>inspiringvillas</a><br>
						Samui <a href='tel:+66836556452' style=' color:#fff;'>+66 83 655 6452</a><br>
						Phuket <a href='tel:+66846771551' style=' color:#fff;'>+66 84 677 1551</a><br>
						Thailand <a href='tel:+6676626762' style=' color:#fff;'>+66 (0)76 626 762</a><br>
						Hong Kong <a href='tel:+85281986765' style=' color:#fff;'>+852 8198 6765</a><br>
						Website: <a href='https://www.inspiringvillas.com/' style=' color:#fff;'>www.inspiringvillas.com</a>
						
					</div>
					<hr>
					<div style='margin-top:15px;'><em>Copyright &copy; 2018 InspiringVillas, All rights reserved</em></div>
				</center>
		   </div>
		</div>";
		
			


		//mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
		newSendMail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
		
		
		
		
		$strTo_2 = "rsvn@inspiringvillas.com";
		//$strTo_2 = "aobcoopy@gmail.com";
		$strHeader_2 = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
		$strHeader_2.= "From: rsvn@inspiringvillas.com";
		$strSubject_2 = "Question from ".$fullname;
		
		//$strHeader .= "From: info@inspiringvillas.com";
		//$strSubject = "Thank you from inspiringvillas" ;
		
		$strMessage_2 = "<div style=\"padding:0px; background:#f5f6f5; border:1px solid #CDCDCD;width:600px;padding:10px;\">
				<div style=\" height: 82px; width: 100%;\">
					<div style=\"width:100%;padding: 0px 30px; \"><br>
                        <img src=\"http://inspiringvillas.com/libs/actions/logo.png\" width=\"80\">
                    </div>
				</div>
				<div style=\"width:100%;border-top:0px solid #CCC;margin-top: 45px;\">
					<div style=\"color: #000000;font-size:16px;\">
						<div class=\"\" style=\"border-bottom:0px solid #999;font-family: sans-serif;padding: 0px 30px;\">
                        	<h2>Question from ".$fullname." </h2>";
							$strMessage_2.= "Name: ".$fullname."<br>";
							$strMessage_2.= "Email: ".$email."<br>";
							$strMessage_2.= "Phone: ".$phone."<br>";
							$strMessage_2.= "Property Name: <span style=\"color:#f05542;\">".$villa_name."</span><br>";
                            $strMessage_2.= "Message:".$message;
                            $strMessage_2.= "<br><br>
                            Best Regards,<br>
                            Inspiring Villas Team
						</div>
					</div>
				</div>
                <div style=\"padding: 0px 30px;margin-top: 45px;\">
                    <div style=\"background: none;margin-top:25px;padding: 10px; !importantfont-size:11px;border-top: 1px solid #999;\">
                        <div style=\"font-size: 14px;font-family: sans-serif;color: #292929;\">
                        E:rsvn@inspiringvillas.com &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href=\"http://www.inspiringvillas.com\" target=\"_blank\" style=\"color: #292929; text-decoration:none;\">www.inspiringvillas.com</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href=\"tel:+66846771551\" style=\"color: #292929; text-decoration:none;\">T:+66 84 677 1551</a>
                        </div>
                    </div>
                </div>
			</div>";
			
		//mail($strTo_2,$strSubject_2,$strMessage_2,$strHeader_2);  // @ = No Show Error //
		newSendMail($strTo_2,$strSubject_2,$strMessage_2,$strHeader_2);  // @ = No Show Error //
		
		echo json_encode(
			array(
				'status' => true,
				'msg' => 'Successful'
			)
		);	
	}
	else
	{
		echo json_encode(
			array(
				'status' => false,
				'msg' => 'Please try again'
			)
		);
	}
?>