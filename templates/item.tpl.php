<?php
defined('_Sdef') or exit();
?>
<?php if(!empty($item)) : ?>
		<div class="article">
			<h2><?php echo $item['title']?></h2>
			<p class="infopost">Опубликовано: <span class="date"><?php echo date('d M Y',$item['date'])?></span> &nbsp;&nbsp;&bull;&nbsp;&nbsp; <a href="<?php echo $app->urlFor('category',array('alias' => $item['alias_cat']))?>"><?php echo $item['category']?></a></p>
			<div class="clr"></div>
			 <div class="img"><img src="<?php echo $uri;?>/<?php echo FILES;?>img1.jpg" width="156" height="207" alt="" class="fl" /></div>
			 <div class="post_content">
			 	<?php echo $item['fulltext']?>
			 </div>
			  <div class="clr"></div>
		</div>
<?php else :?>
	<h3>Статтей	 нет</h3>
<?php endif;?>