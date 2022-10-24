<div class="article">
          <h2><?php echo $title;?></h2>
          <div class="clr"></div>
          <form enctype="multipart/form-data" action="<?php echo $url;?>" method="post">
            <ol>
              <li>
                <label for="title">Заголовок</label>
                <input id="title" name="title" class="text" value="<?php echo $post['title']?>" />
				
				<input type="hidden" id="id" name="id" value="<?php echo $post['id']?>" />
              </li>
              <li>
                <label for="keywords">Ключевые слова</label>
                <input id="keywords" name="keywords" class="text" value="<?php echo $post['keywords']?>" />
              </li>
			  <li>
                <label for="description">Ключевые слова</label>
                <input id="description" name="description" class="text" value="<?php echo $post['description']?>" />
              </li>
			  <li>
                <label for="alias">Псевдоним</label>
                <input id="alias" name="alias" class="text" value="<?php echo $post['alias']?>" />
              </li>
			  
              <li>
                <label for="introtext">Ввводный текст</label>
                <textarea id="introtext" name="introtext" rows="8" cols="50"><?php echo $post['introtext']?></textarea>
              </li>
              <li>
                <label for="fulltext">Полный текст</label>
                <textarea id="fulltext" name="fulltext" rows="8" cols="50"><?php echo $post['fulltext']?></textarea>
              </li>
			  <li>
                <label for="id_cat">Категория</label>
                <select id="id_cat" name="id_cat" rows="8" cols="50">
					<?php foreach($categories as $category) :?>
						<?php if($category['id'] == $post['id_cat']) :?>
							<option selected="selected" value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
						<?php else :?>
							<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
						<?php endif;?>
					<?php endforeach;?>
				</select>
              </li>
			  
			   <li>
                <label for="images">Изображения</label>
                <input id="images" name="images" type="file" />
                <br />
                <br />
               <?php if(!empty($post['images'])) :?>
      <input  name="tmp_images" type="hidden" value="<?php echo $post['images']->img;?>" />
                	<img src="<?php echo $uri.FILES;?>/thumb/<?php echo $post['images']->img;?>">
                <?php endif; ?>
              </li>
			  
              <li>
                <input type="submit"   class="send" value="Отправить" />
                <div class="clr"></div>
              </li>
            </ol>
          </form>
        </div>
		
		<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('introtext');
                CKEDITOR.replace('fulltext');
            </script>
		