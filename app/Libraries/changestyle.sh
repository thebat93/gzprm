#!/bin/bash
curl -v -u admin:geoserver -XPUT -H "Content-type: text/xml" -d "<layer><defaultStyle><name>polygon</name></defaultStyle></layer>" http://192.168.255.140:8080/geoserver/rest/layers/users:order_$1
