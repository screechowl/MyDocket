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
// search_trademarks.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<br><br>

<center>SEARCH TRADEMARKS</center><br>
<? if ($submitok==""){?>
<form method=get action="trademarks_list.php">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="SORT" value="SEARCH">
  <input type="hidden" name="ORDER" value="docket">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5">
    <tr>
        <td align="right" width="115">
            Title
        </td>
        <td colspan="3" align="left" width="450">
            <input name="title" type="text" maxlength="200" size="60" value="<?=$title;?>">
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Docket No.
        </td>
        <td width="205">
            <input name="docket" type="text" maxlength="35" size="20" value="<?=$docket;?>">
        </td>
        <td align="right" width="115">
            Status
        </td>
        <td width="205">						
			<select name="status" size="1">
			<option><?=$status;?></option>
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
        </td>
        <td align="right" width="115">
            Client Contact
        </td>
        <td width="205">
            <input name="client_contact" type="text" maxlength="100" size="25" value="<?=$client_contact;?>">
        </td>
    </tr>
    <tr>
        <td align="right" width="115">
            Type
        </td>
        <td width="205">			
			<select name="filing_type" size="1">
			<option><?=$filing_type;?></option>
		    <? $sql="SELECT * FROM menus WHERE menu_type='TRADEMARK_TYPE' ORDER BY menu_name";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)){
              $menu_name=$row["menu_name"];?>
              <option><?=$menu_name?></option>"
			<?}?>
            </select>
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
			&nbsp;&nbsp;<a target="_blank" href="help.php#country_codes">Country Codes</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Priority Date
        </td>
        <td width="205">
            <input type="text" name="priority_date" size="11" maxlength="10" value="<?=$priority_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Original
        </td>
        <td width="205">
            <select name=original size="1">
            <option><?=$original;?></option>
			<option>Y</option><option>N</option>
            </select>
			&nbsp;&nbsp;<a target="_blank" href="help.php#glossary">Glossary</a>
        </td>
	</tr>
	<tr>
        <td align="right" width="115">
            Filing Date
        </td>
        <td width="205">
            <input type="text" name="filing_date" size="11" maxlength="10" value="<?=$filing_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
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
            <input type="text" name="pub_date" size="11" maxlength="10" value="<?=$pub_date;?>">
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
            <input type="text" name="issue_date" size="11" maxlength="10" value="<?=$issue_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
        <td align="right" width="115">
            Reg. No.
        </td>
        <td width="205">
            <input name="tm_no" type="text" maxlength="25" size="25" value="<?=$tm_no;?>">
        </td>
	</tr>
	<tr>
        <td align=right width="110">
            Intl. Classes
        </td>
        <td width="205">
            <input name=intl_class type=text maxlength=25 size=25 value="<?=$intl_class;?>">
        </td>
	</tr>
    <tr>
        <td align="center" colspan="4" width="650">
            <hr noshade size="1" width="650">
            <input type=submit name="submitok" value="   OK   ">
			</form>
        </td>
    </tr>
</table>
<?}
html_footer(); ?>
