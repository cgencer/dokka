<?php

$databases = array (
  'default' => 
  array (
    'default' => 
    array (
      'database' => 'sites/default/files/.drupal7.sqlite',
      'driver' => 'sqlite',
      'prefix' => '',
    ),
  ),
);

$update_free_access = FALSE;

$drupal_hash_salt = '7RzoencM-8mRs-tZuwCBqRjDa1cFBKdUmYNLI01zqcg';

# $base_url = 'http://www.example.com';  // NO trailing slash!


ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

ini_set('session.gc_maxlifetime', 200000);

ini_set('session.cookie_lifetime', 2000000);

# $cookie_domain = '.example.com';


# $conf['site_name'] = 'My Drupal site';
# $conf['theme_default'] = 'garland';
# $conf['anonymous'] = 'Visitor';
# $conf['maintenance_theme'] = 'bartik';


# $conf['css_gzip_compression'] = FALSE;
# $conf['js_gzip_compression'] = FALSE;


# $conf['blocked_ips'] = array(
#   'a.b.c.d',
# );

$conf['404_fast_paths_exclude'] = '/\/(?:styles)|(?:system\/files)\//';
$conf['404_fast_paths'] = '/\.(?:txt|png|gif|jpe?g|css|js|ico|swf|flv|cgi|bat|pl|dll|exe|asp)$/i';
$conf['404_fast_html'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL "@path" was not found on this server.</p></body></html>';

/**
 * Trusted host configuration.
 *
 * Drupal can attempt to prevent HTTP Host header spoofing.
 *
 * To enable the trusted host mechanism, you enable your allowable hosts in
 * $conf['trusted_host_patterns']. This should be an array of regular expression
 * patterns, without delimiters, representing the hosts you would like to allow.
 *
 * For example, this code will allow the site to only run from www.example.com.
 *
 * @code
 * $conf['trusted_host_patterns'] = array(
 *   '^www\.example\.com$',
 * );
 * @endcode
 *
 * If you are running multisite, or if you are running your site from different
 * domain names (for example, you don't redirect http://www.example.com to
 * http://example.com), you should specify all of the host patterns that are
 * allowed by your site.
 *
 * For example, this code will allow the site to run off of all variants of
 * example.com and example.org, with all subdomains included.
 *
 * @code
 * $conf['trusted_host_patterns'] = array(
 *   '^example\.com$',
 *   '^.+\.example\.com$',
 *   '^example\.org',
 *   '^.+\.example\.org',
 * );
 * @endcode
 */

/**
 * Theme debugging:
 *
 * When debugging is enabled:
 * - The markup of each template is surrounded by HTML comments that contain
 *   theming information, such as template file name suggestions.
 * - Note that this debugging markup will cause automated tests that directly
 *   check rendered HTML to fail.
 *
 * For more information about debugging theme templates, see
 * https://www.drupal.org/node/223440#theme-debug.
 *
 * Not recommended in production environments.
 *
 * Remove the leading hash sign to enable.
 */
# $conf['theme_debug'] = TRUE;

/**
 * CSS identifier double underscores allowance:
 *
 * To allow CSS identifiers to contain double underscores (.example__selector)
 * for Drupal's BEM-style naming standards, uncomment the line below.
 * Note that if you change this value in existing sites, existing page styles
 * may be broken.
 *
 * @see drupal_clean_css_identifier()
 */
# $conf['allow_css_double_underscores'] = TRUE;

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see file_scan_directory()
 */
$conf['file_scan_ignore_directories'] = array(
  'node_modules',
  'bower_components',
);

/**
 * Logging of user flood control events.
 *
 * Drupal's user module will place a temporary block on a given IP address or
 * user account if there are excessive failed login attempts. By default these
 * flood control events will be logged. This can be useful for identifying
 * brute force login attacks. Set this variable to FALSE to disable logging, for
 * example if you are using the dblog module and want to avoid database writes.
 *
 * @see user_login_final_validate()
 * @see user_user_flood_control()
 */
# $conf['log_user_flood_control'] = FALSE;

/**
 * Opt out of variable_initialize() locking optimization.
 *
 * After lengthy discussion in https://www.drupal.org/node/973436 a change was
 * made in variable_initialize() in order to avoid excessive waiting under
 * certain conditions. Set this variable to TRUE in order to opt out of this
 * optimization and revert to the original behaviour.
 */
# $conf['variable_initialize_wait_for_lock'] = FALSE;

/**
 * Opt in to field_sql_storage_field_storage_write() optimization.
 *
 * To reduce unnecessary writes field_sql_storage_field_storage_write() can skip
 * fields where values have apparently not changed. To opt in to this
 * optimization, set this variable to TRUE.
 */
$conf['field_sql_storage_skip_writing_unchanged_fields'] = TRUE;

/**
 * Use site name as display-name in outgoing mail.
 *
 * Drupal can use the site name (i.e. the value of the site_name variable) as
 * the display-name when sending e-mail. For example this would mean the sender
 * might be "Acme Website" <acme@example.com> as opposed to just the e-mail
 * address alone. In order to avoid disruption this is not enabled by default
 * for existing sites. The feature can be enabled by setting this variable to
 * TRUE.
 *
 * @see https://tools.ietf.org/html/rfc2822
 * @see drupal_mail()
 */
$conf['mail_display_name_site_name'] = TRUE;

/**
 * SameSite cookie attribute.
 *
 * This variable can be used to set a value for the SameSite cookie attribute.
 *
 * Versions of PHP before 7.3 have no native support for the SameSite attribute
 * so it is emulated.
 *
 * The session.cookie-samesite setting in PHP 7.3 and later will be overridden
 * by this variable for Drupal session cookies, and any other cookies managed
 * with drupal_setcookie().
 *
 * Setting this variable to FALSE disables the SameSite attribute on cookies.
 *
 * @see drupal_setcookie()
 * @see drupal_session_start()
 * @see https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite
 */
# $conf['samesite_cookie_value'] = 'None';

/**
 * Retain legacy has_js cookie.
 *
 * Older releases of Drupal set a has_js cookie with a boolean value which
 * server-side code can use to determine whether JavaScript is available.
 *
 * This functionality can be re-enabled by setting this variable to TRUE.
 */
# $conf['set_has_js_cookie'] = FALSE;

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
# $conf['skip_permissions_hardening'] = TRUE;

/**
 * Additional public file schemes:
 *
 * Public schemes are URI schemes that allow download access to all users for
 * all files within that scheme.
 *
 * The "public" scheme is always public, and the "private" scheme is always
 * private, but other schemes, such as "https", "s3", "example", or others,
 * can be either public or private depending on the site. By default, they're
 * private, and access to individual files is controlled via
 * hook_file_download().
 *
 * Typically, if a scheme should be public, a module makes it public by
 * implementing hook_file_download(), and granting access to all users for all
 * files. This could be either the same module that provides the stream wrapper
 * for the scheme, or a different module that decides to make the scheme
 * public. However, in cases where a site needs to make a scheme public, but
 * is unable to add code in a module to do so, the scheme may be added to this
 * variable, the result of which is that system_file_download() grants public
 * access to all files within that scheme.
 */
# $conf['file_additional_public_schemes'] = array('example');

/**
 * Sensitive request headers in drupal_http_request() when following a redirect.
 *
 * By default drupal_http_request() will strip sensitive request headers when
 * following a redirect if the redirect location has a different http host to
 * the original request, or if the scheme downgrades from https to http.
 *
 * These variables allow opting out of this behaviour. Careful consideration of
 * the security implications of opting out is recommended.
 *
 * @see _drupal_should_strip_sensitive_headers_on_http_redirect()
 * @see drupal_http_request()
 */
# $conf['drupal_http_request_strip_sensitive_headers_on_host_change'] = TRUE;
# $conf['drupal_http_request_strip_sensitive_headers_on_https_downgrade'] = TRUE;

/**
 * Cron lock expiration timeout:
 *
 * Each time Drupal's cron is executed, it acquires a cron lock. Older releases
 * of Drupal set the default cron lock expiration timeout to 240 seconds. This
 * duration was considered short, because it often caused concurrent cron runs
 * especially on busy sites heavily utilizing cron.
 *
 * Use this variable to set a custom cron lock expiration timeout (float).
 */
# $conf['cron_lock_expiration_timeout'] = 900.0;

/**
 * File schemes whose paths should not be normalized:
 *
 * Normally, Drupal normalizes '/./' and '/../' segments in file URIs in order
 * to prevent unintended file access. For example, 'private://css/../image.png'
 * is normalized to 'private://image.png' before checking access to the file.
 *
 * On Windows, Drupal also replaces '\' with '/' in URIs for the local
 * filesystem.
 *
 * If file URIs with one or more scheme should not be normalized like this, then
 * list the schemes here. For example, if 'porcelain://china/./plate.png' should
 * not be normalized to 'porcelain://china/plate.png', then add 'porcelain' to
 * this array. In this case, make sure that the module providing the 'porcelain'
 * scheme does not allow unintended file access when using '/../' to move up the
 * directory tree.
 */
# $conf['file_sa_core_2023_005_schemes'] = array('porcelain');

/**
 * Configuration for phpinfo() admin status report.
 *
 * Drupal's admin UI includes a report at admin/reports/status/php which shows
 * the output of phpinfo(). The full output can contain sensitive information
 * so by default Drupal removes some sections.
 *
 * This behaviour can be configured by setting this variable to a different
 * value corresponding to the flags parameter of phpinfo().
 *
 * If you need to expose more information in the report - for example to debug a
 * problem - consider doing so temporarily.
 *
 * @see https://www.php.net/manual/function.phpinfo.php
 */
# $conf['sa_core_2023_004_phpinfo_flags'] = ~(INFO_VARIABLES | INFO_ENVIRONMENT);

/**
 * Session IDs are hashed by default before being stored in the database. This
 * reduces the risk of sessions being hijacked if the database is compromised.
 *
 * This variable allows opting out of this security improvement.
 */
# $conf['do_not_hash_session_ids'] = TRUE;

/**
 * URL for update information.
 *
 * Drupal's update module can check for the availability of updates. By default
 * https is used for this check. If for any reason your site cannot use https
 * you can change this variable to fallback to http. It is recommended to fix
 * the problem with SSL/TLS rather than use http which provides no security.
 */
# $conf['update_fetch_url'] = 'https://updates.drupal.org/release-history';

/**
 * Opt out of double submit protection.
 *
 * By default Drupal will prevent consecutive form submissions of identical form
 * values. Set this variable to FALSE in order to opt out of this
 * prevention and revert to the original behaviour.
 */
# $conf['javascript_use_double_submit_protection'] = FALSE;

/**
 * Cron logging.
 *
 * Optionally drupal_cron_run() can log each execution of hook_cron() together
 * with the execution time. This is disabled by default to reduce log noise. Set
 * this variable to TRUE in order to enable the additional logging.
 */
# $conf['cron_logging_enabled'] = TRUE;
