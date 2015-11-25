<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Question as Question;

// get the client
$client = new Client(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

$question = new Question( $client );
$question->get(2);

try {
	$question->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>