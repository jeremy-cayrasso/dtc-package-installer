<?php

$pkg_info = array(
  "name" => "Vtiger",
  "version" => "5.0.2",
  "short_desc" => "A fully featured Customer Relationship Management system",
  "long_desc" => "Vtiger is a high powered, fully scalable, and highly customizable
  Open Source Customer Relationship Management system. Vtiger has a user-friendly interface, simple
  and straightforward administration panel, and helpful FAQ. Based on the powerful
  PHP server language and MySQL database server,
  Vtiger is the ideal free community solution for managing customer relationships.",
  "unpack_disk_usage" => "19924907",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "install.php",

  "remove_folder" => "no",

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "crm",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "vtigercrm-5.0.2.tar.gz",
  "resulting_dir" => "vtigercrm",
  "renamedir_to" => "crm");

?>
