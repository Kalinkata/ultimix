DROP TABLE IF EXISTS `{prefix}action`;
CREATE TABLE `{prefix}action` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`alias` varchar(64) NOT NULL default 'guest' ,
	`description` text ,
	`owner` varchar(128) ,
	`ip` varchar(32) ,
	`action_date` datetime ,
	`execute_time` double default '0' ,
	`session` double default '0' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}ad_banner`;
CREATE TABLE `{prefix}ad_banner` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`campaign_id` int(10) unsigned NOT NULL ,
	`code` text NOT NULL ,
	`archived` int(10) unsigned NOT NULL default '0' ,
	`shows` int(10) unsigned NOT NULL default '0' ,
	`clicks` int(10) unsigned NOT NULL default '0' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}ad_campaign`;
CREATE TABLE `{prefix}ad_campaign` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` text NOT NULL ,
	`creator` int(10) unsigned NOT NULL default '1' ,
	`archived` int(10) unsigned NOT NULL default '0' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}category`;
CREATE TABLE `{prefix}category` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` varchar(255) NOT NULL default 'category' ,
	`root_id` int(10) unsigned NOT NULL default '1' ,
	`mask` int(10) unsigned NOT NULL default '1' ,
	`direct_category` int(10) unsigned NOT NULL default '1' ,
	`category_name` varchar(128) NOT NULL default 'category_name' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}category` ( `id` , `title` , `root_id` , `mask` , `direct_category` , `category_name` ) VALUES 
( '1' , '{lang:root_category}' , '0' , '0' , '0' , '' ),
( '10' , '{lang:news}' , '9' , '0' , '9' , 'news' ),
( '9' , '{lang:content_category}' , '0' , '0' , '1' , 'content_category' ),
( '11' , '{lang:articles}' , '9' , '0' , '9' , 'article' ),
( '12' , '{lang:faq}' , '9' , '0' , '9' , 'faq' ),
( '13' , '{lang:blog_entries}' , '9' , '0' , '9' , 'blog_entry' );

DROP TABLE IF EXISTS `{prefix}change_history`;
CREATE TABLE `{prefix}change_history` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`field_name` text NOT NULL ,
	`field_value` text NOT NULL ,
	`author` int(10) unsigned NOT NULL ,
	`creation_date` datetime NOT NULL default '0000-00-00 00:00:00' ,
	`object_id` int(10) unsigned NOT NULL ,
	`object_type` int(10) unsigned NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}comment`;
CREATE TABLE `{prefix}comment` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`author` int(10) unsigned NOT NULL ,
	`comment` text NOT NULL ,
	`creation_date` datetime NOT NULL ,
	`page` text NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}content`;
CREATE TABLE `{prefix}content` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` text ,
	`demo_content` text ,
	`main_content` text ,
	`print_content` text ,
	`category` int(10) unsigned ,
	`author` int(10) default '1' ,
	`creation_date` datetime ,
	`modification_date` datetime ,
	`publication_date` datetime ,
	`keywords` text ,
	`description` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}content` ( `id` , `title` , `demo_content` , `main_content` , `category` , `author` , `creation_date` , `modification_date` , `publication_date` , `keywords` , `description` ) VALUES 
( '1' , 'Welcome' , '<p>Hi! I&#039;am glad that you have downloaded and installed the latest release of the Ultimix framework. I hope that you&#039;ll enjoy using it. If you have any questions how to use it or any problems while using it - please comtact me using this email <strong>dodonov_a_a@inbox.ru</strong> and i&#039;ll help you as fast as i can. Or visit me at <a href="http://gdzone.ru">my blog</a>.<br></p><p>Have a nice day!<br></p>' , '' , '10' , '1' , '2011-09-25 14:50:00' , '2011-09-25 14:50:00' , '2011-09-25 14:50:00' , '' , '' );


DROP TABLE IF EXISTS `{prefix}error_log`;
CREATE TABLE `{prefix}error_log` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` varchar(255) NOT NULL ,
	`description` text ,
	`error_date` datetime ,
	`severity` int(10) unsigned ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}gallery`;
CREATE TABLE `{prefix}gallery` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` text ,
	`description` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}graph_data`;
