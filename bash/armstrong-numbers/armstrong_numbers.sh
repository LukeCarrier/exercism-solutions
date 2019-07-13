#!/usr/bin/env bash

sum=0
for (( i = 0; i < ${#1}; i++ )); do
  sum=$(( $sum + ${1:$i:1} ** ${#1} ))
done

if (( $1 == $sum )); then
  echo 'true'
else
  echo 'false'
fi
