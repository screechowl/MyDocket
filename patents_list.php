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
// patents_list.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
if($SORT=="PATFAM")
  $var="SORT=PATFAM&PATFAM_ID=$PATFAM_ID";
elseif($SORT=="SEARCH")
  $var="SORT=SEARCH&title=$title&docket=$docket&".
  "firm=$firm&firm_contact=$firm_contact&client=$client&filing_type=$filing_type&".
  "country=$country&priority_date=$priority_date&".
  "filing_date=$filing_date&ser_no=$ser_no&pub_date=$pub_date&".
  "pub_no=$pub_no&issue_date=$issue_date&pat_no=$pat_no&status=$status";
else $var="SORT=ALL";
// Set Defaults
if($REPORT=="") $REPORT="A";
if($NEXT=="1") $START=$START+50;
  else $START="0";
?>
<table align="left" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">Reports:&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=A&<?=$var;?>">All</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=B&<?=$var;?>">Expanded</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=C&<?=$var;?>">Docket</a>&nbsp;|&nbsp;
	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=Z&<?=$var;?>">Index</a></td>
	</tr>
</table>
<table align="right" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&NEXT=0&START=<?=$START;?>&ORDER=<?=$ORDER;?>&<?=$var;?>">First 50</a>&nbsp;|&nbsp;
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&NEXT=1&START=<?=$START;?>&ORDER=<?=$ORDER;?>&<?=$var;?>">Next 50</a>
  </td></tr>
</table><br><br>
<? if($SORT=="ALL") echo("<center>LIST ALL PATENTS");
  else echo("<center>LIST PATENT SEARCH RESULTS");
  echo (" -- REPORT TYPE ".$REPORT."<br>");?><br>
