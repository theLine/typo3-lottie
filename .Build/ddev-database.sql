-- -------------------------------------------------------------
-- TablePlus 6.1.2(568)
--
-- https://tableplus.com/
--
-- Database: db
-- Generation Time: 2024-08-01 21:42:56.0210
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

TRUNCATE `pages`;
INSERT INTO `pages` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `starttime`, `endtime`, `fe_group`, `sorting`, `rowDescription`, `editlock`, `sys_language_uid`, `l10n_parent`, `l10n_source`, `l10n_state`, `t3_origuid`, `l10n_diffsource`, `t3ver_oid`, `t3ver_wsid`, `t3ver_state`, `t3ver_stage`, `perms_userid`, `perms_groupid`, `perms_user`, `perms_group`, `perms_everybody`, `title`, `slug`, `doktype`, `TSconfig`, `is_siteroot`, `php_tree_stop`, `url`, `shortcut`, `shortcut_mode`, `subtitle`, `layout`, `target`, `media`, `lastUpdated`, `keywords`, `cache_timeout`, `cache_tags`, `newUntil`, `description`, `no_search`, `SYS_LASTCHANGED`, `abstract`, `module`, `extendToSubpages`, `author`, `author_email`, `nav_title`, `nav_hide`, `content_from_pid`, `mount_pid`, `mount_pid_ol`, `l18n_cfg`, `fe_login_mode`, `backend_layout`, `backend_layout_next_level`, `tsconfig_includes`, `categories`, `tx_impexp_origuid`) VALUES
(1, 0, 1722538734, 1722538734, 1, 0, 0, 0, 0, '0', 0, NULL, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, 0, 1, 1, 31, 31, 1, 'Home', '/', 1, NULL, 1, 0, '', 0, 0, '', 0, '', 0, 0, NULL, 0, '', 0, NULL, 0, 1722539937, NULL, '', 0, '', '', '', 0, 0, 0, 0, 0, 0, '', '', NULL, 0, 0);

TRUNCATE `sys_file`;
INSERT INTO `sys_file` (`uid`, `pid`, `tstamp`, `last_indexed`, `missing`, `storage`, `type`, `metadata`, `identifier`, `identifier_hash`, `folder_hash`, `extension`, `mime_type`, `name`, `sha1`, `size`, `creation_date`, `modification_date`) VALUES
(1, 0, 1722539669, 1722539669, 0, 1, '1', 0, '/Animation - 1722539067123.json', 'ed3e51f1b6d67289129eea28142ea131d78ac0a7', '42099b4af021e53fd8fd4e056c2568d7c2e3ffa8', 'json', 'text/plain', 'Animation - 1722539067123.json', 'ba0920a9a254d7189d85fc33c7818faf3b29673c', 64533, 1722539086, 1722539086);

TRUNCATE `sys_file_metadata`;
INSERT INTO `sys_file_metadata` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `t3_origuid`, `l10n_diffsource`, `t3ver_oid`, `t3ver_wsid`, `t3ver_state`, `t3ver_stage`, `file`, `title`, `width`, `height`, `description`, `alternative`, `categories`, `visible`, `status`, `keywords`, `caption`, `creator_tool`, `download_name`, `creator`, `publisher`, `source`, `copyright`, `location_country`, `location_region`, `location_city`, `latitude`, `longitude`, `ranking`, `content_creation_date`, `content_modification_date`, `note`, `unit`, `duration`, `color_space`, `pages`, `language`, `fe_groups`, `tx_lottie_is_lottie_animation`) VALUES
(1, 0, 1722539690, 1722539669, 1, -1, 0, NULL, 0, '{\"title\":\"\",\"description\":\"\",\"ranking\":\"\",\"keywords\":\"\",\"caption\":\"\",\"download_name\":\"\",\"sys_language_uid\":\"\",\"creator\":\"\",\"creator_tool\":\"\",\"publisher\":\"\",\"source\":\"\",\"copyright\":\"\",\"language\":\"\",\"location_country\":\"\",\"location_region\":\"\",\"location_city\":\"\",\"visible\":\"\",\"status\":\"\",\"fe_groups\":\"\",\"categories\":\"\",\"tx_lottie_is_lottie_animation\":\"\"}', 0, 0, 0, 0, 1, NULL, 0, 0, NULL, NULL, 0, 1, '1', NULL, NULL, '', '', '', '', '', NULL, '', '', '', 0.00000000000000, 0.00000000000000, 0, 0, 0, NULL, '', 0, '', 0, '', NULL, 1);

