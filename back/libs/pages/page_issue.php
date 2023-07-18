<div class="container">
	<div class="row">
    	<div class="col-sm-12 col-sm-12 col-md-12">
        	<br><br>
        	<h1>Issue & Articles</h1><br>
        </div>    
            <div class="col-sm-12 col-sm-12 col-md-3">
            	<ul class="ab_menu">
                	<li onClick="click_me(this,'01')" class="active">Latest Issue</li>
                    <li onClick="click_me(this,'02')">Open Access Articles</li>
                    <li onClick="click_me(this,'03')">Most Cited Articles</li>
                </ul>
            </div>

            <div class="col-sm-12 col-sm-12 col-md-9">
            	<div class="a_01 a_show">
                	<?php include "IS_Latest_Issue.php";?>
                </div>
                <div class="a_02 a_show disnon">
                	<?php include "IS_Open_Access_Articles.php";?>
                </div>
                <div class="a_03 a_show disnon">
                	<?php include "IS_Most_Cited_Articles.php";?>
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








