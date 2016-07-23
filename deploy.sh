set -e 

git diff --exit-code

./run_tests.sh

git push heroku master

heroku run "vendor/bin/phinx migrate -e production"
