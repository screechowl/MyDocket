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
// view_menus.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin); ?>
<br><br>

<center>VIEW MENU RECORDS</center><br>
<table align="center" width="500"><br><br>
  SERVICE FIRM RECORDS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Service Firm Sort Records
$sql="SELECT * FROM menus WHERE customer_ID = '$customer_ID' and menu_type='FIRM' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  CLIENT RECORDS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE customer_ID = '$customer_ID' and menu_type='CLIENT' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  PATENT STATUS MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='PATENT_STATUS' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  PATENT ACTION MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='PATENT_ACTION' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  TRADEMARK TYPE MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_TYPE' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  TRADEMARK STATUS MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_STATUS' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  TRADEMARK ACTION MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_ACTION' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  COPYRIGHT TYPE MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='COPYRIGHT_TYPE' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  COPYRIGHT STATUS MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='COPYRIGHT_STATUS' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  LICENSE TYPE MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='LICENSE_TYPE' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  LICENSE STATUS MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='LICENSE_STATUS' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>
<br>
<hr noshade size="1" width="650">
<br>
<table align="center" width="500">
  NDA STATUS MENUS
</table><br>
<table align="center" width="650" cellpadding="5">
<?
// SQL Query for Selecting All Client Sort Records
$sql="SELECT * FROM menus WHERE menu_type='NDA_STATUS' ORDER BY menu_name";
$result=mysql_query($sql);
while($row_1=mysql_fetch_array($result)){
  $menu_name_1=$row_1["menu_name"];
  $ID_1=$row_1["ID"];
  $row_2=mysql_fetch_array($result);
  $menu_name_2=$row_2["menu_name"];
  $ID_2=$row_2["ID"];
?>
<tr bgcolor=EEEEEE><font size="-2">
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_1?>&I=1"><small><?=$menu_name_1;?></small></a></td>
  <td width="325"><a href="menus_edit.php?module=<?=$module;?>&ID=<?=$ID_2?>&I=1"><small><?=$menu_name_2;?></small></a></td>
</font></tr>
<?}?>
</table>

<? html_footer(); ?>
