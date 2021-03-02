UPDATE `lc_settings` SET `function` = 'zones("default_country_code")' WHERE `key` = 'default_zone_code';
-- --------------------------------------------------------
UPDATE `lc_settings` SET `function` = 'zones("site_country_code")' WHERE `key` = 'site_zone_code';
