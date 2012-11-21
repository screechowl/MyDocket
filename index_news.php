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
// view_patents.php
include("accesscontrol.php");
html_header($fullname,$module,$orgadmin);?>
<br>
<center>HOME</center><br>
<table align="center" width="630">
<p>Welcome <?=$fullname?>.  Here's today's headline news from <a href="http://www.ipnews.org">ipnews.org</a>
<p>
MyDocket Features Include:
<small>
<li>Manages all types of IP including patents, trademarks, copyrights, licenses and NDAs</li>
<li>Each type of IP can be displayed and organized by docket number, title, filing data, response data and issue data</li>
<li>Licenses can be displayed and organized by inbound licenses, outbound licenses and cross-licenses</li>
<li>Non-Disclosure Agreements (NDAs) can be displayed and organized by inbound, outbound and mutual</li>
<li>Administrative control panel to add users with various access levels including read-write and read-only</li>
<li>Company relationship management and tracking (that can be updated by the client company)</li>
<!--<li>Reminder notices by e-mail in advance of due dates (i.e. 30 days, 7 days and 1 day) until checked off as completed</li>-->
<li>Software runs on a managed server with the latest software updates (no need for customers to maintain the system)</li>
<li>Software can be installed on a Windows, Linux or Solaris Intranet</li>
<li>Local version can be installed on a Windows or Linux laptop computer for mobility</li>
<li>Additional features and graphical enhancements will be added to ensure that the user interface remains easy to use</li></small>
</p>
<p>MyDocket is written in PHP and employs a MySQL database.<br>
The preferred server environment is Linux, Apache, MySQL and PHP (LAMP).<br>
MyDocket is &copy; 2001-2004 <a target='_blank' href="http://www.ipgroup.org">IP Group</a>, all rights reserved.</p>
<p>MyDocket is provided as Open Source License under the Mozilla Public License
version 1.1, wich can be found at http://www.mozilla.org/MPL/MPL-1.1.html.</p>
</table>
<? html_footer(); ?>
