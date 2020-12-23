#!/bin/bash
runDir=$(pwd);
unitGenDir="$runDir/vendor/bin/phpunitgen";

walk_dir () {    
    shopt -s nullglob dotglob

    for pathname in "$1"/*; do
        if [ -d "$pathname" ]; then
            walk_dir "$pathname"
        else
            case "$pathname" in
                *.php)
                    #printf '%s\n' "$pathname"
                    echo $($unitGenDir $pathname);
            esac
        fi
    done
}

walk_dir $1