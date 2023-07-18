
<!doctype html><html><head> <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

<?php 
    //$url_link = "http://" . $_SERVER['SERVER_NAME'] . "/";
	$url_link = "http://127.0.0.1:8124/back/";
    $app = isset($_REQUEST['app'])?$_REQUEST['app']:"dashboard";
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="msvalidate.01" content="E38E748C2673AE382D71A04F846950AF" />
    
    <meta property="og:title" content="back - IJMBE.com"/>
    
    <title>Bsck - IJMBE.com</title>    

    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="apple-touch-icon" href="icon.jpg">
    <link href="<?php echo $url_link;?>libs/css/bootstrap.min.css" rel="stylesheet"> 
	<link href="<?php echo $url_link;?>libs/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="<?php echo $url_link;?>libs/css/bootstrap-datepicker3.min.css" rel="stylesheet"> 
    <link rel="preload" href="<?php echo $url_link;?>libs/css/datepicker.css" rel="stylesheet">
    
    <!--datatable-->
    <link href="<?php echo $url_link;?>libs/css/datatables/twitter-bootstrap.4.1.3.bootstrap.css" rel="stylesheet"> 
    <link href="<?php echo $url_link;?>libs/css/datatables/1.10.19.dataTables.bootstrap4.min.css" rel="stylesheet"> 
    <!--datatable-->
    
    <link href="<?php echo $url_link;?>libs/css/style.css?v=00000" rel="stylesheet"> 
    
    
    <script src="<?php echo $url_link;?>libs/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $url_link;?>admin.js"></script>
</head>
<body>
<?php //$page=isset($_REQUEST['page'])?$_REQUEST['page']:'home';

if(isset($_SESSION['auth']['user_id']))
{
	include_once "apps/menu.php";
	include "pages/header.php";
	
	switch($app){
		default:
			include "apps/$app/view/index.php";
			break;
	}
}
else
{
	include "pages/header.php";
	include "pages/page_login.php";
}
include "pages/footer.php";
?> 

<script defer src="<?php echo $url_link;?>libs/js/lazyload.min.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo $url_link;?>libs/js/datatables/jquery.dataTables.min.js"></script>-->

<script type="text/javascript" src="libs/ckeditor/ckeditor.js"></script>	
<script type="text/javascript" src="libs/ckeditor/adapters/jquery.js"></script>	


<!--datatable-->
<script src="<?php echo $url_link;?>libs/js/datatables/1.10.19.jquery.dataTables.min.js"></script>
<script src="<?php echo $url_link;?>libs/js/datatables/1.10.19.dataTables.bootstrap4.min.js"></script>
<!--datatable-->
<script src="<?php echo $url_link;?>libs/js/jQuery_sort.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>-->

<!--<script defer src="<?php echo $url_link;?>libs/js/selectFx.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/script.js?v=03"></script> -->
<!--<script defer src="<?php echo $url_link;?>libs/js/star-rating.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/bootstrap-datepicker.js"></script>
<script defer src="<?php echo $url_link;?>libs/js/jssor.slider.mini.js"></script>-->

 </body></html>