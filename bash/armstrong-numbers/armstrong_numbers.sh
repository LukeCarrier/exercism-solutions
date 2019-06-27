#!/usr/bin/env bash

count="${#1}"
sum=0
work="$1"

while (( $work > 0 )); do
  sum=$(( $sum + ($work % 10) ** $count ))
  work=$(( $work / 10 ))
done

if (( $1 == $sum )); then
  echo 'true'
else
  echo 'false'
fi
