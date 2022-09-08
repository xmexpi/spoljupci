CREATE TABLE `xp_countries` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `name` VARCHAR(64) NOT NULL DEFAULT '',
  `domestic_name` VARCHAR(64) NOT NULL DEFAULT '',
  `iso_code_1` VARCHAR(3) NOT NULL DEFAULT '',
  `iso_code_2` VARCHAR(2) NOT NULL DEFAULT '',
  `iso_code_3` VARCHAR(3) NOT NULL DEFAULT '',
  `tax_id_format` VARCHAR(64) NOT NULL DEFAULT '',
  `address_format` VARCHAR(128) NOT NULL DEFAULT '',
  `postcode_format` VARCHAR(512) NOT NULL DEFAULT '',
  `postcode_required` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `language_code` VARCHAR(2) NOT NULL DEFAULT '',
  `currency_code` VARCHAR(3) NOT NULL DEFAULT '',
  `phone_code` VARCHAR(3) NOT NULL DEFAULT '',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso_code_1` (`iso_code_1`),
  UNIQUE KEY `iso_code_2` (`iso_code_2`),
  UNIQUE KEY `iso_code_3` (`iso_code_3`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_currencies` (
  `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `code` VARCHAR(3) NOT NULL DEFAULT '',
  `number` VARCHAR(3) NOT NULL DEFAULT '',
  `name` VARCHAR(32) NOT NULL DEFAULT '',
  `value` DECIMAL(11,6) UNSIGNED NOT NULL DEFAULT '0',
  `decimals` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `prefix` VARCHAR(8) NOT NULL DEFAULT '',
  `suffix` VARCHAR(8) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_customers` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(32) NOT NULL DEFAULT '',
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  `email` VARCHAR(128) NOT NULL DEFAULT '',
  `password_hash` VARCHAR(256) NOT NULL DEFAULT '',
  `tax_id` VARCHAR(32) NOT NULL DEFAULT '',
  `company` VARCHAR(64) NOT NULL DEFAULT '',
  `firstname` VARCHAR(64) NOT NULL DEFAULT '',
  `lastname` VARCHAR(64) NOT NULL DEFAULT '',
  `address1` VARCHAR(64) NOT NULL DEFAULT '',
  `address2` VARCHAR(64) NOT NULL DEFAULT '',
  `postcode` VARCHAR(16) NOT NULL DEFAULT '',
  `city` VARCHAR(32) NOT NULL DEFAULT '',
  `country_code` VARCHAR(4) NOT NULL DEFAULT '',
  `zone_code` VARCHAR(8) NOT NULL DEFAULT '',
  `phone` VARCHAR(24) NOT NULL DEFAULT '',
  `different_shipping_address` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `shipping_company` VARCHAR(64) NOT NULL DEFAULT '',
  `shipping_firstname` VARCHAR(64) NOT NULL DEFAULT '',
  `shipping_lastname` VARCHAR(64) NOT NULL DEFAULT '',
  `shipping_address1` VARCHAR(64) NOT NULL DEFAULT '',
  `shipping_address2` VARCHAR(64) NOT NULL DEFAULT '',
  `shipping_city` VARCHAR(32) NOT NULL DEFAULT '',
  `shipping_postcode` VARCHAR(16) NOT NULL DEFAULT '',
  `shipping_country_code` VARCHAR(4) NOT NULL DEFAULT '',
  `shipping_zone_code` VARCHAR(8) NOT NULL DEFAULT '',
  `shipping_phone` VARCHAR(24) NOT NULL DEFAULT '',
  `newsletter` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `notes` TEXT NOT NULL DEFAULT '',
  `password_reset_token` VARCHAR(128) NOT NULL DEFAULT '',
  `num_logins` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `last_ip` VARCHAR(39) NOT NULL DEFAULT '',
  `last_host` VARCHAR(128) NOT NULL DEFAULT '',
  `last_agent` VARCHAR(256) NOT NULL DEFAULT '',
  `date_login` TIMESTAMP NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_emails` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` ENUM('draft','scheduled','sent','error') NOT NULL DEFAULT 'draft',
  `code` VARCHAR(256) NOT NULL DEFAULT '',
  `charset` VARCHAR(16) NOT NULL DEFAULT '',
  `sender` VARCHAR(256) NOT NULL DEFAULT '',
  `recipients` TEXT NOT NULL DEFAULT '',
  `ccs` TEXT NOT NULL DEFAULT '',
  `bccs` TEXT NOT NULL DEFAULT '',
  `subject` VARCHAR(256) NOT NULL DEFAULT '',
  `multiparts` MEDIUMTEXT NOT NULL DEFAULT '',
  `date_scheduled` TIMESTAMP NULL,
  `date_sent` TIMESTAMP NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `date_scheduled` (`date_scheduled`),
  KEY `code` (`code`),
  KEY `date_created` (`date_created`),
  KEY `sender_email` (`sender`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_geo_zones` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(32) NOT NULL DEFAULT '',
  `name` VARCHAR(64) NOT NULL DEFAULT '',
  `description` VARCHAR(256) NOT NULL DEFAULT '',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_languages` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `code` VARCHAR(2) NOT NULL DEFAULT '',
  `code2` VARCHAR(3) NOT NULL DEFAULT '',
  `name` VARCHAR(32) NOT NULL DEFAULT '',
  `locale` VARCHAR(64) NOT NULL DEFAULT '',
  `charset` VARCHAR(16) NOT NULL DEFAULT '',
  `url_type` VARCHAR(16) NOT NULL DEFAULT '',
  `domain_name` VARCHAR(64) NOT NULL DEFAULT '',
  `raw_date` VARCHAR(32) NOT NULL DEFAULT '',
  `raw_time` VARCHAR(32) NOT NULL DEFAULT '',
  `raw_datetime` VARCHAR(32) NOT NULL DEFAULT '',
  `format_date` VARCHAR(32) NOT NULL DEFAULT '',
  `format_time` VARCHAR(32) NOT NULL DEFAULT '',
  `format_datetime` VARCHAR(32) NOT NULL DEFAULT '',
  `decimal_point` VARCHAR(1) NOT NULL DEFAULT '',
  `thousands_sep` VARCHAR(1) NOT NULL DEFAULT '',
  `currency_code` VARCHAR(3) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY `id` (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `xp_modules` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_id` VARCHAR(64) NOT NULL DEFAULT '',
  `type` VARCHAR(16) NOT NULL DEFAULT '',
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `settings` TEXT NOT NULL DEFAULT '',
  `last_log` TEXT NOT NULL DEFAULT '',
  `date_pushed` TIMESTAMP NULL,
  `date_processed` TIMESTAMP NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_id` (`module_id`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_pages` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `parent_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `dock` VARCHAR(64) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parent_id` (`parent_id`),
  KEY `dock` (`dock`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_pages_info` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `language_code` VARCHAR(2) NOT NULL DEFAULT '',
  `title` VARCHAR(256) NOT NULL DEFAULT '',
  `content` MEDIUMTEXT NOT NULL DEFAULT '',
  `head_title` VARCHAR(128) NOT NULL DEFAULT '',
  `meta_description` VARCHAR(512) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_info` (`page_id`, `language_code`),
  KEY `page_id` (`page_id`),
  KEY `language_code` (`language_code`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_settings` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_group_key` VARCHAR(64) NOT NULL DEFAULT '',
  `type` enum('global','local') NOT NULL DEFAULT 'local',
  `key` VARCHAR(64) NOT NULL DEFAULT '',
  `value` VARCHAR(8192) NOT NULL DEFAULT '',
  `title` VARCHAR(128) NOT NULL DEFAULT '',
  `description` VARCHAR(512) NOT NULL DEFAULT '',
  `function` VARCHAR(128) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `setting_group_key` (`setting_group_key`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_settings_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(64) NOT NULL DEFAULT '',
  `name` VARCHAR(64) NOT NULL DEFAULT '',
  `description` VARCHAR(256) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_slides` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `languages` VARCHAR(32) NOT NULL DEFAULT '',
  `name` VARCHAR(128) NOT NULL DEFAULT '',
  `image` VARCHAR(256) NOT NULL DEFAULT '',
  `priority` INT(11) NOT NULL DEFAULT '0',
  `date_valid_from` TIMESTAMP NULL DEFAULT NULL,
  `date_valid_to` TIMESTAMP NULL DEFAULT NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `xp_slides_info` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slide_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `language_code` VARCHAR(2) NOT NULL DEFAULT '',
  `caption` TEXT NOT NULL DEFAULT '',
  `link` VARCHAR(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slide_info` (`slide_id`,`language_code`),
  KEY `slide_id` (`slide_id`),
  KEY `language_code` (`language_code`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_translations` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(250) NOT NULL DEFAULT '',
  `text_en` TEXT NOT NULL DEFAULT '',
  `html` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `frontend` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `backend` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `date_accessed` TIMESTAMP NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `frontend` (`frontend`),
  KEY `backend` (`backend`),
  KEY `date_created` (`date_created`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `xp_users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `username` VARCHAR(32) NOT NULL DEFAULT '',
  `email` VARCHAR(128) NOT NULL DEFAULT '',
  `password_hash` VARCHAR(256) NOT NULL DEFAULT '',
  `apps` VARCHAR(4096) NOT NULL DEFAULT '',
  `widgets` VARCHAR(512) NOT NULL DEFAULT '',
  `last_ip` VARCHAR(39) NOT NULL DEFAULT '',
  `last_host` VARCHAR(128) NOT NULL DEFAULT '',
  `login_attempts` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_logins` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `date_valid_from` TIMESTAMP NULL,
  `date_valid_to` TIMESTAMP NULL,
  `date_active` TIMESTAMP NULL,
  `date_login` TIMESTAMP NULL,
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_zones` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_code` VARCHAR(4) NOT NULL DEFAULT '',
  `code` VARCHAR(8) NOT NULL DEFAULT '',
  `name` VARCHAR(64) NOT NULL DEFAULT '',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `country_code` (`country_code`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};
-- --------------------------------------------------------
CREATE TABLE `xp_zones_to_geo_zones` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `geo_zone_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `country_code` VARCHAR(2) NOT NULL DEFAULT '',
  `zone_code` VARCHAR(8) NOT NULL DEFAULT '',
  `date_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `region` (`geo_zone_id`, `country_code`, `zone_code`),
  KEY `geo_zone_id` (`geo_zone_id`),
  KEY `country_code` (`country_code`),
  KEY `zone_code` (`zone_code`)
) ENGINE=MyISAM DEFAULT CHARSET={DB_DATABASE_CHARSET} COLLATE {DB_DATABASE_COLLATION};