TRUNCATE `sys_file_reference`;
INSERT INTO `sys_file_reference` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `sys_language_uid`, `l10n_parent`, `l10n_state`, `l10n_diffsource`, `t3ver_oid`, `t3ver_wsid`, `t3ver_state`, `t3ver_stage`, `uid_local`, `uid_foreign`, `tablenames`, `fieldname`, `sorting_foreign`, `table_local`, `title`, `description`, `alternative`, `link`, `crop`, `autoplay`) VALUES
(1, 1, 1722539937, 1722539723, 1, 0, 0, -1, 0, NULL, '{\"hidden\":\"\"}', 0, 0, 0, 0, 1, 1, 'tt_content', 'assets', 1, 'sys_file', NULL, NULL, NULL, '', '', 0);

TRUNCATE `sys_template`;
INSERT INTO `sys_template` (`uid`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `starttime`, `endtime`, `sorting`, `description`, `t3_origuid`, `t3ver_oid`, `t3ver_wsid`, `t3ver_state`, `t3ver_stage`, `title`, `root`, `clear`, `include_static_file`, `constants`, `config`, `basedOn`, `includeStaticAfterBasedOn`, `static_file_mode`, `tx_impexp_origuid`) VALUES
(1, 1, 1722541296, 1722538734, 1, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'Main TypoScript Rendering', 1, 3, 'EXT:fluid_styled_content/Configuration/TypoScript/,EXT:lottie/Configuration/TypoScript', '', 'page = PAGE\r\npage.10 = CONTENT\r\npage.10 {\r\n    table = tt_content\r\n    select {\r\n        orderBy = sorting\r\n        where = {#colPos}=0\r\n    }\r\n}\r\n', NULL, 0, 0, 0);

TRUNCATE `tt_content`;
INSERT INTO `tt_content` (`uid`, `rowDescription`, `pid`, `tstamp`, `crdate`, `cruser_id`, `deleted`, `hidden`, `starttime`, `endtime`, `fe_group`, `sorting`, `editlock`, `sys_language_uid`, `l18n_parent`, `l10n_source`, `l10n_state`, `t3_origuid`, `l18n_diffsource`, `t3ver_oid`, `t3ver_wsid`, `t3ver_state`, `t3ver_stage`, `CType`, `header`, `header_position`, `bodytext`, `bullets_type`, `uploads_description`, `uploads_type`, `assets`, `image`, `imagewidth`, `imageorient`, `imagecols`, `imageborder`, `media`, `layout`, `frame_class`, `cols`, `space_before_class`, `space_after_class`, `records`, `pages`, `colPos`, `subheader`, `header_link`, `image_zoom`, `header_layout`, `list_type`, `sectionIndex`, `linkToTop`, `file_collections`, `filelink_size`, `filelink_sorting`, `filelink_sorting_direction`, `target`, `date`, `recursive`, `imageheight`, `pi_flexform`, `accessibility_title`, `accessibility_bypass`, `accessibility_bypass_text`, `category_field`, `table_class`, `table_caption`, `table_delimiter`, `table_enclosure`, `table_header_position`, `table_tfoot`, `categories`, `selected_categories`, `tx_impexp_origuid`) VALUES
(1, '', 1, 1722539937, 1722539723, 1, 0, 0, 0, 0, '', 256, 0, -1, 0, 0, NULL, 0, '{\"CType\":\"\",\"colPos\":\"\",\"header\":\"\",\"header_layout\":\"\",\"header_position\":\"\",\"date\":\"\",\"header_link\":\"\",\"subheader\":\"\",\"bodytext\":\"\",\"assets\":\"\",\"imagewidth\":\"\",\"imageheight\":\"\",\"imageborder\":\"\",\"imageorient\":\"\",\"imagecols\":\"\",\"image_zoom\":\"\",\"layout\":\"\",\"frame_class\":\"\",\"space_before_class\":\"\",\"space_after_class\":\"\",\"sectionIndex\":\"\",\"linkToTop\":\"\",\"sys_language_uid\":\"\",\"hidden\":\"\",\"starttime\":\"\",\"endtime\":\"\",\"fe_group\":\"\",\"editlock\":\"\",\"categories\":\"\",\"rowDescription\":\"\"}', 0, 0, 0, 0, 'textmedia', 'Lottie Animation', '', '', 0, 0, 0, 1, 0, 0, 0, 2, 0, 0, 0, 'default', 0, '', '', NULL, NULL, 0, '', '', 0, '0', '', 1, 0, NULL, 0, '', '', '', 0, 0, 0, NULL, '', 0, '', '', '', NULL, 124, 0, 0, 0, 0, NULL, 0);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
