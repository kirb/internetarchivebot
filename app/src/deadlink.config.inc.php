<?php
//Create a file in the same directory as this on named deadlink.config.local.inc.php and copy the stuff below.
//Activate this to run the bot on a specific page(s) for debugging purposes.
$debug = false;
$limitedRun = false;
$disableConfigUpdate = false;
$debugPage = [ 'title' => "", 'pageid' => 0 ];
$debugStyle = 20;   //Use an int to run through a limited amount of articles.  Use "test" to run the test pages.
// Set to true to disable writing to database and editing wiki (dry run)
// And write what would be edited on the page to stdout
$testMode = false;

// This is easier on Wayback Machine, because it can queue page saves until a later time when things
// aren't as busy. However, the bot will not know whether the save was successful until it comes
// across the same link again in a future run.
$delayedAvailability = false;

//Progress memory file.  This allows the bot to resume where it left off in the event of a shutdown or a crash.
$memoryFile = "";
//Wiki connection setup.  Keys are grouped in sets of 3, and given a name to be referred to by the wiki setup parameters.
$oauthKeys = [
	'default' => [
		'bot'         => [
			'consumerkey' => "", 'consumersecret' => "", 'accesstoken' => "", 'accesssecret' => "", 'username' => ""
		],
		'webappfull'  => [ 'consumerkey' => "", 'consumersecret' => "" ],
		'webappbasic' => [ 'consumerkey' => "", 'consumersecret' => "" ]
	]
];
//These are required to initiate a save page request.
$waybackKeys = [
	'accesstoken' => "", 'accesssecret' => ""
];

//Wikipedia DB setup
$wikiDBs = [
	'default' => [
		'host'      => "", 'port' => "", 'user' => "", 'pass' => "", 'db' => "", 'revisiontable' => "",
		'texttable' => "", 'pagetable' => "", 'ssl' => false
	]
];

//DB connection setup
$host = "";
$port = "";
$user = "";
$pass = "";
$db = "";
$secondaryDB = "";
$ssl = false;

// Configure metrics driver to use and pass configuration values to the driver
$MetricsOptions = [
	'driver' => 'Dummy',
	'configuration' => []
];
$EmailOptions = [
	'driver' => 'Dummy',
	'configuration' => []
];

//Offload tables that can get large into a secondary DBs
$offloadDBs = [];

//Sentry keys to log exceptions to a Sentry endpoint
$sentryDSN = "";
$sentryCSP = "";

//Path to store chromium socket data
$CIDChromiumSocket = sys_get_temp_dir();

//Webapp variables
//These are defaults for the web interface portion of the bot.

//Directory path to the public html directory.
$publicHTMLPath = "html/";

$disableInterface = false;
$interfaceMaster = [
	'inheritsgroups' => [ 'root' ],
	'inheritsflags'  => [ 'defineusergroups', 'configurewiki' ],
	'assigngroups'   => [ 'root' ],
	'assignflags'    => [ 'defineusergroups', 'configurewiki' ],
	'removegroups'   => [ 'root' ],
	'removeflags'    => [ 'defineusergroups', 'configurewiki' ],
	'members'        => []
];
