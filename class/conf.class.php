<?php
load::classJz('tpl');
load::jz(CCS . 'G');
class conf extends tpl {
	public function tpl($name='run', $data='') {
		global $getBase;
		$HtmlUrl = implode('/', explode('.', $name));
		tpl::dataTpl(DATATPL . POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . $name, fileDetact::dqwj(CCT . $HtmlUrl, 'htm'));
		include(DATATPL . POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . $name . '.php');
		common::footer();
	}
	public function site(){
		global $getBase;
		$site['base'] = $getBase;
		return $site;
	}
	
	//执行完销毁类
	public function __destruct() {
		unset($this);
	}
	
}