CREATE TABLE `m_graph_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `author` int(10) unsigned NOT NULL default '0',
  `graph_type` int(10) unsigned NOT NULL default '1',
  `ordinatus` decimal(20,5) NOT NULL default '0.00000',
  `abscissa` decimal(20,0) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}group`;
CREATE TABLE `{prefix}group` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`title` text NOT NULL ,
	`comment` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}group` ( `id` , `title` , `comment` ) VALUES 
( '11' , 'user_manager' , 'group of permits for user managers' ),
( '9' , 'admin' , 'admin group' ),
( '10' , 'developer' , 'developer group' ),
( '12' , 'permit_manager' , 'group of permits for permit managers' ),
( '13' , 'system_structure_manager' , 'group of permits for system structure managers' ),
( '14' , 'menu_manager' , 'group of permits for menu management' ),
( '15' , 'review_manager' , 'group of permits for review management' ),
( '16' , 'comment_manager' , 'group of permits for comment management' ),
( '17' , 'content_manager' , 'group of permits for content management' ),
( '18' , 'category_manager' , 'group of permits for category management' ),
( '19' , 'page_manager' , 'group of permits for page management' ),
( '20' , 'package_manager' , 'group of permits for package management' ),
( '21' , 'static_content_manager' , 'group of permits for static content management' );

DROP TABLE IF EXISTS `{prefix}link`;
CREATE TABLE `{prefix}link` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`object1_id` int(10) unsigned NOT NULL ,
	`object2_id` int(10) unsigned NOT NULL ,
	`type` int(10) unsigned NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}link` ( `id` , `object1_id` , `object2_id` , `type` ) VALUES 
( '14' , '1' , '3' , '1' ),
( '65' , '1' , '12' , '2' ),
( '64' , '1' , '11' , '2' ),
( '13' , '1' , '2' , '1' ),
( '12' , '1' , '1' , '1' ),
( '20' , '3' , '3' , '1' ),
( '38' , '3' , '0' , '2' ),
( '22' , '3' , '2' , '1' ),
( '70' , '3' , '11' , '2' ),
( '25' , '2' , '3' , '1' ),
( '69' , '13' , '16' , '3' ),
( '68' , '13' , '17' , '3' ),
( '67' , '13' , '18' , '3' ),
( '66' , '13' , '19' , '3' ),
( '76' , '11' , '21' , '3' ),
( '75' , '11' , '20' , '3' ),
( '74' , '1' , '13' , '2' ),
( '73' , '3' , '9' , '2' ),
( '72' , '13' , '13' , '2' ),
( '71' , '3' , '12' , '2' ),
( '52' , '11' , '7' , '3' ),
( '56' , '12' , '8' , '3' ),
( '57' , '12' , '9' , '3' ),
( '58' , '12' , '10' , '3' ),
( '59' , '12' , '11' , '3' ),
( '60' , '12' , '12' , '3' ),
( '61' , '12' , '13' , '3' ),
( '62' , '12' , '14' , '3' ),
( '63' , '12' , '15' , '3' ),
( '77' , '1' , '14' , '2' ),
( '78' , '14' , '23' , '3' ),
( '79' , '14' , '25' , '3' ),
( '80' , '14' , '24' , '3' ),
( '81' , '14' , '22' , '3' ),
( '89' , '14' , '26' , '3' ),
( '88' , '14' , '28' , '3' ),
( '87' , '14' , '29' , '3' ),
( '86' , '14' , '27' , '3' ),
( '90' , '15' , '30' , '3' ),
( '91' , '15' , '31' , '3' ),
( '92' , '15' , '32' , '3' ),
( '93' , '16' , '33' , '3' ),
( '94' , '16' , '34' , '3' ),
( '95' , '16' , '35' , '3' ),
( '96' , '1' , '15' , '2' ),
( '97' , '1' , '16' , '2' ),
( '98' , '17' , '36' , '3' ),
( '99' , '17' , '37' , '3' ),
( '100' , '17' , '38' , '3' ),
( '101' , '17' , '39' , '3' ),
( '102' , '1' , '17' , '2' ),
( '103' , '1' , '40' , '1' ),
( '104' , '18' , '41' , '3' ),
( '105' , '18' , '42' , '3' ),
( '106' , '18' , '43' , '3' ),
( '107' , '18' , '44' , '3' ),
( '108' , '1' , '18' , '2' ),
( '109' , '1' , '45' , '1' ),
( '110' , '1' , '46' , '1' ),
( '111' , '19' , '47' , '3' ),
( '112' , '1' , '19' , '2' ),
( '113' , '19' , '48' , '3' ),
( '114' , '19' , '49' , '3' ),
( '115' , '19' , '50' , '3' ),
( '116' , '1' , '20' , '2' ),
( '117' , '20' , '51' , '3' ),
( '118' , '1' , '52' , '1' ),
( '119' , '1' , '21' , '2' ),
( '120' , '21' , '53' , '3' ),
( '121' , '21' , '54' , '3' ),
( '122' , '21' , '55' , '3' ),
( '123' , '21' , '56' , '3' ),
( '124' , '1' , '57' , '1' );

