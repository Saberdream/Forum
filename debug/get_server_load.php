<?php
// require '../includes/functions.php';

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();

function get_server_load() {
    if (stristr(PHP_OS, 'win')) 
    {
        $wmi = new COM('Winmgmts://');
        $server = $wmi->execquery('SELECT LoadPercentage FROM Win32_Processor');  
        $cpu_num = 0;
        $load_total = 0;
		
		foreach($server as $cpu) {
			$cpu_num++;
			$load_total += $cpu->loadpercentage;
		}
		
        $load = round($load_total/$cpu_num);
		return (int) $load;
    } 
    else
    {
        $load = sys_getloadavg();
		return (int) $load[0]*100;
    }
}

$load = get_server_load();

$time_end = microtime_float();
$time = $time_end - $time_start;

print '<p>'.$load.'%</p>';

if($load > 5)
	print '<p>load limit exceeded 5%</p>';

print '<p>execution time: '.$time.' s</p>';