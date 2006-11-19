<?php
/**
 * @package DTC
 * @version  $Id: dtc-pkg-info.php,v 1.1 2006/11/19 14:09:24 thomas Exp $
 * 
 */
$pkg_info = array(
  "name" => "Joomla",
  "version" => "1.0.10",
  "short_desc" => "A fully featured content management system",
  "long_desc" => "Joomla is a high powered, fully scalable, and highly customizable
  Open Source content management system. Joomla has a user-friendly interface, simple
  and straightforward administration panel, and helpful FAQ. Based on the powerful
  PHP server language and your choice of MySQL, MS-SQL, PostgreSQL or Access/ODBC
  database servers, Joomla is the ideal free community solution for all web sites.",
  "unpack_disk_usage" => "7709555",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "INSTALL.php",

  "remove_folder" => "no",

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "cms",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "Joomla_1.0.11-Stable-Full_Package.tar.bz2",
  "resulting_dir" => "",
  "renamedir_to" => "");

?>
