<?php
load::classJz('file/fileDetect');
if(fileDetact::folder('./control/' . POR)) {
	fileDetact::cjml('./control/' . POR);
	fileDetact::cjml('./control/' . POR . '/c');
	fileDetact::cjml('./control/' . POR . '/c/run');
	fileDetact::cjml('./control/' . POR . '/tpl');
	fileDetact::cjml('./control/' . POR . '/res');
	fileDetact::cjml('./control/' . POR . '/SRC');
	fileDetact::cjwj('./control/' . POR . '/install.xml', include(COUNT . 'test/xml.php'));
	fileDetact::cjwj('./control/' . POR . '/c/run/run.class.php', include(COUNT . 'test/run.php'));
	fileDetact::cjwj('./control/' . POR . '/tpl/run.htm', include(COUNT . 'test/run.htm.php'));
}