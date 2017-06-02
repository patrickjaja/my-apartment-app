<?php
require __DIR__ . '/db.inc.php';
require __DIR__ . '/vendor/autoload.php';
$GLOBALS["_CONFIG"]=json_decode( file_get_contents( __DIR__ . '/api.config.json' ), true );
require __DIR__ . '/lib/class.out.php';
require __DIR__ . '/lib/class.session.php';
require __DIR__ . '/lib/class.api.php';
require __DIR__ . '/public/class.token.php';
