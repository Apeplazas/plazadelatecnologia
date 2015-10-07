#!/bin/sh

username=admin
password=admin01
baseurl=https://201.149.1.131:8443

if [ $# -lt 2 ] ; then
    echo "Usage: $0 <mac> <minutes>"
    exit -1
fi

mac=$1
minutes=120

curl_cmd="curl -3 --cookie /tmp/unifi_cookie --cookie-jar /tmp/unifi_cookie --insecure "

# authenticate against unifi controller
$curl_cmd --data "login=login" --data "username=$username" --data "password=$password" $baseurl/login

# authorize a guest for 
$curl_cmd --data "json={'cmd':'authorize-guest', 'mac':'${mac}', 'minutes':${minutes}}" $baseurl/api/cmd/stamgr

# logout
$curl_cmd $baseurl/logout
