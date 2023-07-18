<?php 
    session_start();
    include_once "../../config/define.php";
    include_once "../class/db.php";
    include_once "../class/minerva.php";
	include_once "../../inc/functions.inc.php"; 
    
    // search exclusion/inclusion
    $searchChannels = $_REQUEST['cbbDestination'] . "|" . $_REQUEST['cbbSub'] . "|"  .$_REQUEST['cbbRoom'] . "|" . $_REQUEST['cbbCollection'];
    //$exclusionInclusionRule = " AND (properties.exclude_from_search NOT LIKE '%" . $searchChannels . "%' OR properties.exclude_from_search IS NULL)";
    //$exclusionInclusionRule .= " ) OR properties.include_in_search LIKE '%" . $searchChannels . "%') "; 
    $exclusionInclusionRule = " AND (LOCATE('" . $searchChannels . "', properties.exclude_from_search)=0 OR properties.exclude_from_search IS NULL)";
    $exclusionInclusionRule .= " ) OR LOCATE('" . $searchChannels . "', properties.include_in_search)>0 ) ";  
    
    //$sortByMostPopular = "ORDER BY FIELD(include_in_search, '" . $searchChannels . "') desc";   
    $sortByMostPopular = "LOCATE('" . $searchChannels . "', include_in_search) desc";    
    
    // deactivate inclusion rule
    //$exclusionInclusionRule = " )";
    
    @ini_set('display_errors',DEBUG_MODE?1:0);
    date_default_timezone_set(DEFAULT_TIMEZONE);
    
    $dbc = new dbc;
    $dbc->Connect();
    $os = new minerva($dbc);
    $textH2 = $_REQUEST['textH2'];
    $starts = $_REQUEST['starts'];
    $new_starts = $_REQUEST['starts'];
    $zzx = $starts;
	
	if($_REQUEST['view']!='')
	{
		$v = explode("#",$_REQUEST['view']);
		$view = $_REQUEST['view'];//$v[1];
	}
	else
	{
		$view = 'list';
	}
	//echo '>>>>>'.$view;
	
	$zzx = $starts;
    
    //echo $_REQUEST['cbbDestination'];
    $Destination='';
    if(isset($_REQUEST['cbbDestination']))
    {
        if($_REQUEST['cbbDestination']!='all')
        {
            $Destination="properties.destination = '".$_REQUEST['cbbDestination']."' ";
        }
        else
        {
            $Destination="properties.destination  BETWEEN '38' AND '39' ";
        }
    }
    
    $SubDes='';
    if(isset($_REQUEST['cbbSub']))
    if($_REQUEST['cbbSub']!='all')
    {
        $SubDes="AND properties.subdestination = '".$_REQUEST['cbbSub']."' ";
    }
    else
    {
        $SubDes="";
    }
    
    
    
    
    $Room='';
    if(isset($_REQUEST['cbbRoom']))
    //$ex_room = explode("-",$_REQUEST['cbbRoom']);
    if($_REQUEST['cbbRoom']=='all')
    {
        $Room="";
    }
    else
    {
        if($_REQUEST['cbbRoom']==3 )
        {
            $Room = "AND property_room.room  BETWEEN '3' AND '4' ";
        }
        else
        {
            $Room = "AND property_room.room = '".$_REQUEST['cbbRoom']."'";
        }
    }
    
    $Collection='';
    if(isset($_REQUEST['cbbCollection']) && $_REQUEST['cbbCollection']!=0)
    {
        $Collection = "AND property_cate.caategory = '".$_REQUEST['cbbCollection']."'  ";
    }
    else
    {
        $Collection = '';
    }

    $ActualBedrooms = "";
    if(isset($_REQUEST['cbbActualbed']) && $_REQUEST['cbbActualbed'] != "")
    {
        $ActualBedrooms = "AND properties.actualbed = ".$_REQUEST['cbbActualbed']." ";
    }    

    
    $link_url = $_REQUEST['link_url'];
    $ar_link = array(
        
        '/search-rent/thailand/all-beach/all-price/8-10-bedrooms/all-collections/all-sort.html',
        
        '/search-rent/thailand/all-beach/all-price/all-bedrooms/wedding-villas/all-sort.html',
        '/search-rent/thailand/all-beach/all-price/all-bedrooms/larger-group-villas/all-sort.html',
        '/search-rent/thailand/all-beach/all-price/all-bedrooms/seaview-villas/all-sort.html',
    );
    $ar_link_1_1 = array(
        '/search-rent/thailand/all-beach/all-price/5-7-bedrooms/all-collections/all-sort.html',
    );
    $ar_link_2 = array(
        '/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/all-collections/all-sort.html',
    );
    $ar_link_3 = array(
        '/search-rent/thailand/all-beach/all-price/all-bedrooms/all-collections/all-sort.html',
    );
    $ar_link_4 = array(
        '/search-rent/thailand-koh-samui/all-beach/all-price/1-4-bedrooms/all-collections/all-sort.html',
    );
    $ar_link_5 = array(
        '/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/seaview-villas/all-sort.html',
    );
    $ar_link_6 = array(
        '/search-rent/thailand-phuket/all-beach/all-price/1-4-bedrooms/all-collections/all-sort.html',
    );    
    $ar_link_7 = array(
        '/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/beachfront-villas/all-sort.html',
    );
    $ar_link_8 = array(
        '/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/wedding-villas/all-sort.html',
        '/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/seaview-villas/all-sort.html',
    );
    $ar_link_9 = array(
        '/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/all-collections/all-sort.html',
    );
    $ar_link_10 = array(
        '/search-rent/thailand-koh-samui/all-beach/all-price/all-bedrooms/wedding-villas/all-sort.html',
    );
    $ar_link_11 = array(
        '/search-rent/thailand/all-beach/all-price/all-bedrooms/beachfront-villas/all-sort.html',
    );
    $ar_link_12 = array(
        '/search-rent/thailand/all-beach/all-price/1-4-bedrooms/all-collections/all-sort.html',
    );
    
                                
    if(in_array($link_url,$ar_link))
    {
        $starts += 5;
        //echo 'YESSSSSS';
    }
    elseif(in_array($link_url,$ar_link_1_1))
    {
        $starts += 10;
        //echo 'YESSSSSS___2';
    }
    elseif(in_array($link_url,$ar_link_2))
    {
        $starts +=  1;
        //echo 'YESSSSSS___2';
    }
    elseif(in_array($link_url,$ar_link_3))
    {
        $starts += 12;
    }
    elseif(in_array($link_url,$ar_link_4))
    {
        $starts += 16;
    }
    elseif(in_array($link_url,$ar_link_5))
    {
        $starts += 20;
    }
    elseif(in_array($link_url,$ar_link_6))
    {
        $starts += 2;
    }
    elseif(in_array($link_url,$ar_link_7))
    {
        $starts += 2;
    }
    elseif(in_array($link_url,$ar_link_8))
    {
        $starts += 1;
    }
    elseif(in_array($link_url,$ar_link_9))
    {
        $starts += 1;
    }
    elseif(in_array($link_url,$ar_link_10))
    {
        $starts += 1;
    }
    elseif(in_array($link_url,$ar_link_11))
    {
        $starts += 6;
        //echo 'YESSSSSS';
    }
    elseif(in_array($link_url,$ar_link_12))
    {
        $starts += 6;
        //echo 'YESSSSSS';
    }
    else
    {
        //echo 'NOOOOOOOOOOOOOOOOOOOOOOOOO';
        //$starts = "0";
    }    
    
    if($link_url == '/search-rent/thailand/all-beach/all-price/5-7-bedrooms/all-collections/all-sort.html')
    {
        $in_list = "AND properties.id NOT IN (19)";
    }
    elseif($link_url == '/search-rent/thailand-phuket/all-beach/all-price/all-bedrooms/larger-group-villas/all-sort.html')
    {
        //$in_list = "AND properties.id NOT IN (63)";
    }
    else
    {
        $in_list = "";
    }
    
    
    $sorted='';
    if($_REQUEST['cbbSort']!='0' )
    {
        $ex_s = explode("|",$_REQUEST['cbbSort']);
        
        /*if($ex_s[0]=='tag')
        {
            $sorted = "AND tag = ".$ex_s[1]." ";
        }
        else
        {
            $sorted = "ORDER BY ".$ex_s[0]." ".$ex_s[1]." ";
        }*/
        
        if($_REQUEST['cbbSort']!='0'  || $_REQUEST['cbbSort']!='')
        {
            //$ex = explode("|",$_REQUEST['cbbSort']);
            
            if( $ex_s[0]." ".$ex_s[1] == "price asc") $sorted = "ORDER BY " . $sortByMostPopular . ", ".$ex_s[0]." ".$ex_s[1]." limit ".$new_starts.",5 ";
            else $sorted = "ORDER BY ".$ex_s[0]." ".$ex_s[1]." limit ".$new_starts.",5 ";
        }
        else
        {
            $sorted = "";
        }
    }
    else
    {
        $sorted = "";
    }

    
    
    //echo '>>>>>>>>>>>'.$_REQUEST['cbbSort'].'<<<<<<<<<<<<<br>';
