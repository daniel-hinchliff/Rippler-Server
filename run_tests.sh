#!/usr/bin/env bash
set -e

vendor/bin/phinx migrate

vendor/bin/phpunit tests
