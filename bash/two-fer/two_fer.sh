#!/usr/bin/env bash

set -o errexit
set -o nounset

main() {
  local you="${1-you}"
  echo "One for ${you}, one for me."
}

main "$@"
