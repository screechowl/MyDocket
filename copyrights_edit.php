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
// full_copyright.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<?
// For new records, incoming link is set to $ID="0" and I="0"
// Otherwise, $ID is set to the existing record number
// SQL Query for an existing NDA record and retrieving data
if ($I=="1"){
$sql="SELECT * FROM copyrights WHERE ID='$ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
    $docket = $row["docket"];
    $org = $row["org"];
    $firm = $row["firm"];
    $firm_contact = $row["firm_contact"];
    $client = $row["client"];
    $title = $row["title"];
    $authors = $row["authors"];
	$filing_type = $row["filing_type"];
	$country = $row["country"];
	$status = $row["status"];
    $filing_date = $row["filing_date"];
    $pub_date = $row["pub_date"];
	$issue_date = $row["issue_date"];
	$c_no = $row["c_no"];
    $description=$row["description"];
    $notes=$row["notes"];
    $creator=$row["creator"];
    $create_date=$row["create_date"];
    $editor=$row["editor"];
    $edit_date=$row["edit_date"];
}
if (($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y") and $read_only=="N" and $EDIT=="Y"){?>
<? if ($ID!="0"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="100" align="center">
  <a href="delete_confirm.php?module=<?=$module;?>&TABLE=copyrights&ID=<?=$ID;?>&NAME=<?=$docket;?>">Delete</a></td>
  </td></tr>
</table>
<?}?><br><br>
<? if ($ID=="0") echo("<center>ADD COPYRIGHT RECORD</center><br>");
   else echo("<center>EDIT COPYRIGHT RECORD</center><br>");
if ($submitok=="" or $docket=="" or $firm=="" or $title=="" or $filing_type=="" or $status=="" or $country=="" or $authors==""){?>
<table align="center" width="500">
</table><br>
<form method=post action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="SORT" value="<?=$SORT;?>">
  <input type="hidden" name="VAR" value="<?=$VAR;?>">
  <input type="hidden" name="ID" value="<?=$ID;?>">
  <input type="hidden" name="I" value="0">
  <input type="hidden" name="EDIT" value="Y">
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
            Title
        </td>
        <td width="400">
            <input name="title" type="text" maxlength="100" size="35" value="<?=$title;?>">
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Docket Number
        </td>
        <td width="400">
            <input name="docket" type="text" maxlength="35" size="35" value="<?=$docket;?>">
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Service Firm
        </td>
        <td width="400">
            <select name="firm" size="1">
			<option><?=$firm;?></option>
		    <? $sql="SELECT * FROM menus WHERE org='$userorg' and menu_type='FIRM' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Contact
        </td>
        <td width="400">
            <input name="firm_contact" type="text" maxlength="100" size="35" value="<?=$firm_contact;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Client
        </td>
        <td width="400">
            <select name="client" size="1">
			<option><?=$client;?></option>
		    <? $sql="SELECT * FROM menus WHERE org='$userorg' and menu_type='CLIENT' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Type
        </td>
        <td width="400">
            <select name="filing_type" size="1">
            <option><?=$filing_type;?></option>
            <? $sql="SELECT * FROM menus WHERE org='$userorg' and menu_type='COPYRIGHT_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
	<tr>
		<td align=right width="150">
            Country
        </td>
        <td width="400">
            <input name="country" type="text" maxlength="100" size="35" value="<?=$country;?>">
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Filing Date
        </td>
        <td width="400">
            <input type="text" name="filing_date" size="8" maxlength="10" value="<?=$filing_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Publication Date
        </td>
        <td width="400">
            <input type="text" name="pub_date" size="8" maxlength="10" value="<?=$pub_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Issue Date
        </td>
        <td width="400">
            <input type="text" name="issue_date" size="8" maxlength="10" value="<?=$issue_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Reg. No.
        </td>
        <td width="400">
            <input name="c_no" type="text" maxlength="25" size="25" value="<?=$c_no;?>">
        </td>
	</tr>
    <tr valign=top>
        <td align=right width="150">
            Authors
        </td>
        <td width="400">
            <textarea wrap name="authors" rows="3" cols="35"><?=$authors;?></textarea>
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Status
        </td>
        <td width="400">
            <select name="status" size="1">
            <option><?=$status;?></option>
		    <? $sql="SELECT * FROM menus WHERE org='$userorg' and menu_type='COPYRIGHT_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
	<tr>
        <td align=right width="150">
            Description
        </td>
        <td width="400">
            <textarea wrap name="description" rows="2" cols="35"><?=$description;?></textarea>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Notes
        </td>
        <td width="400">
            <textarea wrap name="notes" rows="2" cols="35"><?=$notes;?></textarea>
        </td>
	</tr>	
    <tr>
        <td align="center" colspan="4" width="100%">
            <hr noshade size="1" width="500">
            <input type=submit name="submitok" value="   OK   ">
        </td>
    </tr>
</table>

<?}
// UPDATE RECORD
else{

if ($ID=="0" or $duplicate=="Y") // ADD NEW COPYRIGHT
    $sql = "INSERT INTO copyrights SET
              customer_ID = '$customer_ID',
              docket = '$docket',
              org = '$userorg',
              firm = '$firm',
              firm_contact = '$firm_contact',
              client = '$client',
              title = '$title',
              filing_type = '$filing_type',
			  authors = '$authors',
			  country = '$country',
			  status = '$status',
              filing_date = '$filing_date',
              pub_date = '$pub_date',
			  issue_date = '$issue_date',
			  c_no = '$c_no',
			  description = '$description',
              notes = '$notes',
			  creator='$fullname',
			  create_date='$today'";

else // UPDATE EXISTING COPYRIGHT
    $sql = "UPDATE copyrights SET
              customer_ID = '$customer_ID',
              docket = '$docket',
              org = '$userorg',
              firm = '$firm',
              firm_contact = '$firm_contact',
              client = '$client',
              title = '$title',
              filing_type = '$filing_type',
			  authors = '$authors',
			  country = '$country',
			  status = '$status',
              filing_date = '$filing_date',
              pub_date = '$pub_date',
			  issue_date = '$issue_date',
			  c_no = '$c_no',
			  description = '$description',
              notes = '$notes',
			  editor='$fullname',
			  edit_date='$today'
              WHERE ID='$ID'";
			  
// RUN THE QUERY
     if (!mysql_query($sql)){
             error("A database error occurred in processing your ".
              "submission.\\nIf this error persists, please ".
              "contact info@ipdox.com.");
             }
?>
<table align="center" width="500">
<p><strong>Your record has been successfully updated.</strong></p>
<p> To return to the login page, click <a href="index.php">here</a></p>
<p> To view copyright records, click <a href="copyrights_view.php?module=<?=$module;?>&SORT=<?=$SORT;?>&VAR=<?=$VAR?>&ORDER=docket">here</a></p>
</table>
<? }} ?>
<!-- DISPLAY -->
<? if ($EDIT=="N") { ?>
<? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="100" align="center">
  <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&VAR=<?=$VAR?>&ID=<?=$ID?>&I=1&EDIT=Y">Edit</a>
  </td></tr>
</table>
<?}?><br><br>
<center>FULL COPYRIGHT RECORD</center><br>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="10">
    <tr>
        <td align=right width="150">
            Title
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$title;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Docket Number
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$docket;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Service Firm
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$firm;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Contact
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$firm_contact;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Client
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$client;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Type
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$filing_type;?>
        </td>
    </tr>
	<tr>
		<td align=right width="150">
            Country
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$country;?>
        </td>
	</tr>
    <tr>
        <td align=right width="150">
            Status
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$status;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Authors
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$authors;?>
        </td>
    </tr>
	<tr>
        <td align=right width="150">
            Filing Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$filing_date;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Publication Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$pub_date;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Issue Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$issue_date;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Reg. No.
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$c_no;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Description
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$description;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Notes
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$notes;?>
        </td>
	</tr>
</table>
<?}?>
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table><br>
<? html_footer(); ?>
