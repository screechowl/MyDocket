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
// edit_autoaction.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<?
// For new records, incoming link is set to $ID="0" and I="0"
// Otherwise, $ID is set to the existing record number
if ($I=="1"){
$sql="SELECT * FROM autoactions WHERE ID='$ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
  $ID=$row["ID"];
  $ip_type = $row["ip_type"];		  
  $country = $row["country"];
  $action_type = $row["action_type"];
  $original_only = $row["original_only"];
  $recurring = $row["recurring"];
  $due_month = $row["due_month"];
  $due_day = $row["due_day"];
  $due_year = $row["due_year"];
  $due_time = $row["due_time"];
  $reference_date = $row["reference_date"];
  $on_off = $row["on_off"];
  $description = $row["description"];
  $creator = $row["creator"];
  $create_date = $row["create_date"];
  $editor = $row["editor"];
  $edit_date = $row["edit_date"];			  
}?>
<!-- ADD OR EDIT AUTO ACTIONS -->
<? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
<? if ($ID!="0"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">
    <a href="delete_confirm.php?TABLE=autoactions&ID=<?=$ID;?>&NAME=Auto Action for <?=$action_type;?>">Delete</a>
  </td></tr>
</table>
<?}?><br><br>
<? if ($ID=="0") echo("<center>ADD AUTO ACTION</center>");
   else echo("<center>EDIT AUTO ACTION</center>");
