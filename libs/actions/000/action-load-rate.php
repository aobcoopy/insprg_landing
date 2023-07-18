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
	
	$sql = $dbc->Query("select * from rating where property = '".$_REQUEST['id']."'");
	$count = $dbc->GetCount("rating","property = '".$_REQUEST['id']."'");
	if($count<='0')
	{
		?><center><font size="+2" color="#FF0004"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></font><br>Not Found</center><?php
	}
	else
	{
		while($rate = $dbc->Fetch($sql))
		{
			////$re_name = explode("-",$rate['name']);
////			$re_month = explode(" ",$re_name[1]);
////			$re_date = explode(" ",$re_name[1]);
////			$re_year = explode(" ",$re_name[1]);
////			$dash = ($re_year[1]!='')?'-':'';
//			echo '<div class="col-md-12" style="padding: 10px;border-bottom: 1px solid #dadada;">';
//			echo '<div class="col-md-1"><i class="fa fa-quote-left" aria-hidden="true" style="color: #f05b46;"></i> </div>';
//				//echo '&nbsp;&nbsp;&nbsp;';
//				echo '<div class="col-md-10">'.base64_decode($rate['text'],true);
//				echo '<br>';
//				/*for($a=0;$a<$rate['rate'];$a++)
//				{
//					echo '<i class="fa fa-star" aria-hidden="true" style="color: #f05b46;"></i>';
//				}*/
//				//echo '&nbsp;&nbsp; <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">'.$re_name[0].'</span></span> '.$dash.' '.$re_year[1].' '.$re_year[2].' '.$re_year[3];
//				//echo '<span class="rname">1'.$rate['name'].'&nbsp;--('.dateType2($rate['created']).')--</span>';
////				echo '<br>';
//				echo '<span class="rname">'.$rate['name'].'</span>';
//				//echo '<br>';
////				echo '<span class="rname">3'.$re_name[0].'&nbsp;'.$dash.' '.$re_year[1].' '.$re_year[2].' '.$re_year[3].'</span>';
//				
//				echo '</div>';
//			echo '<div class="col-md-1"><i class="fa fa-quote-right" aria-hidden="true" style="color: #f05b46;"></i></div>';
//			echo '<hr>';
//			echo '</div>';
			
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
	}
	
	
	function dateType2($data)
	{
		$y = substr($data,0,4);
		$m = substr($data,5,2);
		$d = substr($data,8,2);
		switch($m)
		{
			case'01':  $month = 'Jan';break;
			case'02':  $month = 'Feb';break;
			case'03':  $month = 'Mar';break;
			case'04':  $month = 'Apr';break;
			case'05':  $month = 'May';break;
			case'06':  $month = 'Jun';break;
			case'07':  $month = 'Jul';break;
			case'08':  $month = 'Aug';break;
			case'09':  $month = 'Sep';break;
			case'10':  $month = 'Oct';break;
			case'11':  $month = 'Nov';break;
			case'12':  $month = 'Dec';break;
		}
		return  $month .'  '.$y;
	}
?>
