<div class="searchform">
          <form id="formsearch" name="formsearch" method="post" action="#">
            <span>
            <input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" value="Search our ste:" type="text" />
            </span>
            <input name="button_search" src="<?php echo $uri; ?>/templates/images/search.gif" class="button_search" type="image" />
          </form>
        </div>
        <div class="clr"></div>
        <?php if(!empty($categories) && is_array($categories)) :?>
        <div class="gadget">
          <h2 class="star">Категории</h2>
          <div class="clr"></div>
          <ul class="sb_menu">
          	<?php  foreach($categories as $category) :?>
          		<li><a href="<?php echo $app->urlFor('category',array('alias'=>$category['alias']));?>"><?php echo $category['name']?></a></li>
          	<?php endforeach;?>
          </ul>
        </div>
        <?php endif;?>
        
        <?php if(!empty($news) && is_array($news)) :?>
        <div class="gadget">
         	<h2 class="star">Новости</h2>
         	<div class="clr"></div>
          	<ul class="ex_menu">
         	<?php foreach($news as $item) :?>
         		<li><a href="<?php echo $app->urlFor('news',array('alias'=>$item['alias']));?>"><?php echo $item['title']?></a><br />
    <div style="color:#665f69;text-align: right;"><?php echo date('d M Y',$item['date'])?></div>
         		<?php echo $item['anons']?>
         			
         		</li>
         	<?php endforeach;?>
         	</ul>
          </div>
        <?php endif;?>