# Forum
This is an evolutive and web responsive PHP forum script, to be more precise it is a CMS. The initial idea is strongly inspired by phpBB but the whole script is noticeably different, in particular due to the many optimizations in terms of speed and security of the script, and thanks to the MVC architecture which guarantees great stability and scalability of the script.
# Requirments
* Running the script in PHP 5.6.x is HIGHLY recommanded. This script works fine on > PHP 5 but DO NOT work for the moment with PHP 7 or higher, mainly due to conflicts issue with novel functions of higher versions of PHP.
* The url rewrite mod must be enabled, as well as GD library and PDO kernel.
* You must have read and write permissions (chmod 0777) on certain folders, such as the image gallery, the cache folder or the logs folder.
* Finally, some functions such as password recovery require that a correct SMTP server is entered in the forum parameters (for sending emails).
# Features
* Different features for the users with notably a forum system with categories, subforums, private messages...
* Different time zones with automatic time adjustment according to user region, which guarantees the universality of the script and that it could be used in the whole world
* A convenient template system management and template engine (RainTPL) with a cache system, guaranteeing speed and allowing to separate the logic from the front end
* Management of permissions and various site features via the administration panel
* Reliability guaranteed by object-oriented programming, and security guaranteed by the use of the PDO interface for connecting to the database (especially against SQL injections), as well as a whole bunch of protection against CSRF flaws thanks to CSRF token system and referer checking, and against common flaws such as XSS flaws
* Different languages at a site and user level (French, English, Spanish, German, Chinese...)
# How to use
1. Connect to the phpMyAdmin interface of your host (or of your local server)  and upload the structure.sql file to create the forum tables.
2. Fill the config.php file at the root of the script with your SQL connection informations (db name, password...).
3. Rename the "config.dat.ini.bak" file (in cache/ directory) to "config.dat.ini", by don't forgetting to fill the following variables:
	* site_name="Your site name (this is the name of your site which is displayed to the visitors)"
	* domain_name="Your site domain name (www.yourdomain.xxx or www.yourdomain.xxx/forum), this is the root directory of your forum."
	* talbe_prefix="The prefix of your tables if you want to change them (must be the same as the tables you created by uploading the structure.sql file)"
	* site_mail="Email of your site (webmaster@yourdomain.xxx)"
	* smtp_server="Your SMTP server if you have one (smtp.yourdomain.xxx)"
	* sendmail_from="The mail which the SMTP server sends the mail from (name.surname@yourdomain.xxx)"
	* All the other parameters can be modified until the site is installed so it's not necessary to fill them.
4. Upload all the files from the root of the script to the root of your server via an FTP client such as FileZilla.
5. Go to the root of your site via your web browser; if the script runs correctly, the home page should appear. Go to the login page via the menu on top and log to the admin account (see below for administrator account credentials).
When you run the script for the first time, there should normally be 3 different users:
* The founder account, which have the total access to the forum and can enter to the administrator panel.
* The anonymous account, which every user that is not logged in and is visiting the site for the first time is connected to.
* And the robot account, which is for the robots and crawlers such as Google.

The connection identifiants for the founder account are:
* Username: Admin
* Password: admin

It is strongly recommended to change the password immediately after the first connection in order to avoid security issue.