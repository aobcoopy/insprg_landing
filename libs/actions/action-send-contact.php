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

	$data = array(
		'#id' => 'DEFAULT',
		'#type' => '1',
		'name' => $_REQUEST['full-name'],
		'email' => $_REQUEST['email'],
		'subject' => $_REQUEST['countryCode'].'-'.$_REQUEST['subject'],
		'message' => base64_encode($_REQUEST['message']),
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		'#status' => '0',
		//'checkin' => $_REQUEST['checkin'],
		//'checkout' => $_REQUEST['checkout'],
	);
	
	if($dbc->Insert("contact_us",$data))
	{
		$to = $_REQUEST['email'];
		$strTo = $to;//.",aobcoopy@gmail.com";
		$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
		$strHeader .= "From: rsvn@inspiringvillas.com";
		$strSubject = "Thank You from Inspiring Villas" ;
		
		$strMessage = "
		
		<style type='text/css'>
		
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
			
			



		//$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
		$flgSend = newSendMail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
		
		if($flgSend)
		{

			$strTo_2 = "rsvn@inspiringvillas.com";
			//$strTo_2 = "aobcoopy@gmail.com";
			$strHeader_2 = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
			$strHeader_2 .= "From: rsvn@inspiringvillas.com";
			$strSubject_2 = "Thank You from Inspiring Villas" ;
			$strMessage_2 = "<div style=\"padding:0px; background:#fff; border:1px solid #CDCDCD;width:600px;padding:10px;\">
				<div style=\" height: 82px; width: 100%;\">
					<div style=\"width:100%; \">
                        <center>
                            <img src=\"http://inspiringvillas.com/libs/actions/logo.png\" width=\"80\"/>
                        </center>
                    </div>
				</div>
				<div style=\" width:100%; border-top:0px solid #CCC;margin-top:25px;\">
					<div style=\"color:#999999;font-size:16px;\">
						<div class=\"\" style=\"border-bottom:0px solid #999;font-family: sans-serif;padding: 0px 30px;\">
							Thank you for contacting us. We have received your enquiry, our team will get back to you as soon as we can.<br><br>";
							$strMessage_2.= "Name : ".$_REQUEST['full-name']."<br>";
							$strMessage_2.= "Email : ".$_REQUEST['email']."<br>";
							$strMessage_2.= "Phone : ".$_REQUEST['countryCode'].'-'.$_REQUEST['subject']."<br>";
							//$strMessage_2.= "Property Name: <span style=\"color:#f05542;\">".$prop['name']."</span><br>";
                            //$strMessage_2.= "Check In: <span style=\"color:#f05542;\">".$in."</span><br>";
                            //$strMessage_2.= "Check Out: <span style=\"color:#f05542;\">".$out."</span><br>";
                           // $strMessage_2.= "No. Adults: ".$_REQUEST['cbbGuest']."<br>";
							//$strMessage_2.= "No. Children: ".$_REQUEST['cbbChildren']."<br>";
                            $strMessage_2.= "Note :".$_REQUEST['message']."
						</div>
					</div>
				</div>
				<div style=\" background: #0c2647;margin-top:25px;padding:20px;color: #ffffff !important;font-size:11px;\">
                    <div style=\"font-size: 14px;font-family: sans-serif;color: #ffffff;\">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E:rsvn@inspiringvillas.com &nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=\"http://www.inspiringvillas.com\" target=\"_blank\" style=\"color: #fff;\">www.inspiringvillas.com</a>&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=\"tel:+66915046665\"  style=\"color: #fff;\">T:+66 84 677 1551</a>
					</div>
				</div>
			</div>";
			
				//mail($strTo_2,$strSubject_2,$strMessage_2,$strHeader_2); 
				newSendMail($strTo_2,$strSubject_2,$strMessage_2,$strHeader_2); 
			
			echo json_encode(
				array(
					'status' => true,
					'msg' => 'Success full'
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
			//echo "Email Can Not Send.";
		}
	
		
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
