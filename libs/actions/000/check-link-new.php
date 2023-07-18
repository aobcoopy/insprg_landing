<?php
	$des = $_REQUEST['cbbDestination'];
	$beach = $_REQUEST['cbbSub'];
	$price = $_REQUEST['cbbPrice'];
	$room = $_REQUEST['cbbRoom'];
	
	//$option = $des.'-'.$beach.'-'.$price.'-'.$room;
	
	
/*	function destination($option)
	{
		switch($option)
		{
			case "38" :
				return "thailand-phuket";//"phuket";
			break;
			case "39" :
				return "thailand-koh-samui";//"koh-samui";
			break;
			default:
				return "thailand";
		}
	}
	
	function price($option)
	{
		switch($option)
		{
			case "3" :
				return "over-usd-1000";//"over1000";
			break;
			case "2" :
				return "under-usd-1000";//"under1000";
			break;
			default:
				return "all-price";
		}
	}
	
	function bed($option)
	{
		switch($option)
		{
			case "1-4" :
				return "1-4-bedrooms";//"1-4";
			break;
			case "5-7" :
				return "5-7-bedrooms";//"5-7";
			break;
			case "8-10" :
				return "8-10-bedrooms";//"8-10";
			break;
			case "more" :
				return "over-10-bedrooms";//"11";
			break;
			default:
				return "all-bedrooms";//"all-bed";
		}
	}
	
	function beach($option)
	{
		switch($option)
		{
			case "54" :
				return "angthong-beach";
			break;
			case "55" :
				return "ao-po-beach";//"aopo-beach";
			break;
			case "56" :
				return "bang-po-beach";
			break;
			case "58" :
				return "bangrak-beach";
			break;
			case "59" :
				return "bang-tao-beach";//"bangtao-beach";
			break;
			case "60" :
				return "bophut-beach";//"bo-phut-beach";
			break;
			case "61" :
				return "cape-yamu";
			break;
			case "62" :
				return "chaweng-noi-beach";
			break;
			case "63" :
				return "chaweng-beach";
			break;
			case "64" :
				return "choeng-mon-beach";
			break;
			case "65" :
				return "haad-thong-lang-beach";
			break;
			case "66" :
				return "kamala-beach";
			break;
			case "67" :
				return "kata-beach";
			break;
			case "68" :
				return "laem-noi-beach";
			break;
			case "69" :
				return "laem-set-beach";
			break;
			case "70" :
				return "laem-yai-beach";
			break;
			case "71" :
				return "lamai-beach";
			break;
			case "72" :
				return "layan-beach";
			break;
			case "73" :
				return "laem-sor-beach";
			break;
			case "74" :
				return "lipa-noi-beach";
			break;
			case "75" :
				return "maenam-beach";
			break;
			case "76" :
				return "naithon-beach";
			break;
			case "77" :
				return "natai-beach";
			break;
			case "78" :
				return "phuket-town";
			break;
			case "79" :
				return "plai-leam-beach";
			break;
			case "80" :
				return "surin-beach";
			break;
			case "81" :
				return "taling-ngam-beach";
			break;
			case "83" :
				return "cape-panwa-beach";
			break;
			case "84" :
				return "ao-yon-bay";
			break;
			case "85" :
				return "patong";
			break;
			case "86" :
				return "ao-makham-bay";
			break;
			default:
				return "all-beach";
		}
	}  */
	
	//echo "RewriteRule ^search-rent/".destination($des)."/".beach($beach)."/".price($price)."/".bed($room)."\.html$ /?page=forrent&des=".$des."&sub=".$beach."&pri=".$price."&room=".$room." [L]";
	echo "search-rent/".destination($des)."/".beach($beach)."/".price($price)."/".bed($room);
	
	
	
