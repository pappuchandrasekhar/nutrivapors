<?php
class ImageClass
{

	function rand_uniq_code($echo=false) 
	{
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
		$password = '';
		
		for($i = 0;$i <= 10;$i++)
		{
			$num = rand() % 61;
			$tmp = substr($string, $num, 1);
			$password = $password.$tmp;
		}
		return $password;
	}
	
	function create_image_byoriginal($srcpath,$dir,$width,$height)
	{
	
		if(!is_dir($dir)) { mkdir($dir); }
	
		if(!empty($srcpath))
		{
			$target_path = $srcpath;

			$slashpos = strrpos($target_path,"/");
			
			$filename = substr($target_path,$slashpos+1);

			$extension = substr($filename,strrpos($filename,".") +1);
		
			$imgdir = $dir."/";
			
			if($extension == 'jpg' || $extension == 'JPG')
			{
				$src_img = imagecreatefromjpeg($target_path);
			}
			if($extension == 'gif' || $extension == 'GIF')
			{
				$src_img = imagecreatefromgif($target_path);
			}
			if($extension == 'png' || $extension == 'PNG')
			{
				$src_img = imagecreatefrompng($target_path);
			}
			if($extension == 'jpeg' || $extension == 'jpeg')
			{
				$src_img = imagecreatefromjpeg($target_path);
			}

			$size = getimagesize($target_path);
			$old_x = $size[0];
			$old_y = $size[1];
	
			$dst_img = imagecreatetruecolor($width,$height);
		
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$width,$height,$old_x,$old_y);
			
			if(($extension == 'jpg') || ($extension == 'JPG')){
					$upimg = imagejpeg($dst_img, $imgdir.$filename,90);
			}else if(($extension == 'gif') || ($extension == 'GIF')){
					$upimg = imagegif($dst_img, $imgdir.$filename,90);
			}else if(($extension == 'png') || ($extension == 'PNG')){
					$upimg = imagepng($dst_img, $imgdir.$filename,1);
			}else if(($extension == 'jpeg')|| ($extension == 'JPEG')){
					$upimg = imagejpeg($dst_img, $imgdir.$filename,90);
			}
			$imageparameter = array(status=>$upimg,filename=>$filename);
		 }
		 else
		 {
		 	$imageparameter = array(status=>1,filename=>'');
		 }
		return $imageparameter;
	}
	function upload($filetagname='', $dir='')
	{	
		if(is_dir($dir))
			$dir=$dir;
		else
			mkdir($dir);

		$rand = $this->rand_uniq_code();
		$rand .= $this->rand_uniq_code();
		
		$uplfilename = $_FILES[$filetagname]['name']; 
		
		$path_info = pathinfo($uplfilename);
		$extension = $path_info['extension'];
		
		$randcode = time().$rand.'.'.$extension;
		$filename = $randcode;
		
		$from = $_FILES[$filetagname]['tmp_name']; 
		$imguploaded = move_uploaded_file($from, $dir."/".$filename);
		
		$imageres = array(status=>$imguploaded, filename=>$filename);
		
		return $imageres;
	}
	function upload_add_image($filetagname='')
	{
		$rand = $this->rand_uniq_code();
		$rand .= $this->rand_uniq_code();
		
		$uplfilename = $_FILES[$filetagname]['name']; 
		
		$path_info = pathinfo($uplfilename);
		
		$extension = $path_info['extension'];
		$original = $path_info['basename'];
		
		$randcode = uniqid().$rand.'.'.$extension;
		$filename = $randcode;
		
		$from = $_FILES[$filetagname]['tmp_name']; 
		 
		$imguploaded = move_uploaded_file($from,CMS_UPLOADS_ROOT."/adds/original/".$filename);			
		
		$imageres = array(status=>$imguploaded,filename=>$filename,orig=>$original);
		$this->create_image_byoriginal(CMS_UPLOADS_ROOT."/adds/original/".$filename,CMS_UPLOADS_ROOT.'/adds/thumbs',223,102);

		return $imageres;
	}
	
	
	function watermarkImage($SourceFile, $WaterMarkText, $DestinationFile, $filename)
	{
		list($width, $height) = getimagesize($SourceFile);
		$image_p = imagecreatetruecolor($width, $height);
		
		$extension = substr($filename,strrpos($filename,".") +1);
		
		if($extension == 'jpg' || $extension == 'JPG')
		{
			$image = imagecreatefromjpeg($SourceFile);
		}
		if($extension == 'gif' || $extension == 'GIF')
		{
			$image = imagecreatefromgif($SourceFile);
		}
		if($extension == 'png' || $extension == 'PNG')
		{
			$image = imagecreatefrompng($SourceFile);
		}
		if($extension == 'jpeg' || $extension == 'jpeg')
		{
			$image = imagecreatefromjpeg($SourceFile);
		}
		

		
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
		
		$black = imagecolorallocate($image_p, 255, 255, 255);
		$font = "arial.ttf";
		$font_size = 45;
		imagettftext($image_p, $font_size, 0, 10, 50, $black, $font, $WaterMarkText);
		
		
		if($extension == 'jpg' || $extension == 'JPG')
		{
			imagejpeg ($image_p, $DestinationFile, 100);
		}
		if($extension == 'gif' || $extension == 'GIF')
		{
			imagegif ($image_p, $DestinationFile, 100);
		}
		if($extension == 'png' || $extension == 'PNG')
		{
			imagepng ($image_p, $DestinationFile, 100);
		}
		if($extension == 'jpeg' || $extension == 'jpeg')
		{
			imagejpeg ($image_p, $DestinationFile, 100);
		}
		imagedestroy($image);
		imagedestroy($image_p);
	}
} 
?>
