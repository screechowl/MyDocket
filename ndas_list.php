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
// view_ndas.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
if ($SORT=="NDAFAM")
  $var="SORT=NDAFAM&NDAFAM_ID=$NDAFAM_ID";
elseif ($SORT=="SEARCH")
  $var="SORT=SEARCH&title=$title&docket=$docket&".
  "firm=$firm&firm_contact=$firm_contact&client=$client&client_contact=$client_contact&".
  "parties=$parties&direction=$direction&status=$status&contract_type=$contract_type&".
  "effective_date=$effective_date&expiry_date=$expiry_date"; 
else $var="SORT=ALL";
// Set Defaults
if ($ORDER=="") $ORDER="docket";
if ($REPORT=="") $REPORT="A";
if ($NEXT=="1") $START=$START+50;
  else $START="0";
?>
<table align="left" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">Reports:&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=A&<?=$var;?>">All</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=B&<?=$var;?>">Expanded</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=C&<?=$var;?>">Docket</a></td>
	</tr>
</table>
<table align="right" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&NEXT=0&START=<?=$START;?>&ORDER=<?=$ORDER;?>&<?=$var;?>">First 50</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&NEXT=1&START=<?=$START;?>&ORDER=<?=$ORDER;?>&<?=$var;?>">Next 50</a>
  </td></tr>
</table><br><br>
<?        
if ($SORT=="ALL") echo("<center>LIST ALL NON-DISCLOSURE AGREEMENTS</center><br>");
else echo("<center>LIST NON-DISCLOSURE AGREEMENT SEARCH RESULTS</center><br>");?>
<br>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Parties</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=parties&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=parties DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="175"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Status</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=expiry_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=expiry_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Direction</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=direction&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&DIRECTION=<?=$DIRECTION;?>&ORDER=direction DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
// SQL Query
if ($SORT == "ALL")
    $sql="SELECT * FROM contracts WHERE customer_ID = '$customer_ID' and (org='$member' or client='$member' or firm='$member') and contract_type='NDA' ORDER BY $ORDER, docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM contracts WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    parties LIKE '%$parties%' and
    title LIKE '%$title%' and
	direction LIKE '%$direction%' and
	contract_type='NDA' and
	status LIKE '%$status%' and
	effective_date LIKE '%$effective_date%' and
	expiry_date LIKE '%$expiry_date%' and
    description LIKE '%$description%' and
    notes LIKE '%$notes%'
	ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
// Print the records
while($row=mysql_fetch_array($result)){
  $ID=$row["ID"];
  $org=$row["org"];
  $docket=$row["docket"];
  $parties=$row["parties"];
  $title=$row["title"];
  $direction=$row["direction"];
  $contract_type = $row["contract_type"];
  $effective_date=$row["effective_date"];
  $expiry_date=$row["expiry_date"];
  $status=$row["status"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="125"><small><?=$parties;?></small></td>
  <td width="175"><small><a href="ndas_edit.php?module=<?=$module;?>&SORT=<?=$SORT?>&VAR=<?=$var?>&ID=<?=$ID?>&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$status;?>
    <? if ($effective_month!="0000-00-00") echo("<br>".$effective_date);?>
    <? if ($expiry_month!="0000-00-00") echo("<br>".$expiry_date);?></small></td>
  <td width="125"><small><?=$direction;?></small></td>
</tr>
<?}?>
</table>
<? html_footer(); ?>
