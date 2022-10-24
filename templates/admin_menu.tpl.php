<ul>
	<?php if(!empty($pages) && is_array($pages)) :?>
		<?php foreach($pages as $page) :?>
			<li><a href="<?php echo $page['url'];?>"><span><?php echo $page['name']?></span></a></li>
		<?php endforeach;?>
	<?php endif;?>
</ul>