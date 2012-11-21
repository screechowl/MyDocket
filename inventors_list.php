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
//
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<br><br>
<? if ($EDIT=="Y" and $PAT_ID!="0") echo("<center>ADD INVENTOR TO PATENT APPLICATION</center>");
  else echo("<center>LIST INVENTORS</center>"); ?><br>
<?
if ($submitok!=""){
// An Inventor to add
if ($INVENTOR_ID!=""){
  if ($EDIT=="Y" and $PAT_ID!="0") // PAT UPDATE
    $sql="INSERT INTO pat_inventors SET
      customer_ID='$customer_ID',
      pat_ID='$PAT_ID',
      inventor_ID='$INVENTOR_ID'";
      if (!mysql_query($sql))
             error("A database error occurred in processing your ".
              "submission.\\nIf this error persists, please ".
              "contact info@ipdox.com.");}
  
// An Inventor to delete
if ($INVENTOR_DELETE_ID!=""){
  if ($EDIT=="Y" and $PAT_ID!="0") // PAT UPDATE
    $sql="DELETE FROM pat_inventors WHERE ID='$INVENTOR_DELETE_ID'";
    if (!mysql_query($sql))
             error("A database error occurred in processing your ".
              "submission.\\nIf this error persists, please ".
              "contact info@ipdox.com.");}
}
?>
<form method=get action="<?=$PHP_SELF;?>">
<? if ($EDIT=="Y"){?>
<!-- EXISTING INVENTORS -->
<table align="center" width="100%" cellpadding="5">
<tr><td colspan="6"><small><u>EXISTING INVENTORS FOR CASE</u></small></td></tr>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="20"><U>Delete</U></td>
  <td width="125"><U>First Name</U>
  <td width="130"><U>Last Name</U>
  <td width="125"><U>Company</U>
  <td width="125"><U>Telephone</U>
  <td width="125"><U>email</U>
</font></tr>
<?
// SQL Query for Selecting Existing Inventors
if ($PAT_ID!="0") // PAT FILING UPDATE
  $sql_1="SELECT * FROM pat_inventors WHERE
  customer_ID='$customer_ID' and
  pat_ID='$PAT_ID'";
$result_1=mysql_query($sql_1);
while($row_1=mysql_fetch_array($result_1)){
  $inventor_ID=$row_1["inventor_ID"];
  $pat_inventor_ID=$row_1["ID"];
  $sql_2="SELECT * FROM inventors WHERE
    ID='$inventor_ID'";
  $result_2=mysql_query($sql_2);
  // Print the records
  $row_2=mysql_fetch_array($result_2);
    $ID=$row_2["ID"];		  
    $first_name = $row_2["first_name"];		  
    $last_name = $row_2["last_name"];
    $company = $row_2["company"];
    $tel = $row_2["tel"];
    $email = $row_2["email"];
?>
<tr bgcolor=EEEEEE>
  <td width="20"><small><input type="radio" name="INVENTOR_DELETE_ID" value="<?=$pat_inventor_ID;?>"></small></td>
  <td width="125"><small><?=$first_name;?></small></td>
  <td width="130"><small><a href="inventors_edit.php?module=<?=$module;?>&ID=<?=$ID;?>&I=1"><?=$last_name;?></a></small></td>
  <td width="100"><small><?=$company;?></small></td>
  <td width="100"><small><?=$tel;?></small></td>
  <td width="100"><small><?=$email;?></small></td>
</tr>
<?}?>
</table>
<?}?>
  <input type="hidden" name="PAT_ID" value="<?=$PAT_ID?>">
  <input type="hidden" name="EDIT" value="<?=$EDIT?>">
  <? if ($submit_50 != "") $START=$START+50;
     else $START="0";?>
  <input type="hidden" name="START" value="<?=$START?>">
<table align="center" width="650" cellpadding="5">
  <? if ($EDIT=="Y") echo("<tr><td><small><u>POTENTIAL INVENTORS TO ADD</u></small></td></tr>"); ?>
  <tr><td>
  <small>LAST NAME&nbsp;<input type="text" name="LAST_NAME_SEARCH" maxlength="10" size="10" value="<?=$LAST_NAME_SEARCH;?>"></small>&nbsp;&nbsp;
  <small>COMPANY&nbsp;<input type="text" name="COMPANY_SEARCH" maxlength="30" size="10" value="<?=$COMPANY_SEARCH;?>"></small>&nbsp;&nbsp;
  <input type="submit" name="submit_search" value=" SEARCH ">&nbsp;&nbsp;
  <input type="submit" name="submit_50" value=" NEXT 50 ">&nbsp;&nbsp;
  <small><a href="inventors_edit.php?module=<?=$module;?>&EDIT=Y&I=0&ID=0">ADD INVENTOR</a></small>
  </td></tr>
</table>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <? if ($EDIT=="Y"){?><td width="20"><U>Add</U></td><?}?>
  <td width="125"><U>First Name</U><!--
    <a href="<?=$PHP_SELF;?>?ORDER=first_name"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?ORDER=first_name DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>-->
  <td width="130"><U>Last Name</U><!--
    <a href="<?=$PHP_SELF;?>?ORDER=last_name"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?ORDER=last_name DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>-->
  <td width="125"><U>Company</U><!--
    <a href="<?=$PHP_SELF;?>?ORDER=company"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?ORDER=company DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>-->
  <td width="125"><U>Telephone</U><!--
    <a href="<?=$PHP_SELF;?>?ORDER=tel"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?ORDER=tel DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>-->
  <td width="125"><U>email</U><!--
    <a href="<?=$PHP_SELF;?>?ORDER=email"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?ORDER=email DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>-->
</font></tr>
<?
// SQL Query for Selecting All $TYPE IP Records
//  $sql="SELECT * FROM inventors WHERE customer_ID='$customer_ID' ORDER BY last_name LIMIT $START, 50";
  $sql="SELECT * FROM inventors WHERE
  customer_ID='$customer_ID' and
  last_name LIKE '%$LAST_NAME_SEARCH%' and
  company LIKE '%$COMPANY_SEARCH%'
  ORDER BY last_name
  LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $ID=$row["ID"];
  $member = $row["member"];		  
  $first_name = $row["first_name"];		  
  $last_name = $row["last_name"];
  $company = $row["company"];
  $tel = $row["tel"];
  $email = $row["email"];
?>
<tr bgcolor=EEEEEE>
  <? if ($EDIT=="Y"){?><td width="20"><small><input type="radio" name="INVENTOR_ID" value="<?=$ID;?>"></small></td><?}?>
  <td width="125"><small><?=$first_name;?></small></td>
  <td width="130"><small><a href="inventors_edit.php?module=<?=$module;?>&ID=<?=$ID;?>&I=1"><?=$last_name;?></a></small></td>
  <td width="100"><small><?=$company;?></small></td>
  <td width="100"><small><?=$tel;?></small></td>
  <td width="100"><small><?=$email;?></small></td>
</tr>
<?}?>
</table>
<? if ($EDIT=="Y"){?>
<br><center>
  <input type="submit" name="submitok" value=" SUBMIT ">
</center><?}?>
<? html_footer(); ?>
