<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>

<META name="keywords" content="<?php echo $keywords;?>" />
<META name="description" content="<?php echo $description;?>" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo $uri;?>templates/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $uri;?>templates/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo $uri;?>templates/js/script.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="slider">
        <div id="coin-slider"> <a href="#">
        
  <img src="<?php echo $uri;?>templates/images/slide1.jpg" width="960" height="500" alt="" /> </a> </div>
      </div>
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
	
	
      <div class="mainbar">
        <?php echo $mainbar;?>
      </div>
      <div class="sidebar">
        <?php echo $sidebar;?>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Image</span> Gallery</h2>
        <a href="#"><img src="<?php echo $uri;?>templates/images/gal1.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="<?php echo $uri;?>templates/images/gal2.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="<?php echo $uri;?>templates/images/gal3.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="<?php echo $uri;?>templates/images/gal4.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="<?php echo $uri;?>templates/images/gal5.jpg" width="75" height="75" alt="" class="gal" /></a> <a href="#"><img src="<?php echo $uri;?>templates/images/gal6.jpg" width="75" height="75" alt="" class="gal" /></a> </div>
      <div class="col c2">
        <h2><span>Services</span> Overview</h2>
        <p>Curabitur sed urna id nunc pulvinar semper. Nunc sit amet tortor sit amet lacus sagittis posuere cursus vitae nunc.Etiam venenatis, turpis at eleifend porta, nisl nulla bibendum justo.</p>
        <ul class="fbg_ul">
          <li><a href="#">Lorem ipsum dolor labore et dolore.</a></li>
          <li><a href="#">Excepteur officia deserunt.</a></li>
          <li><a href="#">Integer tellus ipsum tempor sed.</a></li>
        </ul>
      </div>
      <div class="col c3">
        <h2><span>Contact</span> Us</h2>
        <p>Nullam quam lorem, tristique non vestibulum nec, consectetur in risus. Aliquam a quam vel leo gravida gravida eu porttitor dui.</p>
        <p class="contact_info"> <span>Address:</span> 1458 TemplateAccess, USA<br />
          <span>Telephone:</span> +123-1234-5678<br />
          <span>FAX:</span> +458-4578<br />
          <span>Others:</span> +301 - 0125 - 01258<br />
          <span>E-mail:</span> <a href="#">mail@yoursitename.com</a> </p>
      </div>
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
