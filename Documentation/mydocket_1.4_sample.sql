# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Nov 06, 2004 at 07:23 PM
# Server version: 3.23.58
# PHP Version: 4.3.3
# 
# Database : `mydocket`
# 

# --------------------------------------------------------

#
# Table structure for table `autoactions`
#

CREATE TABLE `autoactions` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `ip_type` varchar(10) NOT NULL default '',
  `country` char(3) NOT NULL default '',
  `action_type` varchar(25) NOT NULL default '',
  `original_only` char(1) NOT NULL default 'N',
  `recurring` char(1) NOT NULL default 'N',
  `description` text NOT NULL,
  `due_month` tinyint(2) NOT NULL default '0',
  `due_day` tinyint(2) NOT NULL default '0',
  `due_year` tinyint(4) NOT NULL default '0',
  `due_time` bigint(15) NOT NULL default '0',
  `reference_date` varchar(20) NOT NULL default '',
  `on_off` char(3) NOT NULL default 'ON',
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

#
# Dumping data for table `autoactions`
#

INSERT INTO `autoactions` VALUES (1, 1, 'PATENT', 'US', 'Foreign Filing', '', 'N', '', 0, 0, 1, 31104000, 'Priority Date', 'ON', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');
INSERT INTO `autoactions` VALUES (2, 1, 'PATENT', 'US', 'Publication', '', 'N', '', 6, 0, 1, 46656000, 'Priority Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (3, 1, 'PATENT', 'US', 'Maintenance Fee 3.5', '', 'N', '', 6, 0, 3, 108864000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (4, 1, 'PATENT', 'US', 'Maintenance Fee 7.5', '', 'N', '', 6, 0, 7, 233280000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (5, 1, 'PATENT', 'US', 'Maintenance Fee 11.5', '', 'N', '', 6, 0, 11, 357696000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (6, 1, 'PATENT', 'PCT', 'Chapter II', '', 'N', '', 7, 0, 1, 49248000, 'Priority Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (7, 1, 'PATENT', 'PCT', 'National Stage', '', 'N', '', 6, 0, 2, 77760000, 'Priority Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (8, 1, 'TRADEMARK', 'US', 'Section 8', '', 'N', '', 0, 0, 5, 155520000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (9, 1, 'TRADEMARK', 'US', 'Section 15', '', 'N', '', 0, 0, 5, 155520000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'Guest Admin', '0000-00-00');
INSERT INTO `autoactions` VALUES (10, 1, 'TRADEMARK', 'US', 'Section 8', 'N', 'Y', '', 0, 0, 10, 311040000, 'Issue Date', 'ON', 'Guest Admin', '0000-00-00', 'GuestAdmin', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `contracts`
#

CREATE TABLE `contracts` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  `client_contact` varchar(50) NOT NULL default '',
  `firm` varchar(50) NOT NULL default '',
  `firm_contact` varchar(50) NOT NULL default '',
  `parties` varchar(50) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `direction` varchar(10) NOT NULL default '',
  `contract_type` varchar(25) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `effective_date` date NOT NULL default '0000-00-00',
  `expiry_date` date NOT NULL default '0000-00-00',
  `paydue_date` date NOT NULL default '0000-00-00',
  `payment_type` varchar(25) NOT NULL default '',
  `description` text NOT NULL,
  `notes` text NOT NULL,
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Dumping data for table `contracts`
#

INSERT INTO `contracts` VALUES (1, 1, 'MyDocket', 'SOFT-444', '', 'Guest Co.', '', 'Charles and Smith', '', 'ABC Corp.', 'Software License', 'IN', 'Non-Exclusive', 'Active', '2001-01-01', '2010-01-01', '2003-01-01', 'Annual', '', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '2002-01-11');
INSERT INTO `contracts` VALUES (2, 1, 'MyDocket', 'NDA-321', '', 'Guest Co.', '', 'Charles and Smith', '', 'ABC Corp.', 'Technology NDA', 'OUT', 'NDA', 'Active', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', 'GuestAdmin', '0000-00-00', '', '0000-00-00');
INSERT INTO `contracts` VALUES (3, 1, 'MyDocket', 'Dock-033', '', 'Guest Co.', '', 'Charles and Smith', '', 'Party A and Party B', 'Tire Wrench License', 'CROSS', 'Exclusive', 'Active', '0000-00-00', '0000-00-00', '0000-00-00', 'Quarterly', '', '', 'GuestAdmin', '2002-01-11', '', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `copyrights`
#

CREATE TABLE `copyrights` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  `client_contact` varchar(50) NOT NULL default '',
  `firm` varchar(50) NOT NULL default '',
  `firm_contact` varchar(50) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `filing_type` varchar(5) NOT NULL default '',
  `authors` text NOT NULL,
  `country` varchar(25) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `filing_date` date NOT NULL default '0000-00-00',
  `filing_receipt` char(1) NOT NULL default 'N',
  `assignment` char(1) NOT NULL default 'N',
  `assignment_recorded` char(1) NOT NULL default 'N',
  `pub_date` date NOT NULL default '0000-00-00',
  `issue_date` date NOT NULL default '0000-00-00',
  `c_no` varchar(25) NOT NULL default '',
  `description` text NOT NULL,
  `products` text NOT NULL,
  `notes` text NOT NULL,
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `copyrights`
#

INSERT INTO `copyrights` VALUES (1, 1, 'MyDocket', 'MUS-555', '', 'Guest Co.', '', 'Charles and Smith', '', 'Sound of Music', 'TX', 'Sam Music', 'US', 'Pending', '0000-00-00', 'N', 'N', 'N', '0000-00-00', '0000-00-00', '', '', '', '', 'GuestAdmin', '0000-00-00', '', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `customers`
#

CREATE TABLE `customers` (
  `ID` int(10) NOT NULL auto_increment,
  `org` varchar(50) NOT NULL default '',
  `subscribe_type` varchar(20) NOT NULL default '',
  `subscribe_period` varchar(10) NOT NULL default '',
  `no_records` int(5) NOT NULL default '0',
  `substart_date` date NOT NULL default '0000-00-00',
  `subend_date` date NOT NULL default '0000-00-00',
  `email_from` varchar(25) NOT NULL default '',
  `n1_day` int(3) default '30',
  `n1_msg` text NOT NULL,
  `n2_day` int(3) default '7',
  `n2_msg` text NOT NULL,
  `n3_day` int(3) default '1',
  `n3_msg` text NOT NULL,
  `nfor_day` int(3) default '180',
  `nfor_msg` text NOT NULL,
  `npub_day` int(3) default '90',
  `npub_msg` text NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

#
# Dumping data for table `customers`
#

INSERT INTO `customers` VALUES (1, 'MyDocket', 'A', 'Month', 0, '0000-00-00', '0000-00-00', 'docketing@mydocket.com', 30, 'First Reminder\r\nSincerely,\r\nMyDocket', 7, 'Second Reminder\r\nSincerely,\r\nMyDocket', 1, 'Third Reminder\r\nSincerely,\r\nMyDocket', 180, 'Foreign Reminder\r\nSincerely,\r\nMyDocket', 90, 'Publication Reminder\r\nSincerely,\r\nMyDocket');

# --------------------------------------------------------

#
# Table structure for table `inventors`
#

CREATE TABLE `inventors` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `member` varchar(50) NOT NULL default '',
  `first_name` varchar(30) NOT NULL default '',
  `middle_name` varchar(30) NOT NULL default '',
  `last_name` varchar(30) NOT NULL default '',
  `company` varchar(50) NOT NULL default '',
  `street` varchar(50) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` char(2) NOT NULL default '',
  `zip` varchar(5) NOT NULL default '',
  `country` char(2) NOT NULL default '',
  `citizen` char(2) NOT NULL default '',
  `tel` varchar(20) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `notes` text NOT NULL,
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Dumping data for table `inventors`
#

INSERT INTO `inventors` VALUES (1, 1, 'MyDocket', '', 'Steven', 'J.', 'Jones', 'Jones Co.', '', '', '', '', 'US', 'US', '', '', 'steve@mydocket.com', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');
INSERT INTO `inventors` VALUES (2, 1, 'MyDocket', '', 'Johnson', 'S.', 'Pinchet', 'Pinchet Consulting', '', '', '', '', 'US', 'US', '', '', 'pinchet@mydocket.com', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `menus`
#

CREATE TABLE `menus` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `menu_type` varchar(20) NOT NULL default '',
  `menu_name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=70 ;

#
# Dumping data for table `menus`
#

INSERT INTO `menus` VALUES (1, 1, 'MyDocket', 'FIRM', 'Charles and Smith');
INSERT INTO `menus` VALUES (2, 1, 'MyDocket', 'FIRM', 'Jones and Harvey');
INSERT INTO `menus` VALUES (3, 1, 'MyDocket', 'CLIENT', 'Guest Co.');
INSERT INTO `menus` VALUES (4, 1, 'MyDocket', 'PATENT_STATUS', 'Pending');
INSERT INTO `menus` VALUES (5, 1, 'MyDocket', 'PATENT_STATUS', 'Missing Parts Due');
INSERT INTO `menus` VALUES (6, 1, 'MyDocket', 'PATENT_STATUS', 'Amendment Due');
INSERT INTO `menus` VALUES (7, 1, 'MyDocket', 'PATENT_STATUS', 'Appeal Due');
INSERT INTO `menus` VALUES (8, 1, 'MyDocket', 'PATENT_STATUS', 'Allowed');
INSERT INTO `menus` VALUES (9, 1, 'MyDocket', 'PATENT_STATUS', 'Issued');
INSERT INTO `menus` VALUES (10, 1, 'MyDocket', 'PATENT_STATUS', 'M. Fee Due');
INSERT INTO `menus` VALUES (11, 1, 'MyDocket', 'PATENT_STATUS', 'Abandoned');
INSERT INTO `menus` VALUES (12, 1, 'MyDocket', 'PATENT_TYPE', 'Provisional');
INSERT INTO `menus` VALUES (13, 1, 'MyDocket', 'PATENT_TYPE', 'Utility');
INSERT INTO `menus` VALUES (14, 1, 'MyDocket', 'PATENT_TYPE', 'Design');
INSERT INTO `menus` VALUES (15, 1, 'MyDocket', 'PATENT_TYPE', 'Plant');
INSERT INTO `menus` VALUES (16, 1, 'MyDocket', 'PATENT_TYPE', 'Reissue');
INSERT INTO `menus` VALUES (17, 1, 'MyDocket', 'PATENT_TYPE', 'Reexam');
INSERT INTO `menus` VALUES (18, 1, 'MyDocket', 'PATENT_ACTION', 'Missing Parts');
INSERT INTO `menus` VALUES (19, 1, 'MyDocket', 'PATENT_ACTION', 'Amendment');
INSERT INTO `menus` VALUES (20, 1, 'MyDocket', 'PATENT_ACTION', 'Foreign Filing');
INSERT INTO `menus` VALUES (21, 1, 'MyDocket', 'PATENT_ACTION', 'Maintenance Fee');
INSERT INTO `menus` VALUES (22, 1, 'MyDocket', 'PATENT_ACTION', 'Corporate');
INSERT INTO `menus` VALUES (23, 1, 'MyDocket', 'PATENT_ACTION', 'Internal');
INSERT INTO `menus` VALUES (24, 1, 'MyDocket', 'PATENT_ACTION', 'Other');
INSERT INTO `menus` VALUES (25, 1, 'MyDocket', 'TRADEMARK_TYPE', 'Principal');
INSERT INTO `menus` VALUES (26, 1, 'MyDocket', 'TRADEMARK_TYPE', 'Supplemental');
INSERT INTO `menus` VALUES (27, 1, 'MyDocket', 'TRADEMARK_TYPE', 'Intent To Use');
INSERT INTO `menus` VALUES (28, 1, 'MyDocket', 'TRADEMARK_STATUS', 'To Be Filed');
INSERT INTO `menus` VALUES (29, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Pending');
INSERT INTO `menus` VALUES (30, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Amendment Due');
INSERT INTO `menus` VALUES (31, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Statement of Use Due');
INSERT INTO `menus` VALUES (32, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Appeal Due');
INSERT INTO `menus` VALUES (33, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Suspended');
INSERT INTO `menus` VALUES (34, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Opposition Due');
INSERT INTO `menus` VALUES (35, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Allowed');
INSERT INTO `menus` VALUES (36, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Registered');
INSERT INTO `menus` VALUES (37, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Renewal Due');
INSERT INTO `menus` VALUES (38, 1, 'MyDocket', 'TRADEMARK_STATUS', 'Abandoned');
INSERT INTO `menus` VALUES (39, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Missing Parts');
INSERT INTO `menus` VALUES (40, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Amendment');
INSERT INTO `menus` VALUES (41, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Foreign Filing');
INSERT INTO `menus` VALUES (42, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Maintenance Fee');
INSERT INTO `menus` VALUES (43, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Corporate');
INSERT INTO `menus` VALUES (44, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Internal');
INSERT INTO `menus` VALUES (45, 1, 'MyDocket', 'TRADEMARK_ACTION', 'Other');
INSERT INTO `menus` VALUES (46, 1, 'MyDocket', 'LICENSE_TYPE', 'Non-Exclusive');
INSERT INTO `menus` VALUES (47, 1, 'MyDocket', 'LICENSE_TYPE', 'Exclusive');
INSERT INTO `menus` VALUES (48, 1, 'MyDocket', 'LICENSE_TYPE', 'Partial-Exclusive');
INSERT INTO `menus` VALUES (49, 1, 'MyDocket', 'LICENSE_STATUS', 'Negotiating');
INSERT INTO `menus` VALUES (50, 1, 'MyDocket', 'LICENSE_STATUS', 'Active');
INSERT INTO `menus` VALUES (51, 1, 'MyDocket', 'LICENSE_STATUS', 'Delinquent');
INSERT INTO `menus` VALUES (52, 1, 'MyDocket', 'LICENSE_STATUS', 'Expired');
INSERT INTO `menus` VALUES (53, 1, 'MyDocket', 'NDA_STATUS', 'Negotiating');
INSERT INTO `menus` VALUES (54, 1, 'MyDocket', 'NDA_STATUS', 'Active');
INSERT INTO `menus` VALUES (55, 1, 'MyDocket', 'NDA_STATUS', 'Delinquent');
INSERT INTO `menus` VALUES (56, 1, 'MyDocket', 'NDA_STATUS', 'Expired');
INSERT INTO `menus` VALUES (57, 1, 'MyDocket', 'COPYRIGHT_TYPE', 'PA');
INSERT INTO `menus` VALUES (58, 1, 'MyDocket', 'COPYRIGHT_TYPE', 'SE');
INSERT INTO `menus` VALUES (59, 1, 'MyDocket', 'COPYRIGHT_TYPE', 'SR');
INSERT INTO `menus` VALUES (60, 1, 'MyDocket', 'COPYRIGHT_TYPE', 'TX');
INSERT INTO `menus` VALUES (61, 1, 'MyDocket', 'COPYRIGHT_TYPE', 'VA');
INSERT INTO `menus` VALUES (62, 1, 'MyDocket', 'COPYRIGHT_STATUS', 'To Be Filed');
INSERT INTO `menus` VALUES (63, 1, 'MyDocket', 'COPYRIGHT_STATUS', 'Pending');
INSERT INTO `menus` VALUES (64, 1, 'MyDocket', 'COPYRIGHT_STATUS', 'Issued');
INSERT INTO `menus` VALUES (65, 1, 'MyDocket', 'COPYRIGHT_STATUS', 'Abandoned');
INSERT INTO `menus` VALUES (66, 1, 'MyDocket', 'COPYRIGHT_STATUS', 'Unfiled');
INSERT INTO `menus` VALUES (67, 2, 'MyDocket', 'FIRM', 'IPSG');
INSERT INTO `menus` VALUES (68, 2, 'MyDocket', 'CLIENT', 'TESTCO');

# --------------------------------------------------------

#
# Table structure for table `pat_actions`
#

CREATE TABLE `pat_actions` (
  `action_ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `pat_ID` int(10) NOT NULL default '0',
  `autogen` char(1) NOT NULL default 'N',
  `action_type` varchar(25) NOT NULL default '',
  `description` text NOT NULL,
  `oa_date` date NOT NULL default '0000-00-00',
  `respdue_date` date NOT NULL default '0000-00-00',
  `done` char(1) NOT NULL default 'N',
  `respdone_date` date NOT NULL default '0000-00-00',
  `n1_sent` char(1) NOT NULL default 'N',
  `n2_sent` char(1) NOT NULL default 'N',
  `n3_sent` char(1) NOT NULL default 'N',
  `nfor_sent` char(1) NOT NULL default 'N',
  `npub_sent` char(1) NOT NULL default 'N',
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`action_ID`),
  UNIQUE KEY `ID` (`action_ID`)
) TYPE=MyISAM AUTO_INCREMENT=56 ;

#
# Dumping data for table `pat_actions`
#

INSERT INTO `pat_actions` VALUES (1, 1, 2, 'N', 'Amendment', '', '0000-00-00', '0000-00-00', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '0000-00-00', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (2, 1, 3, 'N', 'Amendment', '', '2001-12-15', '2002-03-15', 'N', '0000-00-00', 'Y', 'Y', 'N', 'N', 'N', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '2002-01-13');
INSERT INTO `pat_actions` VALUES (22, 1, 3, 'Y', 'Maintenance Fee 11.5', '', '0000-00-00', '2013-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (21, 1, 3, 'Y', 'Maintenance Fee 7.5', '', '0000-00-00', '2009-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (20, 1, 3, 'Y', 'Maintenance Fee 3.5', '', '0000-00-00', '2005-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (19, 1, 3, 'Y', 'Publication', '', '0000-00-00', '2002-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (32, 1, 1, 'Y', 'Maintenance Fee 7.5', '', '0000-00-00', '2009-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (31, 1, 1, 'Y', 'Maintenance Fee 3.5', '', '0000-00-00', '2005-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (18, 1, 3, 'Y', 'Foreign Filing', '', '0000-00-00', '2002-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (33, 1, 1, 'Y', 'Maintenance Fee 11.5', '', '0000-00-00', '2013-02-20', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2002-01-13', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (55, 2, 4, 'Y', 'Maintenance Fee 11.5', '', '0000-00-00', '2013-10-16', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2003-12-04', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (54, 2, 4, 'Y', 'Maintenance Fee 7.5', '', '0000-00-00', '2009-10-16', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2003-12-04', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (53, 2, 4, 'Y', 'Maintenance Fee 3.5', '', '0000-00-00', '2005-10-16', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2003-12-04', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (52, 2, 4, 'Y', 'Publication', '', '0000-00-00', '2002-04-27', 'Y', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2003-12-04', '', '0000-00-00');
INSERT INTO `pat_actions` VALUES (51, 2, 4, 'Y', 'Foreign Filing', '', '0000-00-00', '2001-10-27', 'Y', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '2003-12-04', '', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `pat_families`
#

CREATE TABLE `pat_families` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `pat_families`
#

INSERT INTO `pat_families` VALUES (1, 1, 'MyDocket', '', '', '');
INSERT INTO `pat_families` VALUES (2, 1, 'MyDocket', '', '', '');
INSERT INTO `pat_families` VALUES (3, 1, 'MyDocket', '', '', '');

# --------------------------------------------------------

#
# Table structure for table `pat_filings`
#

CREATE TABLE `pat_filings` (
  `pat_ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `patfam_ID` int(10) NOT NULL default '0',
  `original` char(1) NOT NULL default 'N',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  `client_contact` varchar(50) NOT NULL default '',
  `firm` varchar(50) NOT NULL default '',
  `firm_contact` varchar(50) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `title_alt` varchar(250) NOT NULL default '',
  `filing_type` varchar(25) NOT NULL default '',
  `country` varchar(25) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `priority_date` date NOT NULL default '0000-00-00',
  `filing_date` date NOT NULL default '0000-00-00',
  `filing_receipt` char(1) NOT NULL default 'N',
  `assignment` char(1) NOT NULL default 'N',
  `assignment_recorded` char(1) NOT NULL default 'N',
  `ids` char(1) NOT NULL default 'N',
  `no_pub` char(1) NOT NULL default 'N',
  `pub_date` date NOT NULL default '0000-00-00',
  `noa_date` date NOT NULL default '0000-00-00',
  `issue_date` date NOT NULL default '0000-00-00',
  `ser_no` varchar(25) NOT NULL default '',
  `pub_no` varchar(25) NOT NULL default '',
  `pat_no` varchar(25) NOT NULL default '',
  `abstract` text NOT NULL,
  `products` text NOT NULL,
  `notes` text NOT NULL,
  `inventors` text NOT NULL,
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`pat_ID`),
  UNIQUE KEY `ID` (`pat_ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `pat_filings`
#

INSERT INTO `pat_filings` VALUES (1, 1, 1, 'Y', 'MyDocket', 'BAS-033', '', 'Guest Co.', '', 'Charles and Smith', '', 'Baseball Bat', '', 'Utility', 'US', 'Pending', '1999-01-02', '1999-01-02', 'Y', '', '', '', '', '0000-00-00', '0000-00-00', '2001-10-02', '09/999,222', '', '5,734,649', '', '', '', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '2002-01-13');
INSERT INTO `pat_filings` VALUES (2, 1, 2, 'Y', 'MyDocket', 'TIR-333', '', 'Guest Co.', '', 'Charles and Smith', '', 'Spare Tire Changer', '', 'Utility', 'US', 'To Be Filed', '0000-00-00', '0000-00-00', 'Y', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '09/888,111', '', '', '', '', '', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');
INSERT INTO `pat_filings` VALUES (3, 1, 3, 'Y', 'MyDocket', 'AUT-001', '', 'Guest Co.', '', 'Charles and Smith', '', 'Automotive Widget', '', 'Utility', 'US', 'Pending', '2001-01-02', '2001-01-02', 'Y', 'Y', '', '', '', '0000-00-00', '0000-00-00', '2002-01-02', '09/333,777', '', '', 'An automotive widget includes a this and a that.', 'Cars', 'Notes', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '2002-01-13');

# --------------------------------------------------------

#
# Table structure for table `pat_inventors`
#

CREATE TABLE `pat_inventors` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `pat_ID` int(10) NOT NULL default '0',
  `inventor_ID` int(10) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `pat_inventors`
#

INSERT INTO `pat_inventors` VALUES (1, 1, 'MyDocket', '', '', 3, 1);
INSERT INTO `pat_inventors` VALUES (2, 1, 'MyDocket', '', '', 1, 2);
INSERT INTO `pat_inventors` VALUES (3, 1, 'MyDocket', '', '', 2, 1);
INSERT INTO `pat_inventors` VALUES (4, 1, 'MyDocket', '', '', 2, 2);
INSERT INTO `pat_inventors` VALUES (5, 2, 'MyDocket', '', '', 4, 3);

# --------------------------------------------------------

#
# Table structure for table `tm_actions`
#

CREATE TABLE `tm_actions` (
  `action_ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `tm_ID` int(10) NOT NULL default '0',
  `autogen` char(1) NOT NULL default 'N',
  `action_type` varchar(25) NOT NULL default '',
  `description` text NOT NULL,
  `oa_date` date NOT NULL default '0000-00-00',
  `respdue_date` date NOT NULL default '0000-00-00',
  `done` char(1) NOT NULL default 'N',
  `respdone_date` date NOT NULL default '0000-00-00',
  `n1_sent` char(1) NOT NULL default 'N',
  `n2_sent` char(1) NOT NULL default 'N',
  `n3_sent` char(1) NOT NULL default 'N',
  `nfor_sent` char(1) NOT NULL default 'N',
  `npub_sent` char(1) NOT NULL default 'N',
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`action_ID`),
  UNIQUE KEY `ID` (`action_ID`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `tm_actions`
#

INSERT INTO `tm_actions` VALUES (1, 1, 1, 'N', 'Amendment', '', '0000-00-00', '0000-00-00', 'N', '0000-00-00', 'N', 'N', 'N', 'N', 'N', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `tm_families`
#

CREATE TABLE `tm_families` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `tm_families`
#

INSERT INTO `tm_families` VALUES (1, 1, 'MyDocket', '', '', '');
INSERT INTO `tm_families` VALUES (2, 2, 'MyDocket', '', '', '');
INSERT INTO `tm_families` VALUES (3, 2, 'MyDocket', '', '', '');
INSERT INTO `tm_families` VALUES (4, 2, 'MyDocket', '', '', '');
INSERT INTO `tm_families` VALUES (5, 2, 'MyDocket', '', '', '');

# --------------------------------------------------------

#
# Table structure for table `tm_filings`
#

CREATE TABLE `tm_filings` (
  `tm_ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `tmfam_ID` int(10) NOT NULL default '0',
  `original` char(1) NOT NULL default 'N',
  `org` varchar(50) NOT NULL default '',
  `docket` varchar(25) NOT NULL default '',
  `docket_alt` varchar(25) NOT NULL default '',
  `client` varchar(50) NOT NULL default '',
  `client_contact` varchar(50) NOT NULL default '',
  `firm` varchar(50) NOT NULL default '',
  `firm_contact` varchar(50) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `title_alt` varchar(250) NOT NULL default '',
  `filing_type` varchar(25) NOT NULL default '',
  `intl_class` varchar(20) NOT NULL default '',
  `country` varchar(25) NOT NULL default '',
  `status` varchar(25) NOT NULL default '',
  `priority_date` date NOT NULL default '0000-00-00',
  `filing_date` date NOT NULL default '0000-00-00',
  `filing_receipt` char(1) NOT NULL default 'N',
  `assignment` char(1) NOT NULL default 'N',
  `assignment_recorded` char(1) NOT NULL default 'N',
  `pub_date` date NOT NULL default '0000-00-00',
  `noa_date` date NOT NULL default '0000-00-00',
  `issue_date` date NOT NULL default '0000-00-00',
  `ser_no` varchar(25) NOT NULL default '',
  `pub_no` varchar(25) NOT NULL default '',
  `tm_no` varchar(25) NOT NULL default '',
  `description` text NOT NULL,
  `products` text NOT NULL,
  `notes` text NOT NULL,
  `creator` varchar(50) NOT NULL default '',
  `create_date` date NOT NULL default '0000-00-00',
  `editor` varchar(50) NOT NULL default '',
  `edit_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`tm_ID`),
  UNIQUE KEY `ID` (`tm_ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `tm_filings`
#

INSERT INTO `tm_filings` VALUES (1, 1, 1, 'Y', 'MyDocket', 'BUB-444', '', 'Guest Co.', '', 'Charles and Smith', '', 'Big Bang Bubble Gum', '', 'Principal', '009', 'US', 'Pending', '0000-00-00', '0000-00-00', 'Y', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '75/444,999', '', '', 'bubble gum', '', '', 'GuestAdmin', '0000-00-00', 'GuestAdmin', '0000-00-00');

# --------------------------------------------------------

#
# Table structure for table `users`
#

CREATE TABLE `users` (
  `ID` int(10) NOT NULL auto_increment,
  `customer_ID` int(10) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `sysadmin` char(1) NOT NULL default 'N',
  `orgadmin` char(1) NOT NULL default 'N',
  `memadmin` char(1) NOT NULL default 'N',
  `reminders` char(1) NOT NULL default 'Y',
  `userorg` varchar(50) NOT NULL default '',
  `member` varchar(50) NOT NULL default '',
  `password` varchar(16) NOT NULL default '',
  `fullname` varchar(50) NOT NULL default '',
  `company` varchar(50) NOT NULL default '',
  `street` varchar(50) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` char(2) NOT NULL default '',
  `zip` varchar(5) NOT NULL default '',
  `country` varchar(25) NOT NULL default '',
  `tel` varchar(20) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `notes` text NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `users`
#

INSERT INTO `users` VALUES (1, 1, 'admin', 'N', 'Y', 'Y', 'Y', 'MyDocket', 'MyDocket', '', 'Admin', 'Sample Co', '', '', '', '', '', '', '', 'admin@mydocket.com', '');
INSERT INTO `users` VALUES (2, 1, 'guest', 'N', 'N', 'N', 'N', 'MyDocket', 'MyDocket', '', 'Guest', 'Sample Co.', '', '', '', '', '', '', '', 'guest@mydocket.com', '');