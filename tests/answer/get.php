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
$answer->get(58);

$comments = $answer->getComments();
var_dump($comments);

$votes = $answer->getVotes();
var_dump($votes);


?>