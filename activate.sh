#!/bin/sh

_root="$(cd "$(dirname "$1")" && pwd -P)"

alias exercism="${_root}/_exercism/exercism"

if [ -n "$BASH_VERSION" ]; then
    . "${_root}/_exercism/shell/exercism_completion.bash"
elif [ -n "$ZSH_VERSION" ]; then
    . "${_root}/_exercism/shell/exercism_completion.zsh"
fi

unset _root

exercism configure --workspace "$_root"
