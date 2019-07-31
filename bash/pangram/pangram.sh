#!/usr/bin/bash

if (( $# != 1 )); then
  echo "Usage: $0 <phrase>"
  exit 1
fi

alphabet='abcdefghijklmnopqrstuvwxyz'
input="${1,,}"

for (( i = 0; i < ${#input}; i++ )); do
  char="${input:$i:1}"
  alphabet="${alphabet//$char}"
done

if (( ${#alphabet} == 0 )); then
  echo 'true'
else
  echo 'false'
fi
