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
// edit_patent.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
// Set $var string
$var="DOCKET=$DOCKET&TITLE=$TITLE";
// Set Defaults
if ($NEXT=="1") $START=$START+50;
  else $START="0";
?>
<table align="left" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="205" align="center" bgcolor="#EEEEEE"><small><?=$fullname;?></small></td></tr>
</table>
<!-- SELECT RELATED PATENT -->
<?
if ($PATFAM=="1") {
if ($submit_1=="" or $PAT_ID==""){?>
<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="edit_patent.php?PATFAM=1&PATEDIT=0&NEXT=1&START=<?=$START;?>&<?=$var;?>"><small>Next 50</small></a></td></tr>
</table><br><br> 
<center>ADD PATENT RECORD -- SELECT RELATED PATENT</center><br>
<form method=get action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="PATFAM" value="1">
  <input type="hidden" name="PATEDIT" value="0">
  <input type="hidden" name="I" value="0">
  <input type="hidden" name="EDIT" value="Y">
<table align="center" width="100%" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td align="right" colspan="3">
	  <small>DOCKET&nbsp;<input type="text" name="DOCKET" maxlength="10" size="10" value="<?=$DOCKET;?>"></small>&nbsp;&nbsp;
      <small>TITLE&nbsp;<input type="text" name="TITLE" maxlength="30" size="10" value="<?=$TITLE;?>"></small>&nbsp;&nbsp;
      <input type="submit" name="submit_search" value=" SEARCH ">&nbsp;&nbsp;
      <input type="submit" name="submit_50" value=" NEXT 50 ">&nbsp;&nbsp;
      <small><a href="edit_patent.php?PATFAM=0&PATEDIT=1&PAT_ID=0&I=2&EDIT=Y&NEW=Y">ADD NEW PATENT</a></small></td>	
  </tr>
  <tr bgcolor=EEEEEE>
    <td width="20"><small>SELECT</small></td>
    <td width="50"><small>DOCKET</small></td>
    <td width="480"><small>TITLE</small></td>
  </tr>
  <?
//  if ($DOCKET!="" or $TITLE!="")
    $sql="SELECT pat_ID, docket, title FROM pat_filings WHERE
      customer_ID='$customer_ID' and
	  docket LIKE '%$DOCKET%' and
      title LIKE '%$TITLE%' and
	  original='Y'	
	  ORDER BY docket LIMIT $START, 50";
//  else
//     $sql="SELECT pat_ID, docket, title FROM pat_filings WHERE
//	  customer_ID='$customer_ID' and
//      original='Y'
//	  ORDER BY docket LIMIT $START, 50";
  $result=mysql_query($sql);
  while($row=mysql_fetch_array($result)){
    $PAT_ID=$row["pat_ID"];
    $docket=$row["docket"];
    $title=$row["title"];
  ?>
  </td></tr>
  <tr bgcolor=EEEEEE>
    <td width="20"><input type="radio" name="PAT_ID" value="<?=$PAT_ID;?>"></td>
    <td width="100"><small><?=$docket;?></small></td>
    <td width="430"><small><a href="patents_edit.php?module=<?=$module;?>&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&I=1&EDIT=N"><?=$title;?></small></td>
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
$sql="SELECT * FROM pat_filings WHERE pat_ID='$PAT_ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
  $PATFAM_ID=$row["patfam_ID"];
  $docket=$row["docket"];
  $title=$row["title"];
  $firm=$row["firm"];
  $firm_contact=$row["firm_contact"];
  $client=$row["client"];
  $client_contact=$row["client_contact"];
  $filing_type=$row["filing_type"];
  $priority_date=$row["priority_date"];
  $abstract=$row["abstract"];
  $products=$row["products"];
  
// Create the record that will be edited
$sql="INSERT INTO pat_filings SET
	customer_ID='$customer_ID',
    org='$userorg',
    patfam_ID='$PATFAM_ID',
    original='N',
    docket='$docket',
    title='$title',
	firm='$firm',
	firm_contact='$firm_contact',
    client='$client',
    client_contact='$client_contact',
	filing_type='$filing_type',
    priority_date='$priority_date',	
    abstract='$abstract',
    products='$products',
	creator='$fullname',
	create_date='$today',
	editor='$fullname',
	edit_date='$today'";
if (!mysql_query($sql))
  error("A database error occurred in processing your ".
  "submission.\\nIf this error persists, please ".
  "contact info@ipdox.com.");
  
// Get the ID of the new pat_filings record
$PAT_ID_NEW=mysql_insert_id();

// Copy the inventors to the new application
$sql_1="SELECT * FROM pat_inventors WHERE pat_ID='$PAT_ID'";
$result_1=mysql_query($sql_1);
while ($row_1=mysql_fetch_array($result_1)){
  $inventor_ID=$row_1["inventor_ID"];
$sql_2="INSERT INTO pat_inventors SET
  customer_ID='$customer_ID',
  pat_ID='$PAT_ID_NEW',
  inventor_ID='$inventor_ID'";
if (!mysql_query($sql_2))
  error("A database error occurred in processing your ".
  "submission.\\nIf this error persists, please ".
  "contact info@ipdox.com.");
}
// Move on to adding the patent filing record
$PATEDIT="1";
$I="1";
$PAT_ID=$PAT_ID_NEW;
$NEW="Y";
}}?>

<!-- ADD OR EDIT PATENT RECORD -->
<?
if ($PATEDIT=="1") {

// If it's a brand new case ($I=="2"), we need to set up a patent family number, 
// patent number and identify the new patent as an original
if ($I=="2") {
  $sql = "INSERT INTO pat_families SET
    customer_ID = '$customer_ID',
    org = '$userorg'";  
	if (!mysql_query($sql))
      error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
  $PATFAM_ID=mysql_insert_id();
  $sql = "INSERT INTO pat_filings SET
    customer_ID = '$customer_ID',
	patfam_ID = '$PATFAM_ID',
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
  $PAT_ID=mysql_insert_id();
  $original="Y";
  }

// To retrieve data, $PAT_ID is set to the existing record number
// SQL Query for an existing NDA record and retrieving data
if ($I=="1"){
$sql="SELECT * FROM pat_filings WHERE pat_ID='$PAT_ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
    $PATFAM_ID = $row["patfam_ID"];
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
    $inventors = $row["inventors"];
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
    $ids = $row["ids"];
    $no_pub = $row["no_pub"];
    $pub_date = $row["pub_date"];
	$issue_date = $row["issue_date"];
	$issue_date_1 = $row["issue_date"];
    $ser_no = $row["ser_no"];
	$pat_no = $row["pat_no"];
	$abstract = $row["abstract"];
	$products = $row["products"];
    $notes=$row["notes"];			  
}
if (($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y") and $read_only=="N" and $EDIT=="Y"){?>
<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="patents_view.php?module=<?=$module;?>&SORT=PATFAM&PATFAM_ID=<?=$PATFAM_ID;?>"><small>View Family</small></a></td>
  <? // The ability to delete a record only if there is an existing record ($PAT_ID!="0") 
  if ($PAT_ID!="0"){?>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="delete_confirm.php?TABLE=pat_filings&ID=<?=$PAT_ID;?>&NAME=<?=$docket;?>"><small>Delete</small></a></td>
  <?}?></tr>
</table><br><br>
<? if ($NEW=="Y") echo("<center>ADD PATENT RECORD</center>");
  else echo("<center>EDIT PATENT RECORD</center>");
if ($submit_2=="" or $docket=="" or $firm=="" or $title=="" or $filing_type=="" or $status=="" or $country==""){?>
<form method=get action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="PATFAM" value="0">
  <input type="hidden" name="PATEDIT" value="1">
  <input type="hidden" name="PATFAM_ID" value="<?=$PATFAM_ID;?>">
  <input type="hidden" name="PAT_ID" value="<?=$PAT_ID;?>">
  <input type="hidden" name="ACTIONS" value="<?=$ACTIONS;?>">
  <input type="hidden" name="I" value="0">
  <input type="hidden" name="EDIT" value="Y">
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
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Docket No.
        </td>
        <td width="205">
            <input name="docket" type="text" maxlength="35" size="20" value="<?=$docket;?>">
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
        <td align="right" width="115">
            Status
        </td>
        <td width="205">			
			<select name="status" size="1">
			<option><?=$status;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='PATENT_STATUS' ORDER BY menu_name";
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
            <font color="orangered"><TT><B>*</B></TT></font>
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
            <font color="orangered"><TT><B>*</B></TT></font>
        </td>
        <td align="right" width="115">
            Client Contact
        </td>
        <td width="205">
            <input name="client_contact" type="text" maxlength="100" size="25" value="<?=$client_contact;?>">
        </td>
    </tr>
    </tr>
    <tr>
        <td align="right" width="115">
            Type
        </td>
        <td width="205">			
			<select name="filing_type" size="1">
			<option><?=$filing_type;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='PATENT_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
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
            <font color="orangered"><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#country_codes">Country Codes</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Priority Date
        </td>
        <td width="205">
		<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css">
		<script type="text/javascript" src="jscalendar/calendar.js"></script>
		<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
		<input type=text name="priority_date" size="11" maxlength="10" id='jscal_field1' value="<?=$priority_date;?>">
		<small>&nbsp;(YYYY-MM-DD)</small>
		<img src="Theme/images/calendar.gif" id="jscal_trigger"><br>
  		<script type="text/javascript">
		Calendar.setup ({
			inputField : "jscal_field1", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger", singleClick : true, step : 1
		});
		</script>
<script type="text/javascript" language="Javascript">
<!--  to hide script contents from old browsers
/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "-";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   }
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strYear=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strDay=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format must be: yyyy-mm-dd")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month.")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day.")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year.")
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date.")
		return false
	}
return true
}

