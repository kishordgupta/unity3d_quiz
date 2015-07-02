<?php
	include("linkvars.php");
	$cur_page_arr = explode("/",$_SERVER['PHP_SELF']);
	$cur_page = $cur_page_arr[count($cur_page_arr)-1];
?>	
	
<ul class="shortcut-buttons-set">
<?php 
	if (isset($main_menu) && is_array($main_menu) && count ($main_menu) > 0)
	{	
		$m_main_menu=1;
		foreach ($main_menu as $k=>$v)
		{
		?>
        	<li><a class="shortcut-button" href="<?=$v[1]?>"><span style=" 
			<?php 	
				$i=0;
				$j= count($v[2]);
				for($j; $j>=0;$j--)
				{ 
					if($v[2][$i][1]==$cur_page || $v[2][$i][2]==$cur_page)
					{
						echo ' background:#e5e5e5';
					}
					$i++;
				}
				
			?>
			<? //$mainmenu==$m_main_menu?'':''?>">
				<img src="<?=$v[3]?>" alt="icon" width="75" height="75" /><br /><?=$v[0]?></span></a>
            </li>
		<?php
		$m_main_menu++;
		}
	}
	?>
</ul>