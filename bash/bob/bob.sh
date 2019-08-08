#!/usr/bin/env bash

RESPONSE_SHOUTED_QUESTION='Calm down, I know what I'\''m doing!'
RESPONSE_QUESTION='Sure.'
RESPONSE_SILENCE='Fine. Be that way!'
RESPONSE_SHOUTED_WILDCARD='Whoa, chill out!'
RESPONSE_WILDCARD='Whatever.'

strip_whitespace() {
  echo "${1//[[:space:]]/}"
}

is_question() {
  [[ "${1: -1}" == '?' ]]
  return $?
}

is_shouting() {
  re='[[:alpha:]]'
  [[ "$1" =~ $re ]] && [[ "$1" == "${1^^}" ]]
  return $?
}

is_silence() {
  [[ -z "$1" ]]
  return $?
}

message="$(strip_whitespace "$1")"
is_shouting "$message"
shouted=$?
if is_silence "$message"; then
  echo "$RESPONSE_SILENCE"
elif is_question "$message"; then
  (( $shouted == 0 )) && echo $RESPONSE_SHOUTED_QUESTION || echo "$RESPONSE_QUESTION"
else
  (( $shouted == 0 )) && echo "$RESPONSE_SHOUTED_WILDCARD" || echo "$RESPONSE_WILDCARD"
fi