function isTime(timeStr){
	//time must be in the 24:00 format
    if (timeStr.length != 5) { thetimeStr = '0'+timeStr }
	else { thetimeStr = timeStr }
	var strHour=thetimeStr.substring(0,2)
	var strMin=thetimeStr.substring(3,5)
	var strTime=strHour+strMin
	var delimiter=thetimeStr.substring(2,3)
	if (strHour>24 || strMin>60  || delimiter!=':' || strTime>2400){
		alert("Please enter a valid time.")
		return false
	}

return true
}

function trim(s) {
	while (s.substring(0,1) == " ") {
		s = s.substring(1, s.length);
	}
	while (s.substring(s.length-1, s.length) == ' ') {
		s = s.substring(0,s.length-1);
	}

	return s;
}

function verify_data(form) {
	var isError = false;
	var errorMessage = "";
	if (trim(form.name.value) == "") {
		isError = true;
		errorMessage += "\nSubject";
	}
	if (trim(form.date_due.value) != '' && isDate(form.date_due.value)==false) return false;
	if (trim(form.time_due.value) != '' && isTime(form.time_due.value)==false) return false;
	// Here we decide whether to submit the form.
	if (isError == true) {
		alert("Missing required fields:" + errorMessage);
		return false;
	}
	return true;
}
// end hiding contents from old browsers  -->
</script>

        </td>
        <td align="right" width="115">
            Original
        </td>
        <td width="205">
            <select name=original size="1">
            <option><?=$original;?></option>
			<option>Y</option><option>N</option>
            </select>
            <font color="orangered"><TT><B>*</B></TT></font>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Filing Date
        </td>
        <td width="205">
		<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css">
		<script type="text/javascript" src="jscalendar/calendar.js"></script>
		<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
		<input type=text name="filing_date" size="11" maxlength="10" id='jscal_field1' value="<?=$filing_date;?>">
		<small>&nbsp;(YYYY-MM-DD)</small>
		<img src="Theme/images/calendar.gif" id="jscal_trigger"><br>
  		<script type="text/javascript">
		Calendar.setup ({
			inputField : "jscal_field1", ifFormat : "%Y-%m-%d", showsTime : false, button : "jscal_trigger", singleClick : true, step : 1
		});
		</script>

        
        
            
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
            <input type="text" name="pub_date" size="10" maxlength="10" value="<?=$pub_date;?>">
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
            <input type="text" name="issue_date" size="10" maxlength="10" value="<?=$issue_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Pat. No.
        </td>
        <td width="205">
            <input name="pat_no" type="text" maxlength="25" size="25" value="<?=$pat_no;?>">
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
	      Related<br>Documents
	    </td>
        <td width="205">
          <input type="checkbox" name="filing_receipt" value="Y" <? if ($filing_receipt=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Filing Receipt<br>
          <input type="checkbox" name="assignment" value="Y" <? if ($assignment=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Assignment<br>
          <input type="checkbox" name="assignment_recorded" value="Y" <? if ($assignment_recorded=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Recorded Assignment<br>
          <input type="checkbox" name="ids" value="Y" <? if ($ids=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Information Disclosure<br>
          <input type="checkbox" name="no_pub" value="Y" <? if ($no_pub=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;No Publication Request
	    </td>
        <td align="right" valign="top" width="115">
            Inventors<br>
			<a target=_blank href="inventors_view.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&I=1&EDIT=Y">Edit</a>&nbsp;&nbsp;
        </td>
        <td width="205" valign="top"><!-- EXISTING INVENTORS -->
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
			$middle_name = $row_2["middle_name"];
			$middle_initial = substr($middle_name,0,1);  
			$last_name = $row_2["last_name"];?>
			<a target=_blank href="inventors_edit.php?module=<?=$module;?>&ID=<?=$ID;?>&I=1&EDIT=N"><?=$first_name;?>&nbsp;<?=$middle_initial;?>.&nbsp;<?=$last_name;?></a><br>
		  <?}?>
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Abstract
        </td>
        <td colspan="3">
            <textarea wrap name="abstract" rows="3" cols="50"><?=$abstract;?></textarea>
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
			<a target=_blank href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=0&I=0&EDIT=Y">Add</a>&nbsp;&nbsp;
        </td>
        <td colspan="3"><!-- EXISTING PAT ACTIONS -->
		  <? // SQL Query for Selecting Actions Type
		  echo($ACTIONS." Actions");?>
		  	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=All&I=1&EDIT=Y">All</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=Y">Open</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Closed&I=1&EDIT=Y">Closed</a><br>
		  <? if ($ACTIONS=="Open") 
		    $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID' and
			  done='N'";
		  elseif ($ACTIONS=="Closed")
		    $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID' and
			  done='Y'";
		  else
            $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID'
			  ORDER BY respdue_date";
		  $result=mysql_query($sql);
		  while($row=mysql_fetch_array($result)){
		    $ACTION_ID=$row["action_ID"];
		    $action_type=$row["action_type"];
		    $respdue_date=$row["respdue_date"];
		    $description=$row["description"];?>
			<a target=_blank href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <?=$action_type;?></a>&nbsp;Due&nbsp;<?=$respdue_date;?><br>
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
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}
else{

// The script performs the database modification
$sql = "UPDATE pat_filings SET
    customer_ID = '$customer_ID',
    patfam_ID = '$PATFAM_ID',
    original = '$original',
    org = '$userorg',
    docket = '$docket',
    firm = '$firm',
    firm_contact = '$firm_contact',
    client = '$client',
    client_contact = '$client_contact',
    title = '$title',
    inventors = '$inventors',
    filing_type = '$filing_type',
    country = '$country',
    status = '$status',
    priority_date = '$priority_date',
    filing_date = '$filing_date',
    filing_receipt = '$filing_receipt',
    assignment = '$assignment',
    assignment_recorded = '$assignment_recorded',
    ids = '$ids',
    no_pub = '$no_pub',
    pub_date = '$pub_date',
    issue_date = '$issue_date',
    ser_no = '$ser_no',
    pub_no = '$pub_no',
    pat_no = '$pat_no',
    abstract = '$abstract',
    products = '$products',
    notes = '$notes',
	editor='$fullname',
	edit_date='$today'
    WHERE pat_ID='$PAT_ID'";
  
// RUN THE QUERY
  if (!mysql_query($sql))
    error("A database error occurred in processing your ".
      "submission.\\nIf this error persists, please ".
      "contact info@ipdox.com.");
	  
// Autodocket if it's a first case or if any of several dates have changed
  if($NEW=="Y" or $priority_date!=$priority_date_1 or $filing_date!=$filing_date_1 or $issue_date!=$issue_date_1){
    include("autoactions.php");}
	  
$DONE="1";
}}
else{ // DISPLAY RECORD -- NOT EDIT
?>
<!-- DISPLAY PATENT -->
<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="patents_view.php?module=<?=$module;?>&SORT=PATFAM&PATFAM_ID=<?=$PATFAM_ID;?>"><small>View Family</small></a></td>
  <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
  <td width="100" align="center" bgcolor="#EEEEEE"><a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID?>&ACTIONS=Open&I=1&EDIT=Y&SORT=<?=$SORT;?>&VAR=<?=$VAR?>"><small>Edit</small></a></td>
  <?}?></tr>
</table><br><br>
<center>FULL PATENT RECORD</center><br>
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
            Pat. No.
        </td>
        <td width="205" bgcolor="#EEEEEE">
            <?=$pat_no;?>
        </td>
	</tr>
    <tr>
        <td align="right" valign="top" width="115">
	      Related<br>Documents
	    </td>
        <td width="205" bgcolor="#EEEEEE">
          <input type="checkbox" name="filing_receipt" value="Y" <? if ($filing_receipt=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Filing Receipt<br>
          <input type="checkbox" name="assignment" value="Y" <? if ($assignment=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Assignment<br>
          <input type="checkbox" name="assignment_recorded" value="Y" <? if ($assignment_recorded=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Recorded Assignment<br>
          <input type="checkbox" name="ids" value="Y" <? if ($ids=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;Information Disclosure<br>
          <input type="checkbox" name="no_pub" value="Y" <? if ($no_pub=="Y") echo ("checked");?>>&nbsp;&nbsp;&nbsp;No Publication Request
	    </td>
        <td align="right" valign="top" width="115">
            Inventors			
			<? if (($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y") and $read_only=="N"){?>
			<br><a target=_blank href="inventors_view.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&I=1&EDIT=Y">Edit</a>&nbsp;&nbsp;<?}?>
        </td>
        <td width="205" valign="top" bgcolor="#EEEEEE"><!-- EXISTING INVENTORS -->
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
			$middle_name = $row_2["middle_name"];
			$middle_initial = substr($middle_name,0,1);  
			$last_name = $row_2["last_name"];?>
			<a target=_blank href="inventors_edit.php?module=<?=$module;?>&ID=<?=$ID;?>&I=1&EDIT=N"><?=$first_name;?>&nbsp;<?=$middle_initial;?>.&nbsp;<?=$last_name;?></a><br>
		  <?}?>
        </td>
	</tr>
	<tr>
        <td align="right" valign="top" width="115">
            Abstract
        </td>
        <td colspan="3" bgcolor="#EEEEEE">
            <?=$abstract;?>
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
		    <br><a target=_blank href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=0&I=0&EDIT=Y">Add</a>&nbsp;&nbsp;<?}?>
        </td>
        <td colspan="3" bgcolor="#EEEEEE"><!-- EXISTING PAT ACTIONS -->
		  <? // SQL Query for Selecting Actions Type
		  echo($ACTIONS." Actions");?>
		  	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=All&I=1&EDIT=N">All</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Open&I=1&EDIT=N">Open</a> -
			<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&PATFAM=0&PATEDIT=1&PAT_ID=<?=$PAT_ID;?>&ACTIONS=Closed&I=1&EDIT=N">Closed</a><br>
		  <? if ($ACTIONS=="Open") 
		    $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID' and
			  done='N'";
		  elseif ($ACTIONS=="Closed")
		    $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID' and
			  done='Y'";
		  else
            $sql="SELECT * FROM pat_actions WHERE
		      pat_ID='$PAT_ID'
			  ORDER BY respdue_date";
		  $result=mysql_query($sql);
		  while($row=mysql_fetch_array($result)){
		    $ACTION_ID=$row["action_ID"];
		    $action_type=$row["action_type"];
		    $respdue_date=$row["respdue_date"];
		    $description=$row["description"];?>
			<a target=_blank href="pataction_edit.php?module=<?=$module;?>&PAT_ID=<?=$PAT_ID;?>&ACTION_ID=<?=$ACTION_ID;?>&I=1&EDIT=N">
			  <?=$action_type;?></a>&nbsp;Due&nbsp;<?=$respdue_date;?><br>
		  <?}?>
        </td>
    </tr>
</table>
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
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
<p> To view patent records, click <a href="patents_view.php?module=<?=$module;?>&SORT=ALL">here</a></p>
<p> To add another record, click <a href="patents_edit.php?module=<?=$module;?>&PATFAM=1&PATEDIT=0">here</a></p>
</td></tr></table><br>
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<?}
html_footer(); ?>
