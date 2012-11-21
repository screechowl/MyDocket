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
// notify.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);

if ($read_only=="Y"){
  echo("<br><center>ACCESS DENIED THIS IS A READ-ONLY SYSTEM</center><br>");
  html_footer();
  exit;}

// The script checks for the presence of a $submitok variable, which would
// indicate that the signup form had been submitted. If the variable is not found,
// the script displays the form from the previous section for the user to fill in:

if ($submitok==""){
// Display the notify form ?>

<br>
<center>NOTIFY</center><br>
<form method=post action="<?=$PHP_SELF;?>">
<table align="center" width="300">
  <tr>
    <td align="center">
	  Proceed With Notifications?
	</td>
  </tr>
  <tr>
    <td  align="center">
      <hr noshade color=black>
      <input type=submit name="submitok" value="  OK  ">
	  </form>
    </td>
  </tr>
</table>
<?}
else {
// Proceed with notification
echo("Proceeding With Notification<br>");
  
// Identify each of the customers and get their message parameters
  
$sql = "SELECT * FROM customers";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
  $customer_ID = $row["ID"];
  $org = $row["org"];
  $email_from = $row["email_from"];
  $n1_day = $row["n1_day"];
  $n1_msg = $row["n1_msg"];
  $n2_day = $row["n2_day"];
  $n2_msg = $row["n2_msg"];
  $n3_day = $row["n3_day"];
  $n3_msg = $row["n3_msg"];
  $nfor_day = $row["nfor_day"];
  $nfor_msg = $row["nfor_msg"];
  $npub_day = $row["npub_day"];
  $npub_msg = $row["npub_msg"];
  
  $n1_time=$n1_day*86400; // 86400 seconds per day
  $n2_time=$n1_day*86400;
  $n3_time=$n1_day*86400;
  $nfor_time=$n1_day*86400;
  $npub_time=$n1_day*86400;

  // PATENT NOTICES
  echo("Sending Patent Notices<br>");
  
  $sql_2 = "SELECT * FROM pat_actions, pat_filings WHERE
    pat_actions.customer_ID='$customer_ID' and
    pat_actions.pat_ID=pat_filings.pat_ID and
	pat_actions.done='N'";
  $result_2 = mysql_query($sql_2);
  
  // Locate the action due records
  while($row_2 = mysql_fetch_array($result_2)){
    $PAT_ID = $row_2["pat_ID"];
	$ACTION_ID = $row_2["action_ID"];
	echo("ACTION_ID ".$ACTION_ID."<br>");
	$action_type = $row_2["action_type"];
	$respdue_date = $row_2["respdue_date"];
    $n1_sent = $row_2["n1_sent"];
    $n2_sent = $row_2["n2_sent"];
    $n3_sent = $row_2["n3_sent"];
    $nfor_sent = $row_2["nfor_sent"];
    $npub_sent = $row_2["npub_sent"];
	$title = $row_2["title"];
	$docket = $row_2["docket"];
	$org = $row_2["org"];
	$firm = $row_2["firm"];
	$client = $row_2["client"];
  
**
    // Make Response Due Date
    $date=explode(-,$respdue_date);
	$now_time = mktime();
    $respdue_diff = $respdue_time - $now_time;
	$respdue_diff_days = floor($respdue_diff/86400); // 86400 seconds per day
	
    // Make Current Time and compare response due time
    $now_time = mktime();
    $respdue_diff = $respdue_time - $now_time;
	$respdue_diff_days = floor($respdue_diff/86400); // 86400 seconds per day
		
	// Create e-mail message
	$std_subj = "Due Date Reminder - Docket No. $docket";
    $std_msg = "The following is due within the next $respdue_diff_days days:
  Docket No.: $docket
  Title: $title
  Action Type: $action_type
  Due Date: $respdue_month $respdue_day, $respdue_year	  

  ";	
		
	if ($respdue_diff_days <= $n3_day and $n3_day!="0" and $n3_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N3 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n3_msg, "From:$email_from");}
		$n3_sent="Y"; }
	if ($respdue_diff_days <= $n2_day and $n2_day!="0" and $n2_sent=="N" and $n3_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N2 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n2_msg, "From:$email_from");}
		$n2_sent="Y"; }
	if ($respdue_diff_days <= $n1_day and $n1_day!="0" and $n1_sent=="N" and $n2_sent=="N" and $n3_sent=="N"){	
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N1 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n1_msg, "From:$email_from");}
		$n1_sent="Y"; }
	if ($action_type=="Foreign Filing" and $respdue_diff_days <= $nfor_day and $nfor_day!="0" and $nfor_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within NFOR Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$nfor_msg, "From:$email_from");}
		$nfor_sent="Y"; }		
	if ($action_type=="Publication" and $respdue_diff_days <= $npub_day and $npub_day!="0" and $npub_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within NPUB Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$npub_msg, "From:$email_from");}
		$npub_sent="Y"; }

	// UPDATE THE ACTION
    $sql_3 = "UPDATE pat_actions SET
      n1_sent='$n1_sent',
      n2_sent='$n2_sent',
      n3_sent='$n3_sent',
      nfor_sent='$nfor_sent',
      npub_sent='$npub_sent'
      WHERE action_ID=$ACTION_ID";
	// RUN THE QUERY	
    if (!mysql_query($sql_3))
      error("A database error occurred in processing your ".
        "submission.\\nIf this error persists, please ".
        "contact info@ipdox.com.");
}

  // TRADEMARK NOTICES
  echo("Sending Trademark Notices<br>");

  $sql_2 = "SELECT * FROM tm_actions, tm_filings WHERE
    tm_actions.customer_ID='$customer_ID' and
    tm_actions.tm_ID=tm_filings.tm_ID and
	tm_actions.done='N'";
  $result_2 = mysql_query($sql_2);
  
  // Locate the action due records
  while($row_2 = mysql_fetch_array($result_2)){
    $TM_ID = $row_2["tm_ID"];
    $ACTION_ID = $row_2["action_ID"];
	$action_type = $row_2["action_type"];
	$respdue_month = $row_2["respdue_month"];
	$respdue_day = $row_2["respdue_day"];
	$respdue_year = $row_2["respdue_year"];
    $respdue_time = $row_2["respdue_time"];
    $n1_sent = $row_2["n1_sent"];
    $n2_sent = $row_2["n2_sent"];
    $n3_sent = $row_2["n3_sent"];
    $nfor_sent = $row_2["nfor_sent"];
    $npub_sent = $row_2["npub_sent"];
	$title = $row_2["title"];
	$docket = $row_2["docket"];
	$org = $row_2["org"];
	$firm = $row_2["firm"];
	$client = $row_2["client"];
  
    // Make Current Time and compare response due time
    $now_time = mktime();
    $respdue_diff = $respdue_time - $now_time;
	$respdue_diff_days = floor($respdue_diff/86400); // 86400 seconds per day
		
	// Create e-mail message
	$std_subj = "Due Date Reminder - Docket No. $docket";
    $std_msg = "The following is due within the next $respdue_diff_days days:
  Docket No.: $docket
  Title: $title
  Action Type: $action_type
  Due Date: $respdue_month $respdue_day, $respdue_year  

  ";	

	if ($respdue_diff_days <= $n3_day and $n3_day!="0" and $n3_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N3 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n3_msg, "From:$email_from");}
		$n3_sent="Y"; }
	if ($respdue_diff_days <= $n2_day and $n2_day!="0" and $n2_sent=="N" and $n3_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N2 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n2_msg, "From:$email_from");}
		$n2_sent="Y"; }
	if ($respdue_diff_days <= $n1_day and $n1_day!="0" and $n1_sent=="N" and $n2_sent=="N" and $n3_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within N1 Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$n1_msg, "From:$email_from");}
		$n1_sent="Y"; }
	if ($action_type=="Foreign Filing" and $respdue_diff_days <= $nfor_day and $nfor_day!="0" and $nfor_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within NFOR Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$nfor_msg, "From:$email_from");}
		$nfor_sent="Y"; }
	if ($action_type=="Publication" and $respdue_diff_days <= $npub_day and $npub_day!="0" and $npub_sent=="N"){		
	    $sql_3 = "SELECT email FROM users WHERE
		  customer_ID='$customer_ID' and
		  (member='$org' or member='$firm' or member='$client') and
		  reminders='Y'";
		$result_3 = mysql_query($sql_3);
		while($row_3 = mysql_fetch_array($result_3)){
		  $email = $row_3["email"];	
          echo("Sending Message Within NPUB Period to ".$email."<br>");
	      mail($email, $std_subj, $std_msg.$npub_msg, "From:$email_from");}
		$npub_sent="Y"; }

	// UPDATE THE ACTION
    $sql_3 = "UPDATE tm_actions SET
      n1_sent='$n1_sent',
      n2_sent='$n2_sent',
      n3_sent='$n3_sent',
      nfor_sent='$nfor_sent',
      npub_sent='$npub_sent'
      WHERE action_ID=$ACTION_ID";
	// RUN THE QUERY	
    if (!mysql_query($sql_3))
      error("A database error occurred in processing your ".
        "submission.\\nIf this error persists, please ".
        "contact info@ipdox.com.");
  }}
?>
<br>
<table align="center" width="300">
<tr><td>
<p><strong>Notification Successful!</strong></p>
<p>All notifications have been sent.</p>
</td></tr>
</table><br>
<?}
html_footer();
?>
