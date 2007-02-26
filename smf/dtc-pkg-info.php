<?php

$pkg_info = array(
  "name" => "SMF",
  "version" => "1.1.2",
  "short_desc" => "A fully featured Forum offering",
  "long_desc" => "CMF is a high powered, fully scalable, and highly customizable
  Open Source forum system. CMF has a user-friendly interface, simple
  and straight forward administration panel, and helpful FAQ. Based on the powerful
  PHP server language and your choice of MySQL, MS-SQL, PostgreSQL or Access/ODBC
  database servers, CMF is the ideal free community solution to build your online community.",
  "unpack_disk_usage" => "5438330",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "install.php",

  "remove_folder" => "no",

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "cms",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.bz2",
  "file" => "smf_1-1-2_install.tar.bz2",
  "resulting_dir" => "smf",
  "renamedir_to" => "smf");

?>
