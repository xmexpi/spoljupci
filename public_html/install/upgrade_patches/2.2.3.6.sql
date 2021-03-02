ALTER TABLE `lc_attribute_groups`
ADD COLUMN `sort` ENUM('alphabetical','priority') NOT NULL DEFAULT 'alphabetical' AFTER `code`;
-- --------------------------------------------------------
UPDATE `lc_settings` SET `function` = 'zone("site_country_code")' WHERE `key` = 'site_zone_code';
-- --------------------------------------------------------
UPDATE `lc_settings` SET `function` = 'zone("site_country_code")' WHERE `key` = 'default_zone_code';
