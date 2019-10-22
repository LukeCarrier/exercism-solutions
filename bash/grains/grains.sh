#!/usr/bin/env bash

BOARD_SQUARES=64

square() {
  local num="$1"
  printf '%u\n' "$(( 2 ** ($num - 1) ))"
}

total() {
  printf '%u\n' "$(( 2 ** ($BOARD_SQUARES + 1) - 1 ))"
}

if [[ "$1" == 'total' ]]; then
  total
elif (( $1 >= 1 && $1 <= $BOARD_SQUARES )); then
  square "$1"
else
  echo 'Error: invalid input'
  exit 1
fi
