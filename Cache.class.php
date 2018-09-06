<?php
	/*
	name:PHP文件缓存类
	author:xiaoz.me
	QQ:337003006
	update:2018-09-06
	*/
	//设置缓存路径
	define('CPATH', './caches');
	//检查缓存目录是否存在
	if(!is_dir(CPATH)){
		mkdir(CPATH,0777,true);
	}
	
	class Cache{
		//生成缓存
		function create($key,$cacheTime,$content){
			//完整的缓存路径
			$fullpath = CPATH.'/'.$key;

			//获取缓存文件时间
			@$fileTime = filemtime($fullpath);
			@(int)$fileTime = date("YmdHi",$fileTime);
			//获取当前时间
			(int)$theTime = date("YmdHi",time());
			//计算时间差
			$timeDiff = $theTime - $fileTime;

			//缓存过期了，重新生成
			if((!file_exists($fullpath)) || ($timeDiff > $cacheTime)){
				$myfile = fopen($fullpath,"w") or die("Unable to open file!");
				fwrite($myfile, $content);
				fclose($myfile);
			}
			//读取缓存
			$myfile = fopen($fullpath,"r") or die("Unable to open file!");
			@$cacheContent = fread($myfile,filesize($fullpath));
			fclose($myfile);

			//返回文件内容
			return $cacheContent;
		}
		//删除缓存
		function delete($key = 'all'){
			//删除所有缓存文件
			if($key == 'all'){
				$cachedir = CPATH;

	            $arr = scandir($cachedir);

	            foreach ($arr as $value) {
	                if(($value == 'index.html') || ($value == '.') || ($value == '..')){
	                    continue;
	                }
	                @unlink($cachedir.'/'.$value);
	            }
			}
			//删除单个缓存
			else{
				//完整的缓存路径
				$fullpath = CPATH.'/'.$key;
				@unlink($fullpath);
			}
		}
		//刷新缓存
		function flush($key,$cacheTime,$content){
			//先删除缓存
			$this->delete($key);
			//然后重新生成缓存
			$this->create($key,$cacheTime,$content);
		}
		//读取缓存
		function get($key){
			$myfile = fopen($fullpath,"r") or die("Unable to open file!");
			@$cacheContent = fread($myfile,filesize($fullpath));
			fclose($myfile);

			return $cacheContent;
		}
	}
?>