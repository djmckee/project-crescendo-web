# Project Crescendo Website
----

This repository holds the website and server-side web API for the Project Crescendo upload system.

The website is a simple promotional site to promote the app, with a few images
and a copy of the APK file.

The API is a simple API written in raw PHP and MySQLi, to allow the uploading of
MusicXML encoded files, so that they can be shared and downloaded.

The website was created by Craig Hirst.
The web API, all documentation and `README` and was created by Dylan McKee.

The website and API are hosted live over HTTPS at [https://sonata.ml](https://sonata.ml).

Deployment and Ops
----
The website is hosted on a standard _LAMP_ Stack, consisting of Ubuntu Linux, Apache web server, MySQL DBMS and PHP 5.5. The website is served over HTTPS (via an SSL Certificate from [Let's Encrypt](https://letsencrypt.org/) to ensure a good level of security and privacy for our users.

Security considerations
----
The website and API are served over HTTPS to ensure that user data in both POST and GET requests (including in the URL query string). Aditioanlly, the API features client authentication to ensure that it is indeed our own Android client app, and not any rouge 3rd party client, connecting to it and uploading data. This is performed by verifying a `Client ID` and `Client Secret` value that is known to and POSTed from our client app against the values defined in the `constants.php` file - as such, to prevent inercept of these client ID and client secret values, the API is hosted over an encrypted HTTPS connection.


Requirements
----
- PHP 5.3
- MySQL 5.5
- Apache 2.4
- Ubuntu Server 14.04
- Valid SSL Certificate for encryption of the connection

Instructions
----
1. Clone repo
2. Set up database in MySQL, create a table as per the table definition in the `create_table.sql` file. Set database hostname, database name and database user name and password in the `constants.php` file.
3. Set client secret and client ID to match those in the Client App's API client class.
4. Set current hostname in the `upload.php` file. 
5. Start uploading and sharing your `MusicXML` - POST requests to the API as documented in `upload.php`.