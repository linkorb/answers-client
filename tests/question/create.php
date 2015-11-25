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

// Create Question 
$question = new Question( $client );
$question->setQuestion('asking question 1?');
$question->setDescription('wow question 1');
$question->setTopicId('1');

try {
	$question->create(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

$question->setQuestion('this is update question?');

try {
	$question->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>