<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Answer as Answer;

// get the client
$client = new Client(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

$answer = new Answer( $client );
$answer->get(57);

try {
	$answer->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 
?>