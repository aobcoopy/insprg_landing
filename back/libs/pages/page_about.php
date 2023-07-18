<div class="container">
	<div class="row">
    	<div class="col-12">
        	<br><br>
        	<h1>About</h1><br>
        </div>    
            <div class="col">
            	<ul class="ab_menu">
                	<li onClick="click_me(this,'01')" class="active">Editorial Board</li>
                    <li onClick="click_me(this,'02')">Editorial Team</li>
                    <li onClick="click_me(this,'03')">News</li>
                    <li onClick="click_me(this,'04')">IJMBE Fact Sheet</li>
                    <li onClick="click_me(this,'05')">Connect with us</li>
                </ul>
            </div>
            
            <div class="col-9">
            	<div class="a_01 a_show">
                	<?php include "about_Editorial_Board.php";?>
                </div>
                <div class="a_02 a_show disnon">
                	<?php include "about_Editorial_Team.php";?>
                </div>
                <div class="a_03 a_show disnon">
                	<?php include "about_News.php";?>
                </div>
                <div class="a_04 a_show disnon">
                	<?php include "about_IJMBE_Fact_Sheet.php";?>
                </div>
                <div class="a_05 a_show disnon">
                	<?php include "about_Connect_with_Us.php";?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function click_me(me,pos)
{
	$(".ab_menu").children("li").removeClass("active");
	$(me).addClass("active");
	
	$(".a_show").hide();
	$(".a_"+pos).fadeIn(500);
}
</script>



