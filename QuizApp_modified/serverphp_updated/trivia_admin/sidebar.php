<?php
include("linkvars.php");
$cur_page_arr = explode("/", $_SERVER['PHP_SELF']);
$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
?>
<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <!-- Logo (221px wide) -->
        <a href="#"><img id="logo" src="images/logo.png" width="221" alt="<?= $SITE_NAME ?>" /></a>
        <!-- Sidebar Profile links -->
        <div id="profile-links">
            Hello, <a href="#" title="Edit your profile"><?php echo $Adm_Fname; ?> <?php echo $Adm_Lname; ?></a><br />
            <a target="_blank" href="../" title="View the Site">View the Site</a> | <a href="logout.php" title="Sign Out">Sign Out</a>
        </div>        
        <ul id="main-nav">  <!-- Accordion Menu -->
            <li>
                <a href="dashboard.php" class="nav-top-item no-submenu <?= $cur_page == 'dashboard.php' ? 'current' : '' ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
                    Dashboard
                </a>       
            </li>
            <?php
            if (isset($main_menu) && is_array($main_menu) && count($main_menu) > 0) {
                $m_main_menu = 1;
                foreach ($main_menu as $k => $v) {
                    ?>
                    <li> 
                        <a href="<?= $v[1] ?>" class="nav-top-item <?= $top_menu_class ?> 
                           <?php
                           $i = 0;
                           $j = count($v[2]);
                           for ($j; $j >= 0; $j--) {
                               if ($v[2][$i][1] == $cur_page || $v[2][$i][2] == $cur_page) {
                                   echo ' current';
                               }
                               $i++;
                           }
                           ?>
                           "> <!-- Add the class "current" to current menu item -->
                               <?= $v[0] ?>
                        </a>    
                        <?php
                        if (isset($v[2]) && is_array($v[2]) && count($v[2]) > 0) {
                            echo "<ul>";
                            foreach ($v[2] as $k1 => $v1) {
                                ?>	
                            <li><a <?= $cur_page == $v1[2] || $cur_page == $v1[1] ? 'class="current"' : '' ?> 
                                    href="<?= $v1[1] ?>"><?= $v1[0] ?></a></li>
                                <?php
                            }
                            echo "</ul>";
                        }
                        ?>

                    </li>
                    <?php
                    $m_main_menu++;
                }
            }
            ?>
        </ul> <!-- End #main-nav -->
        <!-- Start #messages -->
        <!-- End #messages -->
    </div></div>