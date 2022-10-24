<?php
defined('_Sdef') or exit();
?>
<?php if(!empty($page)) : ?>
		<div class="article">
			<h2><?php echo $page['title']?></h2>
			<div class="clr"></div>
			<div class="content">
			 	<?php echo $page['text']?>
			 </div>
			  <div class="clr"></div>
		</div>
<?php else :?>
	<h3>Статтей	 нет</h3>
<?php endif;?>