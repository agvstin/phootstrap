phootstrap
==========

*phootstrap* is a php application template.

About
-----

This template provides a project skeleton to write small php
applications and prototypes.
It uses the following *awesome* libraries:

* `composer` -- The fabolous package installer
* `silex` -- A small, fast and extensible web framework
* `redbeanphp` -- Dead simple orm
* `twig` -- Easy to use template engine

Get started
-----------

If you haven't installed composer, do it now (visit [composer
website](http://getcomposer.org) for more instructions):

```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

Follow these steps:

```
# clone this repo
git clone git://github.com/agvstin/phootstrap.git myapp
cd myapp

# start your own repo
rm -rf .git
git init .
git add .
git commit -m "Initial import from phootstrap"

# install vendors
composer.phar install

# copy parameters file (and edit as you need...)
cp config/parameters.example.ini config/parameters.ini

# start your server (you'll need php 5.4.0 for this to work)
./bin/server 7890

# head to http://localhost:7890

```
