#!/bin/bash
export TARGET=../famsyse
rm -rf $TARGET
mkdir $TARGET

/Applications/ioncube_encoder_evaluation/ioncube_encoder53 index.php app/ cake/ extension/ plugins/ vendors/ --into $TARGET --ignore .svn/ --ignore "*~" --copy app/config/ --ignore-deprecated-warnings --replace-target --ignore-strict-warnings --verbose --binary

cp .htaccess $TARGET
cp app/.htaccess $TARGET/app/
cp app/webroot/.htaccess $TARGET/app/webroot/
