<ul>
	<?php if(!empty($pages) && is_array($pages)) :?>
		<?php foreach($pages as $page) :?>
			<?php if($page['active']) : ?>
				<li class="active"><a href="<?php echo $page['url'];?>"><span><?php echo $page['title']?></span></a></li>
			<?php else :?>
				<li><a href="<?php echo $page['url'];?>"><span><?php echo $page['title']?></span></a></li>
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
</ul>