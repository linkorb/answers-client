<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Vote as Vote;

// get the client
$client = new Client(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

$vote = new Vote( $client );
$vote->get(1);

try {
	$vote->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 
?>