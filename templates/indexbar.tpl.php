<?php
defined('_Sdef') or exit();
?>
<?php if(!empty($items) && is_array($items)) : ?>
	<?php foreach($items as $item) :?>
		<div class="article">
			<h2><?php echo $item['title']?></h2>
			
	<p class="infopost">Опубликовано:<span class="date"><?php echo date('d M Y',$item['date'])?></span> &nbsp;&nbsp;&bull;&nbsp;&nbsp; <a href="<?php echo $app->urlFor('category',array('alias' => $item['alias_cat']))?>"><?php echo $item['category']?></a></p>
			<div class="clr"></div>
<div class="img"><img src="<?php echo $uri.FILES;?>thumb/<?php echo $item['images']->img?>" width="156" height="207" alt="" class="fl" /></div>
			 <div class="post_content">
			 	<?php echo $item['introtext']?>
	<p class="spec"><a href="<?php echo $app->urlFor('item',array('alias' => $item['alias']))?>" class="rm">Read more</a></p>
			 </div>
			  <div class="clr"></div>
		</div>
	<?php endforeach;?>
	
	
	<? if($navigation) :?>
							<br />
							<ul class="pager">
								<? if($navigation['first']) :?>
									<li class="first">
										<a href="<?php echo $app->urlFor('home')?>">Первая</a>
									</li>
								<? endif; ?>
								
								<? if($navigation['last_page']) :?>
									<li>
										<a href="<?php echo $app->urlFor('home',array('page' => $navigation['last_page']));?>">&lt;</a>
									</li>
								<? endif; ?>
								
								<? if($navigation['previous']) :?>
									<? foreach($navigation['previous'] as $val) :?>
										<li>
											<a href="<?php echo $app->urlFor('home',array('page'=>$val));?>"><?php echo $val;?></a>
										</li>
									<? endforeach; ?>
								<? endif; ?>
							
							<? if($navigation['current']) :?>
									<li>
										<span><?php echo $navigation['current'];?></span>
									</li>
								<? endif; ?>
								
							<? if($navigation['next']) :?>
									<? foreach($navigation['next'] as $v) :?>
										<li>
											<a href="<?php echo $app->urlFor('home',array('page'=>$v));?>"><?php echo $v;?></a>
										</li>
									<? endforeach; ?>
								<? endif; ?>
							<? if($navigation['next_pages']) :?>
									<li>
										<a href="<?php echo $app->urlFor('home',array('page'=>$navigation['next_pages']));?>">&gt;</a>
									</li>
								<? endif; ?>	
								
							<? if($navigation['end']) :?>
									<li class="last">
										<a href="<?php echo $app->urlFor('home',array('page'=>$navigation['end']));?>">Последняя</a>
									</li>
								<? endif; ?>		
									
							</ul>
							<? endif;?>
	
	
<?php else :?>
	<h3>Статтей	 нет</h3>
<?php endif;?>