<br>
<!-- REPORT A -->
<? if($REPORT=="ALL" or $REPORT=="A"){
if($ORDER=="") $ORDER="docket";?>
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
if($SORT == "ALL")
  $sql="SELECT * FROM pat_filings WHERE customer_ID='$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
elseif($SORT == "PATFAM")
  $sql="SELECT * FROM pat_filings WHERE customer_ID='$customer_ID' and patfam_ID='$PATFAM_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM pat_filings WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    title LIKE '%$title%' and
    filing_type LIKE '%$filing_type%' and
    inventors LIKE '%$inventors%' and
    country LIKE '%$country%' and
	status LIKE '%$status%' and
	filing_date LIKE '%$filing_date%' and
	pub_date LIKE '%$pub_date%' and
    issue_date LIKE '%$issue_date%' and
	pat_no LIKE '%$pat_no%'
	ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $PAT_ID=$row["pat_ID"];
  $org=$row["org"];
  $docket=$row["docket"];
  $title=$row["title"];
  $country=$row["country"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $status=$row["status"];
  $respdue_date=$row["respdue_date"];
  $pat_no=$row["pat_no"];
  $issue_date=$row["issue_date"];
  // Remove commas in patent number
  $pat_nocommas=str_replace(",","",$pat_no);
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="patents_edit.php?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$ser_no;?><? if($filing_date!="0000-00-00") echo("<br>".$filing_date);?></small></td>
  <td width="125"><small><a target=_blank href="http://v3.espacenet.com/results?sf=n&FIRST=1&F=0&CY=ep&LG=en&DB=EPODOC&PN=<?echo($country.$pat_nocommas);?>&Submit=SEARCH&=&=&=&=&="><?=$pat_no;?></a>
  <? if($issue_date!="0000-00-00") echo("<br>".$issue_date);?></small></td>
</tr>
<?}?>
</table>
<?}?>
<!-- REPORT B -->
<? if($REPORT=="B"){
if($ORDER=="") $ORDER="docket";?>
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
if($SORT == "ALL")
  $sql="SELECT * FROM pat_filings WHERE customer_ID='$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
elseif($SORT == "PATFAM")
  $sql="SELECT * FROM pat_filings WHERE customer_ID='$customer_ID' and patfam_ID='$PATFAM_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM pat_filings WHERE	  	  
    customer_ID = '$customer_ID' and
    docket LIKE '%$docket%' and
	(org='$member' or client='$member' or firm='$member') and
    firm LIKE '%$firm%' and
    firm_contact LIKE '%$firm_contact%' and
    client LIKE '%$client%' and
    title LIKE '%$title%' and
    filing_type LIKE '%$filing_type%' and
    inventors LIKE '%$inventors%' and
    country LIKE '%$country%' and
	status LIKE '%$status%' and
	filing_date LIKE '%$filing_date%' and
	pub_date LIKE '%$pub_date%' and
    issue_date LIKE '%$issue_date%' and
	pat_no LIKE '%$pat_no%'
	ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $PAT_ID=$row["pat_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $country=$row["country"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $respdue_date=$row["respdue_date"];
  $pat_no=$row["pat_no"];
  $issue_date=$row["issue_date"];
  // Remove commas in patent number
  $pat_nocommas=str_replace(",","",$pat_no);
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="patents_edit.php?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="125"><small><?=$filing_date;?><br><?=$ser_no;?></small></td>
  <td width="125"><small><a target=_blank href="http://v3.espacenet.com/results?sf=n&FIRST=1&F=0&CY=ep&LG=en&DB=EPODOC&PN=<?echo($country.$pat_nocommas);?>&Submit=SEARCH&=&=&=&=&="><?=$pat_no;?></a><br>
  <?=$issue_date;?></small></td>
</tr>
<tr>
  <td align="center" bgcolor=EEEEEE>
    <small><?=$country;?></small>
  </td>
  <td bgcolor=EEEEEE>   <!-- Open Actions -->
		  <? // SQL Query for Selecting Actions Type
		  $sql_1="SELECT * FROM pat_actions WHERE
		    pat_ID='$PAT_ID' and
			done='N'
			ORDER BY respdue_date";
		  $result_1=mysql_query($sql_1);
		  while($row_1=mysql_fetch_array($result_1)){
		    $ACTION_ID=$row_1["action_ID"];
		    $action_type=$row_1["action_type"];
		    $respdue_date=$row_1["respdue_date"];?>
			<a href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <small><?=$action_type;?></a>&nbsp;
			  Due&nbsp;<?=$respdue_date;?></small><br>
		  <?}?>
  </td>
  <td colspan="2" bgcolor=EEEEEE><!-- Inventors -->
		  <? // SQL Query for Selecting All $TYPE IP Records
		  $sql_1="SELECT * FROM pat_inventors WHERE
		    customer_ID='$customer_ID' and
		    pat_ID='$PAT_ID'";
		  $result_1=mysql_query($sql_1);
		  while($row_1=mysql_fetch_array($result_1)){
		    $inventor_ID=$row_1["inventor_ID"];
		    $sql_2="SELECT * FROM inventors WHERE
		      ID='$inventor_ID'";
		    $result_2=mysql_query($sql_2);
		    // Print the records
			$row_2=mysql_fetch_array($result_2);
			$ID=$row_2["ID"];
			$first_name = $row_2["first_name"];  
			$last_name = $row_2["last_name"];?>
			<a href="inventor_edit.php?module=<?=$module;?>&ID=<?=$inventor_ID;?>&I=1&EDIT=N">
			<small><?=$first_name;?>&nbsp;<?=$last_name;?></small></a><br>
		  <?}?>
  </td>
</tr>
<?}?>
</table>
<?}?>
<!-- REPORT C -->
<? if($REPORT=="C"){
if($ORDER=="") $ORDER="pat_actions.respdue_date";?>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="100"><U>Docket</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.docket&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.docket DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="300"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="250"><U>Open Actions</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_actions.respdue_date&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_actions.respdue_date DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
if($SORT == "ALL")
  $sql="SELECT * FROM pat_filings, pat_actions WHERE
    pat_filings.customer_ID='$customer_ID' and
    (pat_filings.org='$member' or pat_filings.client='$member' or pat_filings.firm='$member') and
    pat_actions.pat_ID=pat_filings.pat_ID and
	pat_actions.done='N'
    ORDER BY $ORDER, pat_filings.docket LIMIT $START, 50";
elseif($SORT == "PATFAM")    
  $sql="SELECT * FROM pat_filings, pat_actions WHERE
    pat_filings.customer_ID='$customer_ID' and
    (pat_filings.org='$member' or pat_filings.client='$member' or pat_filings.firm='$member') and
	pat_filings.patfam_ID='$PATFAM_ID' and
    pat_actions.pat_ID=pat_filings.pat_ID and
	pat_actions.done='N'
    ORDER BY $ORDER, pat_filings.docket LIMIT $START, 50";
else // ($SORT == "SEARCH")
  $sql="SELECT * FROM pat_filings, pat_actions WHERE
    pat_filings.customer_ID='$customer_ID' and
    (pat_filings.org='$member' or pat_filings.client='$member' or pat_filings.firm='$member') and
    pat_actions.pat_ID=pat_filings.pat_ID and
	pat_actions.done='N' and
    pat_filings.docket LIKE '%$docket%' and
    pat_filings.firm LIKE '%$firm%' and
    pat_filings.firm_contact LIKE '%$firm_contact%' and
    pat_filings.client LIKE '%$client%' and
    pat_filings.client_contact LIKE '%$client_contact%' and
    pat_filings.title LIKE '%$title%' and
    pat_filings.filing_type LIKE '%$filing_type%' and
    pat_filings.inventors LIKE '%$inventors%' and
    pat_filings.country LIKE '%$country%' and
	pat_filings.status LIKE '%$status%' and
	pat_filings.filing_date LIKE '%$filing_date%' and
	pat_filings.pub_date LIKE '%$pub_date%' and
    pat_filings.issue_date LIKE '%$issue_date%' and
	pat_filings.pat_no LIKE '%$pat_no%' and
	ORDER BY $ORDER, pat_filings.docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $ACTION_ID=$row["action_ID"];
  $action_type=$row["action_type"];
  $PAT_ID=$row["pat_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $filing_date=$row["filing_date"];
  $ser_no=$row["ser_no"];
  $respdue_date=$row["respdue_date"];
  $pat_no=$row["pat_no"];
  $issue_date=$row["issue_date"];
?>
<tr bgcolor=EEEEEE>
  <td width="100"><small><?=$docket;?></small></td>
  <td width="300"><small><a href="patents_edit.php?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$title;?></a></small></td>
  <td width="250"><a href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
	  <small><?=$action_type;?></a>&nbsp;
      Due&nbsp;<?=$respdue_date;?></small></td>
</tr>
<?}?>
</table>
<?}?>
<!-- REPORT Z -->
<? if($REPORT=="Z"){
if($ORDER=="") $ORDER="pat_ID";?>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="150"><U>PAT_ID No.</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.pat_id&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.pat_id DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="500"><U>Title</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.title&<?=$var?>"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&REPORT=<?=$REPORT;?>&ORDER=pat_filings.title DESC&<?=$var?>"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
//SQL Query for Selecting All $TYPE IP Records
$sql="SELECT * FROM pat_filings WHERE customer_ID='$customer_ID' and (org='$member' or client='$member' or firm='$member') ORDER BY $ORDER, docket LIMIT $START, 50";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $PAT_ID=$row["pat_ID"];
  $title=$row["title"];
?>
<tr bgcolor=EEEEEE>
  <td width="150"><small><a href="patents_edit.php?PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=N"><?=$PAT_ID;?></a></small></td>
  <td width="500"><small><?=$title;?></small></td>
</tr>
<?}?>
</table>
<?}?>
<? html_footer(); ?>
