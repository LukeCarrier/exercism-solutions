#!/usr/bin/env bash

declare -i sum
for (( i = 0; i < ${#1}; i++ )); do
  (( sum += ${1:$i:1} ** ${#1} ))
done

if (( $1 == $sum )); then
  echo 'true'
else
  echo 'false'
fi
