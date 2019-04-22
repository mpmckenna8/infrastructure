<?php
{{ ansible_managed | comment }}
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Enable to put site in maintence.
# $wgReadOnly = ( PHP_SAPI === 'cli' ) ? false : 'This wiki is currently being upgraded to a newer software version. Please check back in a couple of hours.';

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Noisebridge";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgScript = "$wgScriptPath/index.php";
$wgRedirectScript = "$wgScriptPath/index.php";
$wgArticlePath = "/wiki/$1";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://www.{{ mediawiki.domain }}";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "/img/nb-logo-131.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "webmaster@noisebridge.net";
$wgPasswordSender = "do-not-reply@noisebridge.net";

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "localhost";
$wgDBname = "{{ mediawiki.database }}";
$wgDBuser = "{{ mediawiki.database_username }}";
$wgDBpassword = "{{ mysql_users|selectattr('name', 'equalto', 'wiki')|map(attribute='password')|join('')}}";

# MySQL specific settings
$wgDBprefix = "noisebridge_mediawiki";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_MEMCACHED;
$wgMessageCacheType = CACHE_MEMCACHED;
$wgParserCacheType = CACHE_MEMCACHED;
$wgMemCachedServers = array( "127.0.0.1:11211" );
$wgEnableSidebarCache = true;
$wgSessionsInObjectCache = true; # optional
$wgSessionCacheType = CACHE_MEMCACHED; # optional

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgUseImageResize = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "{{ mediawiki_secret_key }}";

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "{{ mediawiki_upgrade_key }}";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-nc-sa/4.0/";
$wgRightsText = "Creative Commons Attribution-NonCommercial-ShareAlike";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-nc-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );


# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtensions('ExtensionName');
# to LocalSettings.php. Check specific extension documentation for more details.
# The following extensions were automatically enabled:
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/ReCaptchaNoCaptcha' ]);
wfLoadExtension( 'mwGoogleSheet' );

# End of automatically generated settings.
# Add more configuration options below.

$wgUseGzip = true;
$wgUseFileCache = false;
$wgFileCacheDirectory = '/var/cache/mediawiki/';

#
# Configure ReCaptcha
$wgCaptchaClass = 'ReCaptchaNoCaptcha';
$wgReCaptchaSiteKey = '{{ mediawiki_recaptcha_site_key }}';
$wgReCaptchaSecretKey = '{{ mediawiki_recaptcha_secret_key }}';
$wgReCaptchaSendRemoteIP = false;
$ceAllowConfirmedEmail = true;

# Require CAPTCHA for edit, create, new account.
$wgCaptchaTriggers['edit'] = true;
$wgCaptchaTriggers['create'] = true;
$wgCaptchaTriggers['addurl'] = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin'] = true;

$wgGroupPermissions['*']['createpage'] = false;
$wgGroupPermissions['user']['createpage'] = false;
$wgGroupPermissions['*']['createtalk'] = false;
$wgGroupPermissions['user']['createtalk'] = false;
$wgGroupPermissions['autoconfirmed' ]['createpage'] = true;
$wgGroupPermissions['autoconfirmed' ]['createtalk'] = true;
$wgGroupPermissions['*']['move'] = false;
$wgGroupPermissions['user']['move'] = false;
$wgGroupPermissions['autoconfirmed' ]['move'] = true;
$wgGroupPermissions['*']['upload'] = false;
$wgGroupPermissions['user']['upload'] = false;
$wgGroupPermissions['autoconfirmed' ]['upload'] = true;

$wgGroupPermissions['*'             ]['skipcaptcha'] = false;
$wgGroupPermissions['user'          ]['skipcaptcha'] = false;
$wgGroupPermissions['autoconfirmed' ]['skipcaptcha'] = true;
$wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
$wgGroupPermissions['bot'           ]['skipcaptcha'] = true; // registered bots
$wgGroupPermissions['sysop'         ]['skipcaptcha'] = true;


$wgGroupPermissions['confirmed' ] = $wgGroupPermissions['autoconfirmed' ];

$wgAutoConfirmCount = 5;
$wgAutoConfirmAge = 86400*3; // three days

$wgAutopromote = array(
	"autoconfirmed" => array( "&",
		array( APCOND_EDITCOUNT, &$wgAutoConfirmCount ),
		array( APCOND_AGE, &$wgAutoConfirmAge ),
		APCOND_EMAILCONFIRMED
	),
);

$wgFileExtensions[] = 'pdf';
$wgFileExtensions[] = 'svg';
