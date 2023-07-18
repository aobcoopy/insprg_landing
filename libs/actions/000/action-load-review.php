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
	
	$pid = $_REQUEST['pid'];
	$count = $_REQUEST['count'];
	
	//echo $pid.'----'.$count.'<br><br><br><br><br><br><br><br><br><br><br><br><br>';
	
	$sql_rate = $dbc->Query("select * from rating where property = '".$pid."' limit $count,5");
	while($rate = $dbc->Fetch($sql_rate))
	{
		   echo '<div class="col-md-12 tr_coverbox ">';
				echo '<div class="tr_box">';
					echo '<div class="tr_name">Review by <strong>'.$rate['name'].'</strong></div>';
					echo '<div class="tr_date">'.$dbc->date_type($rate['days']).'</div>';
					if($rate['title']!='')
					{
					echo '<div class="tr_title">';
						//echo '<i class="fa fa-quote-left ffix" aria-hidden="true" style="color: #f05b46;"></i>';
						echo '"'.$rate['title'].'"';
						//echo '<i class="fa fa-quote-right ffix" aria-hidden="true" style="color: #f05b46;"></i>';
					echo '</div>';
					}
					else
					{
						echo '<div class="tr_title"></div>';
					}
					echo '<div class="tr_message">'.base64_decode($rate['text'],true).'</div>';
				   //echo '<div class="tr_star">';
//							for($a=0;$a<$rate['rate'];$a++)
//							{
//								echo '<i class="fa fa-star ffix" aria-hidden="true" style="color: #f05b46;"></i>';
//							}
//				   echo '</div>';
			   echo '</div>';
		   echo '</div>';
	   }
?>
