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

// Update comment
$answer = new Answer( $client );
$answer->get(57);

$answer->setAnswer('this is update answer for id 2?');

try {
	$answer->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>