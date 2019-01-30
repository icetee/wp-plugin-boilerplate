#!/bin/bash

# Config
PLUGIN_NAME_HYPEN="plugin-icetee"
PLUGIN_CREATOR_HYPEN="plugin-creator"
PLUGIN_NAME_CAMEL_CASE="PluginName"
PLUGIN_CREATOR_CAMEL_CASE="PluginCreator"

# Generator
cd ./plugin-name

find . -type f -not -path "./vendor/*" -exec sed -i '' -e "s/plugin-name/$PLUGIN_NAME_HYPEN/" {} \;
find . -type f -not -path "./vendor/*" -exec sed -i '' -e "s/plugin-creator/$PLUGIN_CREATOR_HYPEN/" {} \;
find . -type f -not -path "./vendor/*" -exec sed -i '' -e "s/PluginName/$PLUGIN_NAME_CAMEL_CASE/" {} \;
find . -type f -not -path "./vendor/*" -exec sed -i '' -e "s/PluginCreator/$PLUGIN_CREATOR_CAMEL_CASE/" {} \;

find . -type f -not -path "./vendor/*" -name '*plugin-name*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/plugin-name/$PLUGIN_NAME_HYPEN/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f -not -path "./vendor/*" -name '*plugin-creator*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/plugin-creator/$PLUGIN_CREATOR_HYPEN/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f -not -path "./vendor/*" -name '*PluginName*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/PluginName/$PLUGIN_NAME_CAMEL_CASE/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f -not -path "./vendor/*" -name '*PluginCreator*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/PluginCreator/$PLUGIN_CREATOR_CAMEL_CASE/")" ;
    mv "${FILE}" "${newfile}";
done
