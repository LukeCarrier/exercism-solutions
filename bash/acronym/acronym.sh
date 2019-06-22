#!/usr/bin/env bash

RE_FIRST_LETTER_OF_WORD='\b[[:alpha:]]'
acronym="$(echo "$1" | grep -o "$RE_FIRST_LETTER_OF_WORD" | tr -d '\n')"
echo "${acronym^^}"
