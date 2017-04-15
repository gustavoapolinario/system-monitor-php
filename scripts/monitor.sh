#!/bin/sh

if [ $# -eq 0 ]; then
    echo "monitor \$user \$password"
    exit 1
fi

#mysql -u $1 --password=$2 -B -N -e "use monitor;create table if not exists logs (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, time TIMESTAMP, value text)"
#only for test
mysql -h db -u $1 --password=$2 -B -N -e "use monitor;create table if not exists logs (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, time TIMESTAMP, value text)"

# get memory info
meminfo=$(cat /proc/meminfo)
if [ "$meminfo" = "" ]; then
	echo "Sem previlégio suficiente"
	exit 1
fi


json_return="{"
memTotal=$(awk '/MemTotal/ { print $2 }' /proc/meminfo)
memFree=$(awk '/MemFree/ { print $2 }' /proc/meminfo)
buffers=$(awk '/Buffers/ { print $2 }' /proc/meminfo)
cached=$(awk '/^Cached/ { print $2 }' /proc/meminfo)
swapTotal=$(awk '/SwapTotal/ { print $2 }' /proc/meminfo)
swapFree=$(awk '/SwapFree/ { print $2 }' /proc/meminfo)

json_return="$json_return \"memTotal\":\"$memTotal\","
json_return="$json_return \"memFree\":\"$memFree\","
json_return="$json_return \"buffers\":\"$buffers\","
json_return="$json_return \"cached\":\"$cached\","
json_return="$json_return \"swapTotal\":\"$swapTotal\","
json_return="$json_return \"swapFree\":\"$swapFree\","

# get cpu info
loadAvg=$(awk '{print $1}' /proc/loadavg)
json_return="$json_return \"loadAvg\":\"$loadAvg\","




#disk_space=df --total -k  --output=source,avail | grep -vE "^Filesystem|tmpfs|cdrom"


#json_return="$json_return disk_space:{ $disk_space },"

uname=$(uname)
json_return="$json_return \"uname\":\"$uname\"}"
json_return_sql=$( echo $json_return | sed -e "s/'/\\\'/g" )
#echo $json_return_sql
#echo "insert into monitor.logs set value = '$json_return_sql')"

#mysql -u $1 --password=$2 -B -N -e "insert into monitor.logs set value = '$json_return_sql'"
#only for test
mysql -h db -u $1 --password=$2 -B -N -e "insert into monitor.logs set value = '$json_return_sql'"