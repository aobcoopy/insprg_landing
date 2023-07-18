<div class="container">
	<div class="row">
    	<div class="col-md-12">
        	<br><br>
        	<h1>For Authors</h1><br>
        </div>    
            <div class="col-md-3">
            	<ul class="ab_menu">
                	<li onClick="click_me(this,'01')" class="active">Aims & Scope</li>
                    <li onClick="click_me(this,'02')">Calls for Papers & Proposals</li>
                    <li onClick="click_me(this,'03')">Submission</li>
                    <li onClick="click_me(this,'04')">Presentation and Formatting</li>
                    <li onClick="click_me(this,'05')">Tables and Figures</li>
                    <li onClick="click_me(this,'06')">Editorial Policy</li>
                    <li onClick="click_me(this,'07')">Copyright and Permissions</li>
                    <li onClick="click_me(this,'08')">Ethics Policy</li>
                    <li onClick="click_me(this,'09')">Contacts</li>
                </ul>
            </div>

            <div class="col-md-9">
            	<div class="a_01 a_show">
                	<?php include "FA_Aims.php";?>
                </div>
                <div class="a_02 a_show disnon">
                	<?php include "FA_Calls_for_Papers.php";?>
                </div>
                <div class="a_03 a_show disnon">
                	<?php include "FA_Submission.php";?>
                </div> 
                <div class="a_04 a_show disnon">
                	<?php include "FA_Presentation_and_Formatting.php";?>
                </div>
                <div class="a_05 a_show disnon">
                	<?php include "FA_Tables_and_Figures.php";?>
                </div>
                <div class="a_06 a_show disnon">
                	<?php include "FA_Editorial_Policy.php";?>
                </div>
                <div class="a_07 a_show disnon">
                	<?php include "FA_copy.php";?>
                </div>
                <div class="a_08 a_show disnon">
                	<?php include "FA_Ethics_Policy.php";?>
                </div>
                <div class="a_09 a_show disnon">
                	<?php include "FA_Contacts.php";?>
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
	
	$('html,body').animate({ 
		scrollTop: $(".a_"+pos+"").offset().top-50
	}, 1000);
}
</script>








