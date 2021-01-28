#!/usr/bin/env bash

printf "=======================\n";
printf "Generating user $USER configuration \n\n";

if test -f .env; then
    echo ".envexist, deleting..."
    rm .env
fi

printf "Processing....\n\n";

(echo "#### ONLY GENERATED CONFIG. DO NOT EDIT MANUALLY ####" && cat .env.example.prod) > .env.temp && mv .env.temp .env

printf "Done.\n";
printf "=======================\n";
