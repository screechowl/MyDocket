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
// delete_confirm.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin); ?>
<!--<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="JavaScript:window.close()"><small>Close</small></a></td></tr>
</table>-->
<br><br>

<center>DELETE CONFIRM</center><br>
<?
if ($submityes=="" and $submitno==""){
// Display the delete record form
?>
<form method=post action="<?=$PHP_SELF;?>">
<input type="hidden" name="module" value="<?=$module;?>">
<input type="hidden" name="TABLE" value="<?=$TABLE;?>">
<input type="hidden" name="ID" value="<?=$ID;?>">
<input type="hidden" name="NAME" value="<?=$NAME;?>">
<table align="center" width="500">
    <tr><td align="center">
	    Are you sure you want to delete <?=$NAME;?>?<br><br>
    </td></tr>
	<tr><td align="center">
        <input type=submit name="submityes" value=" YES ">
        <input type=submit name="submitno" value=" NO ">
    </td></tr>
</table><br>
<?
}
elseif ($submityes!="") {

  if ($TABLE=="pat_filings"){
    $sql = "DELETE FROM pat_filings WHERE pat_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
	// Delete Associated Records
	$sql = "DELETE FROM pat_actions WHERE pat_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
	$sql = "DELETE FROM pat_inventors WHERE pat_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");}
	  	
  elseif ($TABLE=="pat_actions"){
    $sql = "DELETE FROM pat_actions WHERE action_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");}
	  
  elseif ($TABLE=="tm_filings"){
    $sql = "DELETE FROM tm_filings WHERE tm_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
	// Delete Associated Records
	$sql = "DELETE FROM tm_actions WHERE tm_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
	$sql = "DELETE FROM tm_inventors WHERE tm_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");}
	  
  elseif ($TABLE=="tm_actions"){
    $sql = "DELETE FROM tm_actions WHERE action_ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");}
	  
  else {
    $sql = "DELETE FROM $TABLE WHERE ID='$ID'";
    if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");}
?>
<table align="center" width="500"><br>
<p><strong>Your record has been successfully deleted.</strong></p>
</table><br>
<?
}
else {
?>
<table align="center" width="500"><br>
<p><strong>Your record has NOT been deleted.</strong></p>
</table><br>
<?
}
html_footer();?>
