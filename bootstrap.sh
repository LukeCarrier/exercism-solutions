#!/bin/sh

guess_os() {
  uname="$(uname)"
  case "$uname" in
    Darwin) platform='mac' ;;
    Linux) platform='linux' ;;
    *)
      echo "Operating system ${uname} not known; aborting" >&2
      return 1
  esac

  echo "$platform"
}

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
  mkdir _exercism/
  tar -x -C _exercism -f "$(make_archive_filename)"
}

cleanup() {
  rm -f "$(make_archive_filename)"
}

version=3.0.12
arch=64bit
platform="$(guess_os)"

download
install
cleanup
