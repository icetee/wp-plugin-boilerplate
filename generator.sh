#!/bin/bash

# Config
PLUGIN_NAME_HYPEN="plugin-name"
PLUGIN_CREATOR_HYPEN="plugin-creator"
PLUGIN_NAME_CAMEL_CASE="PluginName"
PLUGIN_NAME_CAMEL_CASE_WITH_SPACE="Plugin Name"
PLUGIN_CREATOR_CAMEL_CASE="PluginCreator"
PLUGIN_TAGS="comments, spam"
PLUGIN_NAME="WordPress Plugin Boilerplate"
PLUGIN_URI="http://example.com/plugin-name-uri/"
PLUGIN_VERSION="1.0.0"
PLUGIN_DESCRIPTION="This is a short description of what the plugin does. It's displayed in the WordPress admin area."
PLUGIN_AUTHOR="Your Name or Your Company"
PLUGIN_AUTHOR_URI="http://example.com/"

# Generator
function escape {
  echo $(echo "$*" | sed 's/\//\\\//g' | sed 's/ /\\ /g' )
}

PLUGIN_NAME=$(escape $PLUGIN_NAME)
PLUGIN_URI=$(escape $PLUGIN_URI)
PLUGIN_AUTHOR=$(escape $PLUGIN_AUTHOR)
PLUGIN_AUTHOR_URI=$(escape $PLUGIN_AUTHOR_URI)
PLUGIN_VERSION=$(escape $PLUGIN_VERSION)

cd ./plugin-name

# Metadata
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "Your Name or Your Company")/${PLUGIN_AUTHOR}/g" "{}" \;
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "WordPress Plugin Boilerplate")/${PLUGIN_NAME}/g" "{}" \;
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "http://example.com/plugin-name-uri/")/${PLUGIN_URI}/g" "{}" \;
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "http://example.com/")/${PLUGIN_AUTHOR_URI}/g" "{}" \;
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "This is a short description of what the plugin does. It's displayed in the WordPress admin area.")/${PLUGIN_DESCRIPTION}/g" "{}" \;
find 'plugin-name.php' -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/$(escape "1.0.0")/${PLUGIN_VERSION}/g" "{}" \;

# Replaces
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/plugin-name/$PLUGIN_NAME_HYPEN/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/plugin-creator/$PLUGIN_CREATOR_HYPEN/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/PluginName/$PLUGIN_NAME_CAMEL_CASE/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/PluginNameAdmin/${PLUGIN_NAME_CAMEL_CASE}Admin/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/PluginNameCli/${PLUGIN_NAME_CAMEL_CASE}Cli/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/PluginNameClient/${PLUGIN_NAME_CAMEL_CASE}Client/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/Plugin Name/$PLUGIN_NAME_CAMEL_CASE_WITH_SPACE/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/PluginCreator/$PLUGIN_CREATOR_CAMEL_CASE/" {} \;
find . -type f ! -path "./vendor/*" ! -path "composer.lock" -exec sed -i '' -e "s/comments, spam/$PLUGIN_TAGS/" {} \;

find . -type f ! -path "./vendor/*" ! -path "composer.lock" -name '*plugin-name*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/plugin-name/$PLUGIN_NAME_HYPEN/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f ! -path "./vendor/*" ! -path "composer.lock" -name '*plugin-creator*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/plugin-creator/$PLUGIN_CREATOR_HYPEN/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f ! -path "./vendor/*" ! -path "composer.lock" -name '*PluginName*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/PluginName/$PLUGIN_NAME_CAMEL_CASE/")" ;
    mv "${FILE}" "${newfile}";
done

find . -type f ! -path "./vendor/*" ! -path "composer.lock" -name '*PluginCreator*' | while read FILE ; do
    newfile="$(echo ${FILE} | sed -e "s/PluginCreator/$PLUGIN_CREATOR_CAMEL_CASE/")" ;
    mv "${FILE}" "${newfile}";
done
