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
// setup.php
include("accesscontrol.php");
// $fullname = $accessrow["fullname"];
html_header($fullname,$module,$orgadmin); ?>
<!--
<table align="left" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="200" align="center" bgcolor="#EEEEEE"><small><?=$fullname;?></small></td></tr>
</table>
<table align="right" border="3" cellpadding="0" cellspacing="0" bordercolor="#336666" bgcolor="#336666"><tr>
  <td width="100" align="center" bgcolor="#EEEEEE"><small><? print(date("F d, Y")); ?></small></td></tr>
</table>--><br>
    <? if ("Y"==$read_only){?><p>THIS IS A BACKUP READ-ONLY SYSTEM.</p><?}?>
    <table align="center" border="0" width="400" cellpadding="0" cellspacing="10">
	  <? if ($sysadmin=="Y" or $orgadmin=="Y"){?>
	  <tr><td></td><td colspan="2" align="center">SETUP CONTROLS</td><td></td></tr><tr>
	  <td width="25%" align=right height="30"><small>USERS</small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="users_edit.php?module=<?=$module;?>&ID=0&I=0">ADD</a></small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="users_list.php?module=<?=$module;?>&ORDER=ID">LIST</a></small></td>
	  <td width="25%" align=center><small></small></td>
	  </tr>
	  <tr>
	  <td width="25%" align=right height="30"><small>MENUS</small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="menus_edit.php?module=<?=$module;?>&ID=0&I=0">ADD</a></small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="menus_list.php?module=<?=$module;?>">LIST</a></small></td>
	  <td width="25%" align=center><small></small></td>
	  </tr>
	  <tr>
	  <td width="25%" align=right height="30"><small>REMINDERS</small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="notify.php?module=<?=$module;?>">SEND</a></small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="notices_edit.php?module=<?=$module;?>&I=0">LIST</a></small></td>
	  <td width="25%" align=center><small></small></td>
	  </tr>
	  <tr>
	  <td width="25%" align=right height="30"><small>AUTO ACTIONS</small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="autoactions_edit.php?module=<?=$module;?>&ID=0&I=0">ADD</a></small></td>
	  <td width="25%" align=center bgcolor=EEEEEE><small><a href="autoactions_list.php?module=<?=$module;?>">LIST</a></small></td>
	  <td width="25%" align=center><small></small></td>
	  </tr>
	  <tr>
	  <td width="25%" align=right height="30"><small>DATABASE</small></td>
	  <td colspan="2" width="50%" align=center bgcolor=EEEEEE><small><a href="accessdenied.php?module=<?=$module;?>">BACKUP & RESTORE</a></small></td>
	  <td width="25%" align=center><small></small></td>
	  </tr><?}?>
	</table>
<? html_footer();?>