DROP TABLE IF EXISTS `{prefix}link_dictionary`;
CREATE TABLE `{prefix}link_dictionary` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`object1_type` text NOT NULL ,
	`object2_type` text NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}link_dictionary` ( `id` , `object1_type` , `object2_type` ) VALUES 
( '1' , 'user' , 'permit' ),
( '2' , 'user' , 'group' ),
( '3' , 'group' , 'permit' );

DROP TABLE IF EXISTS `{prefix}menu`;
CREATE TABLE `{prefix}menu` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`name` varchar(128) ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}menu` ( `id` , `name` ) VALUES 
( '1' , 'admin' ),
( '2' , 'main' );

DROP TABLE IF EXISTS `{prefix}menu_item`;
CREATE TABLE `{prefix}menu_item` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`menu` varchar(128) NOT NULL ,
	`name` varchar(128) NOT NULL ,
	`href` varchar(255) NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}menu_item` ( `id` , `menu` , `name` , `href` ) VALUES 
( '1' , 'main' , 'index' , '<a href="./index.html">{lang:main_page}</a><br />' );

DROP TABLE IF EXISTS `{prefix}message`;
CREATE TABLE `{prefix}message` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`author` varchar(128) ,
	`recipient` varchar(128) ,
	`subject` text ,
	`message` text ,
	`creation_date` datetime ,
	`guest_author` varchar(128) ,
	`read` int(10) unsigned default '0' ,
	`deleted` int(10) unsigned default '0' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}permit`;
