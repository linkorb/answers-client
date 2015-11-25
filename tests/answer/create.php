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

// Create Answer 
$answer = new Answer( $client );
$answer->setQuestionId( 16 );
$answer->setAnswer( 'this is some answer 2' );

try {
	$answer->create(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>