# PHPclass
自己写的PHP常用类和一些PHP实用脚本

## Cache.class.php

文件缓存类，使用方法：
```php
<?php
	include_once( 'Cache.class.php' );
	$cache = new Cache;
	#创建一个名为test的缓存，有效期20分钟
	$cache->create('test',20,'测试内容');
?>
```

## compress.php

* PHP代码压缩，将该文件放到站点某个目录，会自动寻找`.php`文件并进行压缩。（无法压缩二级目录下的PHP文件）
* 原理：就是使用`php_strip_whitespace()`函数去掉PHP代码中的注释和多余空格