CREATE TABLE `{prefix}permit` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`permit` text NOT NULL ,
	`comment` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}permit` ( `id` , `permit` , `comment` ) VALUES 
( '1' , 'admin' , 'admin permit' ),
( '2' , 'registered' , 'permit for registered users' ),
( '3' , 'public' , 'permit for public users' ),
( '7' , 'user_manager' , 'user manager permit' ),
( '8' , 'permit_manager' , 'permit manager permit' ),
( '9' , 'create_permit' , 'permit creation permit' ),
( '10' , 'update_permit' , 'permit updating permit' ),
( '11' , 'delete_permit' , 'permit deletion permit' ),
( '12' , 'group_manager' , 'group manager permit' ),
( '13' , 'create_group' , 'group creation permit' ),
( '14' , 'updating_group' , 'group updating permition' ),
( '15' , 'delete_group' , 'group deletion permit' ),
( '16' , 'update_system_structure' , 'system structure updating permit' ),
( '17' , 'delete_system_structure' , 'system structure deleting permit' ),
( '18' , 'create_system_structure' , 'system structure creation permit' ),
( '19' , 'system_structure_manager' , 'permit for system structure managers' ),
( '20' , 'delete_user' , 'delete user permit' ),
( '21' , 'update_user' , 'update user permit' ),
( '22' , 'menu_manager' , 'menu manager permit' ),
( '23' , 'create_menu' , 'create menu permit' ),
( '24' , 'edit_menu' , 'edit menu permit' ),
( '25' , 'delete_menu' , 'delete menu permit' ),
( '26' , 'menu_item_manager' , 'menu item manager permit' ),
( '27' , 'create_menu_item' , 'create menu item permit' ),
( '28' , 'edit_menu_item' , 'edit menu item permit' ),
( '29' , 'delete_menu_item' , 'delete menu item permit' ),
( '30' , 'review_manager' , 'review manager permit' ),
( '31' , 'delete_review' , 'delete review permit' ),
( '32' , 'create_review' , 'create review permit' ),
( '33' , 'comment_manager' , 'comment manager permit' ),
( '34' , 'delete_comment' , 'delete comment permit' ),
( '35' , 'create_comment' , 'create comment permit' ),
( '36' , 'content_manager' , 'content manager permit' ),
( '37' , 'delete_content' , 'delete content permit' ),
( '38' , 'create_content' , 'create content permit' ),
( '39' , 'update_content' , 'update content permit' ),
( '40' , 'news_manager' , 'news manager permit' ),
( '41' , 'category_manager' , 'category manager permit' ),
( '42' , 'create_category' , 'create category permit' ),
( '43' , 'update_category' , 'update category permit' ),
( '44' , 'delete_category' , 'delete category permit' ),
( '45' , 'database_manager' , 'database manager permit' ),
( '46' , 'tester' , 'tester permit' ),
( '47' , 'page_manager' , 'page manager permit' ),
( '48' , 'delete_page' , 'delete page permit' ),
( '49' , 'update_page' , 'update page permit' ),
( '50' , 'create_page' , 'create page permit' ),
( '51' , 'package_manager' , 'package manager permit' ),
( '52' , 'database_manager' , 'database manager permit' ),
( '53' , 'static_content_manager' , 'static content manager permit' ),
( '54' , 'create_static_content' , 'static content creation permit' ),
( '55' , 'update_static_content' , 'static content updating permit' ),
( '56' , 'delete_static_content' , 'static content deletion permit' ),
( '57' , 'site_manager' , 'site manager permit' );

DROP TABLE IF EXISTS `{prefix}rating`;
CREATE TABLE `{prefix}rating` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`value` float NOT NULL default '0' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}review`;
CREATE TABLE `{prefix}review` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`rank` int(11) NOT NULL default '0' ,
	`review` text NOT NULL ,
	`creation_date` datetime NOT NULL ,
	`author` int(10) unsigned NOT NULL ,
	`page` text NOT NULL ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}schedule`;
CREATE TABLE `{prefix}schedule` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`package_name` varchar(128) NOT NULL ,
	`package_version` varchar(128) NOT NULL default 'last' ,
	`type` int(10) unsigned NOT NULL default '0' ,
	`time_step` int(10) unsigned NOT NULL default '1' ,
	`archived` int(10) unsigned NOT NULL default '0' ,
	`parameters` text ,
	`next_processing_time` timestamp NOT NULL default '0000-00-00 00:00:00' ,
	`processing` int(10) unsigned NOT NULL default '0' ,
	`count` int(10) unsigned NOT NULL default '1' ,
	`next_iteration` int(10) unsigned NOT NULL default '0' ,
	`iteration_step` int(10) unsigned NOT NULL default '1' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}setting`;
