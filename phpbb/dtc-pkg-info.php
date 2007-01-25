<?php

$pkg_info = array(
  "name" => "PHPBB2",
  "version" => "2.0.22",
  "short_desc" => "A fully featured and skinneable flat (non-threaded) webforum",
  "long_desc" => "phpBB is a high powered, fully scalable, and highly customizable
  Open Source bulletin board package. phpBB has a user-friendly interface, simple
  and straightforward administration panel, and helpful FAQ. Based on the powerful
  PHP server language and your choice of MySQL, MS-SQL, PostgreSQL or Access/ODBC
  database servers, phpBB is the ideal free community solution for all web sites.",
  "unpack_disk_usage" => "2093315",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "yes",
  "post_script_url" => "install/install.php",

  "remove_folder" => "yes",
  "remove_folder_path" => array( "install", "contrib"),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "phpBB2",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.bz2",
  "file" => "phpBB-2.0.22.tar.bz2",
  "resulting_dir" => "phpBB2",
  "renamedir_to" => "phpBB2");

?>
