#!/usr/bin/env bash

shopt -s extglob

if [[ -z "$1" ]] || [[ ! -z ${1##+([0-9])} ]]; then
  echo "usage: $0 <number>" >&2
  exit 1
fi

result=
if (( ($1 % 3) == 0 )); then
  result+=Pling
fi
if (( ($1 % 5) == 0 )); then
  result+=Plang
fi
if (( ($1 % 7) == 0 )); then
  result+=Plong
fi

[[ -n $result ]] && echo $result || echo $1