CREATE TABLE `{prefix}setting` (
	`id` int(10) NOT NULL auto_increment ,
	`group_id` int(10) unsigned NOT NULL default '0' ,
	`name` text NOT NULL ,
	`value` text ,
	`date_from` bigint(20) unsigned NOT NULL default '0' ,
	`date_to` bigint(20) unsigned NOT NULL default '4491699892' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}site`;
CREATE TABLE `{prefix}site` (
  `id` INTEGER UNSIGNED NOT NULL auto_increment,
  `domain` text NOT NULL,
  `comment` text,
  PRIMARY KEY ( `id` )
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}subscription`;
CREATE TABLE `{prefix}subscription` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` TEXT NOT NULL,
  `description` TEXT NOT NULL,
  `template` TEXT,
  PRIMARY KEY  ( `id` )
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{prefix}system_structure`;
CREATE TABLE `{prefix}system_structure` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`page` text NOT NULL ,
	`root_page` text NOT NULL ,
	`navigation` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}system_structure` ( `id` , `page` , `root_page` , `navigation` ) VALUES 
( '1' , 'index' , 'index' , '' ),
( '2' , 'admin' , 'admin' , '' ),
( '3' , 'system_structure_manager' , 'admin' , '' ),
( '4' , 'auth' , 'index' , '' ),
( '5' , 'map' , 'index' , '' ),
( '6' , 'user_manager' , 'admin' , '' ),
( '7' , 'group_manager' , 'admin' , '' ),
( '8' , 'permit_manager' , 'admin' , '' ),
( '9' , 'user_permit_manager' , 'admin' , '' ),
( '10' , 'pmsg' , 'index' , '' ),
( '11' , 'comment_manager' , 'admin' , '' ),
( '12' , 'review_manager' , 'admin' , '' ),
( '13' , 'content_manager' , 'admin' , '' ),
( '14' , 'news_manager' , 'admin' , '' ),
( '15' , 'profile' , 'index' , '' ),
( '16' , 'category_manager' , 'admin' , '' ),
( '17' , 'profile' , 'index' , '' ),
( '18' , 'edit_profile' , 'profile' , '' ),
( '19' , 'registration' , 'index' , '' ),
( '20' , 'system_settings' , 'admin' , '' ),
( '21' , 'tree_category_manager' , 'admin' , '' ),
( '22' , 'admin_registration' , 'user_manager' , '<a href="admin_registration.html?back_page=user_manager">{lang:registration}</a>{lang_file:package_name=user::user_manager::user_manager_view}' ),
( '23' , 'page_manager' , 'admin' , '' ),
( '24' , 'package_manager' , 'admin' , '' ),
( '25' , 'static_content_manager' , 'admin' , '' ),
( '26' , 'site_manager' , 'admin' , '' );

DROP TABLE IF EXISTS `{prefix}uploaded_file`;
CREATE TABLE `{prefix}uploaded_file` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`file_path` varchar(255) NOT NULL ,
	`original_file_name` text NOT NULL ,
	`preview_image` varchar(255) NOT NULL default '{image_path:package_name=file_input::file_input_view;package_version=1.0.0;file_name=file.gif}' ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}uploaded_file` ( `id` , `file_path` , `original_file_name` , `preview_image` ) VALUES 
( '1' , 'packages/user/packages/user_view/res/images/user.png' , 'user.png' , '{image_path:package_name=file_input::file_input_view;package_version=1.0.0;file_name=file.gif}' );

DROP TABLE IF EXISTS `{prefix}user`;
CREATE TABLE `{prefix}user` (
	`id` int(10) unsigned NOT NULL auto_increment ,
	`login` varchar(128) ,
	`email` varchar(128) ,
	`active` varchar(32) ,
	`password` varchar(32) ,
	`active_to` date NOT NULL default '2019-12-31' ,
	`banned_to` date NOT NULL default '0000-00-00' ,
	`avatar` int(10) unsigned default '1' ,
	`sex` tinyint(3) unsigned NOT NULL default '0' ,
	`system` tinyint(3) unsigned NOT NULL default '0' ,
	`name` varchar(255) NOT NULL default 'Anonimous' ,
	`registered` date NOT NULL default '0000-00-00' ,
	`site` text ,
	`about` text ,
	PRIMARY KEY  ( `id` )
) AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `{prefix}user` ( `id` , `login` , `email` , `active` , `password` , `active_to` , `banned_to` , `avatar` , `sex` , `system` , `name` , `registered` , `site` , `about` ) VALUES 
( '1' , 'admin' , 'admin@localhost' , 'active' , '63a9f0ea7bb98050796b649e85481845' , '2019-12-31' , '0000-00-00' , '1' , '0' , '1' , 'Anonimous' , '0000-00-00' , '' , '' ),
( '2' , 'guest' , 'guest@localhost' , 'active' , '' , '2019-12-31' , '0000-00-00' , '1' , '0' , '1' , 'Anonimous' , '0000-00-00' , '' , '' ),
( '3' , 'developer' , 'developer@localhost' , 'active' , '63a9f0ea7bb98050796b649e85481845' , '2019-12-31' , '0000-00-00' , '1' , '0' , '0' , 'Anonimous' , '0000-00-00' , '' , '' );