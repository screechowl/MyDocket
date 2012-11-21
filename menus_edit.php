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
// full_menu.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<?
// For new records, incoming link is set to $ID="0" and $I="0"
// Otherwise, $ID is set to the existing record number
// SQL Query for an existing NDA record and retrieving data
if ($I=="1"){
$sql="SELECT * FROM menus WHERE ID='$ID'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
    $org = $row["org"];
    $menu_type = $row["menu_type"];
    $menu_name = $row["menu_name"];		
}
if ($sysadmin=="Y" or $orgadmin=="Y"){?>
<? if ($ID!="0"){?>
<table align="right" border="0" cellpadding="0" cellspacing="0"><tr>
  <td width="100%" align="center" bgcolor="#FFFFFF">
    <a href="delete_confirm.php?module=<?=$module;?>&TABLE=menus&ID=<?=$ID;?>&NAME=<?=$menu_name;?>">Delete</a>
  </td></tr>
</table>
<?}?><br><br>
<? if ($ID=="0") echo("<center>ADD MENU RECORD</center><br>");
   else echo("<center>EDIT MENU RECORD</center><br>");
if ($submitok=="" or $menu_type=="" or menu_name==""){?>
<form method=post action="<?=$PHP_SELF;?>">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="ID" value="<?=$ID;?>">
  <input type="hidden" name="I" value="0">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="10">
    <tr>
        <td align=right width="150">
            Name
        </td>
        <td width="400">
            <input name="menu_name" type="text" maxlength="35" size="35" value="<?=$menu_name;?>">
            <font color=orangered size=+1><TT><B>*</B></TT></font>
			(no "&" characters)
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Type
        </td>
        <td width="400">
            <select name=menu_type size="1">
			<option><?=$menu_type;?></option>
			<option>CLIENT</option>
			<option>FIRM</option>
			<option>PATENT_TYPE</option>
			<option>PATENT_STATUS</option>
			<option>PATENT_ACTION</option>
			<option>TRADEMARK_TYPE</option>
			<option>TRADEMARK_STATUS</option>
			<option>TRADEMARK_ACTION</option>
			<option>COPYRIGHT_TYPE</option>
			<option>COPYRIGHT_STATUS</option>
			<option>LICENSE_TYPE</option>
			<option>LICENSE_STATUS</option>
			<option>NDA_STATUS</option>
            </select>
            <font color=orangered size=+1><TT><B>*</B></TT></font>
        </td>
    </tr>
	<tr>
	  <td colspan="2">
        <br><hr noshade size="1" width="400">
      </td>
    </tr>
	<tr>
	  <td colspan="2">
        <center>EXISTING MENUS</center><br>
      </td>
    </tr>
    <tr>
        <td align=right width="150">
            <p>Firms</p>
        </td>		
        <td width="400">
            <select name=x size="1">
		    <? $sql="SELECT * FROM menus WHERE customer_ID = '$customer_ID' and menu_type='FIRM' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            <p>Clients</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE customer_ID = '$customer_ID' and menu_type='CLIENT' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>
    </tr>
    <tr>
        <td align=right width="150">
            <p>Patent Types</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='PATENT_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Patent Status</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='PATENT_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Patent Actions</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='PATENT_ACTION' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Trademark Types</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Trademark Status</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Trademark Actions</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_ACTION' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Copyright Types</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='COPYRIGHT_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>Copyright Status</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='COPYRIGHT_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>License Types</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='LICENSE_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align=right width="150">
            <p>License Status</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='LICENSE_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            <p>NDA Status</p>
        </td>		
        <td width="400">
            <select name=y size="1">
		    <? $sql="SELECT * FROM menus WHERE menu_type='NDA_STATUS' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
        </td>
    </tr>	
    <tr>
        <td align="center" colspan="4" width="100%">
            <hr noshade size="1" width="600">
            <input type=submit name="submitok" value="  OK  ">
        </td>
    </tr>
</table>
<?
}
else {

// The script performs the database update

if ($ID=="0") // ADD NEW RECORD
   $sql = "INSERT INTO menus SET
       customer_ID = '$customer_ID',
       org = '$userorg',
       menu_type = '$menu_type',
       menu_name = '$menu_name'";


else // UPDATE EXISTING RECORD
    $sql = "UPDATE menus SET
       customer_ID = '$customer_ID',
       org = '$userorg',
       menu_type = '$menu_type',
       menu_name = '$menu_name'
       WHERE ID='$ID'";
			  
// RUN THE QUERY
     if (!mysql_query($sql)){
             error("A database error occurred in processing your ".
              "submission.\\nIf this error persists, please ".
              "contact info@ipdox.com.");
             }
?>
<table align="center" width="500"><tr><td>
<p><strong>Your record has been successfully updated.</strong></p>
<p> To return to the login page, click <a href="index.php">here</a></p>
<p> To view menu records, click <a href="menus_view.php?module=<?=$module;?>">here</a></p>
<p> To add another menu, click <a href="menus_edit.php?module=<?=$module;?>&ID=0&I=0">here</a></p>
</td></tr></table><br>
<?}}?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Creator: <?=$creator;?> on <?=$create_date;?></small></td>
  <td width="50%" align="center" bgcolor="#EEEEEE"><small>Editor: <?=$editor;?> on <?=$edit_date;?></small></td></tr>
</table>
<? html_footer(); ?>
