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
$question->get(16);

try {
	$question->comment('this is some comment'); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>