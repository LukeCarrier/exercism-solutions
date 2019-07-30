#!/usr/bin/env bash

if (( $# != 1 )) || ! [[ "$1" =~ ^[0-9]+$ ]]; then
  echo "Usage: $0 <number>"
  exit 1
fi

declare -i sum
for (( i = 0; i < ${#1}; i++ )); do
  (( sum += ${1:$i:1} ** ${#1} ))
done

if (( $1 == $sum )); then
  echo 'true'
else
  echo 'false'
fi
