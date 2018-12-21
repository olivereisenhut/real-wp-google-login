# Real Wordpress Google login

Enables Google login and creates Wordpress login if the user doesn't already exists.
Compatible with [Force Login plugin](https://github.com/kevinvess/wp-force-login)

## Install

1. Clone repo into `wp-content/plugins`
2. Donwload Google OAuth credentials from the [API console](https://console.developers.google.com/apis/credentials)
3. rename it to `client_secret.json` and put it into the projects directory

## Dev

Install deps with `composer install`.
Start wordpress env with `docker-compose up`