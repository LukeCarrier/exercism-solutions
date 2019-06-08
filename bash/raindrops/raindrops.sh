#!/usr/bin/env bash

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
