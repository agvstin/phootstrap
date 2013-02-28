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
```

You can install phootstrap using composer:

```
composer.phar create-project agvstin/phootstrap --stability=dev
```

or directly from GitHub:

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
```

Copy the config file

```
# copy parameters file (and edit as you need...)
cp config/parameters.example.ini config/parameters.ini
```

If you have `php 5.4.0` or greater, you can start a web server by
running:

```
# use a free port
./bin/server 7890
```

Otherwise, setup a virtual host and point the `DocumentRoot` to the
`web` directory.

Open your browser and head to http://localhost:7890 (or the configured
vitual host).

That's it! You can start developing your app!
