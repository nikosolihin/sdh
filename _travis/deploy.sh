#!/bin/bash
set -x
if [ $TRAVIS_BRANCH == 'master' ] ; then
  # Initialize a new git repo in dest folder
  cd public
  git init

  # Add remote destination and set email
  git remote add deploy "deploy@host:/var/www/.git"
  git config user.name "Pipe & Pilcrow"
  git config user.email "hello@pipeandpilcrow.com"

  # Add all files, commit, and deploy
  git add .
  git commit -m "Deploy"
  git push --force deploy master
else
  echo "Not deploying, since this branch isn't master."
fi
