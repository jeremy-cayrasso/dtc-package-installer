<?php

$pkg_info = array(
  "name" => "Drupal",
  "version" => "5.0",
  "short_desc" => "Drupal is one of more used CMS on the world.",
  "long_desc" => "Drupal is software that allows an individual or a community of users to easily publish, manage and organize a great variety of content on a website. Tens of thousands of people and organizations have used Drupal to set up scores of different kinds of web sites.",
  "unpack_disk_usage" => "2248095",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "install/install.php",

  "remove_folder" => "yes",
  "remove_folder_path" => array( "install", "contrib"),

  "need_admin_email" => "no",
  "need_admin_login" => "no",
  "need_admin_pass" => "no",

  "can_select_directory" => "yes",
  "directory" => "drupal",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "drupal-5.0.tar.gz",
  "resulting_dir" => "drupal-5.0",
  "renamedir_to" => "drupal");

?>
