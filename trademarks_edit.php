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
// trademarks_edit.php?module=<?=$module;
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
$var="DOCKET=$DOCKET&TITLE=$TITLE";
// Set Defaults
if ($NEXT=="1") $START=$START+50;
  else $START="0";
?>
<!-- SELECT RELATED TRADEMARK -->
<?
if ($TMFAM=="1") {
if ($submit_1=="" or $TM_ID==""){?>
<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="<?=$PHP_SELF;?>?module=<?=$module;?>?TMFAM=1&TMEDIT=0&NEXT=1&START=<?=$START;?>&<?=$var;?>"><small>Next 50</small></a></td></tr>
</table><br><br> 
<center>ADD TRADEMARK RECORD -- SELECT RELATED TRADEMARK</center><br>
<form method=get action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="TMFAM" value="1">
  <input type="hidden" name="TMEDIT" value="0">
  <input type="hidden" name="I" value="0">
  <input type="hidden" name="EDIT" value="Y">
<table align="center" width="100%" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td align="right" colspan="3">
	  <small>DOCKET&nbsp;<input type="text" name="DOCKET" maxlength="10" size="10" value="<?=$DOCKET;?>"></small>&nbsp;&nbsp;
      <small>TITLE&nbsp;<input type="text" name="TITLE" maxlength="30" size="10" value="<?=$TITLE;?>"></small>&nbsp;&nbsp;
      <input type="submit" name="submit_search" value=" SEARCH ">&nbsp;&nbsp;
      <input type="submit" name="submit_50" value=" NEXT 50 ">&nbsp;&nbsp;
      <small><a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=0&I=2&EDIT=Y&NEW=Y">ADD NEW TRADEMARK</a></small></td>
  </tr>
  <tr bgcolor=EEEEEE>
    <td width="20"><small>SELECT</small></td>
    <td width="50"><small>DOCKET</small></td>
    <td width="480"><small>TITLE</small></td>
  </tr>
  <?
//  if ($DOCKET!="" or $TITLE!="")
    $sql="SELECT tm_ID, docket, title FROM tm_filings WHERE
      customer_ID='$customer_ID' and
	  docket LIKE '%$DOCKET%' and
      title LIKE '%$TITLE%' and
	  original='Y'	
	  ORDER BY docket LIMIT $START, 50";
//  else
//     $sql="SELECT tm_ID, docket, title FROM tm_filings WHERE
//	  customer_ID='$customer_ID' and
//      original='Y'
//	  ORDER BY docket LIMIT $START, 50";
  $result=mysql_query($sql);
  while($row=mysql_fetch_array($result)){
    $TM_ID=$row["tm_ID"];
    $docket=$row["docket"];
    $title=$row["title"];
  ?>
  </td></tr>
  <tr bgcolor=EEEEEE>
    <td width="20"><input type="radio" name="TM_ID" value="<?=$TM_ID;?>"></td>
    <td width="100"><small><?=$docket;?></small></td>
    <td width="430"><small><a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMEDIT=1&TM_ID=<?=$TM_ID;?>&I=1&EDIT=N"><?=$title;?></small></td>
  </tr>
  <?}?>
  <tr>
    <td align="center" colspan="3">
      <hr noshade size="1" width="100%">
      <input type="submit" name="submit_1" value="  OK  ">
    </td>
  </tr>
</table>
<?}
else {

// The script copies the information from the original case to a new record
$sql="SELECT * FROM tm_filings WHERE tm_ID='$TM_ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
  $TMFAM_ID=$row["tmfam_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $firm=$row["firm"];
  $firm_contact=$row["firm_contact"];
  $client=$row["client"];
  $client_contact=$row["client_contact"];
  $filing_type=$row["filing_type"];
  $intl_class=$row["intl_class"];
  $priority_date=$row["priority_date"];
  $description=$row["description"];
  $products=$row["products"];
  
// Create the record that will be edited
$sql="INSERT INTO tm_filings SET
	customer_ID='$customer_ID',
    org='$userorg',
    tmfam_ID='$TMFAM_ID',
    original='N',
    docket='$docket',
    title='$title',
	firm='$firm',
	firm_contact='$firm_contact',
    client='$client',
    client_contact='$client_contact',
	filing_type='$filing_type',
	intl_class='$intl_class',
    priority_date='$priority_date',
    description='$description',
    products='$products',
	creator='$fullname',
	create_date='$today',
	editor='$fullname',
	edit_date='$today'";	
	
if (!mysql_query($sql))
  error("A database error occurred in processing your ".
  "submission.\\nIf this error persists, please ".
  "contact info@ipdox.com.");
  
// Get the ID of the new tm_filings record
$TM_ID_NEW=mysql_insert_id();

// Move on to adding the trademark filing record
$TMEDIT="1";
$I="1";
$TM_ID=$TM_ID_NEW;
$NEW="Y";
}}?>

<!-- ADD OR EDIT TRADEMARK RECORD -->
<?
if ($TMEDIT=="1") {

// If it's a brand new case ($I=="2"), we need to set up a trademark family number, 
// trademark number and identify the new trademark as an original
if ($I=="2") {
  $sql = "INSERT INTO tm_families SET
    customer_ID = '$customer_ID',
    org = '$userorg'";  
	if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
  $TMFAM_ID=mysql_insert_id();
  $sql = "INSERT INTO tm_filings SET
    customer_ID = '$customer_ID',
	tmfam_ID = '$TMFAM_ID',
    original='Y',
    org = '$userorg',
	creator='$fullname',
	create_date='$today',
	editor='$fullname',
	edit_date='$today'";  
	if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
  $TM_ID=mysql_insert_id();
  $original="Y";
  }

// To retrieve data, $TM_ID is set to the existing record number
// SQL Query for an existing NDA record and retrieving data
if ($I=="1"){
$sql="SELECT * FROM tm_filings WHERE tm_ID='$TM_ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
    $TMFAM_ID = $row["tmfam_ID"];
    $original = $row["original"];
    $docket = $row["docket"];
    $org = $row["org"];
    $creator = $row["creator"];
    $create_date = $row["create_date"];
    $editor = $row["editor"];
    $edit_date = $row["edit_date"];
    $firm = $row["firm"];
    $firm_contact = $row["firm_contact"];
    $client = $row["client"];
    $client_contact = $row["client_contact"];
    $title = $row["title"];
	$filing_type = $row["filing_type"];
	$country = $row["country"];
	$status = $row["status"];
    $priority_date = $row["priority_date"];
    $priority_date_1 = $row["priority_date"];
    $filing_date = $row["filing_date"];
    $filing_date_1 = $row["filing_date"];
    $filing_receipt = $row["filing_receipt"];
    $assignment = $row["assignment"];
    $assignment_recorded = $row["assignment_recorded"];
    $pub_date = $row["pub_date"];
	$issue_date = $row["issue_date"];
	$issue_date_1 = $row["issue_date"];
    $ser_no = $row["ser_no"];
	$tm_no = $row["tm_no"];
	$intl_class = $row["intl_class"];
	$description = $row["description"];
	$products = $row["products"];
    $notes=$row["notes"];			  
}
if (($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y") and $read_only=="N" and $EDIT=="Y"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="100%" align="center">
    <a href="trademarks_list.php?module=<?=$module;?>&SORT=TMFAM&TMFAM_ID=<?=$TMFAM_ID;?>">View Family</a>
    <? // The ability to delete a record only if there is an existing record ($TM_ID!="0")
    if ($TM_ID!="0"){?>&nbsp;|&nbsp;
    <a href="delete_confirm.php?module=<?=$module;?>&TABLE=tm_filings&ID=<?=$TM_ID;?>&NAME=<?=$docket;?>">Delete</a>
    <?}?></td></tr>
</table><br><br>
<? if ($NEW=="Y") echo("<center>ADD TRADEMARK RECORD</center>");
  else echo("<center>EDIT TRADEMARK RECORD</center>");
if ($submit_2=="" or $docket=="" or $firm=="" or $title=="" or $filing_type=="" or $status=="" or $country==""){?>
<form method=get action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="TMFAM" value="0">
  <input type="hidden" name="TMEDIT" value="1">
  <input type="hidden" name="TMFAM_ID" value="<?=$TMFAM_ID;?>">
  <input type="hidden" name="TM_ID" value="<?=$TM_ID;?>">
  <input type="hidden" name="ACTIONS" value="<?=$ACTIONS;?>">
<!--// Modified
  <input type="hidden" name="I" value="0">
  <input type="hidden" name="EDIT" value="Y">-->
  <input type="hidden" name="I" value="1">
  <input type="hidden" name="EDIT" value="N">
  <input type="hidden" name="NEW" value="<?=$NEW;?>">
  <input type="hidden" name="original" value="<?=$original;?>">
  <input type="hidden" name="creator" value="<?=$creator;?>">
  <input type="hidden" name="create_date" value="<?=$create_date;?>">
  <input type="hidden" name="editor" value="<?=$editor;?>">
  <input type="hidden" name="edit_date" value="<?=$edit_date;?>">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5">
    <tr>
        <td align="right" width="115">
            Title
        </td>
        <td colspan="3" align="left" width="450">
            <input name="title" type="text" maxlength="200" size="60" value="<?=$title;?>">
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Docket No.
        </td>
        <td width="205">
            <input name="docket" type="text" maxlength="35" size="20" value="<?=$docket;?>">
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
        </td>
        <td align="right" width="115">
            Status
        </td>
        <td width="205">						
			<select name="status" size="1">
			<option><?=$status;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Service Firm
        </td>
        <td width="205">
            <select name="firm" size="1">
			<option><?=$firm;?></option>
		    <? $sql="SELECT * FROM menus WHERE customer_ID='$customer_ID' and menu_type='FIRM' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
        </td>
        <td align="right" width="115">
            Firm Contact
        </td>
        <td width="205">
            <input name="firm_contact" type="text" maxlength="100" size="25" value="<?=$firm_contact;?>">
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Client
        </td>
        <td width="205">
            <select name="client" size="1">
			<option><?=$client;?></option>
		    <? $sql="SELECT * FROM menus WHERE customer_ID='$customer_ID' and menu_type='CLIENT' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
        </td>
        <td align="right" width="115">
            Client Contact
        </td>
        <td width="205">
            <input name="client_contact" type="text" maxlength="100" size="25" value="<?=$client_contact;?>">
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Type
        </td>
        <td width="205">			
			<select name="filing_type" size="1">
			<option><?=$filing_type;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered" size="+1"><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
        <td align="right" width="115">
            Country
        </td>
        <td width="205">
            <select name=country size="1">
            <option><?=$country;?></option>
			<? country_list();?>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#country_codes">Country Codes</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Priority Date
        </td>
        <td width="205">
            <input type="text" name="priority_date" size="11" maxlength="10" value="<?=$priority_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Original
        </td>
        <td width="205">
            <select name=original size="1">
            <option><?=$original;?></option>
			<option>Y</option><option>N</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Filing Date
        </td>
        <td width="205">
            <input type="text" name="filing_date" size="11" maxlength="10" value="<?=$filing_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Serial No.
        </td>
        <td width="205">
            <input name="ser_no" type="text" maxlength="25" size="25" value="<?=$ser_no;?>">
        </td>	
	</tr>
	<tr>
        <td align="right" width="115">
            Publ. Date
        </td>
        <td width="205">
            <input type="text" name="pub_date" size="11" maxlength="10" value="<?=$pub_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Publ. No.
        </td>
        <td width="205">
            <input name="pub_no" type="text" maxlength="25" size="25" value="<?=$pub_no;?>">
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Issue Date
        </td>
        <td width="205">
            <input type="text" name="issue_date" size="11" maxlength="10" value="<?=$issue_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Reg. No.
        </td>
        <td width="205">
            <input name="tm_no" type="text" maxlength="25" size="25" value="<?=$tm_no;?>">
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
	      Related<br>Documents
	    </td>
        <td width="205">
          <input type="checkbox" name="filing_receipt" value="Y" <? if ($filing_receipt=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Filing Receipt<br>
          <input type="checkbox" name="assignment" value="Y" <? if ($assignment=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Assignment<br>
          <input type="checkbox" name="assignment_recorded" value="Y" <? if ($assignment_recorded=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Recorded Assignment
	    </td>
        <td>
		</td>
	</tr>
	<tr>
        <td align=right width="110">
            Intl. Classes
        </td>
        <td width="205">
            <input name=intl_class type=text maxlength=25 size=25 value="<?=$intl_class;?>">
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Description
        </td>
        <td colspan="3">
            <textarea wrap name="description" rows="3" cols="50"><?=$description;?></textarea>
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Products
        </td>
        <td colspan="3">
            <textarea wrap name="products" rows="2" cols="50"><?=$products;?></textarea>
        </td>
	</tr>	
	<tr>
        <td align="right" valign="top" width="115">
            Notes
        </td>
        <td colspan="3">
            <textarea wrap name="notes" rows="2" cols="50"><?=$notes;?></textarea>
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
            Actions<br>
			<a target=_blank href="tmaction_edit.php?module=<?=$module;?>&TM_ID=<?=$TM_ID;?>&ACTION_ID=0&I=0&EDIT=Y">Add</a>&nbsp;&nbsp;
        </td>
        <td colspan="3"><!-- EXISTING TM ACTIONS -->
		  <? // SQL Query for Selecting Actions Type
		  echo($ACTIONS." Actions");?>
		  	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=All&I=1&EDIT=Y">All</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Open&I=1&EDIT=Y">Open</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Closed&I=1&EDIT=Y">Closed</a><br>
		  <? if ($ACTIONS=="Open") 
		    $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID' and
			  done='N'";
		  elseif ($ACTIONS=="Closed")
		    $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID' and
			  done='Y'";
		  else
            $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID'
			  ORDER BY respdue_date";
		  $result=mysql_query($sql);
		  while($row=mysql_fetch_array($result)){
		    $ACTION_ID=$row["action_ID"];
		    $action_type=$row["action_type"];
		    $respdue_date=$row["respdue_date"];
		    $description=$row["description"];?>
			<a target=_blank href="tmaction_edit.php?module=<?=$module;?>&TM_ID=<?=$TM_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <?=$action_type;?></a>&nbsp;
			  Due&nbsp;<?=$respdue_date;?><br>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$description;?>
		  <?}?>
        </td>
    </tr>		
    <tr>
        <td align="center" colspan="4" width="100%">
            <hr noshade size="1" width="500">
            <input type=submit name="submit_2" value="  OK  ">
        </td>
    </tr>
</table>  	
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}
else{

// The script performs the database modification
$sql = "UPDATE tm_filings SET
    customer_ID = '$customer_ID',
    tmfam_ID = '$TMFAM_ID',
    original = '$original',
    org = '$userorg',
    docket = '$docket',
    firm = '$firm',
    firm_contact = '$firm_contact',
    client = '$client',
    client_contact = '$client_contact',
    title = '$title',
    filing_type = '$filing_type',
    country = '$country',
    status = '$status',
    priority_date = '$priority_date',
    filing_date = '$filing_date',
    filing_receipt = '$filing_receipt',
    assignment = '$assignment',
    assignment_recorded = '$assignment_recorded',
    pub_date = '$pub_date',
    issue_date = '$issue_date',
    ser_no = '$ser_no',
    pub_no = '$pub_no',
    tm_no = '$tm_no',
    intl_class = '$intl_class',
    description = '$description',
    products = '$products',
    notes = '$notes',
	editor='$fullname',
	edit_date='$today'
    WHERE tm_ID='$TM_ID'";
  
// RUN THE QUERY
  if (!mysql_query($sql))
    error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@mydocket.com.");
	  
// Autodocket if it's a first case or if any of several dates have changed
  if($NEW=="Y" or $priority_date!=$priority_date_1 or $filing_date!=$filing_date_1 or $issue_date!=$issue_date_1){
    include("autoactions.php");}
	  
// **Commented out to display updated record rather than confirmation screen
// $DONE="1";
}}
else{ // DISPLAY RECORD -- NOT EDIT
?>
<!-- DISPLAY TRADEMARK -->

<table align="right" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">
    <a href="trademarks_list.php?module=<?=$module;?>&SORT=TMFAM&TMFAM_ID=<?=$TMFAM_ID;?>">View Family</a>&nbsp;|&nbsp;
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
  <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID?>&ACTIONS=Open&I=1&EDIT=Y&SORT=<?=$SORT;?>&VAR=<?=$VAR?>">Edit</a>
  <?}?></td></tr>
</table><br><br>
<center>FULL TRADEMARK RECORD</center><br>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5">
    <tr>
        <td align="right" width="115">
            Title
        </td>
        <td colspan="3" align="left" width="450" bgcolor="#EEEEEE">
            <?=$title;?>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Docket No.
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$docket;?>
        </td>
        <td align="right" width="115">
            Status
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$status;?>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Service Firm
        </td>
        <td width="205" bgcolor="#EEEEEE">
			<?=$firm;?>
        </td>
        <td align="right" width="115">
            Firm Contact
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$firm_contact;?>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Client
        </td>
        <td width="205" bgcolor="#EEEEEE">
			<?=$client;?>
        </td>
        <td align="right" width="115">
            Client Contact
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$client_contact;?>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Type
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$filing_type;?>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
        <td align="right" width="115">
            Country
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$country;?>
			&nbsp;&nbsp;<a target="_blank" href="help.php#country_codes">Country Codes</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Priority Date
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$priority_date;?>
        </td>
        <td align="right" width="115">
            Original
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$original;?>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Filing Date
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$filing_date;?>
        </td>
        <td align="right" width="115">
            Serial No.
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$ser_no;?>
        </td>	
	</tr>
	<tr>
        <td align="right" width="115">
            Publ. Date
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$pub_date;?>
        </td>
        <td align="right" width="115">
            Publ. No.
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$pub_no;?>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Issue Date
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$issue_date;?>
        </td>
        <td align="right" width="115">
            Reg. No.
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$tm_no;?>
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
	      Related<br>Documents
	    </td>
        <td width="205" bgcolor="#EEEEEE">
          <input type="checkbox" name="filing_receipt" value="Y" <? if ($filing_receipt=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Filing Receipt<br>
          <input type="checkbox" name="assignment" value="Y" <? if ($assignment=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Assignment<br>
          <input type="checkbox" name="assignment_recorded" value="Y" <? if ($assignment_recorded=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Recorded Assignment
	    </td>
        <td>
		</td>
	</tr>
	<tr>
        <td align=right width="110">
            Intl. Classes
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$intl_class;?>
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Description
        </td>
        <td colspan="3" bgcolor="#EEEEEE">
            <?=$description;?>
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Products
        </td>
        <td colspan="3" bgcolor="#EEEEEE">
            <?=$products;?>
        </td>
	</tr>	
	<tr>
        <td align="right" valign="top" width="115">
            Notes
        </td>
        <td colspan="3" bgcolor="#EEEEEE">
            <?=$notes;?>
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
            Actions
            <? if (($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y") and $read_only=="N"){?>
			<br><a target=_blank href="tmaction_edit.php?module=<?=$module;?>&TM_ID=<?=$TM_ID;?>&ACTION_ID=0&I=0&EDIT=Y">Add</a>&nbsp;&nbsp;<?}?>
        </td>
        <td colspan="3" bgcolor="#EEEEEE"><!-- EXISTING TM ACTIONS -->
		  <? // SQL Query for Selecting Actions Type
		  echo($ACTIONS." Actions");?>
		  	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=All&I=1&EDIT=N">All</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Open&I=1&EDIT=N">Open</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Closed&I=1&EDIT=N">Closed</a><br>
		  <? if ($ACTIONS=="Open") 
		    $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID' and
			  done='N'";
		  elseif ($ACTIONS=="Closed")
		    $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID' and
			  done='Y'";
		  else
            $sql="SELECT * FROM tm_actions WHERE
		      tm_ID='$TM_ID'
			  ORDER BY respdue_date";
		  $result=mysql_query($sql);
		  while($row=mysql_fetch_array($result)){
		    $ACTION_ID=$row["action_ID"];
		    $action_type=$row["action_type"];
		    $respdue_date=$row["respdue_date"];
		    $description=$row["description"];?>
			<a target=_blank href="tmaction_edit.php?module=<?=$module;?>&TM_ID=<?=$TM_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <?=$action_type;?></a>&nbsp;
			  Due&nbsp;<?=$respdue_date;?><br>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$description;?>
		  <?}?>
        </td>
    </tr>
</table>  	
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}}?>

<!-- DONE -->
<? if ($DONE=="1") {?>
<br>
<table align="center" width="500"><tr><td>
<p><strong>Your record has been successfully updated.</strong></p>
<p> To return to the login page, click <a href="index.php">here</a></p>
<p> To view trademark records, click <a href="trademarks_view.php?module=<?=$module;?>&SORT=ALL">here</a></p>
<p> To add another record, click <a href="trademarks_edit.php?module=<?=$module;?>&TMFAM=1&TMEDIT=0">here</a></p>
</td></tr></table><br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}
html_footer(); ?>
