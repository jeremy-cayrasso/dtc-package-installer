<?php

$pkg_info = array(
  "name" => "WordPress",
  "version" => "2.5.1",
  "short_desc" => "WordPress - blogging software you use, not fight!",
  "long_desc" => "WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability. WordPress is both free and priceless at the same time.",

  "unpack_disk_usage" => "4468251",
  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "wp-admin/install.php",

  "remove_folder" => "yes",
  "remove_folder_path" => array( "install", "contrib"),

  "need_admin_email" => "no",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "wordpress",

  "has_install_script" => "no",
  "install_script_url" => "",

  "unpack_type" => "tar.gz",
  "file" => "wordpress.tar.gz",
  "resulting_dir" => "wordpress",
  "renamedir_to" => "wordpress");

?>
