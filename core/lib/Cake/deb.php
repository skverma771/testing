<?php
function dd($data){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
        exit;
}
function pd($data, $bt= false, $e=false){
	echo "<pre>";
	var_dump($data);
	if ($bt) echo bt();// debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
	echo "</pre>";
	if($e) exit;
}

function te($data, $tr=false){
if($tr)	trigger_error(bt(), E_USER_WARNING);
	trigger_error(print_r($data, true), E_USER_WARNING);
}
function bt(){
	$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
	$str = [];
	foreach ($bt as $c){
		$line = $c['class'] ?? "";
		$line.= $c['type'] ?? "";
		$line.= $c['function'];
		$line.= " ".($c['file'] ?? "" )."(".( $c['line'] ?? "" ).")";
		$str[] = $line;
	}
	return implode("\n",$str);
}

?>
