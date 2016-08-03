set -e 

CHANGES=$(git status -s | wc -l)

if [ "0" -ne "$CHANGES" ] ; then
    echo "Workspace is dirty"
    exit 1
fi

./run_tests.sh

git push heroku master

heroku run "vendor/bin/phinx migrate -e production"
