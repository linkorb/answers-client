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
$question->get(8);

$answers = $question->getAnswers();
var_dump($answers);

$comments = $question->getComments();
var_dump($comments);

$votes = $question->getVotes();
var_dump($votes);

?>