# Notes:

# Make the mysql.general_log table MyISAM instead of CSV

# Run the following:

#     CREATE TABLE mysql.general_log_original LIKE mysql.general_log;
#     ALTER TABLE mysql.general_log ENGINE=MyISAM;
#     ALTER TABLE mysql.general_log ADD INDEX (event_time);

# Enable the general log
# Add the following to /etc/my.cnf or /etc/mysql/mysql.conf.d/

#     [mysqld]
#     log-output=TABLE
#     general-log

# If you also want the text version of the general log, add this:

#     [mysqld]
#     log-output=TABLE,FILE
#     general-log
#     general-log-file=/var/log/mysql_general.log

# Restart mysql

#     sudo service mysql restart

# Create a general_log table inside custom database:

#     SHOW CREATE TABLE mysql.general_log

#     -- Use the result above to create our own log table
#     -- Then use the cron job command below to move logs to our own table
#     mysql -e "insert into testdb.mysql_general_log select * from mysql.general_log where user_host like '%[db]%"
#     mysql -e "truncate mysql.general_log"


# =============== Service ===============

while true
do
    read REXARUN < log.txt
    if $REXARUN
    then
        mysql -u root -p123 -e "insert into testdb.mysql_general_log select * from mysql.general_log where argument like '%testdb%' or argument like '%todo%' or argument like '%Transactions%'"
        mysql -u root -p123 -e "truncate mysql.general_log"
    else
        echo 'service is locked by magic variable'
        exit 0
    fi
done