if ($submitok=="" or $action_type=="" or $ip_type=="" or $country=="" or $action_type==""){?>
<form method=post action="<?=$PHP_SELF;?>">
  <input type="hidden" name="ID" value="<?=$ID;?>">
  <input type="hidden" name="I" value="0">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="10">
    <? if ($ID!="0"){?>
	<tr>
        <td align=right width="150">
            Duplicate
        </td>
        <td width="400">
            <input type="checkbox" name="duplicate" value="Y">&nbsp;&nbsp;Saves Data as a New Record
        </td>
    </tr>
	<?}?>
  <tr>
      <td align=right width="150">
          Type IP
      </td>
      <td width="400">
          <select name=ip_type type=text>
          <option><?=$ip_type;?></option>
          <option>PATENT</option>
	      <option>TRADEMARK</option>
	      </select>
          <font color="orangered" size="+1"><TT><B>*</B></TT></font>
      </td>
  </tr>
  <tr>
      <td align=right width="150">
          Country
      </td>
      <td width="400">
            <select name=country size="1">
            <option><?=$country;?></option>
			<? country_list();?>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#country_codes">Country Codes</a>
      </td>
  </tr>
  <tr>
      <td align=right width="150">
          Action Type
      </td>
      <td width="400">
          <select name=action_type type=text>
          <option><?=$action_type;?></option>
          <option>Foreign Filing</option>
	      <option>Publication</option>
	      <option>Chapter II</option>
	      <option>National Stage</option>
	      <option>Maintenance Fee 3.5</option>
	      <option>Maintenance Fee 7.5</option>
	      <option>Maintenance Fee 11.5</option>
	      <option>Section 8</option>
	      <option>Section 15</option>
	      <option>Other</option>
	      </select>
          <font color="orangered"><TT><B>*</B></TT></font>
      </td>
  </tr>
  <tr>
      <td align=right width="150">
          Original Filing Only
      </td>
      <td width="400">
          <select name=original_only type=text>
          <option><?=$original_only;?></option>
          <option>N</option>
	      <option>Y</option>
	      </select>
          <font color="orangered"><TT><B>*</B></TT></font>
		  &nbsp;&nbsp;Applies Only To An Original Filing
      </td>
  </tr>
  <tr>
      <td align=right width="150">
          Recurring
      </td>
      <td width="400">
          <select name=recurring type=text>
          <option><?=$recurring;?></option>
          <option>N</option>
	      <option>Y</option>
	      </select>
          <font color="orangered"><TT><B>*</B></TT></font>
		  &nbsp;&nbsp;Set After Previous Action Is Completed
      </td>
  </tr>
  <tr>
    <td align="right" width="150">
      Date Due
    </td>
    <td width="400">
      <input type="text" name="due_year" value="<?=$due_year;?>" maxlength="4" size="5">&nbsp;Years&nbsp;
      <input type="text" name="due_month" value="<?=$due_month;?>" maxlength="2" size="3">&nbsp;Months&nbsp;
      <input type="text" name="due_day" value="<?=$due_day;?>" maxlength="2" size="3">&nbsp;Days
      <font color="orangered"><TT><B>*</B></TT></font>
    </td>
  </tr>
  <tr>
      <td align=right width="150">
          Reference Date
      </td>
      <td width="400">
          <select name=reference_date type=text>
          <option><?=$reference_date;?></option>
          <option>Priority Date</option>
	      <option>Filing Date</option>
	      <option>Issue Date</option>
	      <option>Other</option>
	      </select>
          <font color="orangered"><TT><B>*</B></TT></font>
      </td>
  </tr>
  <tr>
      <td align=right width="150">
          On or Off
      </td>
      <td width="400">
          <select name=on_off type=text>
          <option><?=$on_off;?></option>
          <option>ON</option>
	      <option>OFF</option>
	      </select>
          <font color="orangered"><TT><B>*</B></TT></font>
      </td>
  </tr>
  <tr>
    <td align="right" width="150">
      Action Description
    </td>
    <td width="400">
      <textarea wrap name=description rows=2 cols=35><?=$description;?></textarea>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <hr noshade size="1" width="100%">
      <input type="submit" name="submitok" value="  OK  ">
    </td>
  </tr>
</table>
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}
else {

// Make time for due date -- not exact, but close enough for ordering
$due_time = ($due_day * 86400) + ($due_month * 2592000) + ($due_year * 31104000);

if ($ID=="0" or $duplicate=="Y") { // ADD NEW RECORD
  $create_date = date("F j, Y");   // e.g. March 10, 2001
  $sql="INSERT INTO autoactions SET
    customer_ID='$customer_ID',
    ip_type = '$ip_type',		  
    country = '$country',
    action_type = '$action_type',
	original_only = '$original_only',
    recurring = '$recurring',
    due_month = '$due_month',
    due_day = '$due_day',
    due_year = '$due_year',
    due_time = '$due_time',
    reference_date = '$reference_date',
    on_off = '$on_off',
    description = '$description',
    creator = '$fullname',
    create_date = '$create_date'";
}
	
else { // UPDATE EXISTING RECORD
  $edit_date = date("F j, Y");   // e.g. March 10, 2001
  $sql="UPDATE autoactions SET
    customer_ID='$customer_ID',
    ip_type = '$ip_type',		  
    country = '$country',
    action_type = '$action_type',
	original_only = '$original_only',
    recurring = '$recurring',
    due_month = '$due_month',
    due_day = '$due_day',
    due_year = '$due_year',
    due_time = '$due_time',
    reference_date = '$reference_date',
    on_off = '$on_off',
    description = '$description',
    editor = '$fullname',
    edit_date = '$edit_date'
	WHERE ID='$ID'";
}
	
// RUN THE QUERY	
if (!mysql_query($sql))
  error("A database error occurred in processing your ".
  "submission.\\nIf this error persists, please ".
  "contact info@ipdox.com.");
?>
<!-- DONE -->
<table align="center" width="500"><tr><td><br>
<p><strong>Your record has been successfully updated.</strong></p>
<p> To return to the login page, click <a href="index.php">here</a></p>
<p> To view auto actions, click <a href="autoactions_list.php">here</a></p>
<p> To add another auto action, click <a href="autoactions_edit.php?ID=0&I=0">here</a></p>
</td></tr></table>
<?}}
else echo("ACCESS DENIED<br>");
html_footer(); ?>
