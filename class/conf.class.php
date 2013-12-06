<?php
load::classJz('tpl');
class conf extends tpl {
	public function tpl($name='run', $data='') {
		global $getBase;
		tpl::dataTpl(DATATPL . POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . $name, fileDetact::dqwj(CCT . $name, 'htm'));
		include(DATATPL . POR . '.M.' . $getBase['m'] . '.C.' . $getBase['c'] . '.A.' . $getBase['a'] . '.V.' . $name . '.php');
		load::classJz('common');
		common::footer();
	}
	public function site(){
		global $getBase;
		$site['base'] = $getBase;
		return $site;
	}
	
}