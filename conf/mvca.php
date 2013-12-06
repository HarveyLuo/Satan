<?php
//获取m
if (!empty($_GET['m'])) {
	$m = $_GET['m'];
} else if (!empty($_GET['M'])) {
	$m = $_GET['M'];
} else {
	$m = 'run';
}
//获取c
if (!empty($_GET['c'])) {
	$c = $_GET['c'];
} else if (!empty($_GET['C'])) {
	$c = $_GET['C'];
} else {
	$c = 'run';
}
//获取a
if (!empty($_GET['a'])) {
	$a = $_GET['a'];
} else if (!empty($_GET['A'])) {
	$a = $_GET['A'];
} else {
	$a = 'run';
}
return array(
	'm' => $m,
	'c' => $c,
	'a' => $a,
);