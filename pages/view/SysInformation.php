<?php
$load = sys_getloadavg();
echo "System Load in last minite: ".$load[0]."<br>";
echo "System Load in last 5 minite: ".$load[1]."<br>";
echo "System Load in last 15 minite: ".$load[2]."<br>";
echo "System memory usage: ".memory_get_usage()."<br>";