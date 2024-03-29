<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /cvsroot/sugarcrm/sugarcrm/themes/Amazon/footer.php,v 1.9 2004/09/08 18:24:18 jostrow Exp $
 * Description:  Contains a variety of utility functions used to display UI
 * components such as form headers and footers.  Intended to be modified on a per
 * theme basis.
 ********************************************************************************/
global $app_strings;
?>
<!--end body panes-->
</td></tr>
<tr><td colspan="2" align="center">
	<table CELLSPACING=3 border=0><tr>
      <td align=center noWrap colSpan=4>
	  <A href="index.php?module=Home&action=index"><?php echo $app_list_strings['moduleList']['Home']; ?></A> |
	  <A href="index.php?module=Patents&action=index"><?php echo $app_list_strings['moduleList']['Patents']; ?></A> |
	  <A href="index.php?module=Trademarks&action=index"><?php echo $app_list_strings['moduleList']['Trademarks']; ?></A> |
	  <A href="index.php?module=Copyrights&action=index"><?php echo $app_list_strings['moduleList']['Copyrights']; ?></A> |
	  <A href="index.php?module=Contacts&action=index"><?php echo $app_list_strings['moduleList']['Contacts']; ?></A> |
	  <A href="index.php?module=Meetings&action=index"><?php echo $app_list_strings['moduleList']['Meetings']; ?></A> |
	  <A href="index.php?module=Tasks&action=index"><?php echo $app_list_strings['moduleList']['Tasks']; ?></A>
	  </td>
    </tr></table>
</td></tr></table>
</body>
</html>
