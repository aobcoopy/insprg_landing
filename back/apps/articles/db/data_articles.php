<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();


	$aColumns = array(
		'a.id',
		'v.name',
		'a.name',
		'a.detail',
		'a.status',
		'a.updated',
		'u.name',
		'a.id',
		'a.files',
	);
	$sIndexColumn = "a.id";
	
	$sTable = "articles AS a 
	LEFT JOIN article_volumes AS v ON a.volumes = v.id
	LEFT JOIN users AS u ON a.user = u.id
	";
	$sLimit = "";
	
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ){
		$sLimit = "LIMIT ".$dbc->Escape_String( $_REQUEST['start'] ).", ".
		$dbc->Escape_String( $_REQUEST['length'] );
	}

	if ( isset( $_REQUEST['order'] ) ){
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<count( $_REQUEST['order'] ) ; $i++ ){
			if($_REQUEST['columns'][intval($_REQUEST['order'][$i]['column'])]['orderable']=="true"){
				
				$sOrder .= $aColumns[ intval( $_REQUEST['order'][$i]['column'] ) ]."
				 	".$dbc->Escape_String( $_REQUEST['order'][$i]['dir'] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY " ){
			$sOrder = "";
		}
	}
	//---used-------------------
	$sOrder = " ORDER BY v.name DESC";
	//---used-------------------

	$sWhere = "";
	if ( $_REQUEST['search']['value'] != "" ){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			$sWhere .= $aColumns[$i]." LIKE '%".$dbc->Escape_String( $_REQUEST['search']['value'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	
	if ( isset($_REQUEST['filter'])){
		if ( $sWhere == "" ){
			$sWhere = "WHERE ";
		}else{
			$sWhere .= " AND ";
		}
		$sWhere .= $_REQUEST['filter']." ";
	}
	
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	
	$rResult = $dbc->Query($sQuery) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $dbc->Query( $sQuery) or die(mysql_error());
	$aResultFilterTotal = $dbc->Fetch($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = $dbc->Query( $sQuery)  or die(mysql_error());
	$aResultTotal = $dbc->Fetch($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	
//	 * Output
//	 
	$output = array(
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = $dbc->Fetch( $rResult ) ){
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			/*if($i==3)
			{
				$row[] = base64_decode($aRow[$i],true);
			}
			else*/if($i==5)
			{
				$y = substr($aRow[$i],0,4);
				$m = substr($aRow[$i],5,2);
				$d = substr($aRow[$i],8,2);
				switch($m)
				{
					case'01': $mm = 'Jan';break;
					case'02': $mm =  'Feb';break;
					case'03': $mm =  'Mar';break;
					case'04': $mm =  'Apr';break;
					case'05': $mm =  'May';break;
					case'06': $mm =  'Jun';break;
					case'07': $mm =  'Jul';break;
					case'08': $mm =  'Aug';break;
					case'09': $mm =  'Sep';break;
					case'10': $mm =  'Oct';break;
					case'11': $mm =  'Nov';break;
					case'12': $mm =  'Dec';break;
				}
				$row[] = $d.' / '.$mm.' / '.$y;
			}
			elseif($i==8)
			{
				$row[] = json_decode($aRow[$i],true);
			}
			else
			{
				$row[] = $aRow[$i];
			}
			
			if($i==0)$row["DT_RowId"] = $aRow[$i];
			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
	$dbc->Close();

?>





