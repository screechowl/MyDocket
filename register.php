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
// register.php
include("common.php");
include("../../include/mydocket/db.php");
html_header($fullname,$module,$orgadmin);

  if ($read_only=="Y"){
    echo("<br><center>ACCESS DENIED THIS IS A READ-ONLY SYSTEM</center><br>");
    html_footer();
    exit;
  }
?>
<center><br>REGISTER FOR MYDOCKET<br>
<table align="center" width="650">
<?
if ($submitok=="" or $org_new=="" or $username_new=="" or $password_new=="" or $fullname_new=="" or $email_new=="" or $company_new==""){
// Display the add customer form
?>
<form method=post action="<?=$PHP_SELF;?>">
<table align="center" width="650" border="0" cellpadding="0" cellspacing="10">
    <tr>
        <td width="150">
        </td>
        <td width="400">
            To register, please complete the following form.
        </td>

    </tr>
    <tr>
        <td align=right width="150">
            Organization
        </td>
        <td width="400">
            <input name=org_new type=text maxlength=35 size=35 value="<?=$org_new;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr><!--
    <tr>
        <td align=right width="150">
            Subscription Type
        </td>
        <td width="400">
            <select name=subscribe_type size="1">
	        <option><?=$subscribe_type;?></option>
	        <option>A</option>
	        <option>B</option>
	        <option>C</option>
	        <option>D</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
	        &nbsp;&nbsp;<a target="_blank" href="about.php#subscribe_type">Categories</a>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Payment Period
        </td>
        <td width="400">
            <select name=subscribe_period size="1">
	        <option><?=$subscribe_period;?></option>
	        <option>Month</option>
	        <option>Year</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>-->
    <tr>
        <td align=right width="150">
            Username
        </td>
        <td width="400">
            <input name=username_new type=text maxlength=35 size=35 value="<?=$username_new;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Password
        </td>
        <td width="400">
            <input name=password_new type=password maxlength=35 size=35 value="<?=$password_new?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Full Name
        </td>
        <td width="400">
            <input name=fullname_new type=text maxlength=100 size=35 value="<?=$fullname_new;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Company
        </td>
        <td width="400">
            <input name=company_new type=text maxlength=100 size=35 value="<?=$company_new;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Street
        </td>
        <td width="400">
            <input name=street_new type=text maxlength=100 size=35 value="<?=$street_new;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            City
        </td>
        <td width="400">
            <input name=city_new type=text maxlength=100 size=35 value="<?=$city_new;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            State
        </td>
        <td width="400">
            <select name=state_new size="1">
            <option><?=$state_new;?></option>
			<? state_list(); ?>
            </select>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Zip Code
        </td>
        <td width="400">
            <input name=zip_new type=text maxlength=100 size=35 value="<?=$zip_new;?>">
        </td>
    </tr>
	<tr>
		<td align=right width="150">
            Country
        </td>
        <td width="400">
            <input name=country_new type=text maxlength=100 size=35 value="<?=$country_new;?>">
        </td>
	</tr>
    <tr>
        <td align=right width="150">
            Telephone
        </td>
        <td width="400">
            <input name=tel_new type=text maxlength=100 size=35 value="<?=$tel_new;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Fax
        </td>
        <td width="400">
            <input name=fax_new type=text maxlength=100 size=35 value="<?=$fax_new;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            email
        </td>
        <td width="400">
            <input name=email_new type=text maxlength=100 size=35 value="<?=$email_new;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
	<tr>
        <td align=right width="150">
            Notes
        </td>
        <td width="400">
            <textarea wrap name=notes_new rows=2 cols=35><?=$notes_new;?></textarea>
        </td>
	</tr>	
    <tr>
        <td align="center" colspan="4" width="650">
            <hr noshade size="1" width="650">
            <input type=submit name="submitok" value="   OK   "><br>
        </td>
    </tr>
</table>

<?}
else{

// Check for existing user with the new organization name
    $sql = "SELECT COUNT(*) FROM customers WHERE org = '$org_new'";
    $result = mysql_query($sql);
    if (!$result) {
       error("A database error occurred in processing your ".
           "submission.\\nIf this error persists, please ".
           "contact info@mydocket.com.");
               }
    if (mysql_result($result,0,0)>0) {
       error("An organization already exists with your chosen Organization name.\\n".
            "Please try another.");    }

// Check for existing user with the new username
    $sql = "SELECT COUNT(*) FROM users WHERE username = '$username_new'";
    $result = mysql_query($sql);
    if (!$result) {
       error("A database error occurred in processing your ".
           "submission.\\nIf this error persists, please ".
           "contact info@mydocket.com.");
               }
    if (mysql_result($result,0,0)>0) {
       error("A user already exists with your chosen username.\\n".
            "Please try another.");    }

// Process record submission

$sql = "INSERT INTO customers SET
        org = '$org_new',
        subscribe_type = '$subscribe_type',
		subscribe_period = '$subscribe_period',
		substart_date = '$today'";
     if (!mysql_query($sql)){
             error("A database error occurred in processing your ".
              "customer submission.\\nIf this error persists, please ".
              "contact info@mydocket.com.");
             }
			 
// Get the ID of the new record
$customer_ID=mysql_insert_id();
// Set privileges for new admin			 
$orgadmin_new = "Y";
$memadmin_new = "Y";
			 
    $sql = "INSERT INTO users SET
              customer_ID = '$customer_ID',
              username = '$username_new',
              userorg = '$org_new',
              member = '$org_new',
			  orgadmin = '$orgadmin_new',
			  memadmin = '$memadmin_new', 			  
              password = PASSWORD('$password_new'),
			  fullname = '$fullname_new',
			  company = '$company_new',
			  street = '$street_new',
			  city = '$city_new',
			  state = '$state_new',
			  zip = '$zip_new',
			  country = '$country_new',
			  tel = '$tel_new',
			  fax = '$fax_new',
			  email = '$email_new',
              notes = '$notes_new'";
     if (!mysql_query($sql)){
             error("A database error occurred in processing your ".
              "username submission.\\nIf this error persists, please ".
              "contact info@mydocket.com.");
             }
 
// Now that the user has been registered in the database, the script needs to
// send an email message indicating the password that has been assigned to the
// user. This is easily done using PHP’s email function.

$message = "Thank you for registering with MyDocket.
Your account for the MyDocket Web Site has been created.
To log in, proceed to the following address:
    http://www.mydocket.com
    
Your login ID and password are as follows:
    username: $username_new
    password: $password_new

Please read the user manual by pressing the HELP link when you first log on.
As the administrator, you will see an administrative control panel where you 
will add service provider firms and clients so that the records can be 
accurately sorted.  Also, you will be able to add additional users to your 
account and restrict their privileges as required.

NOTE THAT THERE ARE NO WARRANTIES OF ANY KIND ASSOCIATED WITH THIS SERVICE.

If you have any problems or questions, please contact info@mydocket.com.
  
-MyDocket Webmaster";

mail($email_new,"MyDocket Login Information",
     $message, "From:MyDocket <info@mydocket.com>");
	 
// Notify MyDocket of a new subscriber

$message = "There's a new subscriber with:
    org: $org_new
    username: $username_new
    email: $email_new";
	
mail("info@mydocket.com","MyDocket New Subscriber",
     $message, "From:MyDocket <info@mydocket.com>");

?>
<table align="center" width="400"><br>
<p><strong>Your Registration Was Successful!</strong></p>
<p>We have sent you an e-mail with your login information.</p>
<p> To return to the login page, click <a href="index.php">here</a></p><br>
</table>
<?}
html_footer(); ?>
