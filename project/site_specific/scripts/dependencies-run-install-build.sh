#!/usr/bin/env bash

printf "Installing NPM dependencies for Colby dependencies \n"

shopt -s extglob # Turns on extended globbing

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"  # This loads nvm


printf "Plugins... \n"
NPM_PLUGIN_DIRS=`ls web/wp-content/plugins/colby-*/src/@(index.js)` # Saves it to a variable
for NPMPLUGINDIR in $NPM_PLUGIN_DIRS; do
  NPMPLUGINDIR=`dirname $NPMPLUGINDIR`
  NPMPLUGINDIR_PRUNED=${NPMPLUGINDIR:0:$((${#NPMPLUGINDIR}-3))}
  cd $NPMPLUGINDIR_PRUNED
  printf "Installing NPM dependencies for ${NPMPLUGINDIR_PRUNED}... \n"
  npm install
  printf "Running build for ${NPMPLUGINDIR_PRUNED}... \n"
  npm run build
  cd -
done

# npm install
shopt -u extglob
