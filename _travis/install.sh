#!/bin/bash
set -x # Show the output of the following commands (useful for debugging)

# Import the SSH deployment key
openssl aes-256-cbc -K $encrypted_99fe7c253eb2_key -iv $encrypted_99fe7c253eb2_iv -in webteam@ubiquitous-couscous.enc -out webteam@ubiquitous-couscous -d
rm webteam@ubiquitous-couscous.enc # Don't need it anymore
chmod 600 webteam@ubiquitous-couscous
mv webteam@ubiquitous-couscous ~/.ssh/id_rsa
