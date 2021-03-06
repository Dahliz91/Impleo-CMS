--
-- Table structure for table `impleo_core_aclaccess`
--

CREATE TABLE IF NOT EXISTS `impleo_core_aclaccess` (
  `id` int(11) NOT NULL auto_increment,
  `route` varchar(200) default NULL,
  `controller` varchar(200) default NULL,
  `action` varchar(200) default NULL,
  `role` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
);

--
-- Dumping data for table `impleo_core_aclaccess`
--

INSERT INTO `impleo_core_aclaccess` (`id`, `route`, `controller`, `action`, `role`) VALUES
(1, NULL, 'admin:index', NULL, 'Guests');

--
-- Table structure for table `impleo_core_aclroles`
--

CREATE TABLE IF NOT EXISTS `impleo_core_aclroles` (
  `id` int(11) NOT NULL auto_increment,
  `role` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

--
-- Dumping data for table `impleo_core_aclroles`
--

INSERT INTO `impleo_core_aclroles` (`id`, `role`, `parent_id`) VALUES
(1, 'Guests', 0),
(2, 'Members', 1),
(3, 'Editors', 2),
(4, 'Publishers', 3),
(5, 'Managers', 4),
(6, 'Admins', 5),
(7, 'Superadmins', 0);

--
-- Struktur för tabell `impleo_core_routes`
--

CREATE TABLE IF NOT EXISTS `impleo_core_routes` (
  `id` int(11) NOT NULL auto_increment,
  `route` text NOT NULL,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `canonical` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data i tabell `impleo_core_routes`
--

INSERT INTO `impleo_core_routes` (`id`, `route`, `key`, `title`, `metakeyword`, `metadescription`, `canonical`) VALUES
(1, '/', 'Index', 'Homepage', 'Impleo, CMS, Homepage', 'Impleo CMS Homepage', '/index.php');

--
-- Table structure for table `impleo_core_users`
--

CREATE TABLE IF NOT EXISTS `impleo_core_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL default 'Members',
  `active` int(1) NOT NULL,
  `activation` varchar(8) NOT NULL,
  `createdate` datetime NOT NULL,
  `moddate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;