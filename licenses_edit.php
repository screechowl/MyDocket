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
// full_license.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<?

// For new records, incoming link is set to $ID="0" and I="0"
// Otherwise, $ID is set to the existing record number
// SQL Query for an existing NDA record and retrieving data
if ($I=="1"){
$sql="SELECT * FROM contracts WHERE ID='$ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
    $docket = $row["docket"];
    $org = $row["org"];
    $firm = $row["firm"];
    $firm_contact = $row["firm_contact"];
    $client = $row["client"];
    $parties = $row["parties"];
    $title = $row["title"];
	$direction = $row["direction"];
	$contract_type = $row["contract_type"];
	$status = $row["status"];
	$effective_date = $row["effective_date"];
	$expiry_date = $row["expiry_date"];	
    $paydue_date = $row["paydue_date"];
	$payment_type = $row["payment_type"];
    $description=$row["description"];
    $notes=$row["notes"];
    $creator=$row["creator"];
    $create_date=$row["create_date"];
    $editor=$row["editor"];
    $edit_date=$row["edit_date"];		
}
if (($sysadmin=="Y" or $orgadmin=="Y") and $read_only=="N" and $EDIT=="Y"){?>
<? if ($ID!="0"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="100" align="center">
  <a href="delete_confirm.php?module=<?=$module;?>&TABLE=contracts&ID=<?=$ID;?>&NAME=<?=$docket;?>">Delete</a></td>
  </td></tr>
</table>
<?}?><br><br>
<? if ($ID=="0") echo("<center>ADD LICENSE RECORD</center><br>");
   else echo("<center>EDIT LICENSE RECORD</center><br>");
if ($submitok=="" or $docket=="" or $firm=="" or $parties=="" or $direction=="" or $title=="" or $contract_type=="" or $status=="" or $payment_type==""){?>
<table align="center" width="500">
The <font color=orangered size=+1><TT><B>*</B></TT></font> indicates a required field.<br>
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
            Docket Number
        </td>
        <td width="400">
            <input name=docket type=text maxlength=35 size=35 value="<?=$docket;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
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
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Contact
        </td>
        <td width="400">
            <input name=firm_contact type=text maxlength=100 size=35 value="<?=$firm_contact;?>">
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
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Parties
        </td>
        <td width="400">
            <input name=parties type=text maxlength=35 size=35 value="<?=$parties;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Title
        </td>
        <td width="400">
            <input name=title type=text maxlength=100 size=35 value="<?=$title;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Direction
        </td>
        <td width="400">
            <select name=direction size="1">
            <option><?=$direction;?></option>
            <option>IN</option>
            <option>OUT</option>
            <option>CROSS</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Type
        </td>
        <td width="400">			
			<select name="contract_type" size="1">
			<option><?=$contract_type;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='LICENSE_TYPE' ORDER BY menu_name";
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
        <td align=right width="150">
            Status
        </td>
        <td width="400">					
			<select name="status" size="1">
			<option><?=$status;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='LICENSE_STATUS' ORDER BY menu_name";
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
       <td align=right width="150">
            Effective Date
        </td>
        <td width="400">
            <input type=text name=effective_date value=<?=$effective_date;?>><small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
    <tr valign=top>
        <td align=right width="150">
            Expiry Date
        </td>
        <td width="400">
            <input type=text name=expiry_date value=<?=$expiry_date;?>><small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
	<tr>
		<td align=right width="150">
            Payments
        </td>
        <td width="400">
            <select name=payment_type size="1">
            <option><?=$payment_type;?></option>
            <option>One Time</option>
            <option>Monthly</option>
			<option>Quarterly</option>
			<option>Annual</option>
			<option>Other</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Payment Due Date
        </td>
        <td width="400">
            <input type=text name=paydue_date value=<?=$paydue_date;?>><small>&nbsp;(YYYY-MM-DD)</small>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Description
        </td>
        <td width="400">
            <textarea wrap name=description rows=2 cols=35><?=$description;?></textarea>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Notes
        </td>
        <td width="400">
            <textarea wrap name=notes rows=2 cols=35><?=$notes;?></textarea>
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
else {

if ($ID=="0" or $duplicate=="Y") // ADD NEW LICENSE
    $sql = "INSERT INTO contracts SET
              customer_ID = '$customer_ID',
              docket = '$docket',
              org = '$userorg',
              firm = '$firm',
              firm_contact = '$contact',
              client = '$client',
              parties = '$parties',
              title = '$title',
			  direction = '$direction',
			  contract_type = '$contract_type',
			  status = '$status',
			  effective_date = '$effective_date',
			  expiry_date = '$expiry_date',
              paydue_date = '$paydue_date',
			  payment_type = '$payment_type',
              description = '$description',
              notes = '$notes',
			  creator='$fullname',
			  create_date='$today'";

else // UPDATE EXISTING LICENSE
    $sql = "UPDATE contracts SET
              customer_ID = '$customer_ID',
              docket = '$docket',
              org = '$userorg',
              firm = '$firm',
              firm_contact = '$contact',
              client = '$client',
              parties = '$parties',
              title = '$title',
			  direction = '$direction',
			  contract_type = '$contract_type',
			  status = '$status',
			  effective_date = '$effective_date',
			  expiry_date = '$expiry_date',
              paydue_date = '$paydue_date',
			  payment_type = '$payment_type',
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
<table align="center" width="500"><br>
<p><strong>Your record has been successfully updated.</strong></p>
<p> To return to the login page, click <a href="index.php">here</a></p>
<p> To view license records, click <a href="licenses_view.php?module=<?=$module;?>&SORT=<?=$SORT;?>&VAR=<?=$VAR?>&DIRECTION=<?=$direction?>&ORDER=docket">here</a></p>
</table>
<? }} ?>
<!-- VIEW -->
<? if (!(($sysadmin=="Y" or $orgadmin=="Y") and $read_only=="N" and $EDIT=="Y")){?>
<? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0">
  <tr><td width="100" align="center">
  <a href="<?=$PHP_SELF;?>?module=<?=$module;?>&SORT=<?=$SORT;?>&VAR=<?=$VAR?>&ID=<?=$ID?>&I=1&EDIT=Y">Edit</a>
  </td></tr>
</table>
<?}?><br><br>
<center>FULL LICENSE RECORD</center><br>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="10">
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
            Parties
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$parties;?>
        </td>
    </tr>
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
            Direction
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$direction;?>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Type
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$contract_type;?>
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
            Effective Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$effective_date;?><small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
    <tr valign=top>
        <td align=right width="150">
            Expiry Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$expiry_date;?><small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
	<tr>
        <td align=right width="150">
            Payment Type
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$payment_type;?>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Payment Due Date
        </td>
        <td width="400" bgcolor=EEEEEE>
            <?=$paydue_date;?><small>&nbsp;(YYYY-MM-DD)</small>
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
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<? html_footer(); ?>
