<strong>Filter By : </strong><?php
	for ($i=65; $i<=90; $i++)
	{
		$char=chr($i);
?>
                    <a href="<?=$cur_page?>?ord=<?=$char?>&perpage=<?=$perpage?><?= isset($cat_id) ? "&cat=$cat_id" : ''?>">
			<?php
				if($ord==$char)
					echo "<strong>$char</strong>";
				else
					echo $char;
			?>
		</a> | 		
<?php
	}
?>
<a href="<?=$cur_page?>?ord=ALL&perpage=<?=$perpage?><?= isset($cat_id) ? "&cat=$cat_id" : ''?>">ALL</a>