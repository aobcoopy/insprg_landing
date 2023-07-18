<div class="topline">

</div>

<nav class="navbar navbar-expand-lg navbar-light " style="background-color:#d8eaff;">
    <a class="navbar-brand" href="#">IJMBE.NET</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
			foreach($appli as $menu)
			{
				$li_menu = '';
				if(isset($menu['submenu'])){
					$hassubmenu = true;
					$href="javascript:;";
				}else{
					$hassubmenu = false;
					$href="?app=".$menu['app']."";
				}
				
					if($hassubmenu)
					{
						$li_menu .='<li class="nav-item dropdown">';
							$li_menu .='<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
								$li_menu .= $menu['name'];
							$li_menu .='</a>';
						
							$li_sub = '';
							$li_sub .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
								foreach($menu['submenu'] as $submenu)
								{
									$href="?app=".$submenu['app']."";
									$li_sub .= '<a class="dropdown-item" href="'.$href.'">'.$submenu['name'].'</a>';
								}
							$li_sub .= '</div>';
						$li_menu .= $li_sub;
					}
					else
					{
						$li_menu .='<li class="nav-item">';
							$li_menu .='<a class="nav-link" href="'.$href.'">'.$menu['name'].'</a>';
					}
					
						$li_menu .='</li>';
				echo $li_menu;
			}
			?>
            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User Management---
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Users</a>
                    <a class="dropdown-item" href="#">Group</a>
                </div>
            </li>-->
            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Article Management
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Volumes</a>
                    <a class="dropdown-item" href="#">Articles</a>
                </div>
            </li>-->
            
            
        </ul>
        <?php
		if(isset($_SESSION['auth']['user_id']))
		{
			echo '<button type="button" class="btn btn-danger" onClick="fn.logout();">Logout</button>';
		}
		?>
        <!--<form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>-->
    </div>
</nav>



