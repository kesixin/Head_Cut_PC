<?php
	error_reporting(0);//禁用错误报告  
	if (IS_POST) {

		header('Content-type:text/html;charset=utf-8');
		$base64_image_content = $_POST['imgBase'];


		//将base64编码转换为图片保存
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
			$type = $result[2];
			$new_file = "./uploads/";
			if (!file_exists($new_file)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0700);
            }
            $img=time() . ".{$type}";
            $new_file = $new_file . $img;
            //将图片保存到指定的位置
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
            	echo 'true';
            }else{
            	echo 'false';
            }
		}else{
			echo 'false';
		}

	}


?>