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
// common.php
function html_header($fullname,$module,$orgadmin) {?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="description" content="MyDocket - Commercial Open Source IP Management">
<meta name="keywords" content="patent, trademark, copyright, docket, docketing">
<title>MyDocket - Commercial Open Source IP Management</title>
<style type="text/css">@import url("Theme/style.css"); </style>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" >
<table cellspacing="5" cellpadding="0" width="100%" border="0">
  <tbody>
  <tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="100%" border="0">
	  <tbody>
	  <tr>
	  <td align="right">
		<img width="40" height="1" src="include/images/blank.gif">
	</td>
	<td valign="bottom">
	     <table cellspacing="0" cellpadding="0" border="0"><tbody>
		 <tr>
		   <td valign="top"><img width="40" height="1" src="include/images/blank.gif"></td>
	  	   <td valign="top" align="left" nowrap bgColor="#ffffff">
           <font size="5" color="red">MyDocket</font><br><br></td>
           <!--<img border="0" src="include/images/company_logo.gif"><P></P></td>
           <td valign="top"><img width="5" height="7" src="include/images/blank.gif"></td>-->
           <!--
		   <td valign="middle" align="right" nowrap bgColor="#ffffff">
			<a href="index.php?module=Users&action=DetailView&record=1">My Account</a>&nbsp;|&nbsp;
			<a href='index.php?module=Administration&action=index'>Admin</a>&nbsp;|&nbsp;
		    <a href="index.php?LOGOUT=1">Logout</a>&nbsp;</td>-->
		</tr><tr>
		</tr><tr>
	 	<td colspan="4">
		  <table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>

	<?if($module=="Home") $HomeTab=currentTab; else $HomeTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$HomeTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$HomeTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$HomeTab;?>' href='index.php?module=Home'>Home</A></td>
      <td class='<?=$HomeTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<!-- Commented Out, link added to blue line menu
	<?//if($module=="Docket") $DocketTab=currentTab; else $DocketTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$DocketTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$DocketTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$DocketTab;?>' href='index.php?module=Docket'>Docket</A></td>
      <td class='<?=$DocketTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>
	-->

	<?if($module=="Patents") $PatentsTab=currentTab; else $PatentsTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$PatentsTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$PatentsTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$PatentsTab;?>' href='patents_list.php?module=Patents&SORT=ALL'>Patents</A></td>
      <td class='<?=$PatentsTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<?if($module=="Trademarks") $TrademarksTab=currentTab; else $TrademarksTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$TrademarksTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$TrademarksTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$TrademarksTab;?>' href='trademarks_list.php?module=Trademarks&SORT=ALL'>Trademarks</A></td>
      <td class='<?=$TrademarksTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<?if($module=="Copyrights") $CopyrightsTab=currentTab; else $CopyrightsTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$CopyrightsTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$CopyrightsTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$CopyrightsTab;?>' href='copyrights_list.php?module=Copyrights&SORT=ALL'>Copyrights</A></td>
      <td class='<?=$CopyrightsTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<?if($module=="Licenses") $LicensesTab=currentTab; else $LicensesTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$LicensesTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$LicensesTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$LicensesTab;?>' href='licenses_list.php?module=Licenses&SORT=ALL'>Licenses</A></td>
      <td class='<?=$LicensesTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<?if($module=="NDAs") $NDAsTab=currentTab; else $NDAsTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$NDAsTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$NDAsTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$NDAsTab;?>' href='ndas_list.php?module=NDAs&SORT=ALL'>NDAs</A></td>
      <td class='<?=$NDAsTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<!-- Commented Out, link added to blue line menu
	<?//if($module=="MyAccount") $MyAccountTab=currentTab; else $MyAccountTab=otherTab;?>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='<?=$MyAccountTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$MyAccountTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$MyAccountTab;?>' href='user_edit.php?module=MyAccount&ID=<?=$userid;?>&I=1'>My Account</A></td>
      <td class='<?=$MyAccountTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>
	-->

	<?if($orgadmin=="Y"){?><td><img src='Theme/images//blank.gif' width='1' height='1'></td>
	<?if($module=="Setup") $SetupTab=currentTab; else $SetupTab=otherTab;?>
      <td class='<?=$SetupTab;?>' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='<?=$SetupTab;?>' valign='middle' nowrap align='center' height='26'>
		<a class='<?=$SetupTab;?>' href='setup.php?module=Setup'>Setup</A></td>
      <td class='<?=$SetupTab;?>' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>
	<?}?>
		
		</tr></tbody></table>
		</td>
		</tr>
		</tbody></table>
     </td>
     <td nowrap Valign="middle" align="right">
		<font size="1">Welcome <?=$fullname;?></font><br>
	    <font size="1"><?=date("Y-m-d, g:i a");?></font><br>
	    <font size="1" color="blue">Powered by MyDocket</font><br>
	    <!--<a href="http://www.mydocket.com" target="_blank"><img src='include/images/mydocket.gif' border="0" alt="MyDocket(tm)"></A>-->
     </td>
  </tr>
<tr>
    <td class="moduleMenu" align="left" width="100%" colSpan="3" height="25">
<table cellSpacing="3" cellpadding="0" border="0"><tbody><tr>
	<td align="right"><img width="70" height="1" src="include/images/blank.gif"></td>

	<?if($module=="Patents"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="patents_list.php?module=<?=$module;?>&SORT=ALL">List Patents</A></td><td class="moduleMenu">|</td>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="patents_search.php?module=<?=$module;?>">Search Patents</A></td><td class="moduleMenu">|</td>
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="patents_edit.php?module=<?=$module;?>&PATFAM=1&PATEDIT=0">Add Patents</A></td><td class="moduleMenu">|</td>
	<?}?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="inventors_list.php?module=<?=$module;?>&SORT=ALL&ORDER=last_name">List Inventors</A></td>
	<?}
	elseif($module=="Trademarks"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="trademarks_list.php?module=<?=$module;?>&SORT=ALL">List Trademarks</A></td><td class="moduleMenu">|</td>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="trademarks_search.php?module=<?=$module;?>">Search Trademarks</A></td>
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
	<td class="moduleMenu">|</td><td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="trademarks_edit.php?module=<?=$module;?>&TMFAM=1&TMEDIT=0">Add Trademarks</A></td>
	<?}}
	elseif($module=="Copyrights"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="copyrights_list.php?module=<?=$module;?>&SORT=ALL">List Copyrights</A></td><td class="moduleMenu">|</td>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="copyrights_search.php?module=<?=$module;?>">Search Copyrights</A></td>
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
	<td class="moduleMenu">|</td><td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="copyrights_edit.php?module=<?=$module;?>&EDIT=Y&I=0&ID=0">Add Copyrights</A></td>
	<?}}
	elseif($module=="Licenses"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="licenses_list.php?module=<?=$module;?>&SORT=ALL">List Licenses</A></td><td class="moduleMenu">|</td>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="licenses_search.php?module=<?=$module;?>">Search Licenses</A></td>
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
	<td class="moduleMenu">|</td><td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="licenses_edit.php?module=<?=$module;?>&EDIT=Y&I=0&ID=0">Add Licenses</A></td>
	<?}}
	elseif($module=="NDAs"){?>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="ndas_list.php?module=<?=$module;?>&SORT=ALL">List NDAs</A></td><td class="moduleMenu">|</td>
	<td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="ndas_search.php?module=<?=$module;?>">Search NDAs</A></td>
    <? if ($sysadmin=="Y" or $orgadmin=="Y" or $memadmin=="Y"){?>
	<td class="moduleMenu">|</td><td nowrap class="moduleMenu">
	  <a class="moduleMenu" href="ndas_edit.php?module=<?=$module;?>&EDIT=Y&I=0&ID=0">Add NDAs</A></td>
	<?}}
	else{?>
	<td nowrap class="moduleMenu"></td>
	<?}?>
	<td nowrap class="moduleMenu" width="100%" align="right">
	  <a class="moduleMenu" href='users_edit.php?module=Setup&ID=<?=$userid;?>&I=1&identity=myself'>My Account</A>
	  &nbsp;|&nbsp;
	  <a class="moduleMenu" href="index.php?LOGOUT=1">Log Out</A>
	</td>

