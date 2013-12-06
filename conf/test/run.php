<?php
	return '<?php
load::classJz(\'conf\');
class run extends conf {
	public function runAction() {
		$this->tpl(\'run\', NULL);
	}
}';