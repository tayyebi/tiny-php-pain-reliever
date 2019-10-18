
<?php
function Shell($inp) {
    $output = shell_exec($inp);
    echo "
    <br/>
    <h1>$inp</h1>
    <br/>
    <pre>$output</pre>
    ";
}

// Date time in Current TimeZone
Shell('date');

// Date Time in UTC
Shell('date -u');

// Date Time Dif
Shell('date +"%Z %z"');

// Check if socket is online
Shell('ps -ef | grep "socket.tayyebi\|anothersocketprogrambytayyebi"');

// Check MySQL Server Status
Shell('systemctl status mysqld');

// Resources
Shell('vmstat -S M');

// Network
Shell('ip -s -h link');

// MySQL general log output
// mysql> show variables where variable_name = 'general_log';
Shell('cat /etc/mysql/mysql.conf.d/mysqld.cnf | grep log-output');

// Disk Free
Shell('df');

// Open ports
Shell('netstat -lntu');

// Port 6161
Shell('netstat -na | grep 6161');

// Firewall
Shell('firewall-cmd --list-all');
?>