The One Village One Product Movement
==================================================

This project was developed by [Resolvo Cambodia](https://resolvocam.com). It shows how to:

 * Implement roles and permissions in your website
 * Organize roles in database into an hierarchy
 * Use Zend\Permissions\Rbac component to implement role-based access control
 * Use dynamic assertions to implement complex access control rules

## Installation

You need to have Apache 2.4 HTTP server, PHP v.5.6 or later with `gd` and `intl` extensions, and MySQL 5.6 or later.

Download the project repository to some directory (it can be your home dir or `/var/www/html`) and run Composer as follows:

```
composer install
```

The command above will install the dependencies (Zend Framework and Doctrine).

Enable development mode:

```
composer development-enable
```

Create the `data/cache` directory:

```
mkdir data/cache
```

Adjust permissions for `data` directory:

```
sudo chown -R www-data:www-data data
sudo chmod -R 775 data
```

Create `public/img/captcha` directory:

```
mkdir public/img/captcha
```

Adjust permissions for `public/img/captcha` directory:

```
sudo chown -R www-data:www-data public/img/captcha
sudo chmod -R 775 public/img/captcha
```

Create `config/autoload/local.php` config file by copying its distrib version:

```
cp config/autoload/local.php.dist config/autoload/local.php
```

Edit `config/autoload/local.php` and set database password parameter.

Login to MySQL client:

```
mysql -u root -p
```

Create database:

```
CREATE DATABASE ovop_db;
GRANT ALL PRIVILEGES ON ovop_db.* TO ovop_db@localhost identified by '<your_password>';
quit
```

Run database migrations to intialize database schema:

```
./vendor/bin/doctrine-module migrations:migrate
```

Then create an Apache virtual host. It should look like below:

```
<VirtualHost *:80>
    # ServerName ovopcambo.local
    DocumentRoot "C:\wamp\www\ovopcambo\public"

	<Directory  "C:\wamp\www\ovopcambo\public">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>

</VirtualHost>
```

Now you should be able to see the ovop website by visiting the link "http://localhost/".

## License

This code is provided under the [BSD-like license](https://en.wikipedia.org/wiki/BSD_licenses).

## Contributing

If you found a mistake or a bug, please report it using the [Issues](https://github.com/gionabbe/ovopcambo/issues) page.
Your feedback is highly appreciated.
