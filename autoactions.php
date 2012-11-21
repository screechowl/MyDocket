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
// autoactions.php

// Patent Autoactions
if ($PAT_ID!=""){
  // Delete and existing autodocket items because they will be regenerated
  $sql="DELETE FROM pat_actions WHERE autogen='Y' and pat_ID='$PAT_ID'";
  mysql_query($sql);
  // Retrieve parameters about the case
  $sql="SELECT * FROM pat_filings WHERE pat_ID='$PAT_ID'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $original = $row["original"];
  $country = $row["country"];
  // Retrieve autotactions
  $sql="SELECT * FROM autoactions WHERE ip_type='PATENT' and country='$country' and on_off='ON'";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
    $insert="0";
    $original_only=$row["original_only"];
    $action_type=$row["action_type"];
    $description=$row["description"];
    $due_year=$row["due_year"];
    $due_month=$row["due_month"];
    $due_day=$row["due_day"];
    $reference_date=$row["reference_date"];
	   
	// Check for Priority Date Related Actions and insure that there is a priority date set
    if ($reference_date=="Priority Date" and $priority_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
    $tmp = explode("-", $priority_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }
    
	// Check for Filing Date Related Actions and insure that there is a filing date set
    elseif ($reference_date=="Filing Date" and $filing_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
	$tmp = explode("-", $filing_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }
    
	// Check for Issue Date Related Actions and insure that there is a issue date set
    elseif ($reference_date=="Issue Date" and $issue_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
	$tmp = explode("-", $issue_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }

	if ($insert=="1"){
	// Calculate the due date
	$respdue_year=$tmp[0]+$due_year;
	$respdue_month=$tmp[1]+$due_month;
	$respdue_day=$tmp[2]+$due_day;
	// Adjust for months
	if ($respdue_month>12){
	  $respdue_month=$respdue_month-12;
	  $respdue_year=$respdue_year+1;}
	// Click back days for short months
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  error("invalid due date");
    $respdue_date = $respdue_year."-".$respdue_month."-".$respdue_day;
	// if time passed, then mark as done for certain actions
	if (($respdue_date < $today) and ($action_type=="Foreign Filing" or $action_type=="Publication"))
	  $done="Y";
	  else $done="N";
    $sql_x="INSERT INTO pat_actions SET
	  customer_ID='$customer_ID',
	  pat_ID='$PAT_ID',
	  autogen='Y',
	  action_type='$action_type',
	  respdue_date='$respdue_date',
	  description='$description',
	  done='$done',
      creator='$fullname',
	  create_date='$today'";
	  if (!mysql_query($sql_x))
        error("A database error occurred in processing your ".
        "submission.\\nIf this error persists, please ".
        "contact info@ipdox.com.");
}}}

// Trademark Autoactions
if ($TM_ID!=""){
  // Delete and existing autodocket items because they will be regenerated
  $sql="DELETE FROM tm_actions WHERE autogen='Y' and tm_ID='$TM_ID'";
  mysql_query($sql);
  // Retrieve parameters about the case
  $sql="SELECT * FROM tm_filings WHERE tm_ID='$TM_ID'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);
  $original = $row["original"];
  $country = $row["country"];
  // Retrieve autotactions
  $sql="SELECT * FROM autoactions WHERE ip_type='TRADEMARK' and country='$country' and on_off='ON'";
  $result = mysql_query($sql);
  while ($row = mysql_fetch_array($result)){
    $insert="0";
    $original_only=$row["original_only"];
    $action_type=$row["action_type"];
    $description=$row["description"];
    $due_year=$row["due_year"];
    $due_month=$row["due_month"];
    $due_day=$row["due_day"];
    $reference_date=$row["reference_date"];
      
	// Check for Priority Date Related Actions and insure that there is a priority date set
    if ($reference_date=="Priority Date" and $priority_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
    $tmp = explode("-", $priority_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }
    
	// Check for Filing Date Related Actions and insure that there is a filing date set
    elseif ($reference_date=="Filing Date" and $filing_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
	$tmp = explode("-", $filing_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }
    
	// Check for Issue Date Related Actions and insure that there is a issue date set
    elseif ($reference_date=="Issue Date" and $issue_date!="0000-00-00" and ($original_only=="N" or $original=="Y")){
	$tmp = explode("-", $issue_date); // $tmp[0]=year, $tmp[1]=month, $tmp[2]=day
	$insert = "1";
    }
	
	if ($insert=="1"){
	// Calculate the due date
	$respdue_year=$tmp[0]+$due_year;
	$respdue_month=$tmp[1]+$due_month;
	$respdue_day=$tmp[2]+$due_day;
	// Adjust for months
	if ($respdue_month>12){
	  $respdue_month=$respdue_month-12;
	  $respdue_year=$respdue_year+1;}
	// Click back days for short months
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  $respdue_day=$respdue_day-1;
	if (!checkdate($respdue_month, $respdue_day, $respdue_year))
	  error("invalid due date");
    $respdue_date = $respdue_year."-".$respdue_month."-".$respdue_day;
	// if time passed, then mark as done for certain actions
	if (($respdue_date < $today) and $action_type=="Foreign Filing")
	  $done="Y";
	  else $done="N";
    $sql_x="INSERT INTO tm_actions SET
	  customer_ID='$customer_ID',
	  tm_ID='$TM_ID',
	  autogen='Y',
	  action_type='$action_type',
	  respdue_date='$respdue_date',
	  description='$description',
	  done='$done',
      creator='$fullname',
	  create_date='$today'";
	  if (!mysql_query($sql_x))
        error("A database error occurred in processing your ".
        "submission.\\nIf this error persists, please ".
        "contact info@ipdox.com.");
}}}
?>
