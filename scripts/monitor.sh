#! /bin/sh
# myuptime.sh - exibe o uptime total do servidor em segundos

if [ $# -eq 0 ]; then
    echo "monitor $user $password"
    exit 1
fi

mysql -u $1 --password=$2 -B -N -e "SHOW STATUS LIKE 'Uptime'"
