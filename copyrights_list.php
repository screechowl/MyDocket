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
// view_copyrights.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
if ($SORT=="COPYFAM")
  $var="SORT=COPYFAM&COPYFAM_ID=$COPYFAM_ID";
elseif ($SORT=="SEARCH")
  $var="SORT=SEARCH&title=$title&docket=$docket&".
  "firm=$firm&firm_contact=$firm_contact&client=$client&client_contact=$client_contact&".
  "authors=$authors&status=$status&filing_type=$filing_type&".
  "country=$country&filing_date=$filing_date&pub_date=$pub_date&".
  "issue_date=$issue_date&c_no=$c_no";
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
if ($SORT=="ALL") echo("<center>LIST ALL COPYRIGHTS</center><br>");
else echo("<center>LIST COPYRIGHT SEARCH RESULTS</center><br>");?>
<br>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="175"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Filing Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=filing_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=filing_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Status</U></td>
  <td width="125"><U>Issue Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=issue_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&ORDER=issue_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
if ($SORT == "ALL")
  $sql="SELECT * FROM copyrights WHERE customer_ID = '$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM copyrights WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    title LIKE '%$title%' and
    filing_type LIKE '%$filing_type%' and
    authors LIKE '%$authors%' and
    country LIKE '%$country%' and
	status LIKE '%$status%' and
	filing_date LIKE '%$filing_date%' and
	pub_date LIKE '%$pub_date%' and
    issue_date LIKE '%$issue_date%' and
	c_no LIKE '%$c_no%' and
    description LIKE '%$description%' and
    notes LIKE '%$notes%'
	ORDER BY $ORDER, docket LIMIT $START, 50";	
$result=mysql_query($sql);
// Print the records
while($row=mysql_fetch_array($result)){
  $ID=$row["ID"];
  $org=$row["org"];
  $docket=$row["docket"];
  $title=$row["title"];
  $filing_date=$row["filing_date"];
  $issue_date=$row["issue_date"];
  $ser_no=$row["ser_no"];
  $status=$row["status"];
  $c_no=$row["c_no"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="175"><small><a href="copyrights_edit.php?module=<?=$module;?>&SORT=<?=$SORT?>&VAR=<?=$var?>&ID=<?=$ID;?>&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$filing_date;?><br><?=$ser_no;?></small></td>
  <td width="125"><small><?=$status;?>
    <? if ($respdue_date!="0000-00-00") echo("<br>".$respdue_date);?></small></td>
  <td width="125"><small><?=$c_no;?>
    <? if ($issue_date!="0000-00-00") echo("<br>".$issue_date);?></small></td>
</tr>
<?}?>
</table>
<? html_footer(); ?>
