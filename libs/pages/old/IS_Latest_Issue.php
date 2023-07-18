<h2>Latest Issue</h2><br>
<?php
$data = $dbc->GetRecord("article_volumes","*","latest > 0 and status > 0");

if($data['latest']>0)
{
	echo '<a href="'.json_decode($data['files'],true).'"><button class="ab_link" type="button">';
	echo $data['name'];	
	echo ' <i class="fa fa-link" aria-hidden="true"></i></button></a>';
	?>
	<h2>Table of  Content</h2>
	<div class="row">
		<div class="col-sm-12 col-sm-12 col-md-10">
		<?php 
		$sql = $dbc->Query("select * from articles where status > 0 and volumes = '".$data['id']."'");
		while($row = $dbc->Fetch($sql))
		{
			$detail = $row['detail'];
			echo '<div class="col-sm-12 col-sm-12 col-md-12 a_box nopad">';
				echo '<div class="col-sm-12 col-sm-12 col-md-12 a_title nopad">';
					echo '<span class="inside_art">Article</span>';
				echo '</div>';
				echo '<div class="col-sm-12 col-sm-12 col-md-12 a_name nopad">';
					echo '<a href="'.json_decode($row['files'],true).'" class="a_link">'.$detail.'</a>';
				echo '</div>';
				echo '<div class="col-sm-12 col-sm-12 col-md-12 nopad">';
					echo '<i class="fa fa-bookmark ifa" aria-hidden="true"></i> ';
					echo $row['name'];
				echo '</div>';
			echo '</div>	';
		}
		?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2"><img src="<?php echo json_decode($data['photo'],true);?>" width="100%" class="cover_book"></div>
	</div>
<?php
}
else
{
	?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fa fa-info-circle" aria-hidden="true"></i>
 Coming soon!</strong> Content is under construction.
    </div>
    <?php
}
?>
