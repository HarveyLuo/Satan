<?php
// # 加载核心文件
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Satan' . DIRECTORY_SEPARATOR . 'Core.php';

// # 初始化框架
\Core::init();

// # 是否是多个应用运行模式 <true|default=true>
\Boot\Define::$isApps= true;

// # 目录配置后面必须带有目录分割符
// # 各个目录单独配置，支持自定义相关目录位置

// # 定义框架目录 <可选>
\Boot\Define::$core  = dirname(__FILE__) . \Boot\Define::$_ . 'Satan' . \Boot\Define::$_;

// # 定义APP项目目录 <可选>
\Boot\Define::$app   = dirname(__FILE__) . \Boot\Define::$_ . 'Application' . \Boot\Define::$_;

// # 定义是否开启debug（是否开启开发者模式），默认关闭 <可选>
\Boot\Define::$debug = true;

// # 更多配置请查看框架目录/Boot/Define.php

// #运行项目
\Core::run();

// END
