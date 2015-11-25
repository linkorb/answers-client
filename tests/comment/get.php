<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Question as Comment;

// get the client
$client = new Client(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

$comment = new Comment( $client );
$comment->get(6);

$votes = $comment->getVotes();
var_dump($votes);

?>