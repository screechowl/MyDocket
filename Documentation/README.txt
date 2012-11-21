This is the README.TXT file for MyDocket.

(c)2001-2004 IP Group -- www.ipgroup.org

MyDocket is provided as Open Source under the Mozilla Public License
version 1.1, wich can be found at http://www.mozilla.org/MPL/MPL-1.1.html.

INSTALLATION

You will need a server running PHP/MySQL

1. Unzip the .zip file.
2. Move the files to your preffered directory, for example, /var/www/html/mydocket/
3. Create an empty database called "dbname" (pick whatever you want).
4. Edit the db.php file to identify the MySQL user, password and datbase name.
5. Move the db.php file to an include directory at the same level as the html
   directory (this is for security so that a web user cannot access your MySQL information).
   For example: /var/www/include/mydocket/db.php
6. If you don't have rights to create an "include" directory at the same level, then just
   edit accesscontrol.php to point to the db.php file wherever you choose to put it.
   For example, change include("../../include/mydocket/db.php");
   to include("db.php");
7. in my *.sql file, the last table is users, and just change the user 'admin' to whatever
   Admin name you want to use, then login with this username (no password needed the first time), and
   create a password and any additional users that you want to use.

INFORMATION

1. The 'autoactions' table and file allows you to add and remove automatically generated docket
   actions to create docket entries, for example, paying maintenance fees following isuuance of
   a patent, or renewal of a trademark.  The table is originally populated for most US autoactions.
2. The 'menus' table and file allows you to add and remove pull-down menu items.

CHANGELOG

1.2 Uses the old menu style and old filename convention, e.g., view_patents.php
1.3 uses the new menu style and continues old filename convention, e.g., view_patents.php
1.4 uses the new menu style and uses the new modular filename convention, e.g., patents_list.php

VARIABLES:

If your register_globals is off, try this (from www.php.net under Predefined Variables)

14-Mar-2003 12:59
After having register_globals = off, I am using the following piece of code to get all the variables created for me. I have put this code in a separate file and just make it require_once() on top of every page.

session_start();
$ArrayList = array("_GET", "_POST", "_SESSION", "_COOKIE", "_SERVER");
foreach($ArrayList as $gblArray)
{
   $keys = array_keys($$gblArray);
   foreach($keys as $key)
   {
       $$key = trim(${$gblArray}[$key]);
   }
}

This pulls out all the possible variables for me, including the predefined variables, so I can keep coding the old style. Note that, this code does not handle the $_FILE.

Hope this helps someone.