</tr></tbody></table>

	</td>
	</tr></table></td></tr>
<tr><td valign="top" width="20%">
<!-- MAIN CONTENT TABLE-->
<table width="85%" align="center" border="0"><tr><td>
<?}?>
<?
function html_footer() {?>
</td></tr></table>
<!-- END MAIN CONTENT TABLE-->
 </td></tr>
<tr><td colspan="2" align="center">
	<table CELLSPACING=3 border=0><tr>
      <td align=center noWrap colSpan=4>
	  <A href="about.php">About</A> |
	  <A href="legal.php">Legal</A> |
	  <A href="help.php">Help</A>
	  </td>
    </tr></table>
</td></tr></table>
</body>
</html>
<table align='center'><tr><td align='center'>
MyDocket is a trademark of <a target='_blank' href='http://www.ipgroup.org'>IP Group</a>.<br>
&copy; 2001-2004 <a target='_blank' href='http://www.ipgroup.org'>IP Group</a>.&nbsp;All Rights Reserved.<br>
</td></tr></table>
<?}?>
<?
function error($msg) {
    ?>
    <html>
    <head>
    <script language="JavaScript">
    <!--
        alert("<?=$msg?>");
        history.back();
    //-->
    </script>
    </head>
    <body>
    </body>
    </html>
    <?
    exit;
}?>
<?
function db_error() {
    ?>
    <html>
    <head>
    <script language="JavaScript">
    <!--
        alert("A database error occurred, please contact info@mydocket.com.");
        history.back();
    //-->
    </script>
    </head>
    <body>
    </body>
    </html>
    <?
    exit;
}?>
<?
function day_diff($month,$day,$year) {
$time_due=mktime("","","",$month,$day,$year);
$time_now=mktime();
$day_diff=floor(($time_due-$time_now)/(24*60*60));
return $day_diff;
}?>
<?
function country_list() {
echo ("<option>AL</option><option>AM</option><option>AP</option><option>AR</option>
		<option>AT</option><option>AU</option><option>AZ</option><option>BA</option>
		<option>BB</option><option>BE</option><option>BF</option><option>BG</option>
		<option>BJ</option><option>BR</option><option>BY</option><option>CA</option>
		<option>CF</option><option>CG</option><option>CH</option><option>CI</option>
		<option>CM</option><option>CN</option><option>CR</option><option>CU</option>
		<option>CY</option><option>CZ</option><option>DE</option><option>DK</option>
		<option>DZ</option><option>EA</option><option>EE</option><option>EP</option>
		<option>ES</option><option>FI</option><option>FR</option><option>GA</option>
		<option>GB</option><option>GE</option><option>GH</option><option>GM</option>
		<option>GN</option><option>GR</option><option>GW</option><option>HR</option>
		<option>HU</option><option>IB</option><option>ID</option><option>IE</option>
		<option>IL</option><option>IN</option><option>IS</option><option>IT</option>
		<option>JP</option><option>KE</option><option>KG</option><option>KP</option>
		<option>KR</option><option>KZ</option><option>LI</option><option>LK</option>
		<option>LR</option><option>LS</option><option>LT</option><option>LU</option>
		<option>LV</option><option>MA</option><option>MC</option><option>MD</option>
		<option>MG</option><option>MK</option><option>ML</option><option>MN</option>
		<option>MR</option><option>MW</option><option>MX</option><option>NE</option>
		<option>NL</option><option>NO</option><option>NZ</option><option>OA</option>
		<option>PCT</option><option>PL</option><option>PT</option><option>RO</option>
		<option>RU</option><option>SD</option><option>SE</option><option>SG</option>
		<option>SI</option><option>SK</option><option>SL</option><option>SN</option>
		<option>SZ</option><option>TD</option><option>TG</option><option>TJ</option>
		<option>TM</option><option>TR</option><option>TT</option><option>TW</option>
		<option>TZ</option><option>UA</option><option>UG</option><option>US</option>
		<option>UZ</option><option>VN</option><option>YU</option><option>ZA</option>
		<option>ZW</option>");
}?>
<?
function state_list() {
echo ("<option>AL</option><option>AK</option><option>AZ</option><option>AR</option><option>CA</option>
       <option>CO</option><option>CT</option><option>DE</option><option>DC</option><option>FL</option>
       <option>GA</option><option>HI</option><option>ID</option><option>IL</option><option>IN</option>
       <option>IA</option><option>KS</option><option>KY</option><option>LA</option><option>ME</option>
	   <option>MD</option><option>MA</option><option>MI</option><option>MN</option><option>MS</option>
	   <option>MO</option><option>MT</option><option>NE</option><option>NV</option><option>NH</option>
       <option>NJ</option><option>NM</option><option>NY</option><option>NC</option><option>ND</option>
       <option>OH</option><option>OK</option><option>OR</option><option>PA</option><option>RI</option>
       <option>SC</option><option>SD</option><option>TN</option><option>TX</option><option>UT</option>
       <option>VT</option><option>VA</option><option>WA</option><option>WV</option><option>WI</option>
       <option>WY</option>");}
?>
<?
function html_headeracc() {?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="description" content="MyDocket - Commercial Open Source IP Management">
<meta name="keywords" content="patent, trademark, copyright, docket, docketing">
<title>MyDocket - Commercial Open Source IP Management</title>
<style type="text/css">@import url("Theme/style.css"); </style>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" >
<table cellspacing="5" cellpadding="0" width="100%" border="0">
  <tbody>
  <tr><td colspan="2">
	<table cellspacing="0" cellpadding="0" width="100%" border="0">
	  <tbody>
	  <tr>
	  <td align="right">
		<img width="40" height="1" src="include/images/blank.gif">
	</td>
	<td valign="bottom">
	     <table cellspacing="0" cellpadding="0" border="0"><tbody>
		 <tr>
		   <td valign="top"><img width="40" height="1" src="include/images/blank.gif"></td>
	  	   <td valign="top" align="left" nowrap bgColor="#ffffff">
           <font size="5" color="red">MyDocket</font><br><br></td>
           <!--<img border="0" src="include/images/company_logo.gif"><P></P></td>
           <td valign="top"><img width="5" height="7" src="include/images/blank.gif"></td>-->
		</tr><tr>
		</tr><tr>
	 	<td colspan="4">
		  <table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>Home</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>Patents</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>Trademarks</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>Copyrights</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>Licenses</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

	<td><img src='Theme/images//blank.gif' width='1' height='1'></td>
      <td class='otherTab' valign='top' align='left' height='26'>
		<img src='Theme/images//left_arc.gif' height='5' width='5' border='0'></td>
      <td class='otherTab' valign='middle' nowrap align='center' height='26'>
		<a class='otherTab' href='index.php'>NDAs</A></td>
      <td class='otherTab' valign='top' align='left'>
		<img src='Theme/images//right_arc.gif' height='5' width='5' border='0'></td>

		</tr></tbody></table>
		</td>
		</tr>
		</tbody></table>
     </td>
     <td nowrap Valign="middle" align="right">
		<font size="1"></font><br>
	    <font size="1"><?=date("Y-m-d, g:i a");?></font><br>
	    <font size="1" color="blue">Powered by MyDocket</font><br>
	    <!--<a href="http://www.mydocket.com" target="_blank"><img src='include/images/mydocket.gif' border="0" alt="MyDocket(tm)"></A>-->
     </td>
  </tr>
<tr>
    <td class="moduleMenu" align="left" width="100%" colSpan="3" height="25">
<table cellSpacing="3" cellpadding="0" border="0"><tbody><tr>
	<td align="right"><img width="70" height="1" src="include/images/blank.gif"></td>
	<td nowrap class="moduleMenu"></td>
</tr></tbody></table>
	</td>
	</tr></table></td></tr>
<tr><td valign="top" width="20%">
<!-- MAIN CONTENT TABLE-->
<table width="85%" align="center" border="0"><tr><td>
<?}?>
