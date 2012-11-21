<?php
/*********************************************************************************
 * The contents of this file are subject to the Mozilla Public License Version 1.1.
 * ("License"); You may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://www.mozilla.org/MPL/.
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  MyDocket Open Source.
 * The Initial Developer of the Original Code is IP Group (www.ipgroup.org).
 * Portions created by IP Group are Copyright (C) IP Group, All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
// accesscontrol.php
include("common.php");
include("../../include/mydocket/db.php"); // DATABASE ACCESS FILE
// Call session_start to either begin a new session, or load the variables 
// belonging to the user's current session.
session_start();
// At this point, the user's login details should be available whether they were
// just submitted from a login form or stored in the user's session. The only
// case in which the user's ID and password would not be available at this point
// in the script is if they had not yet been entered during this visit to the
// site. Thus, the script checks to see if the $uid variable (which will contain
// the user's ID) exists. If it doesn't, the user is presented with a login form
// and the script exits.
if ($LOGOUT=="1") {
  unset($uid);
  unset($pwd);
  session_destroy();}
if(!isset($uid)) {
html_headeracc(); ?>
<br><br>  
<center>MYDOCKET LOGIN</center><br>
<table align="center" width="300" border="0">
<form method="post" action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="Home">
  <tr>
    <td align="right">
      <small>User ID:&nbsp;&nbsp;</small>
    </td>
    <td align="left" valign="top">
      <input type="text" name="uid" size="20">
    </td>
  </tr>
  <tr>
    <td align="right">
      <small>Password:&nbsp;&nbsp;</small>
    </td>
    <td align="left" valign="top">
      <input type="password" name="pwd" SIZE="20">
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="Log in">
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><br>
	  <font color="#ff0000">For demo, use login "guest"<br>and password "demo"</font>
	</td>
  </tr>
</table>
<!-- new stuff-->
</td><td>
<table align="center" width="400" border="0">
<tr><td>
<p>MyDocket is an Open Source intellectual property docket and management program.</p>
<p><a target='_blank' href="http://sourceforge.net/projects/mydocket/">
Download the latest version at SourceForge</a></p>
</td></tr>
</table>
</td></tr><tr><td colspan="2"><center><hr WIDTH="90%"></center>
<? html_footer();
  exit;
}

// When the login form above is submitted, the page will be reloaded, this time
// with the $uid and $pwd variables set to the user's ID and password. The next
// step according to the flowchart above is to register these as session
// variables, ensuring that they are available to all other protected pages that
// the user views during this visit. Note that, at this point, the script still
// doesn't know whether or not the user ID and password that were entered are
// valid.

session_register("uid");
session_register("pwd");

// To find out if the user ID and password are valid, the script searches the
// database for matching entries. In the SELECT query, I encoded the $pwd
// variable using MySQL's PASSWORD function to match it against the stored
// password, which is also encoded.

$sql = "SELECT * FROM users WHERE
        username='$uid' AND password=PASSWORD('$pwd')";
$result = mysql_query($sql);
if (!$result) {
  error("A database error occurred while checking your ".
        "login details.\\nIf this error persists, please ".
        "contact info@ipdox.com.");
}

// If no matching rows are found in the database, then the login details provided
// are incorrect. The script checks for this using the mysql_num_rows function,
// and displays a message denying access to the site, and inviting the user to
// try logging in again. To make this possible, the script also unregisters the
// two session variables ($uid and $pwd) so that the next time the script is run
// it will display the login form. Since the variables were registered earlier
// in the script before checking their validity, the script doesn't need to check
// if they're registered before attempting to unregister them.

if (mysql_num_rows($result) == 0) {
  session_unregister("uid");
  session_unregister("pwd");
  html_headeracc(); ?>
  <br><center>ACCESS DENIED</center><br>
  <table align="center" width="600">Your user ID or password is incorrect,
  or you are not a registered user on this site.<br>To try logging in again, click
  <a href="index.php">here</a>.</table><br>
  <? html_footer();
  exit;
}

// Now that the login details have been stored as session variables and checked
// for validity, the script can safely grant access to the requested page. The
// last thing to do before ending accesscontrol.php and handing control back to
// the protected page is to grab the user's information, which is available from
// the MySQL result set generated earlier on. This doesn't need to be registered
// as a session variable, since it will be retrieved again by each protected page
// using the $uid and $pwd values stored in the session.

$accessrow=mysql_fetch_array($result);
$username = $accessrow["username"];
$fullname = $accessrow["fullname"];
$email = $accessrow["email"];
$userorg = $accessrow["userorg"];
$customer_ID = $accessrow["customer_ID"];
$member = $accessrow["member"];
$company = $accessrow["company"];
$sysadmin = $accessrow["sysadmin"];
$orgadmin = $accessrow["orgadmin"];
$memadmin = $accessrow["memadmin"];
$userid = $accessrow["ID"];
$today = date("Y-m-d");   // e.g. 2051-10-22
?>

