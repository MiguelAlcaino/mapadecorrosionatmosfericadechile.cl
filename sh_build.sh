#!/bin/sh

php symfony doctrine:build-schema
php symfony doctrine:build-model
php symfony doctrine:build-form
php symfony doctrine:build-filter
rm -rf lib/model/doctrine/SfGuard*
#rm -rf lib/model/doctrine/base/BaseSfGuard*
