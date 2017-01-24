# WP Starter Project

## Installation
#### Local VVV Wordpress Site
1. Go to the `www` directory of Vagrant
2. Clone this repo, change `MyApp` to the real project name
3. Find & replace `sdh` with the real project name
4. Provision
```bash
git clone https://github.com/nikosolihin/wp-starter.git MyApp && cd $_
find ./ -type f -maxdepth 1 -exec sed -i '' -e 's/sdh/myapp/g' {} \;
cd ../..
vagrant up --provision
```

### Build Tool
Utilize [Gulp Starter](https://github.com/vigetlabs/gulp-starter) as project builder:
```bash
svn checkout https://github.com/vigetlabs/gulp-starter/trunk/src src
svn checkout https://github.com/vigetlabs/gulp-starter/trunk/gulpfile.js gulpfile.js
svn export https://github.com/vigetlabs/gulp-starter/trunk/package.json
```
Add `php.js` and `twig.js` from older projects to `gulpfile.js/tasks`. Edit `name`, `version` and `description` in `package.json`.

Clean unnecessary folders and `.git` folder to start a fresh history:
```
rm -rf .git
rm -rf ./src/html ./src/images
rm -rf ./gulpfile.js/tasks/html.js ./gulpfile.js/tasks/images.js
npm install
```

### Initial Commit
Tell `.gitignore` to ignore htdocs and VVV config files:
```bash
echo "htdocs/\nvvv-hosts\nvvv-init.sh\nvvv-nginx.conf\nwp-cli.yml" >> .gitignore # We can now ignore the destination folder after vagrant provision
git init
git add .
git commit -m 'Allons-y!'
```
Then use Tower app to initiate Git-Flow.

### Setting up remote repo
Create a new Github repo without .gitignore and README.md. Then add the new origin to our local repo:
```bash
git remote add origin https://github.com/USERNAME/REPOSITORYURL.git
```
Do a git push to make sure everything's good.

### Setting up remote deploy repo
Prepare the bare repo for deployment using this [prep.sh](https://gist.github.com/nikosolihin/7b4eabe087ccec339eca6d8e60d1c56f#file-prep-sh-L5) and [post-receive hook](https://gist.github.com/nikosolihin/63b1c0fc19aaff935f53f3aafdb393e9):
```bash
ssh -i .ssh/KEYNAME user@host
cd ~
curl -O https://gist.githubusercontent.com/nikosolihin/7b4eabe087ccec339eca6d8e60d1c56f/raw/7e433ce5a235e1b150d2eeb2fec9c1f0d664b42a/prep.sh
chmod +x prep.sh && ./$_
```

### Preparing Travis CI
1. Head to [Travis CI](https://travis-ci.org/) account settings, sync repo and toggle the project's repo.
2. Copy the markdown of the status badge.
3. Revise the project's README.md and paste the badge.
4. Copy the private key that Travis will use to the folder. Don't commit!
5. Run `travis login` and `travis encrypt-file deploy-key --add` to add the needed env vars and update `.travis.yml`
6. `rm deploy-key`
7. Customize `.travis.yml`
8. Cut and paste the `openssl` part to `_travis/install.sh`
9. Make sure `_travis/deploy.sh` looks good
10. If using Basecamp, update the Zapier webhooks URL in `.travis.yml`
