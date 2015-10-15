<?php

require_once __DIR__ . '/../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as AnswersClient;
use Linkorb\AnswersClient\Question as AnswersQuestion;

// get the client
$client = new AnswersClient(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

// Create Question 
$answer = new AnswersQuestion();
$answer->setQuestion('this is new question?');
$answer->setDescription('this is new question description');
$answer->setTopicId('1');
$answer->create( $client ); // pass client



?>