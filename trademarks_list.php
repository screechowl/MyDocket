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
// trademarks_list.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
if ($SORT=="TMFAM")
  $var="SORT=TMFAM&TMFAM_ID=$TMFAM_ID";
elseif ($SORT=="SEARCH")
  $var="SORT=SEARCH&title=$title&docket=$docket&".
  "firm=$firm&firm_contact=$firm_contact&client=$client&filing_type=$filing_type&".
  "country=$country&priority_date=$priority_date&".
  "filing_date=$filing_date&".
  "ser_no=$ser_no&pub_date=$pub_date&".
  "pub_no=$pub_no&issue_date=$issue_date&".
  "tm_no=$tm_no&intl_class=$intl_class&status=$status";
else $var="SORT=ALL";
// Set Defaults
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
<? if ($SORT=="ALL") echo("<center>LIST ALL TRADEMARKS");
  else echo("<center>LIST TRADEMARK SEARCH RESULTS");
  echo (" -- REPORT TYPE ".$REPORT."<br>");?><br>        
<br>
<!-- REPORT A -->
<? if ($REPORT=="A"){
if ($ORDER=="") $ORDER="docket";?>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="300"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Filing Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=filing_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=filing_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Issue Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=issue_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=issue_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
if ($SORT == "ALL")
  $sql="SELECT * FROM tm_filings WHERE customer_ID='$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
elseif ($SORT == "TMFAM")
  $sql="SELECT * FROM tm_filings WHERE customer_ID='$customer_ID' and TMFAM_ID='$TMFAM_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
//else if ($SORT == "FIRM")
//  $sql="SELECT * FROM tm_filings WHERE org='$userorg' and (org='$member' or client='$member' or firm='$member') and firm='$var' ORDER BY $ORDER, docket";
//else if ($SORT == "CLIENT")
//  $sql="SELECT * FROM tm_filings WHERE org='$userorg' and (org='$member' or client='$member' or firm='$member') and client='$var' ORDER BY $ORDER, docket";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM tm_filings WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    title LIKE '%$title%' and
    filing_type LIKE '%$filing_type%' and
    country LIKE '%$country%' and
	status LIKE '%$status%' and
	filing_date LIKE '%$filing_date%' and
	pub_date LIKE '%$pub_date%' and
    issue_date LIKE '%$issue_date%' and
	tm_no LIKE '%$tm_no%' and
	intl_class LIKE '%$intl_class%' and
    description LIKE '%$description%' and
    notes LIKE '%$notes%'
	ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $TM_ID=$row["tm_ID"];
  $org=$row["org"];
  $docket=$row["docket"];
  $title=$row["title"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $status=$row["status"];
  $respdue_date=$row["respdue_date"];
  $tm_no=$row["tm_no"];
  $issue_date=$row["issue_date"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="trademarks_edit.php?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$ser_no;?>
    <? if($filing_date!="0000-00-00") echo("<br>".$filing_date);?></small></td>
  <td width="125"><small><a href="http://164.195.100.11/netacgi/nph-Parser?Sect1=PTO1&Sect2=HITOFF&d=PALL&p=1&u=/netahtml/srchnum.htm&r=1&f=G&l=50&s1='<?=$tm_no;?>'.WKU.&OS=PN/<?=$tm_no;?>&RS=PN/<?=$tm_no;?>"><?=$tm_no;?></a><br>
    <? if($issue_date!="0000-00-00") echo("<br>".$issue_date);?></small></td>
</tr>
<?}?>
</table>
<?}?>
<!-- REPORT B -->
<? if ($REPORT=="B"){
if ($ORDER=="") $ORDER="docket";?>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="300"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a>
	  &nbsp;&nbsp;&nbsp;&nbsp;<U>Open Actions</U></td>	
  <td width="125"><U>Filing Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=filing_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=filing_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="125"><U>Issue Data</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=issue_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=issue_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
if ($SORT == "ALL")
  $sql="SELECT * FROM tm_filings WHERE customer_ID='$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
elseif ($SORT == "TMFAM")
  $sql="SELECT * FROM tm_filings WHERE customer_ID='$customer_ID' and TMFAM_ID='$TMFAM_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM tm_filings WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    title LIKE '%$title%' and
    filing_type LIKE '%$filing_type%' and
    country LIKE '%$country%' and
	status LIKE '%$status%' and
	filing_date LIKE '%$filing_date%' and
	pub_date LIKE '%$pub_date%' and
    issue_date LIKE '%$issue_date%' and
	tm_no LIKE '%$tm_no%' and
	intl_class LIKE '%$intl_class%' and
    description LIKE '%$description%' and
    notes LIKE '%$notes%'
	ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $TM_ID=$row["tm_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $country=$row["country"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $tm_no=$row["tm_no"];
  $issue_date=$row["issue_date"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="trademarks_edit.php?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$ser_no;?>
    <? if($filing_date!="0000-00-00") echo("<br>".$filing_date);?></small></td>
  <td width="125"><small><a href="http://164.195.100.11/netacgi/nph-Parser?Sect1=PTO1&Sect2=HITOFF&d=PALL&p=1&u=/netahtml/srchnum.htm&r=1&f=G&l=50&s1='<?=$tm_no;?>'.WKU.&OS=PN/<?=$tm_no;?>&RS=PN/<?=$tm_no;?>"><?=$tm_no;?></a><br>
    <? if($issue_date!="0000-00-00") echo("<br>".$issue_date);?></small></td>
</tr>
<tr>
  <td align="center" bgcolor=EEEEEE>
    <small><?=$country;?></small>
  </td>
  <td bgcolor=EEEEEE colspan="3">   <!-- Open Actions -->
		  <? // SQL Query for Selecting Actions Type
		  $sql_1="SELECT * FROM tm_actions WHERE
		    tm_ID='$TM_ID' and
			done='N'
			ORDER BY respdue_date";
		  $result_1=mysql_query($sql_1);
		  while($row_1=mysql_fetch_array($result_1)){
		    $ACTION_ID=$row_1["action_ID"];
		    $action_type=$row_1["action_type"];
		    $respdue_date=$row_1["respdue_date"];?>
			<a href="tmaction_edit.php?TM_ID=<?=$TM_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <small><?=$action_type;?></a>&nbsp;
			  Due&nbsp;<?=$respdue_date;?></small><br>
		  <?}?>
  </td>
</tr>
<?}?>
</table>
<?}?>
<!-- REPORT C -->
<? if ($REPORT=="C"){
if ($ORDER=="") $ORDER="tm_actions.respdue_date";?>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_filings.docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_filings.docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="300"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_filings.title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_filings.title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="250"><U>Open Actions</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_actions.respdue_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=tm_actions.respdue_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
if ($SORT == "ALL")
  $sql="SELECT * FROM tm_filings, tm_actions WHERE
    tm_filings.customer_ID='$customer_ID' and
    (tm_filings.org='$member' or tm_filings.client='$member' or tm_filings.firm='$member') and
    tm_actions.tm_ID=tm_filings.tm_ID and
	tm_actions.done='N'
    ORDER BY $ORDER, tm_filings.docket LIMIT $START, 50";
elseif ($SORT == "TMFAM")    
  $sql="SELECT * FROM tm_filings, tm_actions WHERE
    tm_filings.customer_ID='$customer_ID' and
    (tm_filings.org='$member' or tm_filings.client='$member' or tm_filings.firm='$member') and
	tm_filings.TMFAM_ID='$TMFAM_ID' and
    tm_actions.tm_ID=tm_filings.tm_ID and
	tm_actions.done='N'
    ORDER BY $ORDER, tm_filings.docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM tm_filings, tm_actions WHERE	  	  
    tm_filings.customer_ID = '$customer_ID' and
	(tm_filings.org='$member' or tm_filings.client='$member' or tm_filings.firm='$member') and
    tm_actions.tm_ID=tm_filings.tm_ID and
    tm_filings.docket LIKE '%$docket%' and
    tm_filings.firm LIKE '%$firm%' and
    tm_filings.firm_contact LIKE '%$firm_contact%' and
    tm_filings.client LIKE '%$client%' and
    tm_filings.title LIKE '%$title%' and
    tm_filings.filing_type LIKE '%$filing_type%' and
    tm_filings.country LIKE '%$country%' and
	tm_filings.status LIKE '%$status%' and
	tm_filings.filing_date LIKE '%$filing_date%' and
	tm_filings.pub_date LIKE '%$pub_date%' and
    tm_filings.issue_date LIKE '%$issue_date%' and
	tm_filings.tm_no LIKE '%$tm_no%' and 
	tm_filings.intl_class LIKE '%$intl_class%' and
    tm_filings.description LIKE '%$description%' and
    tm_filings.notes LIKE '%$notes%' and
	tm_actions.done='N'
    ORDER BY $ORDER, tm_filings.docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $ACTION_ID=$row["action_ID"];
  $action_type=$row["action_type"];
  $TM_ID=$row["tm_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $respdue_date=$row["respdue_date"];
  $tm_no=$row["tm_no"];
  $issue_date=$row["issue_date"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="trademarks_edit.php?module=<?=$module;?>&TMFAM=0&TMEDIT=1&TM_ID=<?=$TM_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="250"><a href="tmaction_edit.php?module=<?=$module;?>&TM_ID=<?=$TM_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
	  <small><?=$action_type;?></a>&nbsp;
      Due&nbsp;<?=$respdue_date;?></small></td>
</tr>
<?}?>
</table>
<?}?>
<? html_footer(); ?>
