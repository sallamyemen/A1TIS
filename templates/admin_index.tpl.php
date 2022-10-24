<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>

<!--<META name="keywords" content="<?php echo $keywords;?>" />
<META name="description" content="<?php echo $description;?>" />-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo $uri;?>templates/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $uri;?>templates/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo $uri;?>templates/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $uri;?>templates/js/script.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize_admin">
      <div class="menu_nav">
       <?php echo $menu;?>
      </div>
      <div class="logo">
        <h1><a href="index.html"><span>Brightpulse</span> <small>Company Slogan Here</small></a></h1>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      
      <? if(!empty($_SESSION['slim.flash']['error'])) :?>
		<div class="msg_error">
			<?php echo $flash['error'] //$_SESSION['slim.flash']['error'] ;?>
		</div>	
	<?php endif;?>
	
	<? if(!empty($_SESSION['slim.flash']['msg'])) :?>
		<div class="msg">
			<?php echo $_SESSION['slim.flash']['msg'] ;?>
		</div>	
	<?php endif;?>
	
	
      <div class="admin_mainbar">
        <?php echo $mainbar;?>
      </div>
     <!-- <div class="sidebar">
        <?php echo $sidebar;?>
      </div>-->
      <div class="clr"></div>
    </div>
  </div>
  
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">Copyright &copy; <a href="#">Domain Name</a>. All Rights Reserved</p>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
</body>
</html>
