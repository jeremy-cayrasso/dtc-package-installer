<?php

$pkg_info = array(
  "name" => "Joomla! CMS",
  "version" => "1.5.9",
  "short_desc" => "The worlds most popular content manage system to easily manage and update your website",
  "long_desc" => "Joomla is an award-winning content management system (CMS), which enables you to build Web
sites and powerful online applications. Many aspects, including its ease-of-use and extensibility,
have made Joomla the most popular Web site software available. Best of all, Joomla is an open
source solution that is freely available to everyone.",
  "unpack_disk_usage" => "16470478",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "yes",
  "post_script_url" => "installation/index.php",

  "remove_folder" => "yes",
  "remove_folder_path" => array("installation"),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "joomla159",//by defaul package comes without a folder - need to be sure of that!

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "Joomla_1.5.9-Stable-Full_Package.tar.gz",
  "resulting_dir" => "joomla159",
  "renamedir_to" => "joomla");

?>