//    echo '>>>>>>>>>>>'.$sorted.'<<<<<<<<<<<<<br>';
    
    $sql = "SELECT
                properties.id,
                properties.`name` AS pname,
                properties.exclude_from_search,
                properties.include_in_search,                
                properties.destination AS destination,
                properties.subdestination AS beach,
                destinations.`name` AS dname,
                property_room.room AS room,
                property_cate.caategory AS cate,
                categories.`name` AS cname,
                properties.actualbed,
                properties.`status`,
                properties.price,
                properties.pmin,
                properties.pmax,
                properties.price_range,
                properties.ht_link,
                properties.brief,
                properties.short_det,
                properties.detail,
                properties.photo,
                properties.tag,
                properties.adults AS adults,
                properties.cate_icon AS cate_icon,
                properties.bedroom_range AS bedroom_range
                
            FROM
            properties
                LEFT JOIN property_cate ON properties.id = property_cate.property
                LEFT JOIN property_room ON properties.id = property_room.property
                LEFT JOIN destinations ON properties.subdestination = destinations.id
                LEFT JOIN categories ON property_cate.caategory = categories.id
            WHERE ( (
                ".$Destination."
                ".$SubDes."
                ".$Room."
                ".$Collection."
                ".$ActualBedrooms."
                 ".$in_list."
                " . $exclusionInclusionRule . "                 
                AND properties.`status` > 0
                AND destinations.status > 0
                GROUP BY
                properties.id
                ".$sorted."    ";
                
    //$sql_2 = "SELECT
//                Count(properties.id) AS Coun,
//                properties.`name` AS pname,
//                properties.destination AS destination,
//                properties.subdestination AS beach,
//                destinations.`name` AS dname,
//                property_room.room AS room,
//                property_cate.caategory AS cate,
//                categories.`name` AS cname,
//                properties.actualbed,
//                properties.`status`,
//                properties.price,
//                properties.pmin,
//                properties.pmax,
//                properties.price_range,
//                properties.ht_link,
//                properties.brief,
//                properties.short_det,
//                properties.detail,
//                properties.photo,
//                properties.tag
//            FROM
//            properties
//                LEFT JOIN property_cate ON properties.id = property_cate.property
//                LEFT JOIN property_room ON properties.id = property_room.property
//                LEFT JOIN destinations ON properties.subdestination = destinations.id
//                LEFT JOIN categories ON property_cate.caategory = categories.id
//            WHERE
//                ".$Destination."
//                ".$SubDes."
//                ".$Room."
//                ".$Collection."
//                AND properties.`status` > 0
//                GROUP BY
//                properties.id
//                ".$sorted."";            
                
    $Qry = $dbc->Query($sql);
    //$Qry_2 = $dbc->Query($sql_2);
    
    //$counts = $dbc->Getnum($Qry_2);
    
    //echo '>>>>>>>>>>>'.$counts.'---'.$zzx.'<<<<<<<<<<<<<br>';
    
    
    /*echo '
            <div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
            <div  style="margin-left:0px;">
            <h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$counts.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
            <h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
            <br>
            </div>
            </div>';*/
    
    
    if($counts==0)
    {?>
        <?php /*?><br>
        <center>
            <font size="+5" color="#f05b46"><img src="/upload/notfound.png" width="200"></font><br><br>
            <font size="+2" color="#112845">Not Found Please try again</font>
        </center><?php */?>
        <?php
    }
    
    
    //$_REQUEST['txs'];    
    $x=0;                        
    while($row = $dbc->Fetch($Qry))
    {
        if($row['tag']!=0)
        {
            $tag = $dbc->GetRecord("tags","*","id = '".$row['tag']."' ");
            $tag_name = $tag['name'];
        }
        else
        {
            $tag_name ='';
        }
        $photo = json_decode($row['photo'],true);
        $laa = $row['latitude'];
        $loo = $row['longtitude'];
        $amap = array(
            'la' => $row['latitude'],
            'lo' => $row['longtitude']
        );
        array_push($arr_map,$amap);
        $name = explode("|",$row['pname']);
        
        $catename = explode("-",$row['cname']);
        switch($row['cate_icon'])
        {
            case"4":
                $icon_cate = "beach";
                $icon_name = "Seaview Villa";
            break;
            case"5":
                $icon_cate = "largegroup";
                $icon_name = "Large Group Villa";
            break;
            case"6":
                $icon_cate = "seas";
                $icon_name = "Beachfront Villa";
            break;
            case"8":
                $icon_cate = "wedding";
                $icon_name = "Wedding Villa";
            break;
            case"9":
                $icon_cate = "house";
                $icon_name = "Garden Villa";
            break;
            case"10":
                $icon_cate = "house";
                $icon_name = "Tropical Villa";
            break;
            default:
                $icon_cate = "";
                $icon_name = "";
        }
        
        //echo $row['dname']."<br>";// แสดงข้อความเต็ม
        
        
        
        if(strstr($row['dname'],'Beach'))
        {
            $split = explode(",",$row['dname']);// แบ่งข้อความโดชใช้ ,
            $locations = str_ireplace('Beach','',$split[0]);// แทนที่ข้อความ
            
            $nost = strrpos($locations," ")."<br>";// หาตำแหน่งสุดท้าย
            //echo $row['dname']."<br>";// แสดงข้อความเต็ม
            //echo substr_replace($locations,",",$nost);// แสดงข้อความที่ถูกตัดออก
            $full_location = substr_replace($locations,",",$nost).$split[1];
        }
        elseif(strstr($row['dname'],'Bay'))
        {
            $split = explode(",",$row['dname']);// แบ่งข้อความโดชใช้ ,
            $locations = str_ireplace('Bay','',$split[0]);// แทนที่ข้อความ
            
            $nost = strrpos($locations," ")."<br>";// หาตำแหน่งสุดท้าย
            //echo $row['dname']."<br>";// แสดงข้อความเต็ม
            //echo substr_replace($locations,",",$nost);// แสดงข้อความที่ถูกตัดออก
            $full_location = substr_replace($locations,",",$nost).$split[1];
        }
        elseif(strstr($row['dname'],'Bophut'))
        {
            //echo $row['dname']."<br>";// แสดงข้อความเต็ม
            $full_location = $row['dname'];
        }
        else
        {
            //echo $row['dname']."<br>";// แสดงข้อความเต็ม
            $full_location = $row['dname'];
        }
                                            
        
        $x++;
        $ft = "";//($x==1)?'ftt':'';
        
        $zzx++;
        
        if($zzx=='1' ||  $zzx=='6' || $zzx=='8' || $zzx=='11' || $zzx=='13')
        {
            $padd = "";//style='padding-bottom: 40px;'
        }
        else
        {
            $padd = "";
        }
        
        if($photo[0]['name']=='')
        {
            $img_tag = $name[0];
        }
        else
        {
            $img_tag = $name[0].'- '.$photo[0]['name'];
        }
        
		
		if($view=='grid')
		{
			if($c==1)
			{
				$c=0;
				$pading_grid = 'padleft15-';
			}
			else
			{
				$c=1;
				$pading_grid = 'padright15-';
			}
			
			$villa_location = $full_location;//$locations.','.$destina[1];
			
			
			
			
			
			
			
			echo '<div class="col-xs-12 col-sm-6 col-md-4 web '.$pading_grid.' ">';//<a href="?page=blogdetail&blog='.$r_blog['id'].'">
													echo '<span itemscope itemtype="http://schema.org/Product" >';
													
														echo '<div class="col-md-12 boxpho nopad">';
															if($row['tag']!=0)
															{
																echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
															}
															echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><img itemprop="image"  src="'.$photo[0]['img'].'" width="100%"></a>';
														echo '</div>';
														echo '<div class="col-xs-12 col-sm-12 col-md-12 boxbot_b nopad" style="    border-bottom: 2px solid #102845;">';
															echo '<div class="col-xs-12 col-sm-12 col-md-12  borbo nopad">';
																echo '<div class="col-xs-12 col-sm-12 col-md-8 t_t33 nopad">';
																	echo '<h2 class="btitle f17" ><span itemprop="name">'.$name[0].'</span></h2>'; 
																echo '</div>';
																echo '<div class="col-xs-12 col-sm-12 col-md-4 t_t44 web992 nopad text-right" style="font-size:14px;margin-top: 22px;">';
																	echo $row['bedroom_range']; 
																echo '</div>';
															echo '</div>';
															
															echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad">';
																echo '<div class="col-sm-12 col-md-12 nopad t_t11" style="font-size: 14px;">';
																	echo '<div class="col-sm-6 col-md-6 nopad t_t11" >';
																		echo '<image  data-src="/upload/location.svg" width="20"  class="micon- lazy" style="float:left;margin-right: -10px;" />';
																		echo '<div class="f13 ic_name_g1">&nbsp;&nbsp;'.$villa_location.'</div>';
																	echo '</div>';
																	echo '<div class="col-sm-6 col-md-6 nopad t_t22" >';
																	if($row['cate_icon']!='')
																	{
																		if($icon_cate == "seas")
																		{
																			//echo '<div class="col-xs-1 nopad">';
																			echo '<img data-src="/upload/'.$icon_cate.'.svg"  width="20" class="micon- lazy " style="width: 30px !important;height: 26px;margin-left: -5px; float:left;margin-right: -5px;margin-top: -5px;">';
																			//echo '</div>';
																			$luxu = "";//"Luxury ";
																		}
																		else
																		{
																			//echo '<div class="col-xs-1 nopad">';
																			echo '<image  data-src="/upload/'.$icon_cate.'.svg" width="20"  class="micon- lazy " style="float:left;margin-right: -5px; " />';
																			//echo '</div>';
																			$luxu = "";
																		}
																		echo '<div class=" ic_name_g1  f13">&nbsp;&nbsp;'.$luxu.''.$icon_name.'</div>';//str_ireplace('Villas','Villa',$catename[0]).'
																	}
																	else
																	{
																	}
																	echo '</div>';
																	echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11 top10">';
																		echo '<span itemprop="description">';
																			echo string_len(base64_decode($row['short_det'],true),125);
																		echo '</span>';
																	echo '</div>';
																echo '</div>';
																echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad web992 t_t22 top10 text-right">';
																	echo '<span  style="font-size: 12px;      margin-right: 10px;">FROM </span>';
																	//echo '<span class="mob992"  style="font-size: 12px;    float: right;    padding-left: 30px;">'.$rev.' Reviews</span><br>';
																	echo '<span style="font-size: 23px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
																	echo '<span style="font-size: 12px;">++ /NT</span>';
																echo '</div>';
																echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad">';
																	echo '<div class="col-xs-5 col-sm-5 col-md-4 nopad mob992 t_t22 " style="height:50px;padding-top: 15px;">';
																		echo '<span class="mob992"  style="font-size: 14px;     ">'.$rev.' Reviews</span><br>';
																	echo '</div>';
																	echo '<div class="col-xs-7 col-sm-7 col-md-4 nopad mob992 t_t33 text-right" style="padding-top: 15px;">';
																		echo '<span  style="font-size: 12px;       padding-right: 20px;">FROM </span>';
																		echo '<span style="font-size: 32px;margin-top:50px;    color: #f05b46;"><span class="doll"  style="font-size: 12px;"> $</span>'.number_format($row['price']).'</span>';
																		echo '<span style="font-size: 12px;">++ /NT</span>';
																	echo '</div>';
																echo '</div>';
															echo '</div>';
														echo '</div>';
														//echo '<span itemprop="brand" itemscope itemtype="http://schema.org/Brand"><span itemprop="name" class="tw tbrand" >Inspiring Villas</span></span>';
													echo '</span>';
												echo '</div>';
												
												
												
?>
<span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
    Price Range 
    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
    -
    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
</span>
<?php

												
												
												array_push($ar_photo,"https://www.inspiringvillas.com".$photo[0]['img']);
                                                            
                                                            $ar_url[] = array(
                                                              "@type" => "ListItem",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".$photo[0]['img'],
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              /*"author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),*/
                                                            );
                                                            
                                                            $ar_url_2[] = array(
                                                              "@context" => "http://schema.org/",
                                                              "@type" => "Recipe",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".$photo[0]['img'],
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              "author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),
                                                            );
                                                            
												
												echo '<div class="mg-avl-room mob '.$padd_1.'1 '.$paddbutt.'1 " ><span itemscope itemtype="http://schema.org/Product" >';
                                                    echo '<span itemprop="brand" itemscope itemtype="http://schema.org/Brand"><span itemprop="name" class="tw tbrand" >Inspiring Villas</span></span>';
                                                        echo '<div class="row">';//echo $row['id'];
                                                            //--------------------------web-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-4 mob">';
                                                            if($row['tag']!=0)
                                                            {
                                                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
                                                            }
                                                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
                                                                //echo slide_photo($photo,$row['id']);
                                                                if($zz==1)
                                                                {
                                                                    echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive" width="100%"></a>';
                                                                }
                                                                else
                                                                {
                                                                    echo '<img itemprop="image" data-src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive lazy" width="100%"></a>';
                                                                }
                                                            
                                                            //array_push($ar_url,"https://www.inspiringvillas.com/".$row['ht_link'].'.html');
                                                            
                                                            echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="" class="img-responsive " width="100%" style="display:none;">';
                                                                
                                                            echo '</div>';
                                                            //--------------------------web-----------------------------
                                                            
                                                            
															
															
															//--------------------------mob-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-6 mob top10">';
                                                                //echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
                                                                //echo '</div>';
                                                                echo '<div class="gray_mob ">';
                                                                    echo '<div class="row mg-room-fecilities">';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 padleft25 padright25 t_t11">';
                                                                            echo '<h3 class=" font_mob top0"><a class="fbk" href="/'.$row['ht_link'].'.html" ><span itemprop="name"><strong>'.$name[0].' </strong></span></a></h3>';
                                                                            echo '<div  class="top10 tb f15t "><span itemprop="description" class="pt">'.base64_decode($row['short_det']).'</span></div>';//f13
                                                                            echo '</div>';
                                                                            //echo '<div class="col-xs-12 col-sm-12 col-md-12 padleft25 top10 t_t41">';
                                                                            echo '<div class="col-xs-7 col-sm-6 col-md-6 padleft25 top10 t_t11">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30" style="padding-left: 5px;">';
//                                                                                            echo '<image xlink:href="/upload/location.svg" src="/upload/location.svg"  class="micon" style="width: 20px !important;" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 22px !important;padding-left: 5px;"/>';
                                                                                        //echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$full_location.'</div>';
                                                                                    echo '</li>';
                                                                                    if($row['cate_icon']!='')
                                                                                    {
                                                                                        echo '<li class="pdmb">';
                                                                                            /*echo '<svg width="30" height="30">';
                                                                                                echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
                                                                                            echo '</svg>';*/
                                                                                            if($icon_cate == "seas")
                                                                                            {
                                                                                                echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
                                                                                                $luxu_mo = "Luxury ";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
                                                                                                $luxu_mo = "";
                                                                                            }
                                                                                            echo '<div class="ic_name f13">&nbsp;'.$luxu_mo.''.$icon_name.'</div>';//'.str_ireplace('Villas','Villa',$catename[0]).'
                                                                                        echo '</li>';
                                                                                    }
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                            echo '<div class="col-xs-5 col-sm-6 col-md-6 padleft251 top10 t_t22">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['bedroom_range'].'</div>';
                                                                                    echo '</li>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/team.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['adults'].' Guests</div>';
                                                                                    echo '</li>';
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 t_price  t_t21">';
                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padleft top20 bottom51 t_t31">';
                                                                                echo '<div class="text-right text_price tp2">From <span class="inprice ">$'.number_format($row['pmin']).'</span> /Night</div>';
                                                                                //echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
                                                                            echo '</div>';
                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padright top20 bottom51 t_t31">';
                                                                                
                                                                                echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa_2 " target="_blank">View Details</button></a>';
                                                                                //echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
                                                                                ?><?php /*?><button class="btn_villa btn_enquire" type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');"> Enquire Now</button><?php */?><?php
                                                                            echo '</div>';
                                                                            
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                    //echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</div>';
                                                            //--------------------------mob-----------------------------
															
															
                                                        echo '</div>';
                                                    echo '</span></div>';
												
												
												
												
											//----------------------  grid   --------------------------------------	
			
			
			
			
			
													
													
													
												
		}
		else
		{
			
			
			 //echo '<!--room-->';
                                                    echo '<div class="mg-avl-room '.$padd_1.'1 '.$paddbutt.'1 " ><span itemscope itemtype="http://schema.org/Product" >';
                                                    echo '<span itemprop="brand" itemscope itemtype="http://schema.org/Brand"><span itemprop="name" class="tw tbrand" >Inspiring Villas</span></span>';
                                                        echo '<div class="row">';//echo $row['id'];
														
														echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t33 villa_boxs">';
														echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad villa_boxs_inside">';
                                                            //--------------------------web-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-4 nopad t_t22">';
                                                            if($row['tag']!=0)
                                                            {
                                                                echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
                                                            }
                                                                echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
                                                                //echo slide_photo($photo,$row['id']);
                                                                if($zz==1)
                                                                {
                                                                    echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive" width="100%"></a>';
                                                                }
                                                                else
                                                                {
                                                                    echo '<img itemprop="image" data-src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive lazy" width="100%"></a>';
                                                                }
                                                            array_push($ar_photo,"https://www.inspiringvillas.com".$photo[0]['img']);
                                                            
                                                            $ar_url[] = array(
                                                              "@type" => "ListItem",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".$photo[0]['img'],
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              /*"author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),*/
                                                            );
                                                            
                                                            $ar_url_2[] = array(
                                                              "@context" => "http://schema.org/",
                                                              "@type" => "Recipe",
                                                              "name" => $name[0],
                                                              "image" => "https://www.inspiringvillas.com".$photo[0]['img'],
                                                              "position" => $zz,
                                                              "url" => "https://www.inspiringvillas.com/".$row['ht_link'].".html",
                                                              "author"=> array(
                                                                "@type" => "Person",
                                                                "name" => "Inspiring Villas"
                                                              ),
                                                            );
                                                            
                                                            //array_push($ar_url,"https://www.inspiringvillas.com/".$row['ht_link'].'.html');
                                                            
                                                            echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="" class="img-responsive " width="100%" style="display:none;">';
                                                            ?>
                                                                <span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
                                                                    Price Range 
                                                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
                                                                    -
                                                                    <span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
                                                                </span>
                                                                
                                                                
                                                                
                                                                <?php /*?><div itemprop="review" itemscope itemtype="http://schema.org/Review"><?php */?>
                                                                 <?php
                                                                    /*$sql_rate = $dbc->Query("select * from rating where property = '".$row['id']."'");
                                                                    $xx=0;
                                                                    $cou_rate = 0;
                                                                    while($rate = $dbc->Fetch($sql_rate))
                                                                    {
                                                                        //echo '<span itemprop="reviewBody" style="display:none;">'.base64_decode($rate['text'],true).'</span>';
                                                                        //echo '<span itemprop="author" itemscope itemtype="http://schema.org/Person" style="display:none;><span itemprop="name">'.$rate['name'].'</span></span>';
                                                                        $xx++;
                                                                        $cou_rate+=$rate['rate'];
                                                                    }
                                                                    if($cou_rate==0)
                                                                    {
                                                                        $cou_rate++;
                                                                    }
                                                                    $total_rate = $cou_rate/$xx;*/
                                                                    /*echo '<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" style="color:#eeeeee;display:none;">';
                                                                        //echo '<span itemprop="ratingValue" style="color:#eeeeee;">'.$total_rate.'</span>';
                                                                            echo '<meta itemprop="worstRating" content = "1">
                                                                            <span itemprop="ratingValue">'.$total_rate.'</span>/
                                                                            <span itemprop="bestRating">5</span>stars';
                                                                            
                                                                    echo '</span>'*/;
                                                                    ?>
                                                                <?php /*?></div><?php */?>
                                                                
                                                                 <?php /*?><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="hidden" style="color:#eeeeee;">
                                                                    <span itemprop="ratingValue"><?php echo $total_rate;?></span>
                                                                    out of <span itemprop="bestRating">5</span>
                                                                    based on <span itemprop="ratingCount"><?php echo $xx;?></span> user ratings
                                                                </div><?php */?>
                                                                    <?php
                                                                
                                                            echo '</div>';
															//------------------------------------------------------------------echo '';
															echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-8 web t_t33" style="margin-top:19px;">';
                                                            
                                                                echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t33">';
                                                                    echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle f23"><span itemprop="name">'.$name[0].'</span></h3></div>';//'.$row['id'].'
																	//echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle f23"><a href="/'.$row['ht_link'].'.html" ><span itemprop="name">'.$name[0].'</span></a></h3></div>';//'.$row['id'].'
                                                                    //echo '<div class="col-xs-12 col-sm-4 col-md-4 text-right nopad r_price tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
                                                                echo '</div>';
                                                                
                                                                echo '<div  class="top20 tb t_t44 f18t- f17Desk- f15t " ><span itemprop="description" style="font-family:pt !important">'.base64_decode($row['short_det']).'</span></div>';
                                                                //echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['pmin'].' - $'.$row['pmax'].' / room nights / season</span></span>';
                                                                
                                                                //echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
                                                                //echo '</div>';
                                                                echo '<div class="gray_mob">';
                                                                    echo '<div class="row mg-room-fecilities">';
                                                                        echo '<div class="col-xs-12 col-sm-4 col-md-5 top15 t_t11">';
                                                                            echo '<ul>';
                                                                                echo '<li style="margin-bottom: -2px;">';
                                                                                    //echo '<svg width="30" height="30">';
                                                                                        echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 23px !important;"/>';
                                                                                    //echo '</svg>';
                                                                                    
                                                                                    //echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                    echo '<div class="ic_name f15t " >&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                echo '</li>';
                                                                                if($row['cate_icon']!='')
                                                                                {
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    if($icon_cate == "seas")
                                                                                    {
                                                                                        echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 32px;margin-left: -5px;" />';
                                                                                        $luxu = "Luxury ";
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
                                                                                        $luxu = "";
                                                                                    }
                                                                                    
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$luxu.''.$icon_name.'</div>';//str_ireplace('Villas','Villa',$catename[0]).'
                                                                                echo '</li>';
                                                                                }
                                                                                else
                                                                                {
                                                                                    //echo '-----';
                                                                                }
                                                                        echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '<div class="col-xs-6 col-sm-4 col-md-3 top15 nopad t_t22">';
                                                                            echo '<ul>';
                                                                                //echo '<li>';
//                                                                                    echo '<svg width="30" height="30">';
//                                                                                        echo '<image xlink:href="/upload/location.svg"  class="micon" />';
//                                                                                    echo '</svg>';
//                                                                                    echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//                                                                                echo '</li>';
                                                                                
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$row['bedroom_range'].'</div>';
                                                                                    //echo '<br><br><div class="ic_name">&nbsp;&nbsp;'.$row['actualbed'].' Bedroom</div><br><br>';
                                                                                echo '</li>';
                                                                                echo '<li>';
                                                                                    /*echo '<svg width="30" height="30">';
                                                                                        echo '<image xlink:href="/upload/team.svg"  class="micon" />';
                                                                                    echo '</svg>';*/
                                                                                    echo '<image data-src="/upload/team.svg"  class="micon lazy"/>';
                                                                                    echo '<div class="ic_name f15t" >&nbsp;&nbsp;'.$row['adults'].' Guests</div>';
                                                                                echo '</li>';
                                                                            echo '</ul>';
                                                                        echo '</div>';
                                                                    
                                                                        echo '<div class="col-xs-6 col-sm-4 col-md-4 t_price text-right nopad t_t33">';
                                                                            echo '<div class="col-xs-12 col-sm-12 col-md-12 text-right nopad  tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
                                                                            echo '<div class="col-xs-12 col-sm-12 col-md-12  nopad top10 t_t31">';
                                                                                echo '<button class="btn_villa btn_detail" target="_blank">View Details</button>';
																				//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
                                                                            //echo '</div>';
//                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6  nopad t_t3">';
                                                                                echo '<button class="btn_villa btn_enquire" target="_blank">Enquire Now</button>';
																				//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
                                                                                ?><?php /*?><button type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');" class="btn_villa btn_enquire" target="_blank">Enquire Now</button><?php */?><?php
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                    //echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</div>';
															echo '</a>';
                                                            //--------------------------web-----------------------------
                                                            echo '</div>'; //---------villa_boxs_inside
															echo '</div>'; //---------villa_boxs
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            //--------------------------mob-----------------------------
                                                            echo '<div class="col-xs-12 col-sm-12 col-md-6 mob top10">';
                                                                //echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
                                                                //echo '</div>';
                                                                echo '<div class="gray_mob ">';
                                                                    echo '<div class="row mg-room-fecilities">';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 padleft25 padright25 t_t11">';
                                                                            echo '<h3 class=" font_mob top0"><a class="fbk" href="/'.$row['ht_link'].'.html" ><span itemprop="name"><strong>'.$name[0].' </strong></span></a></h3>';
                                                                            echo '<div  class="top10 tb f15t "><span itemprop="description" class="pt">'.base64_decode($row['short_det']).'</span></div>';//f13
                                                                            echo '</div>';
                                                                            //echo '<div class="col-xs-12 col-sm-12 col-md-12 padleft25 top10 t_t41">';
                                                                            echo '<div class="col-xs-7 col-sm-6 col-md-6 padleft25 top10 t_t11">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30" style="padding-left: 5px;">';
//                                                                                            echo '<image xlink:href="/upload/location.svg" src="/upload/location.svg"  class="micon" style="width: 20px !important;" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 22px !important;padding-left: 5px;"/>';
                                                                                        //echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$full_location.'</div>';
                                                                                    echo '</li>';
                                                                                    if($row['cate_icon']!='')
                                                                                    {
                                                                                        echo '<li class="pdmb">';
                                                                                            /*echo '<svg width="30" height="30">';
                                                                                                echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
                                                                                            echo '</svg>';*/
                                                                                            if($icon_cate == "seas")
                                                                                            {
                                                                                                echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
                                                                                                $luxu_mo = "Luxury ";
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
                                                                                                $luxu_mo = "";
                                                                                            }
                                                                                            echo '<div class="ic_name f13">&nbsp;'.$luxu_mo.''.$icon_name.'</div>';//'.str_ireplace('Villas','Villa',$catename[0]).'
                                                                                        echo '</li>';
                                                                                    }
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                            echo '<div class="col-xs-5 col-sm-6 col-md-6 padleft251 top10 t_t22">';
                                                                                echo '<ul>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['bedroom_range'].'</div>';
                                                                                    echo '</li>';
                                                                                    echo '<li class="pdmb">';
                                                                                        //echo '<svg width="30" height="30">';
//                                                                                            echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//                                                                                        echo '</svg>';
                                                                                        echo '<image data-src="/upload/team.svg"  class="micon lazy" />';
                                                                                        echo '<div class="ic_name f13">&nbsp;'.$row['adults'].' Guests</div>';
                                                                                    echo '</li>';
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 t_price  t_t21">';
                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padleft top20 bottom51 t_t31">';
                                                                                echo '<div class="text-right text_price tp2">From <span class="inprice ">$'.number_format($row['pmin']).'</span> /Night</div>';
                                                                                //echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
                                                                            echo '</div>';
                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padright top20 bottom51 t_t31">';
                                                                                
                                                                                echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa_2 " target="_blank">View Details</button></a>';
                                                                                //echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
                                                                                ?><?php /*?><button class="btn_villa btn_enquire" type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');"> Enquire Now</button><?php */?><?php
                                                                            echo '</div>';
                                                                            
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                    //echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</div>';
                                                            //--------------------------mob-----------------------------
                                                        echo '</div>';
                                                    echo '</span></div>';
                                                //echo '<!--room-->';
			
			
			
			
			
			
			
			
			
			
			
			
				        //echo '<!--room-->';
			//echo '<div class="mg-avl-room" '.$padd.'><span itemscope itemtype="http://schema.org/Product">';
//				echo '<div class="row">';
//					//--------------------------web-----------------------------
//					echo '<div class="col-xs-12 col-sm-12 col-md-4">';
//					if($row['tag']!=0)
//					{
//						echo '<div class="tags_bar"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag_name.'</div>';
//					}
//						echo '<a href="/'.$row['ht_link'].'.html" target="_blank">';
//						//echo slide_photo($photo,$row['id']);
//						if($zz==1)
//						{
//							echo '<img  src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive" width="100%"></a>';
//						}
//						else
//						{
//							echo '<img  data-src="'.$photo[0]['img'].'" alt="'.$img_tag.'" class="img-responsive lazy" width="100%"></a>';
//						}
//					
//					echo '<img itemprop="image" src="'.$photo[0]['img'].'" alt="" class="img-responsive " width="100%" style="display:none;">';
//					?>
						<?php /*?><span class="hidden" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="color:#f05b46;">
//							Price Range 
//							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="lowPrice" content="<?php echo $row['pmin'];?>"><?php echo $row['pmin'];?></span>
//							-
//							<span itemprop="priceCurrency" content="USD">$</span><span itemprop="highPrice" content="<?php echo $row['pmax'];?>"><?php echo $row['pmax'];?></span> / night
//						</span><?php */?>
							<?php
//						
//					echo '</div>';
//					echo '<div class="col-xs-12 col-sm-12 col-md-8 web ">';
//					
//						echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t33">';
//							echo '<div class="col-xs-12 col-sm-12 col-md-12 nopad t_t11"><h3 class="mg-avl-room-title vtitle"><a href="/'.$row['ht_link'].'.html" ><span itemprop="name">'.$name[0].'</span></a></h3></div>';//'.$row['id'].'
//							//echo '<div class="col-xs-12 col-sm-4 col-md-4 text-right nopad r_price tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
//						echo '</div>';
//						
//						echo '<div  class="top20 tb t_t44 f18t"><span itemprop="description">'.base64_decode($row['short_det']).'</span></div>';
//						//echo '<span ><span  style="color:#f05b46;border-bottom: 0px solid #dbdbda;">Price Range $'.$row['pmin'].' - $'.$row['pmax'].' / room nights / season</span></span>';
//						
//						//echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
//						//echo '</div>';
//						echo '<div class="gray_mob">';
//							echo '<div class="row mg-room-fecilities">';
//								echo '<div class="col-xs-12 col-sm-4 col-md-5 top30 t_t11">';
//									echo '<ul>';
//										echo '<li style="margin-bottom: -2px;">';
//											//echo '<svg width="30" height="30">';
//												echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 23px !important;"/>';
//											//echo '</svg>';
//											
//											//echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//											echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//										echo '</li>';
//										if($row['cate_icon']!='')
//										{
//										echo '<li>';
//											/*echo '<svg width="30" height="30">';
//												echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
//											echo '</svg>';*/
//											
//											if($icon_cate == "seas")
//											{
//												echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 32px;margin-left: -5px;" />';
//												$luxu = "Luxury ";
//											}
//											else
//											{
//												echo '<image  data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
//												$luxu = "";
//											}
//											
//											echo '<div class="ic_name">&nbsp;&nbsp;'.$luxu.''.$icon_name.'</div>';//str_ireplace('Villas','Villa',$catename[0]).'
//										echo '</li>';
//										}
//										else
//										{
//											//echo '-----';
//										}
//								echo '</ul>';
//							echo '</div>';
//							echo '<div class="col-xs-6 col-sm-4 col-md-3 top30 nopad t_t22">';
//									echo '<ul>';
//										echo '<li>';
//											/*echo '<svg width="30" height="30">';
//												echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//											echo '</svg>';*/
//											echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
//											echo '<div class="ic_name">&nbsp;&nbsp;'.$row['bedroom_range'].'</div>';
//											//echo '<div class="ic_name">&nbsp;&nbsp;'.$row['actualbed'].' Bedroom</div>';
//										echo '</li>';
//										echo '<li>';
//											/*echo '<svg width="30" height="30">';
//												echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//											echo '</svg>';*/
//											echo '<image data-src="/upload/team.svg"  class="micon lazy"/>';
//											echo '<div class="ic_name">&nbsp;&nbsp;'.$row['adults'].' Guests</div>';
//										echo '</li>';
//									echo '</ul>';
//								echo '</div>';
//							
//								echo '<div class="col-xs-6 col-sm-4 col-md-4 t_price text-right nopad t_t33">';
//									echo '<div class="col-xs-12 col-sm-12 col-md-12 text-right nopad  tb t_t22"><div class="inside">From <span class="inprice">$'.number_format($row['pmin']).'</span> / Night</div></div>';
//									echo '<div class="col-xs-12 col-sm-12 col-md-12  nopad top10 t_t31">';
//										echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
//									//echo '</div>';
//			//                                                                            echo '<div class="col-xs-6 col-sm-6 col-md-6  nopad t_t3">';
//										echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
//										?><?php /*?><button type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');" class="btn_villa btn_enquire" target="_blank">Enquire Now</button><?php */?><?php
//									echo '</div>';
//								echo '</div>';
//							echo '</div>';
//							//echo '<div class="col-xs-12 col-sm-12 col-md-12 t_t3">';
//			//                                                                        echo '<a href="/'.$row['ht_link'].'.html" class="btn btn-main bto" target="_blank">View Detail</a>';
//			//                                                                    echo '</div>';
//						echo '</div>';
//					echo '</div>';
//					//--------------------------web-----------------------------
//					
//					//--------------------------mob-----------------------------
//					echo '<div class="col-xs-12 col-sm-12 col-md-6 mob top10">';
//						//echo '<p>'.string_len(base64_decode($row['short_det'],true),700).'</p>';
//						//echo '</div>';
//						echo '<div class="gray_mob">';
//							echo '<div class="row mg-room-fecilities">';
//								echo '<div class="col-xs-12 col-sm-12 col-md-6 padleft25 padright25 t_t11">';
//									echo '<h3 class=" font_mob top10"><a class="fbk" href="/'.$row['ht_link'].'.html" ><span itemprop="name"><strong>'.$name[0].' </strong></span></a></h3>';
//									echo '<div  class="top15 tb f15t"><span itemprop="description">'.base64_decode($row['short_det']).'</span></div>';
//									echo '</div>';
//									//echo '<div class="col-xs-12 col-sm-12 col-md-12 padleft25 top10 t_t41">';
//									echo '<div class="col-xs-7 col-sm-6 col-md-6 padleft25 top10 t_t11">';
//										echo '<ul>';
//											echo '<li>';
//												//echo '<svg width="30" height="30" style="padding-left: 5px;">';
//			//                                                                                            echo '<image xlink:href="/upload/location.svg" src="/upload/location.svg"  class="micon" style="width: 20px !important;" />';
//			//                                                                                        echo '</svg>';
//												echo '<image data-src="/upload/location.svg"  class="micon lazy" style="width: 22px !important;padding-left: 5px;"/>';
//												//echo '<div class="ic_name">&nbsp;&nbsp;'.$full_location.'</div>';
//												echo '<div class="ic_name f13">&nbsp;'.$full_location.'</div>';
//											echo '</li>';
//											if($row['cate_icon']!='')
//											{
//											echo '<li>';
//												/*echo '<svg width="30" height="30">';
//													echo '<image xlink:href="/upload/'.$icon_cate.'.svg"  class="micon" />';
//												echo '</svg>';*/
//																
//												if($icon_cate == "seas")
//												{
//													echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" style="width: 34px !important;height: 37px;margin-left: -5px;background: #ffcdcd00;margin-top: -8px;margin-bottom: -1px !important;" />';
//													$luxu_mo = "Luxury ";
//												}
//												else
//												{
//													echo '<image data-src="/upload/'.$icon_cate.'.svg"  class="micon lazy" />';
//													$luxu_mo = "";
//												}
//												echo '<div class="ic_name f13">&nbsp;'.$luxu_mo.''.$icon_name.'</div>';//'.str_ireplace('Villas','Villa',$catename[0]).'
//											echo '</li>';
//											}
//										echo '</ul>';
//									echo '</div>';
//									echo '<div class="col-xs-5 col-sm-6 col-md-6 padleft251 top20 t_t22">';
//										echo '<ul>';
//											echo '<li>';
//												//echo '<svg width="30" height="30">';
//			//                                                                                            echo '<image xlink:href="/upload/bed.svg"  class="micon" />';
//			//                                                                                        echo '</svg>';
//												echo '<image data-src="/upload/bed.svg"  class="micon lazy" />';
//												echo '<div class="ic_name f13">&nbsp;'.$row['bedroom_range'].'</div>';
//											echo '</li>';
//											echo '<li>';
//												//echo '<svg width="30" height="30">';
//			//                                                                                            echo '<image xlink:href="/upload/team.svg"  class="micon" />';
//			//                                                                                        echo '</svg>';
//												echo '<image data-src="/upload/team.svg"  class="micon lazy" />';
//												echo '<div class="ic_name f13">&nbsp;'.$row['adults'].' Guests</div>';
//											echo '</li>';
//										echo '</ul>';
//									echo '</div>';
//								echo '<div class="col-xs-12 col-sm-12 col-md-6 t_price  t_t21">';
//									
//									echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padleft top20 bottom51 t_t31">';
//										echo '<div class="text-right text_price tp2">From <span class="inprice ">$'.number_format($row['pmin']).'</span> /Night</div>';
//										//echo '<a href="/'.$row['ht_link'].'.html" target="_blank"><button class="btn_villa btn_detail" target="_blank">View Details</button></a>';
//									echo '</div>';
//									echo '<div class="col-xs-6 col-sm-6 col-md-6 text-center padright top20 bottom51 t_t31">';
//										
//										echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa_2 " target="_blank">View Details</button></a>';
//										//echo '<a href="/'.$row['ht_link'].'.html"  target="_blank"><button class="btn_villa btn_enquire" target="_blank">Enquire Now</button></a>';
//										?><?php /*?><button class="btn_villa btn_enquire" type="button" onClick="pop_enquiry('<?php echo $row['id'];?>','<?php echo $name[0];?>');"> Enquire Now</button><?php */?><?php
//									echo '</div>';
//									
//								echo '</div>';
//							echo '</div>';
//						echo '</div>';
//					echo '</div>';
//					//--------------------------mob-----------------------------
//					
//				echo '</div>';
//			echo '</span></div>';
//			//echo '<!--room-->';

		}
                                                
                                                
         if($view=='grid')
		{
			if($zzx=='3' || $zzx=='9' || $zzx=='15')
			{
				echo '<div class="col-md-12"><div class="villa_boxs_mini- photo_banner web"><a href="/contact" ><img src="/upload/search/2.png" width="100%"> </a></div></div>';
				echo '<div class="villa_boxs_mini photo_banner mob pointer"><a href="/contact" ><img src="/upload/search/m2.png" width="100%"></a></div>';
				//echo '<div class="col-md-12"><a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a></div>';
			}
			if($zzx=='6' || $zzx=='12' || $zzx=='18')
			{
				echo '<div class="col-md-12"><div class="villa_boxs_mini- photo_banner web"><a href="/contact" ><img src="/upload/search/1.png" width="100%"> </a></div></div>';
				echo '<div class="villa_boxs_mini photo_banner mob"><a href="/contact" ><img src="/upload/search/m1.png" width="100%"> </a></div>';
				//echo '<div class="col-md-12"><a href="/contact"><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong><strong class="tred"> - Click Here!</strong></button></a></div>';
			}
		}
		else
		{
			if($zzx=='1' || $zzx=='7' || $zzx=='13')
			{
				echo '<div class="villa_boxs_mini photo_banner web pointer"><a href="/contact" ><img src="/upload/search/2.png" width="100%"></a></div>';
				echo '<div class="villa_boxs_mini photo_banner mob pointer"><a href="/contact" ><img src="/upload/search/m2.png" width="100%"></a></div>';
				//echo '<div class="villa_boxs_mini"><a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a></div>';
			}
			if($zzx=='4' || $zzx=='10' || $zzx=='16')
			{
				echo '<div class="villa_boxs_mini photo_banner web"><a href="/contact" ><img src="/upload/search/1.png" width="100%"> </a></div>';
				echo '<div class="villa_boxs_mini photo_banner mob"><a href="/contact" ><img src="/upload/search/m1.png" width="100%"> </a></div>';
				//echo '<div class="villa_boxs_mini"><a href="/contact"><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong> <strong class="tred">- Click Here!</strong></button></a></div>';
			}
		}                                       
                                                
        //if($view=='grid')
//		{
//			if($zzx=='3' || $zzx=='9' || $zzx=='15')
//			{
//				//echo '<a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a>';
//				echo '<div class="col-md-12"><div class="villa_boxs_mini- photo_banner web"><a href="/contact" ><img src="/upload/search/1.png" width="100%"> </a></div></div>';
//				//echo '<div class="col-md-12"><a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a></div>';
//			}
//			
//			if($zzx=='6' || $zzx=='12' || $zzx=='18')
//			{
//				//echo '<a href="/contact" ><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong> <strong class="tred">- Click Here!</strong></button></a>';
//				echo '<div class="col-md-12"><div class="villa_boxs_mini- photo_banner web"><a href="/contact" ><img src="/upload/search/2.png" width="100%"> </a></div></div>';
//				//echo '<div class="col-md-12"><a href="/contact"><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong><strong class="tred"> - Click Here!</strong></button></a></div>';
//			}
//		}
//		else
//		{
//			if($zzx=='2' || $zzx=='6' || $zzx=='11')
//			{
//				echo '<div class="villa_boxs_mini photo_banner web"><a href="/contact" ><img src="/upload/search/1.png" width="100%"> </a></div>';
//				//echo '<div class="villa_boxs_mini"><a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a></div>';
//				//echo '<a href="/contact" ><button class="bad clicking tupper"><strong>receive $150 off any excursion booking during your villa stay with us*</strong></button></a>';
//			}
//			
//			if($zzx=='4' || $zzx=='8' || $zzx=='13')
//			{
//				echo '<div class="villa_boxs_mini photo_banner web"><a href="/contact" ><img src="/upload/search/2.png" width="100%"> </a></div>';
//				//echo '<div class="villa_boxs_mini"><a href="/contact"><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong> <strong class="tred">- Click Here!</strong></button></a></div>';
//				//echo '<a href="/contact" ><button class="bad adblu clicking"><strong>LET US FIND THE VILLA OPTIONS FOR YOU  - CONCIERGE SERVICE AVAILABLE</strong><strong class="tred"> - Click Here!</strong></button></a>';
//			}
//		}                                        
        
        
    }
    
    
    
    
    
    
    
//    $price='';
//    if(isset($_REQUEST['cbbPrice']))
//    if($_REQUEST['cbbPrice']!='all')
//    {
//        if($_REQUEST['cbbPrice']=='1')//all price
//        {
//            $price="";
//        }
//        elseif($_REQUEST['cbbPrice']=='2')// < 1000
//        {
//            $price="AND price < 1000";
//        }
//        else// > 1000
//        {
//            $price="AND price > 1000";
//        }
//        
//    }
//    else
//    {
//        $price="";
//    }
    
    
    
    
//    $view = '';
//    if(isset($_REQUEST['t_view']))
//    {
//        $view = $_REQUEST['t_view'];
//    }
    
    
    
    
    

        
        
        
        //$num1 = count($prop_villa);
//        if(count($arr_room_load)>0)
//        {
//            echo '
//            <div class="col-xs-12 col-sm-12 col-md-12 aab nopad">
//            <div  style="margin-left:0px;">
//            <h4 class="f16 ilb" style="font-family: pt !important;">Displaying '.$u.'</h4> <h2 class="f16 ilb" style="font-family: pt !important;">hand-picked villas in your search for </h2>
//            <h2 style="margin-top: 0px;    margin-left: -2px;">'.$textH2.'</h2>
//            <br>
//            </div>
//            </div>';
//            //echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.'</h2>
//             // <h4 style="    font-family: pt !important;">Displaying '.$u.'  hand picked villas in your search </h4><br></div>';
//        }
//        else
//        {
//            
//                //echo '<div style="margin-left:15px;"><h2 style="margin-top: -25px;">'.$textH2.' </h2>
//              //<h4 style="    font-family: pt !important;">Displaying '.$nn.'  hand picked villas in your search </h4><br></div>';
//        }
        
              
        
              
                        
    
    

    
function slide_photo($photo,$i)
{
    //echo '***************'.$photo[0]['img'];
    echo '<div id="caro-'.$i.'" class="carousel slide" data-ride="carousel" data-interval="false">';
        echo '<!-- Indicators -->';
        echo '<ol class="carousel-indicators">';
        for($a=0;$a<count($photo);$a++)
        {
            $acc = ($a==0)?'active':'';
            if($a<=2)
            {
                echo '<li data-target="#caro-'.$i.'" data-slide-to="'.$a.'" class="'.$acc.'"></li>';
            }
        }
        echo '</ol>';
        
        echo '<!-- Wrapper for slides -->';
        echo '<div class="carousel-inner" role="listbox">';
        $b=0;
            foreach($photo as $img)
            {
                //echo '***************'.$img['img'];
                $actt = ($b==0)?'active':'';
                if($b<=2)
                {
                    echo '<div class="item '.$actt.'">';
                        echo '<img src="'.$img['img'].'" alt="" class="img-responsive">';
                    echo '</div>';
                }
                
                $b++;
                
            }
        echo '</div>';
        
        echo '<!-- Controls -->';
        echo '<a class="left carousel-control" href="#caro-'.$i.'" role="button" data-slide="prev">';
        echo '</a>';
        echo '<a class="right carousel-control" href="#caro-'.$i.'" role="button" data-slide="next">';
        echo '</a>';
    echo '</div>';
}

    
    
 function string_len($text,$amount)
{
    if(strlen($text)>$amount)
    {
        return substr($text,0,$amount).'...';
    }
    else
    {
        return $text;
    }
}
?>
<script>
$(document).ready(function(e) {
    $(".lazy").lazyload();
});
</script>