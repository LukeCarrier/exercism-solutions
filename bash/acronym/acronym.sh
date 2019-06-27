#!/usr/bin/env bash

old_ifs="$IFS"
IFS='- '
for word in $1; do
  acronym+="${word:0:1}"
done
IFS="$old_ifs"
echo "${acronym^^}"
