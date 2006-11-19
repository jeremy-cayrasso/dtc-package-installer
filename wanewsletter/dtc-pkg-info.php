<?php

$pkg_info = array(
  "name" => "WANewsletter",
  "version" => "2.3.0",
  "short_desc" => "WANewsletter is a mass mailing tool",
  "long_desc" => "Wanewsletter est un script de newsletter complet programmé en PHP
  et utilisant une base de données.
L'installation a été simplifiée au maximum pour permettre une mise en production rapide.
L'administration dispose de puissantes fonctionnalités et vous permet d'intervenir sur
tous les aspects de vos listes de diffusion. De plus, Wanewsletter est disponible dans
plusieurs langues. 

Enfin, le script fonctionne aussi bien sur les bases de données MySQL (3.23.x/4.x/5.x)
que PostgreSQL ou encore SQLite (version 2 ou 3).",
  "unpack_disk_usage" => "1356274",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "setup/install.php",

  "remove_folder" => "no",
  "remove_folder_path" => array(),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "wanewsletter",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "wanewsletter-2.3.0.tar.gz",
  "resulting_dir" => "wanewsletter",
  "renamedir_to" => "wanewsletter");

?>
