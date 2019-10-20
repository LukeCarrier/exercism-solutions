#!/bin/sh

version=3.0.11
platform=linux
arch=64bit

make_url() {
  echo "https://github.com/exercism/cli/releases/download/v${version}/exercism-${platform}-${arch}.tgz"
}

make_archive_filename() {
  echo "exercism-${version}-${platform}-${arch}.tgz"
}

download() {
  curl -L -o "$(make_archive_filename)" "$(make_url)"
}

install() {
  rm -rf _exercism/
  tar -x -f "$(make_archive_filename)" \
      --one-top-level=_exercism
}

cleanup() {
  rm -f "$(make_archive_filename)"
}

download
install
cleanup
