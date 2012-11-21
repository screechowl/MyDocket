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
// search_ndas.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<br><br>

<center>SEARCH NON-DISCLOSURE AGREEMENTS</center><br>
<? if ($submitok==""){?>
<form method=get action="ndas_list.php">
  <input type="hidden" name="module" value="<?=$module;?>">
  <input type="hidden" name="SORT" value="SEARCH">
  <input type="hidden" name="ORDER" value="docket">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="10">
    <tr>
        <td align=right width="150">
            Title
        </td>
        <td width="400">
            <input name="title" type="text" maxlength="100" size="35" value="<?=$title;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Docket Number
        </td>
        <td width="400">
            <input name="docket" type="text" maxlength="35" size="35" value="<?=$docket;?>">
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
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Contact
        </td>
        <td width="400">
            <input name="firm_contact" type="text" maxlength="100" size="35" value="<?=$firm_contact;?>">
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
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Parties
        </td>
        <td width="400">
            <input name="parties" type="text" maxlength="35" size="35" value="<?=$parties;?>">
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Direction
        </td>
        <td width="400">
            <select name="direction" size="1">
            <option><?=$direction;?></option>
            <option>IN</option>
            <option>OUT</option>
            <option>MUTUAL</option>
            </select>
        </td>
    </tr>
    <tr>
        <td align=right width="150">
            Status
        </td>
        <td width="400">								
			<select name="status" size="1">
			<option><?=$status;?></option>
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
       <td align=right width="150">
            Effective Date
        </td>
        <td width="400">
            <input type="text" name="effective_date" size="8" maxlength="10" value="<?=$effective_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
    <tr valign=top>
        <td align=right width="150">
            Expiry Date
        </td>
        <td width="400">
            <input type="text" name="expiry_date" size="8" maxlength="10" value="<?=$expiry_date;?>">
			<small>&nbsp;(YYYY-MM-DD)</small>
        </td>
    </tr>
	<tr>
        <td align=right width="150">
            Description
        </td>
        <td width="400">
            <textarea wrap name="description" rows="2" cols="35"><?=$description;?></textarea>
        </td>
	</tr>
	<tr>
        <td align=right width="150">
            Notes
        </td>
        <td width="400">
            <textarea wrap name="notes" rows="2" cols="35"><?=$notes;?></textarea>
        </td>
	</tr>	
    <tr>
        <td align="center" colspan="4" width="650">
            <hr noshade size="1" width="650">
            <input type=submit name="submitok" value="  OK  ">
			</form>
        </td>
    </tr>
</table>
<?}
html_footer(); ?>
