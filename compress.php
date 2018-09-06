<?php
	/*
	name:PHP代码压缩
	author:xiaoz.me
	QQ:337003006
	update:2018-09-06
	*/

	//扫描当前目录
	$arr = scandir("./");
	foreach ($arr as $value) {
		//获取文件后缀
		$suffix = explode(".",$value);
		$suffix = end($suffix);
		$suffix = strtolower($suffix);

		if($suffix == 'php'){
			if($value == 'compress.php'){
				continue;
			}
			//压缩代码
			$content = php_strip_whitespace($value);
			//覆盖文件
			$myfile = fopen($value,"w") or die("Unable to open file!");
			fwrite($myfile, $content);
			fclose($myfile);

			echo $value."已压缩！<br />";
		}
        else{
	        continue;
        }
    }
?>