//	switch($option)
//	{
//		//case"all-all-all-all":
////			echo "search-rent/thailand/all-beach/all-price/all-bed";
////		break;
////		case"all-all-3-all":
////			echo "search-rent/thailand/all-beach/over1000/all-bed";
////		break;
////		case"all-all-2-all":
////			echo "search-rent/thailand/all-beach/under1000/all-bed";
////		break;
////		
////		
////		case"all-all-all-1-4":
////			echo "search-rent/thailand/all-beach/all-price/1-4";
////		break;
////		case"all-all-all-5-7":
////			echo "search-rent/thailand/all-beach/all-price/5-7";
////		break;
////		case"all-all-all-8-10":
////			echo "search-rent/thailand/all-beach/all-price/8-10";
////		break;
////		case"all-all-all-more":
////			echo "search-rent/thailand/all-beach/all-price/11";
////		break;
////		
////		
////		case"all-all-3-1-4":
////			echo "search-rent/thailand/all-beach/over1000/1-4";
////		break;
////		case"all-all-3-5-7":
////			echo "search-rent/thailand/all-beach/over1000/5-7";
////		break;
////		case"all-all-3-8-10":
////			echo "search-rent/thailand/all-beach/over1000/8-10";
////		break;
////		case"all-all-3-more":
////			echo "search-rent/thailand/all-beach/over1000/11";
////		break;
////		
////		
////		case"all-all-2-1-4":
////			echo "search-rent/thailand/all-beach/under1000/1-4";
////		break;
////		case"all-all-2-5-7":
////			echo "search-rent/thailand/all-beach/under1000/5-7";
////		break;
////		case"all-all-2-8-10":
////			echo "search-rent/thailand/all-beach/under1000/8-10";
////		break;
////		case"all-all-2-more":
////			echo "search-rent/thailand/all-beach/under1000/11";
////		break;
//		
//		
//		//case"all-76-all-all":
////			echo "search-rent/thailand/naithon-beach/all-price/all-bed";
////		break;
////		case"all-76-3-all":
////			echo "search-rent/thailand/naithon-beach/over1000/all-bed";
////		break;
////		case"all-76-2-all":
////			echo "search-rent/thailand/naithon-beach/under1000/all-bed";
////		break;
////		
////		
////		
////		case"all-76-all-1-4":
////			echo "search-rent/thailand/naithon-beach/all-price/1-4";
////		break;
////		case"all-76-all-5-7":
////			echo "search-rent/thailand/naithon-beach/all-price/5-7";
////		break;
////		case"all-76-all-8-10":
////			echo "search-rent/thailand/naithon-beach/all-price/8-10";
////		break;
////		case"all-76-all-more":
////			echo "search-rent/thailand/naithon-beach/all-price/11";
////		break;
////		
////		
////		
////		case"all-76-3-1-4":
////			echo "search-rent/thailand/naithon-beach/over1000/1-4";
////		break;
////		case"all-76-3-5-7":
////			echo "search-rent/thailand/naithon-beach/over1000/5-7";
////		break;
////		case"all-76-3-8-10":
////			echo "search-rent/thailand/naithon-beach/over1000/8-10";
////		break;
////		case"all-76-3-more":
////			echo "search-rent/thailand/naithon-beach/over1000/11";
////		break;
////		
////		
////		
////		case"all-76-2-1-4":
////			echo "search-rent/thailand/naithon-beach/under1000/1-4";
////		break;
////		case"all-76-2-5-7":
////			echo "search-rent/thailand/naithon-beach/under1000/5-7";
////		break;
////		case"all-76-2-8-10":
////			echo "search-rent/thailand/naithon-beach/under1000/8-10";
////		break;
////		case"all-76-2-more":
////			echo "search-rent/thailand/naithon-beach/under1000/11";
////		break;
//		
//		
//		//case"all-66-all-all":
////			echo "search-rent/thailand/kamala-beach/all-price/all-bed";
////		break;
////		case"all-66-3-all":
////			echo "search-rent/thailand/kamala-beach/over1000/all-bed";
////		break;
////		case"all-66-2-all":
////			echo "search-rent/thailand/kamala-beach/under1000/all-bed";
////		break;
////		
////		
////		case"all-66-all-1-4":
////			echo "search-rent/thailand/kamala-beach/all-price/1-4";
////		break;
////		case"all-66-all-5-7":
////			echo "search-rent/thailand/kamala-beach/all-price/5-7";
////		break;
////		case"all-66-all-8-10":
////			echo "search-rent/thailand/kamala-beach/all-price/8-10";
////		break;
////		case"all-66-all-more":
////			echo "search-rent/thailand/kamala-beach/all-price/11";
////		break;
////		
////		
////		
////		case"all-66-3-1-4":
////			echo "search-rent/thailand/kamala-beach/over1000/1-4";
////		break;
////		case"all-66-3-5-7":
////			echo "search-rent/thailand/kamala-beach/over1000/5-7";
////		break;
////		case"all-66-3-8-10":
////			echo "search-rent/thailand/kamala-beach/over1000/8-10";
////		break;
////		case"all-66-3-more":
////			echo "search-rent/thailand/kamala-beach/over1000/11";
////		break;
////		
////		
////		
////		case"all-66-2-1-4":
////			echo "search-rent/thailand/kamala-beach/under1000/1-4";
////		break;
////		case"all-66-2-5-7":
////			echo "search-rent/thailand/kamala-beach/under1000/5-7";
////		break;
////		case"all-66-2-8-10":
////			echo "search-rent/thailand/kamala-beach/under1000/8-10";
////		break;
////		case"all-66-2-more":
////			echo "search-rent/thailand/kamala-beach/under1000/11";
////		break;
//		
//		
//		/*case"all-67-all-all":
//			echo "search-rent/thailand/kata-beach/all-price/all-bed";
//		break;
//		case"all-67-3-all":
//			echo "search-rent/thailand/kata-beach/over1000/all-bed";
//		break;
//		case"all-67-2-all":
//			echo "search-rent/thailand/kata-beach/under1000/all-bed";
//		break;
//		
//		
//		case"all-67-all-1-4":
//			echo "search-rent/thailand/kata-beach/all-price/1-4";
//		break;
//		case"all-67-all-5-7":
//			echo "search-rent/thailand/kata-beach/all-price/5-7";
//		break;
//		case"all-67-all-8-10":
//			echo "search-rent/thailand/kata-beach/all-price/8-10";
//		break;
//		case"all-67-all-more":
//			echo "search-rent/thailand/kata-beach/all-price/11";
//		break;
//		
//		
//		
//		case"all-67-3-1-4":
//			echo "search-rent/thailand/kata-beach/over1000/1-4";
//		break;
//		case"all-67-3-5-7":
//			echo "search-rent/thailand/kata-beach/over1000/5-7";
//		break;
//		case"all-67-3-8-10":
//			echo "search-rent/thailand/kata-beach/over1000/8-10";
//		break;
//		case"all-67-3-more":
//			echo "search-rent/thailand/kata-beach/over1000/11";
//		break;
//		
//		
//		
//		case"all-67-2-1-4":
//			echo "search-rent/thailand/kata-beach/under1000/1-4";
//		break;
//		case"all-67-2-5-7":
//			echo "search-rent/thailand/kata-beach/under1000/5-7";
//		break;
//		case"all-67-2-8-10":
//			echo "search-rent/thailand/kata-beach/under1000/8-10";
//		break;
//		case"all-67-2-more":
//			echo "search-rent/thailand/kata-beach/under1000/11";
//		break;*/
//		
//		
//		
//		/*case"all-80-all-all":
//			echo "search-rent/thailand/kamala-beach/all-price/all-bed";
//		break;
//		case"all-80-3-all":
//			echo "search-rent/thailand/surin-beach/over1000/all-bed";
//		break;
//		case"all-80-2-all":
//			echo "search-rent/thailand/surin-beach/under1000/all-bed";
//		break;
//		
//		
//		case"all-80-all-1-4":
//			echo "search-rent/thailand/surin-beach/all-price/1-4";
//		break;
//		case"all-80-all-5-7":
//			echo "search-rent/thailand/surin-beach/all-price/5-7";
//		break;
//		case"all-80-all-8-10":
//			echo "search-rent/thailand/surin-beach/all-price/8-10";
//		break;
//		case"all-80-all-more":
//			echo "search-rent/thailand/surin-beach/all-price/11";
//		break;
//		
//		
//		
//		case"all-80-3-1-4":
//			echo "search-rent/thailand/surin-beach/over1000/1-4";
//		break;
//		case"all-80-3-5-7":
//			echo "search-rent/thailand/surin-beach/over1000/5-7";
//		break;
//		case"all-80-3-8-10":
//			echo "search-rent/thailand/surin-beach/over1000/8-10";
//		break;
//		case"all-80-3-more":
//			echo "search-rent/thailand/surin-beach/over1000/11";
//		break;
//		
//		
//		
//		
//		case"all-80-3-1-4":
//			echo "search-rent/thailand/surin-beach/over1000/1-4";
//		break;
//		case"all-80-3-5-7":
//			echo "search-rent/thailand/surin-beach/over1000/5-7";
//		break;
//		case"all-80-3-8-10":
//			echo "search-rent/thailand/surin-beach/over1000/8-10";
//		break;
//		case"all-80-3-more":
//			echo "search-rent/thailand/surin-beach/over1000/11";
//		break;
//		
//		
//		case"all-80-2-1-4":
//			echo "search-rent/thailand/surin-beach/under1000/1-4";
//		break;
//		case"all-80-2-5-7":
//			echo "search-rent/thailand/surin-beach/under1000/5-7";
//		break;
//		case"all-80-2-8-10":
//			echo "search-rent/thailand/surin-beach/under1000/8-10";
//		break;
//		case"all-80-2-more":
//			echo "search-rent/thailand/surin-beach/under1000/11";
//		break;*/
//		
//		
//		/*case"all-61-all-all":
//			echo "search-rent/thailand/cape-yamu/all-price/all-bed";
//		break;
//		case"all-61-3-all":
//			echo "search-rent/thailand/cape-yamu/over1000/all-bed";
//		break;
//		case"all-61-2-all":
//			echo "search-rent/thailand/cape-yamu/under1000/all-bed";
//		break;
//		
//		
//		case"all-61-all-1-4":
//			echo "search-rent/thailand/cape-yamu/all-price/1-4";
//		break;
//		case"all-61-all-5-7":
//			echo "search-rent/thailand/cape-yamu/all-price/5-7";
//		break;
//		case"all-61-all-8-10":
//			echo "search-rent/thailand/cape-yamu/all-price/8-10";
//		break;
//		case"all-61-all-more":
//			echo "search-rent/thailand/cape-yamu/all-price/11";
//		break;
//		
//		
//		case"all-61-3-1-4":
//			echo "search-rent/thailand/cape-yamu/over1000/1-4";
//		break;
//		case"all-61-3-5-7":
//			echo "search-rent/thailand/cape-yamu/over1000/5-7";
//		break;
//		case"all-61-3-8-10":
//			echo "search-rent/thailand/cape-yamu/over1000/8-10";
//		break;
//		case"all-61-3-more":
//			echo "search-rent/thailand/cape-yamu/over1000/11";
//		break;
//		
//		
//		case"all-61-2-1-4":
//			echo "search-rent/thailand/cape-yamu/under1000/1-4";
//		break;
//		case"all-61-2-5-7":
//			echo "search-rent/thailand/cape-yamu/under1000/5-7";
//		break;
//		case"all-61-2-8-10":
//			echo "search-rent/thailand/cape-yamu/under1000/8-10";
//		break;
//		case"all-61-2-more":
//			echo "search-rent/thailand/cape-yamu/under1000/11";
//		break;
//		*/
//		
//		
//		default:
//			echo 'noo';
//	}
	
?>