#!/bin/sh

_root="$(cd "$(dirname "$1")" && pwd -P)"

alias exercism="${_root}/_exercism/exercism"

if [ -n "$BASH_VERSION" ]; then
  . "${_root}/_exercism/shell/exercism_completion.bash"
elif [ -n "$ZSH_VERSION" ]; then
  . "${_root}/_exercism/shell/exercism_completion.zsh"
fi

exercism configure --workspace "$_root"

solve() {
  local track_exercise="$1"
  local track="$(echo "$track_exercise" | cut -d / -f 1)"
  local exercise="$(echo "$track_exercise" | cut -d / -f 2)"
  local workspace="$(exercism workspace)"

  if [ ! -d "$workspace/$track/$exercise" ]; then
    rm -f "$workspace/$track/$exercise"
    exercism download --exercise="$exercise" --track="$track"
    git --work-tree "$workspace" add "$track/$exercise"
    git --work-tree "$workspace" commit "$track/$exercise" -m "$track/$exercise: exercise"
  fi
  code "$track/$exercise"
}

unset _root
