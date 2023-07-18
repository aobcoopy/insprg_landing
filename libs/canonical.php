<?php
    
switch($page)
{
	case"home":
		$url = "";
	break;
	case"service":
		$url = "our-service";
	break;
	case"forrent":
		///$url = "search-rent/thailand/all-beach/all-price/all-bedrooms/all-collections/all-sort.html";   
		$des = $_REQUEST['des'];
		$beach = $_REQUEST['sub'];
		$price = $_REQUEST['pri'];
		$room = $_REQUEST['room'];
		
		if(isset($_REQUEST['cate']))
		{
			$Collection = $_REQUEST['cate'];
		}
		else
		{
			$Collection = "0";
		}
		
		if(isset($_REQUEST['sort']))
		{
			$Sort = $_REQUEST['sort'];
		}
		else
		{
			$Sort = "all";
		}
        

    if(countryIdSlugNameFromDestinationID($des)[0] == "") $countryID = 0; 
    else $countryID = countryIdSlugNameFromDestinationID($des)[0];
            
		//echo "search-rent/".ca_destination($des)."/".ca_beach($beach)."/".ca_price($price)."/".ca_bed($room)."/".ca_collection($Collection)."/".ca_bsort($Sort);
        //$url = "search-rent/".ca_destination($des)."/".ca_beach($beach)."/".ca_price($price)."/".ca_bed($room)."/".ca_collection($Collection)."/".ca_bsort($Sort).".html";
        // NEW
		$url = CanonicalNameBuilder($countryID, $des, $beach, $room, $Collection, $price, $Sort);
        
	break;
	case"blog":
		$url = "blog";
	break;
	case"blogdetail":
		if($_REQUEST['id']=='7')
		{
			$url = "blog/the-10-best-phuket-luxury-villas.html";
		}
		else
		{
			$url = "Lifestyle-".$_REQUEST['id'].".html";
		}
	break;
	case"faq":
		$url = "faq";
	break;
	case"contact":
		$url = "contact";
	break;
	case"propertydetail":
		$ca_prop = $dbc->GetRecord("properties","*","id = '".$_REQUEST['id']."' ");
		$photo = json_decode($ca_prop['photo'],true);
		echo '<link href="https://www.inspiringvillas.com'.$photo[0]['img'].'" rel="me"/>';
		//echo $ca_prop['ht_link'];
		$url = $ca_prop['ht_link'].".html";
		$photo_web = 'https://www.inspiringvillas.com'.$photo[0]['img'];
	break;
	case"villas":
		$url = "collections";
	break;
	case"about":
		$url = "aboutus";
	break;
	case"thanks":
		$url = "thanks";
	break;
	case"privacy":
		$url = "privacy";
	break;
	case"terms":
		$url = "terms";
	break;
	
	case"step1":include "pages/payment_form.php";break;
	case"step2":include "pages/payment_confirm.php";break;
}
	/*$br = $dbc->GetRecord("bedroom","*","id= '".$_REQUEST['cbbRoom']."' status > 0 ");
	$room = $br['id'];
	ss
	*/
	//$option = $des.'-'.$beach.'-'.$price.'-'.$room;
	function ca_destination($option)
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
	
	function ca_price($option)
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
	
	function ca_bed($option)
	{
		switch($option)
		{
			case "1" :
				return "1-4-bedrooms";//"1-4";
			break;
			case "2" :
				return "5-7-bedrooms";//"5-7";
			break;
			case "3" :
				return "8-10-bedrooms";//"8-10";
			break;
			case "4" :
				return "over-10-bedrooms";//"11";
			break;
			default:
				return "all-bedrooms";//"all-bed";
		}
	}
	
	function ca_beach($option)
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
			case "87" :
				return "kalim-beach";
			break;
			case "88" :
				return "chalong-bay";
			break;
			case "89" :
				return "rawai-beach";
			break;
			case "96" :
				return "nai-harn";
			break;
			case "97" :
				return "nathon-beach";
			break;
			default:
				return "all-beach";
		}
	}
	
	function ca_collection($option)
	{
		switch($option)
		{
			case "2" :
				return "party-villas";
			break;
			case "3" :
				return "family-villas";
			break;
			case "4" :
				return "seaview-villas";
			break;
			case "5" :
				return "larger-group-villas";
			break;
			case "6" :
				return "beachfront-villas";
			break;
			case "8" :
				return "wedding-villas";
			break;
			default:
				return "all-collections";
		}
	}
	
	function ca_bsort($option)
	{
		switch($option)
		{
			case "price|asc" :
				return "all-sort";//return "price-min";
			break;
			case "price|desc" :
				return "all-sort";//return "price-max";
			break;
			default:
				return "all-sort";
		}
	}
?>
    <link rel="canonical" href="<?php echo $url_link.$url;?>"/>
    