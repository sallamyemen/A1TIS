<?php
defined('_Sdef') or exit();
?>
<?php if(!empty($items) && is_array($items)) : ?>
<table style="width:100%">
	<thead>
		<th>Заголовок</th>
		<th>Категория</th>
		<th>Дата</th>
		<th>Действие</th>
	</thead>
	
	<tbody>
	<?php foreach($items as $item) :?>
		<tr>
		
			<td><a href="<?php echo $app->urlFor('aitem_edit',array('id' => $item['id']))?>" class="rm"><?php echo $item['title']?></a></td>
			<td style="text-align: center"><?php echo $item['category']?></td>
			<td  style="text-align: center"><?php echo date('d M Y',$item['date'])?></td>
			
			<td style="text-align: center">
				
		<form action="<?php echo $app->urlFor('aitem_edit',array('id'=>$item['id']));?>" method="post">
		    <input type="hidden" name="_METHOD" value="DELETE"/>
		    <input type="submit" value="Delete"/>
		</form>
		
			</td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>	
	<? if($navigation) :?>
							<br />
							<ul class="pager">
								<? if($navigation['first']) :?>
									<li class="first">
										<a href="<?php echo $app->urlFor('aitems')?>">Первая</a>
									</li>
								<? endif; ?>
								
								<? if($navigation['last_page']) :?>
									<li>
										<a href="<?php echo $app->urlFor('aitems',array('page' => $navigation['last_page']));?>">&lt;</a>
									</li>
								<? endif; ?>
								
								<? if($navigation['previous']) :?>
									<? foreach($navigation['previous'] as $val) :?>
										<li>
											<a href="<?php echo $app->urlFor('aitems',array('page'=>$val));?>"><?php echo $val;?></a>
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
											<a href="<?php echo $app->urlFor('aitems',array('page'=>$v));?>"><?php echo $v;?></a>
										</li>
									<? endforeach; ?>
								<? endif; ?>
							<? if($navigation['next_pages']) :?>
									<li>
										<a href="<?php echo $app->urlFor('aitems',array('page'=>$navigation['next_pages']));?>">&gt;</a>
									</li>
								<? endif; ?>	
								
							<? if($navigation['end']) :?>
									<li class="last">
										<a href="<?php echo $app->urlFor('aitems',array('page'=>$navigation['end']));?>">Последняя</a>
									</li>
								<? endif; ?>		
									
							</ul>
							<? endif;?>
	
<a href="<?php echo $app->urlFor('aitem_add');?>">Новый материал</a>
	
<?php else :?>
	<h3>Статтей	 нет</h3>
<?php endif;?>