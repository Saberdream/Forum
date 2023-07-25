# Forum
An optimized and evolutive forum PHP script.
# Requirments
This script works fine on > PHP 5 but DO NOT work for the moment with PHP 7 or higher, mainly due to conflicts issue with novel functions of the higher versions of PHP.
# Features
This is an evolutive and web responsive PHP forum script, to be more precise this is a CMS. The initial idea is strongly inspired by phpBB but the whole script is noticeably different, in particular due to the many optimizations in terms of speed and security of the script, and to the MVC architecture which guarantees great stability and scalability of the script.
In particular, this script supports:
* Different languages at a site and user level (there are currently NOT traduction in english, I'm looking for a volontary to translate the script from french to english)
* Different time zones that guarantees that the script is universal and could be used in the whole world
* A template system management
* A template engine (RainTPL) with a cache system, guaranteeing speed and allowing to separate the logic from the front end
* Different features for the users with notably a forum system with categories, subforums, a system of private messages...
* Management of permissions and various site features via the administration panel.
* Reliability guaranteed by object-oriented programming, and security guaranteed by the use of the PDO interface for connecting to the database (especially against injections), as well as a whole bunch of protection against CSRF flaws thanks to CSRF token and referer checking, as well as common flaws such as XSS flaws...
# How to use
1. Upload the structure.sql file via the phpmyadmin interface of your host or your PHP software if you are local.
2. Fill the config.php file with your data connection (db name, password...) or the script will not be able run.
3. Upload all the files of the root path to the root of your serveur via an FTP client like FileZilla or something.
4. Go to the root of your site via your web browser; if the script runs correctly, the home page should appear. Go to the login page via the menu on top.
When you run the script for the first time, there should normally be 3 different users:
* The founder account, that have the total access to the whole forum and to the administrator panel.
* The anonymous account, which every user that is not logged in is connected to while first visiting the site.
* And the robot account, which is for the robots and crawlers such as Google.
The connection identifiants for the founder account are:
Username: Admin
Password: admin
It is strongly recommended to change the password immediately after the first connection in order to avoid security issue.