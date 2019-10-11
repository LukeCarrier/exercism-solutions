#!/usr/bin/env bash

square() {
  local num="$1"
  if (( $num == 1)); then
    echo 1
    return
  fi
  echo "2^(${num}-1)" | bc
}
total() {
  result=0
  for index in {1..64}; do
    grains="$(square "$index")"
    result="$(echo "${result}+${grains}" | bc)"
  done
  echo $result
}

if [[ "$1" == 'total' ]]; then
  total
elif (( $1 >= 1 && $1 <= 64 )); then
  square "$1"
else
  echo 'Error: invalid input'
  exit 1
fi
