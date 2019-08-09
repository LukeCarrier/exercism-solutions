#!/usr/bin/env bash

input="${1^^}"
score=0
for (( i=0; i<${#input}; i++ )); do
  char="${input:$i:1}"
  if [[ "$char" =~ [AEIOULNRST] ]]; then
    (( score += 1 ))
  elif [[ "$char" =~ [DG] ]]; then
    (( score += 2 ))
  elif [[ "$char" =~ [BCMP] ]]; then
    (( score += 3 ))
  elif [[ "$char" =~ [FHVWY] ]]; then
    (( score += 4 ))
  elif [[ "$char" == K ]]; then
    (( score += 5 ))
  elif [[ "$char" =~ [JX] ]]; then
    (( score += 8 ))
  elif [[ "$char" =~ [QZ] ]]; then
    (( score += 10 ))
  fi
done
echo $score
