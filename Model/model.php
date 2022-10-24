<?php 
namespace Model;

defined('_Sdef') or exit();

class Model {
	
	public $driver;
	
	public function __construct() {
		$this->driver = new \Model\Amodel;
	}
	
	public function getPage($alias) {
		$sql = "SELECT `id`,`title`,`text`,`keywords`,`description`
				FROM `".PREF."pages`
				WHERE `alias` = '%s'
				";
		$sql = sprintf($sql, $this->driver->clear_db($alias));		
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);	
		}
		
		if(!$result) {
			return FALSE;
		}		
		
		return $result;
	}	
	
	public function getItem($alias) {
		$sql = "SELECT `".PREF."content`.`id`,`title`,`fulltext`,`images`,`".PREF."categories`.`name` AS `category`,`".PREF."categories`.`alias` AS `alias_cat`,`".PREF."content`.`alias`,`date`,`images`,`keywords`,`description`
				FROM `".PREF."content`
				LEFT JOIN `".PREF."categories` ON `".PREF."categories`.`id` = `".PREF."content`.`id_cat`
				WHERE `".PREF."content`.`alias` = '%s'
				";
		$sql = sprintf($sql, $this->driver->clear_db($alias));			
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);	
		}
		
		if(!$result) {
			return FALSE;
		}		
		
		return $result;
	}
	
	
	
	public function getPages() {
		$sql = "SELECT `id`,`title`,`alias`
				FROM `".PREF."pages`
		";
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if(!$result) {
			return FALSE;
		}
		
		return $result;
		
	}
	
	protected function transliterate($string) {

		$str = mb_strtolower($string,'UTF-8');
		//   привет мир
		
		$glyph_array = array(
			'a' => 'а',
			'b' => 'б',
			'v' => 'в',
			'g' => 'г,ґ',
			'd' => 'д',
			'e' => 'е,є,э',
			'jo' => 'ё',
			'zh' => 'ж',
			'z' => 'з',
			'i' => 'и,і',
			'ji' => 'ї',
			'j' => 'й',
			'k' => 'к',
			'l' => 'л',
			'm' => 'м',
			'n' => 'н',
			'o' => 'о',
			'p' => 'п',
			'r' => 'р',
			's' => 'с',
			't' => 'т',
			'u' => 'у',
			'f' => 'ф',
			'kh' => 'х',
			'ts' => 'ц',
			'ch' => 'ч',
			'sh' => 'ш',
			'shch' => 'щ',
			'' => 'ъ',
			'y' => 'ы',
			'' => 'ь',
			'yu' => 'ю',
			'ya' => 'я',
		);
		
		foreach($glyph_array as $leter => $glyph) {
			$glyph = explode(',',$glyph);
			
			$str = str_replace($glyph,$leter,$str);

		}
		
		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
		$str = trim($str, '-');
		
		return $str;
		
	}
	
	public function deleteItem($id) {
		if(!empty($id)) {
			$sql = "DELETE FROM `".PREF."content` WHERE `id` = ".(int)$id;
			
			if($this->driver instanceof AModel) {
				$result = $this->driver->query($sql,'update');	
			}
			
			if(!$result) {
				return FALSE;
			}		
			
			return $result;
		}
	}
	
	
	public function save($id = FALSE, $post) {
		foreach ($post as $k=>$item) {
			$post[$k] = $this->driver->clear_db($item);
		}
		
		if(empty($post['alias'])) {
			$post['alias'] = $this->transliterate($post['title']);
		}
		
		$alias_bd = $this->getAlias($post['alias']);
		
		if($alias_bd[0]['count'] > 0 && empty($id)) {
			$post['alias'] .= substr((int)microtime(TRUE),-4);//345345345
		}
		
		if(!empty($_FILES['images']['tmp_name'])) {
			
			$img_types = array('jpeg'=>"image/jpeg",
								"pjpeg"=>"image/pjpeg",
								'png' => "image/png",
								'x-png' => "image/x-png",
								'gif' => "image/gif",
								);
			$type_img = array_search($_FILES['images']['type'],$img_types);	
			if(!$type_img) {
				return "Не верный формат файла";
			}
			
if(!move_uploaded_file($_FILES['images']['tmp_name'],PATH.'/'.FILES.$_FILES['images']['name'])) {
				return 'Не удалось загрузить файл';
			}
			
			if(!$this->img_resize($_FILES['images']['name'],$type_img)) {
				return 'Не удалось изменить размер файла';
			}
			
			$post['images'] = json_encode(array('img'=>$_FILES['images']['name']));
							
		}
		else {
			$post['images'] = json_encode(array('img'=>$post['tmp_images']));
		}
		
		if(!$id) {
			$sql = "INSERT INTO `".PREF."content`(
		`title`,`keywords`,`description`,`alias`,`introtext`,`fulltext`,`date`,`id_cat`,`images`)
			VALUES (
				'".$post['title']."','".$post['keywords']."','".$post['description']."','".$post['alias']."','".$post['introtext']."','".$post['fulltext']."','".time()."','".$post['id_cat']."','".$post['images']."'
				)";
				
			if($this->driver instanceof AModel) {
				$result = $this->driver->query($sql,'insert');	
			}
		}
		else {
			///
			$sql = "UPDATE `".PREF."content` SET
									`title`='".$post['title']."',
									`keywords`='".$post['keywords']."',
									`description`='".$post['description']."',
									`alias`='".$post['alias']."',
									`introtext`='".$post['introtext']."',
									`fulltext`='".$post['fulltext']."',
									`date`='".time()."',
									`id_cat`='".$post['id_cat']."',
									`images`='".$post['images']."'
									
						WHERE `id`='$id'";			
			
			if($this->driver instanceof AModel) {
				$result = $this->driver->query($sql,'update');	
			}												
			
		}
		
		if(!$result) {
			return FALSE;
		}
		
		return $result;
		
		
	}
	
	public function img_resize($file_name,$type) {
		
		switch($type) {
			
			case 'jpeg':
			case 'pjpeg':
				$img_id = imagecreatefromjpeg(PATH.'/'.FILES.$file_name);
			break;
			
			case 'png':
			case 'x-png':
				$img_id = imagecreatefrompng(PATH.'/'.FILES.$file_name);
			break;	
			
			case 'gif':
				$img_id = imagecreatefromgif(PATH.'/'.FILES.$file_name);
			break;
		}
		
		$img_width = imageSX($img_id);
		$img_height = imageSY($img_id);
		
		$img_dest_id  = $img_id;
		
		if($img_width > IMG_WIDTH) {
			$k = round($img_width/IMG_WIDTH,2);
		
			$img_mini_width = round($img_width/$k);
			$img_mini_height = round($img_height/$k);
			
			$img_dest_id = imagecreatetruecolor($img_mini_width,$img_mini_height);
			
			
			$result = imagecopyresampled($img_dest_id,
										$img_id,
										0,
										0,
										0,
										0,
										$img_mini_width,
										$img_mini_height,
										$img_width,
										$img_height
											);
		}
		
		
		
		switch($type) {
			
			case 'jpeg':
			case 'pjpeg':
				$img = imagejpeg($img_dest_id,PATH.'/'.FILES.'thumb/'.$file_name,100);
			break;
			
			case 'png':
			case 'x-png':
				$img = imagepng($img_dest_id,PATH.'/'.FILES.'thumb/'.$file_name);
			break;	
			
			case 'gif':
				$img = imagegif($img_dest_id,PATH.'/'.FILES.'thumb/'.$file_name);
			break;
		}
		
		
		imagedestroy($img_id);
		imagedestroy($img_dest_id);
		
		if($img) {
			return TRUE;
		}
		else {
			return FALSE;
		}								
	} 
	
	public function getAlias($alias) {
		$sql = "SELECT COUNT(*) AS `count`
				FROM `".PREF."content`
				WHERE `alias` = '%s'
				";
		$sql = sprintf($sql, $this->driver->clear_db($alias));
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);	
		}
		
		if(!$result) {
			return FALSE;
		}		
		
		return $result;
		
	}
	
	public function getCategory($alias) {
		$sql = "SELECT `id`,`name`
				FROM `".PREF."categories`
				WHERE `alias` = '%s'
		";
		
		$sql = sprintf($sql, $this->driver->clear_db($alias));
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if(!$result) {
			return FALSE;
		}
		
		return $result;
	}
	
	
	
	public function getItems($page,$alias = FALSE) {
		
		$where = $alias ? "`".PREF."content`.`id_cat` = (SELECT id FROM `".PREF."categories` WHERE `alias` = '".$alias."')" : FALSE;
		
		/*$sql = "SELECT `".PREF."content`.`id`,`title`,`introtext`,`images`,`".PREF."categories`.`name` AS `category`,`".PREF."categories`.`alias` AS `alias_cat`,`".PREF."content`.`alias`,`date` FROM `".PREF."content` LEFT JOIN `".PREF."categories` ON `".PREF."categories`.`id` = `".PREF."content`.`id_cat`
		WHERE "`".PREF."content`.`id_cat` = (SELECT id FROM `".PREF."categories` WHERE `alias` = '".$alias."')	
		";*/
		
		$pager = new \Libraries\Pager(
									$page,
									"`".PREF."content`.`id`,`title`,`introtext`,`images`,`".PREF."categories`.`name` AS `category`,`".PREF."categories`.`alias` AS `alias_cat`,`".PREF."content`.`alias`,`date`",
									"`".PREF."content`",
									$where,
									" LEFT JOIN `".PREF."categories` ON `".PREF."categories`.`id` = `".PREF."content`.`id_cat`",
									QUANTITY,
									QUANTITY_LINKS,
									$this->driver
									);							
		$result = array();
		$result['items'] = $pager->get_posts();
		$result['navigation'] = $pager->get_navigation();
									
		return $result;
	}
	
	public function getCategories() {
		$sql = "SELECT `id`,`name`,`alias`
				FROM `".PREF."categories`
		";
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if(!$result) {
			return FALSE;
		}
		
		return $result;
		
	}
	
	public function getItemForEdit($id) {
		$sql = "SELECT *
				FROM `".PREF."content`
				WHERE `id` = '%d'
				";
		$sql = sprintf($sql,(int)$id);		
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if(!$result) {
			return FALSE;
		}
		
		return $result;
		
	}
	
	
	
	
	public function getNews() {
		$sql = "SELECT `id`,`title`,`alias`,`anons`,`date`
				FROM `".PREF."news`
		";
		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if(!$result) {
			return FALSE;
		}
		
		return $result;
		
	}
	
	public function getUserLoginPass($login,$password) {
		$sql = "SELECT `id`
				FROM ".PREF."users
				WHERE `username` = '%s' AND `password` = '%s'
		";
		
		
		$sql = sprintf($sql, $this->driver->clear_db($login),$this->driver->clear_db($password));

		
		if($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);	
		}
	
		if(!$result || count($result) < 1) {
			return FALSE;
		}
		
		return $result;
	}
	
	public function userLogin($id,$sess) {
		$sql_update = "UPDATE ".PREF."users  SET `sess` = '$sess' 
						WHERE `id` = '%d'
						";
		$sql_update = sprintf($sql_update, (int)$id);
		
		if($this->driver instanceof AModel) {
			return $this->driver->query($sql_update,'update');	
		}
		return FALSE;				
	}
	
}