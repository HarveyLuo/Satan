<?php
class tpl{
	public static function dataTpl($url, $data=''){
		$cache_md5 = DATA . 'cache/md5/' . md5($url);
		$data_md5 = '<?xml version=\'1.0\' encoding=\'utf-8\'?>
	<object>
		<value>' . md5($data) . '</value>
	</object>';
	
		if(fileDetact::pdwj($cache_md5 . '.xml')){
			$jd_md5 = fileDetact::xml($cache_md5);
			$value = $jd_md5->value;
			if(md5($data) != $value){
				fileDetact::cjwj($url . '.php', self::dataTh($data));
				fileDetact::cjwj($cache_md5 . '.xml', $data_md5);
			}
		}else{
			fileDetact::cjwj($url . '.php', self::dataTh($data));
			fileDetact::cjwj($cache_md5 . '.xml', $data_md5);
		}
	}
	public static function dataTh($data){
		return preg_replace(
			array(
				"/\<\!\-\-\#(.*?)\#\-\-\>/is",
				"/\<\-\#(.*?)\#\-\>/is",
				"/\<\%(.*?)\%\>/is",
				"/\@site\:(.*?)\-\>/is",
				"/\@theme\:(.*?)\-\>/is",
				"/\{@url\:(.*?)\/(.*?)\/(.*?)\}/is",
				"/\{@(.*?)\/\}/is",
			),
			array(
				"<?php \\1?>",
				"<?php \\1?>",
				"<?php \\1?>",
				G::site('base') . "/res/\\1/",
				G::site('base') . "/control/" . POR . "/res/\\1/",
				G::site('base') . "/\\1.php?m=\\1&c=\\2&a=\\3",
				"<?php echo \\1;?>", 
			),
			self::dataTplqr($data)
		);
	}
	public static function dataTplqr($data){
		return preg_replace(
			"/\<tpl src\=\"(CCT|TPL)\:(.*?)\"\/\>/is",
			"<?php include(tpl::tplby(\\1.G::url('\\2')));?>",
			$data
		);
	}
	
	public static function tplby($url){
		global $getBase;
		self::dataTpl(DATATPL .  POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . md5($url), fileDetact::dqwj($url, 'htm'));
		return DATATPL .  POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . md5($url) . '.php';
	}
}