<?php
//system('tar -cvf WP-Backup11918.tar wp-*.php wp-content/ wp-includes/ wp-admin/ .htaccess index.php layout-styles.css xmlrpc.php');
system('mysqldump --opt -u sellerino -pPhysioluge2! PhysiotechDB > PhysiotechDB11918.sql');
?>
