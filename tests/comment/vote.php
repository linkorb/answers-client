<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Comment as Comment;

// get the client
$client = new Client(
    'http://answers.dev/api/v1/',
    'kishanio',
    '11121992'
);

$comment = new Comment( $client );
$comment->get(5);

try {
	$comment->vote(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

?>