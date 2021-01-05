Project Sariab
(v1.0.0.0)
===
Based on **Pressz** guideline

# What is Sariab?

Sariab (www.sariab.ir) is a non-profit blogging campaign which is focused on empowering students, increase mental health level, and motivate them, through an integrated knowledge base made on distributed blogs and free content on internet social networks and website platform.

# Homepage

خانه <http://sariab.ir>

# FAQ

سوالات متداول <https://vrgl.ir/D2lo5>

# What is inside this repository?

Web application which is serving content as the hub is available in this repository.

![Website Status](https://img.shields.io/website?url=http%3A%2F%2Fsariab.ir)
![Build](https://img.shields.io/appveyor/build/Pressz/Sariab-V2)
![Languages](https://img.shields.io/github/languages/count/Pressz/Sariab-V2)
![Top Language](https://img.shields.io/github/languages/top/Pressz/Sariab-V2)
![Issues](https://img.shields.io/codeclimate/issues/Pressz/Sariab-V2)

# Installation

## Install Apache-MySQL-PHP

```
apt install tasksel
tasksel install lamp-server
```

## Configure MySQL

```
mysql_secure_installation
```

## Check apache installation

```
cd /var/www/html
vi index.php
```
> `<?php phpinfo(); ?>`
```
wget http://localhost/index.php
```

## Check the php version

`php --version`

## Create database

```
mysql> CREATE DATABASE `sariab_data`;
```

### Execute database query

From file `db.sql`

## Change config file and set yout cridentials

Set your custom configuration:

file: `config.php`

## Give apache permissions to write

```
sudo chgrp -R www-data /var/www/html
```

## Authenticaition

Edit **.htaccess** for default **.htpasswd** file directory.

Then set the permissions to

```
chmod 644 .htaccess
chmod 644 .htpasswd
```

To create **.htpasswd** for the first time:

```
htpasswd -c /var/www/html/Sariab-V2/.htpasswd tayyebi
```

# Contribute
1. Install git from git-scm.com
1. Make a **Fork** of the repository
1. **Clone** the project on your machine
1. Change whatever you want
1. Commit your changes
1. **Pull** before push(Notice that you have to choose **Pull From** the main project.)
1. Push
1. Make a **pull request**
1. Tell us your notes
1. Your commits will be merged after review by developers of master branch

## Project TODO list

- [X] GUI AND DATABASE UPDATES BASED ON NEW WIREFRAME (DOWNLOAD [> WIREFRAME.PDF](docs/prototype/Wireframe.pdf))
- [X] VIEW POST PAGE
- [X] BUG WITH SUPPORT AND POSITIONS PAGES THEME
- [X] REDIRECT ACTION IN HOME CONTROLLER
- [X] VIEW ROADMAP PAGE (CONTAINING STEPS, CHECKLIST, ...)
- [X] HOMEPAGE SEARCH
- [X] SEARCH AND CATEGORIES POSTS
- [X] CREATE A TRACKING INFRASTRUCTURE
- [X] CREATE AN INTERNAL STATISTICS INFRASTRUCTURE (LINKS VISIT COUNT, PAGES VISIT COUNT, NETWORK TRAFIC USAGE, BROWSERS STATISTICS, COUNTRIES STATISTICS, PAGES HEATMAP)
- [ ] PAYMENT INFRASTRUCTURE
- [ ] COOKIE BASED RECOMMENDATION
- [ ] UPLOAD IMAGES FOR POSTS
- [ ] UPLOAD IMAGES FOR ROADMAPS
- [ ] DRAG AND DROP POST DESIGN IN DIFFERENT SIZES AND DOWNLOADABLE OUTPUTS (FOR SOCIAL NETWORKS FEED, STORIES, ...)
- [ ] ALLOW USERS TO BOOKMARK POSTS USING COOKIES
- [x] FLASH CARD BEHAVIOR ON A HOMEPAGE POST HOVER
- [ ] POP-UP WINDOW ON HOMEPAGE POST CLICK ('PARTIAL VIEW' OF 'VIEW PAGE')
- [X] CREATE A ROADMAP FEATURE WHICH ALLOWS PEOPLE TO FOLLOW POSTS FOR A GOAL
- [ ] LAZY LOAD THE CONTENT ON FIRST PAGE
- [ ] PAGINATION ON ADMIN PANEL DATA TABLES
- [X] FILE UPLOADER
- [X] RSS
- [X] WARN PEOPLE ABOUT TRACKING
- [X] Flag posts which are just indexed by Sariab not produced by Sariab Bloggers. This will allow us to add more detailed content even if we are not the producer. And manage from seperated menu.
- [X] Delete 'HTTP_CONNECTION', 'HTTP_SEC_FETCH_MODE', 'HTTP_SEC_FETCH_SITE', 'HTTP_SEC_FETCH_DEST', 'HTTP_SEC_FETCH_PERSON', 'HTTP_UPGRADE_INSECURE_REQUEST', 'HTTP_PERSON_AGENT', 'PATH' from Viststs
- [X] Add $_SERVER['HTTP_USER_AGENT'], $_SERVER['PHP_AUTH_USER'] to Visists
- [ ] Optimize the manifest for PWA https://web.dev/add-manifest/
- [X] Statistics -> Daily Visit Count: Show details of each day's top users navigatino in website
- [X] Statistics -> Daily Visit Count: Show unique users visits
- [X] Statistics -> Daily Visit Count: Show current hour as last
- [X] Statistics -> Weekly Visit Count: Change lables to week date
- [X] Statistics -> Weekly Visit Count: Show unique users visits
- [ ] Statistics -> Daily Visit Count: View a special hour requests in details
- [ ] Home/View -> Each post growth diagrams
- [ ] Statistics -> Each referrer growth diagrams
- [ ] Add `interface` and `implements` for repeating functions in models
- [ ] Statistics -> Search Engine Bots: https://www.webnots.com/user-agents-list-for-google-bing-baidu-and-yandex-search-engines/
- [ ] Edit all Select * Queries
- [ ] Debug and Track HTTP_CLIENT_IP
- [ ] Captcha for public post submit Home/Submit
- [X] Rules

## Project TODO List V1.0.0.0

- [ ] Previous and next posts navigating from Roadmap and simillar posts in alternative
- [ ] Authentication with Gordafarid
- [ ] Badge infrastructure
- [ ] Badges vitrine
- [ ] Profile page
- [ ] Forms CRUD for admins
- [ ] Forum start topic
- [ ] Forum Topics Page
- [ ] Forum topic details
- [ ] Forum topics reply
- [ ] Forum posts vote up/down
- [ ] Gordafarid wordpress plugin for mag
- [ ] Feeback (and links reporting) box ready on whole website

# Developers
<https://github.com/Pressz/Sariab-V2/graphs/contributors>

# Love behind the project
<http://sariab.ir/ThankYou>
