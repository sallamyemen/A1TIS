<div class="article">
	<h2><?php echo $title;?></h2>
	<div class="clr"></div>
	<form action="<?php echo $url;?>" method="post" id="sendemail">
		<ol>
			<li>
				<label for="name">Логин</label>
				<input id="name" name="name" class="text" />
			</li>
			<li>
				<label for="password">Пароль</label>
				<input type="password" id="password" name="password" class="text" />
			</li>
			<li>
				<input type="submit" name="login" value="Вход" class="send" />
				<div class="clr"></div>
			</li>
		</ol>
	</form>
</div>