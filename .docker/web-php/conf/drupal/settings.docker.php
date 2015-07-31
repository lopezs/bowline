<?php
/**
 * @file
 * Docker specific configuration.
 */

// Drupal 6 connection string.
$db_url = 'mysql://dbuser:dbpass@dbhost/drupal';
// Drupal 7 db settings.
$databases['default']['default'] = array(
  'driver' => 'mysql',
  'database' => 'drupal',
  'username' => 'dbuser',
  'password' => 'dbpass',
  'host' => 'dbhost',
);

/**
 * Ensure we know when we are running on HTTPS.
 */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $_SERVER['HTTPS'] = 'on';
}

// Set the host to the proxied container IP.
// $base_url = 'http://projectname';
// Set file system paths.
$conf['file_private_path'] = '/var/www/files-private';
$conf['file_public_path'] = 'sites/default/files';
$conf['file_temporary_path'] = '/tmp';

// Solr
$conf['apachesolr_environments']['solr']['url'] = 'http://solrhost:8983/solr';
$conf['apachesolr_attachments_tika_path'] = '/var/www/docroot/tika';
