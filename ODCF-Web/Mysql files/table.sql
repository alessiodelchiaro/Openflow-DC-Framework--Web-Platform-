--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `usr` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `pass` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `regIP` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usr` (`usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vms` (
  `id` int(11) NOT NULL auto_increment,
  `usr_id` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `cpu` int(4) NOT NULL,
  `ram` int(4) NOT NULL,
  `disk` int(4) NOT NULL,
  `io` int(4) NOT NULL,
  `ipv4` int unsigned NOT NULL,
  `time` datetime NOT NULL default '0000-00-00 00:00:00',
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  FOREIGN KEY (`usr_id`) REFERENCES users(`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `vm_groups` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(10) NOT NULL,
  `vm_id` int unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  FOREIGN KEY (`vm_id`) REFERENCES vms(`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;