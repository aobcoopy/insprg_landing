<?php


 
//echo '------------------------------------------->>>'.$_SERVER['REQUEST_URI'].'<<<-----------------------------------------------------------------------';

$url_path = $_SERVER['REQUEST_URI'];
if($url_path !='/search-rent/thailand/all-beach/all-price/all-bedrooms/party-villas/all-sort.html')
{
	if(isset($_REQUEST['cate']))
	{
		if($_REQUEST['cate']==2 || $_REQUEST['cate']==3)
		{
			echo '<meta name="robots" content="noindex">';
		}//echo $_REQUEST['cate'];
	}
}
else if($url_path =='/search-rent/thailand/all-beach/all-price/all-bedrooms/party-villas/all-sort.html')
{
	if(isset($_REQUEST['cate']))
	{
		if($_REQUEST['cate']==2 || $_REQUEST['cate']==3)
		{
			echo '<meta name="robots" content="noindex">';
		}//echo $_REQUEST['cate'];
	}
}


if(strstr($url_path,"/?page=forrent"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=blogdetail"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=blog"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=faq"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=contact"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=about"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=propertydetail"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/search/forrent"))
{
	echo '<meta name="robots" content="noindex">';
}
elseif(strstr($url_path,"/?page=villas"))
{
	echo '<meta name="robots" content="noindex">';
}







switch($url_path)
{
	case '/search-forrent':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/collections':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/sea-view-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/larger-group-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/wedding-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/party-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/family-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/villa-collections/beach-front-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/?page=forrent&des=2&pri=3&room=2&guest=3':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/?page=forrent&des=1&pri=3&room=2&guest=1':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/?page=forrent&des=2&pri=1&room=2&guest=3':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/forrentt':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/forrent':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/all-beach/all-price/5-7-bedrooms.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/thai-traditional-villas/villa-farrah/kamala-beach-phuket-thailand.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand/all-beach/all-price/all-bedrooms/party-villas/all-sort.html':
		//echo '<meta name="robots" content="noindex">';
	break;
	case '/?page=forrent&des=1&pri=3&room=4&guest=4':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-koh-samui/lamai-beach/all-price/all-bedrooms/seaview-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/surin-beach/all-price/all-bedrooms/beachfront-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/?page=forrent&des=1&pri=2&room=4&guest=2':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/natai-beach/all-price/1-4-bedrooms/all-collections/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/forrentt':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/blog/top-10-phuket-luxury-villas.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search/forrent/1/2/1/null.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-koh-samui/chaweng-beach/all-price/1-4-bedrooms/all-collections/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/bang-tao-beach/all-price/1-4-bedrooms/all-collections/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/all-bedrooms/all-collections/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/all-bedrooms/wedding-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/5-7-bedrooms/all-collections/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/5-7-bedrooms/wedding-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/5-7-bedrooms/seaview-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand-phuket/ao-po-beach/all-price/all-bedrooms/seaview-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	case '/search-rent/thailand/all-beach/all-price/all-bedrooms/seaview-villas/all-sort.html':
		echo '<meta name="robots" content="noindex">';
	break;
	
}








//echo '<pre><br><br><br><br><br><br><br><br<br><br><br><br><br><br><br>';
//for($b=38;$b<=39;$b++)
//{
//	for($c=50;$c<=110;$c++)
//	{
//		if($c==50)
//		{
//			for($d=1;$d<=1;$d++)
//			{
//				for($e=0;$e<=4;$e++)
//				{
//					if($e==0)
//					{	
//						$b_link ="/?page=forrent&des=".$b;
//						$b_link.="&sub=all";
//						$b_link.="&pri=all";
//						$b_link.="&room=all";
//						for($f=0;$f<=10;$f++)
//						{
//							$b_link.="&cate=0";
//							
//							$b_link.="<br>";
//							echo $b_link;
//						}
//					}
//					else
//					{
//						$b_link ="/?page=forrent&des=".$b;
//						$b_link.="&sub=all";
//						$b_link.="&pri=all";
//						$b_link.="&room=".$e;
//						for($f=0;$f<=10;$f++)
//						{
//							$b_link.="&cate=".$f;
//							
//							$b_link.="<br>";
//							echo $b_link;
//						}
//					}
//					
//				}
//			}
//		}
//		else
//		{
//			for($d=2;$d<=3;$d++)
//			{
//				for($e=0;$e<=4;$e++)
//				{
//					$b_link ="/?page=forrent&des=".$b;
//					$b_link.="&sub=".$c;
//					$b_link.="&pri=".$d;
//					if($e==0)
//					{
//						$b_link.="&room=all";
//						for($f=0;$f<=10;$f++)
//						{
//							$b_link.="&cate=".$f;
//							
//							$b_link.="<br>";
//							echo $b_link;
//						}
//					}
//					else
//					{
//						$b_link.="&room=".$e;
//						for($f=0;$f<=10;$f++)
//						{
//							$b_link.="&cate=".$f;
//							
//							$b_link.="<br>";
//							echo $b_link;
//						}
//					}
//				}
//			}
//		}
//	}
//}
//
//echo '</pre>';

//echo '<meta name="robots" content="noindex">';

//$aa=1;
//$s_sql = $dbc->Query("select * from destinations where parent is not null and status > 0");
//while($line = $dbc->Fetch($s_sql))
//{
//	//echo $line['name']."<br>";
//	for($b=1;$b<=3;$b++)
//	{
//		if(check_links($line['parent'],$line['id'],$b,0)==true)
//		{
//			//echo '>>>>>'.$b.'--'.$line['name']."<br>";
//			//echo '<a target="_blank" href="/search-rent/'.destination_f($line['parent']).'/'.beach_f($line['id']).'/all-price/'.bed_f($b).'/all-collections/all-sort.html">'.$line['name'].'</a>'."<br>";
//			echo '(url)<br>';
//				  echo '(loc)https://www.inspiringvillas.com/search-rent/'.destination_f($line['parent']).'/'.beach_f($line['id']).'/all-price/'.bed_f($b).'/all-collections/all-sort.html(/loc)<br>';
//				  echo '(lastmod)2018-03-22T13:03:30+00:00(/lastmod)<br>';
//				  echo '(priority)0.80(/priority)<br>';
//			echo '(/url)';
//			echo '<br>';
//		}
//	}
//	//echo '<br><br>';
//	$aa++;
//}
//echo $aa;

//$aa=1;
//$s_sql = $dbc->Query("select * from properties where status > 0");
//while($line = $dbc->Fetch($s_sql))
//{
//	//echo $line['name']."<br>";
//	//for($b=1;$b<=3;$b++)
//	//{
//		//if(check_links($line['parent'],$line['id'],$b,0)==true)
//		//{
//			//echo '>>>>>'.$b.'--'.$line['name']."<br>";
//			//echo '<a target="_blank" href="/search-rent/'.destination_f($line['parent']).'/'.beach_f($line['id']).'/all-price/'.bed_f($b).'/all-collections/all-sort.html">'.$line['name'].'</a>'."<br>";
//			//echo '---https://www.inspiringvillas.com/'.$line['ht_link'].'.html';
//			echo '(url)<br>';
//				  echo '&nbsp;&nbsp;&nbsp;&nbsp;(loc)https://www.inspiringvillas.com/'.$line['ht_link'].'.html(/loc)<br>';
//				  echo '&nbsp;&nbsp;&nbsp;&nbsp;(lastmod)2018-08-21T13:03:30+00:00(/lastmod)<br>';
//				  echo '&nbsp;&nbsp;&nbsp;&nbsp;(priority)0.8(/priority)<br>';
//				  echo '&nbsp;&nbsp;&nbsp;&nbsp;(changefreq)weekly(/changefreq)<br>';
//			echo '(/url)';
//			echo '<br>';
//		//}
//	//}
//	//echo '<br><br>';
//	$aa++;
//}
//echo $aa;

////function destination_f($option)
////{
////    switch($option)
////    {
////        case "38" :
////            return "thailand-phuket";//"phuket";
////        break;
////        case "39" :
////            return "thailand-koh-samui";//"koh-samui";
////        break;
////        default:
////            return "thailand";
////    }
////}
////function bed_f($option)
////{
////    switch($option)
////    {
////        case "1" :
////            return "1-4-bedrooms";//"1-4";
////        break;
////        case "2" :
////            return "5-7-bedrooms";//"5-7";
////        break;
////        case "3" :
////            return "8-10-bedrooms";//"8-10";
////        break;
////        case "4" :
////            return "over-10-bedrooms";//"11";
////        break;
////        default:
////            return "all-bedrooms";//"all-bed";
////    }
////}
////function beach_f($option)
////{
////    switch($option)
////    {
////        case "54" :
////            return "angthong-beach";
////        break;
////        case "55" :
////            return "ao-po-beach";//"aopo-beach";
////        break;
////        case "56" :
////            return "bang-po-beach";
////        break;
////        case "58" :
////            return "bangrak-beach";
////        break;
////        case "59" :
////            return "bang-tao-beach";//"bangtao-beach";
////        break;
////        case "60" :
////            return "bophut-beach";//"bo-phut-beach";
////        break;
////        case "61" :
////            return "cape-yamu";
////        break;
////        case "62" :
////            return "chaweng-noi-beach";
////        break;
////        case "63" :
////            return "chaweng-beach";
////        break;
////        case "64" :
////            return "choeng-mon-beach";
////        break;
////        case "65" :
////            return "haad-thong-lang-beach";
////        break;
////        case "66" :
////            return "kamala-beach";
////        break;
////        case "67" :
////            return "kata-beach";
////        break;
////        case "68" :
////            return "laem-noi-beach";
////        break;
////        case "69" :
////            return "laem-set-beach";
////        break;
////        case "70" :
////            return "laem-yai-beach";
////        break;
////        case "71" :
////            return "lamai-beach";
////        break;
////        case "72" :
////            return "layan-beach";
////        break;
////        case "73" :
////            return "laem-sor-beach";
////        break;
////        case "74" :
////            return "lipa-noi-beach";
////        break;
////        case "75" :
////            return "maenam-beach";
////        break;
////        case "76" :
////            return "naithon-beach";
////        break;
////        case "77" :
////            return "natai-beach";
////        break;
////        case "78" :
////            return "phuket-town";
////        break;
////        case "79" :
////            return "plai-leam-beach";
////        break;
////        case "80" :
////            return "surin-beach";
////        break;
////        case "81" :
////            return "taling-ngam-beach";
////        break;
////        case "83" :
////            return "cape-panwa-beach";
////        break;
////        case "84" :
////            return "ao-yon-bay";
////        break;
////        case "85" :
////            return "patong";
////        break;
////        case "86" :
////            return "ao-makham-bay";
////        break;
////        case "87" :
////            return "kalim-beach";
////        break;
////        case "88" :
////            return "chalong-bay";
////        break;
////        case "89" :
////            return "rawai-beach";
////        break;
////        case "96" :
////            return "nai-harn";
////        break;
////		case "97" :
////            return "nathon-beach";
////        break;
////        default:
////            return "all-beach";
////    }
////}
////function check_links($c_des,$c_beach,$c_room,$c_collection)
////{
////	global $dbc;
////	//echo '----------'.$c_des.'---'.$c_beach.'---'.$c_room.'---'.$c_collection."<br>";
////	
////	$s_des = '';
////	$s_sub = '';
////	$s_room = '';
////	$s_cate = '';
////	
////	if($c_des==0)
////	{
////		$s_des = "WHERE properties.destination BETWEEN 38 AND 39 ";
////	}
////	else
////	{
////		$s_des = "WHERE properties.destination = ".$c_des;
////	}
////	
////	if($c_beach==0)
////	{
////		$s_sub = "";
////	}
////	else
////	{
////		$s_sub = "AND properties.subdestination = ".$c_beach;
////	}
////	
////	if($c_room==0)
////	{
////		 $s_room = "";
////	}
////	else
////	{
////		$s_room = "AND property_room.room = ".$c_room;
////	}
////	
////	if($c_collection==0)
////	{
////		$s_cate = "";
////	}
////	else
////	{
////		$s_cate = "AND property_cate.caategory = ".$c_collection;
////	}
////	
////////	//echo "SELECT properties.id,properties.`name` AS pname,property_cate.caategory AS cate,property_room.room AS room,properties.destination AS des,properties.subdestination AS sub,properties.`status` AS `status`
//////////		FROM properties
//////////		LEFT JOIN property_cate ON properties.id = property_cate.property
//////////		LEFT JOIN property_room ON properties.id = property_room.property
//////////		".$s_des." ".$s_sub." ".$s_room." ".$s_cate." AND properties.status > 0 <br>";
////			
////	$Qqry = $dbc->Query("SELECT
////			properties.id,
////			properties.`name` AS pname,
////			property_cate.caategory AS cate,
////			property_room.room AS room,
////			properties.destination AS des,
////			properties.subdestination AS sub,
////			properties.`status` AS `status`
////		FROM
////			properties
////		LEFT JOIN property_cate ON properties.id = property_cate.property
////		LEFT JOIN property_room ON properties.id = property_room.property
////		".$s_des." ".$s_sub." ".$s_room." ".$s_cate." AND properties.status > 0");	
////	
////	$numss = $dbc->Getnum($Qqry);
//////	//echo  ">>--".$numss."--<<<br>";
////	if($numss>0)
////	{
////		return true;
////	}
////	else
////	{
////		return false;
////	}
////}
////?>