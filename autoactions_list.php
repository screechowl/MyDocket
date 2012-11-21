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
//
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);
if ($ORDER=="") $ORDER="ip_type"; ?>
<br><br>
<center>LIST AUTO ACTIONS</center><br>
<table align="center" width="500">
  To order by ID, click on
  <img src="up.gif" width="13" height="11" alt="" border="0"> 
  for ascending order, and
  <img src="down.gif" width="13" height="11" alt="" border="0"> 
  for descending order.
</table><br>
<table align="center" width="100%" cellpadding="5">
<tr bgcolor=EEEEEE><font size="-2">
  <td width="120"><U>Type of IP</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=ip_type"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=ip_type DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="120"><U>Country</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=country"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=country DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="140"><U>Action Type</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=action_type"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=action_type DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="150"><U>Due (Y, M, D)</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=due_time"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=due_time DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
  <td width="120"><U>On or Off</U>
    <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=on_off"><img src="up.gif" width="13" height="11" alt="" border="0"></a>
	<a href="<?=$PHP_SELF;?>?module=<?=$module;?>&ORDER=on_off DESC"><img src="down.gif" width="13" height="11" alt="" border="0"></a></td>
</font></tr>
<?
// SQL Query for Selecting All Auto-Action Records
// if ($sysadmin=="Y" or $orgadmin=="Y")
  $sql="SELECT * FROM autoactions ORDER BY $ORDER";
  // $sql="SELECT * FROM autoactions WHERE customer_ID='$customer_ID' ORDER BY $ORDER";
// else
  // $sql="SELECT * FROM autoactions WHERE customer_ID='$customer_ID' and member='$member' ORDER BY $ORDER";
$result=mysql_query($sql);
//Print the records
while($row=mysql_fetch_array($result)){
  $ID=$row["ID"];
  $ip_type = $row["ip_type"];		  
  $country = $row["country"];
  $action_type = $row["action_type"];
  $due_month = $row["due_month"];
  $due_day = $row["due_day"];
  $due_year = $row["due_year"];
  $due_time = $row["due_time"];
  $reference_date = $row["reference_date"];
  $on_off = $row["on_off"];
?>
<tr bgcolor=EEEEEE>
  <td width="120"><small><?=$ip_type;?></small></td>
  <td width="120"><small><?=$country;?></small></td>
  <td width="140"><small><a href="autoactions_edit.php?module=<?=$module;?>&ID=<?=$ID;?>&I=1"><?=$action_type;?></a></small></td>
  <td width="150"><small><?=$due_year;?>,&nbsp;<?=$due_month;?>,&nbsp;<?=$due_day;?> from <?=$reference_date;?></small></td>
  <td width="120"><small><?=$on_off;?></small></td>
</tr>
<?}?>
</table>
<? html_footer(); ?>
