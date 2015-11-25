# Answers Client

PHP client library for [Answers](https://github.com/linkorb/answers) application.

## Installation

```
composer require linkorb/answers-client
```

## Example

Client  

```php
require_once __DIR__ . '/../../vendor/autoload.php'; 

use Linkorb\AnswersClient\Client as Client;
use Linkorb\AnswersClient\Question as Question;

// get the client
$client = new Client(
    '<Host>',
    '<Username>',
    '<Password>'
);
```

Question 

```php

// Create Question 
$question = new Question( $client );
$question->setQuestion(<Question>);
$question->setDescription(<Description>);
$question->setTopicId(<topic id>);

try {
	$question->create(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

$question->setQuestion(<question>);

try {
	$question->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Get Question 
$question = new Question( $client );
$question->get(<Question id>);

$answers = $question->getAnswers();
var_dump($answers);

$comments = $question->getComments();
var_dump($comments);

$votes = $question->getVotes();
var_dump($votes);

// Update question
$question = new Question( $client );
$question->get(<Question id>);

$question->setQuestion(<Question>);
$question->setDescription(<Description>);

try {
	$question->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Delete question
$question = new Question( $client );
$question->get(<Question Id>);

try {
	$question->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

//Comment
$question = new Question( $client );
$question->get(<Question id>);

try {
	$question->comment(<Comment>); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Vote
$question = new Question( $client );
$question->get(<Question id>);

try {
	$question->vote(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

```

Answer 

```php
// Create Answer 
$answer = new Answer( $client );
$answer->setQuestionId( <Question id> );
$answer->setAnswer( <Answer id> );

try {
	$answer->create(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Get Answer
$answer = new Answer( $client );
$answer->get( <Answer id> );

$comments = $answer->getComments();
var_dump($comments);

$votes = $answer->getVotes();
var_dump($votes);

// Update Answer
$answer = new Answer( $client );
$answer->get( <Answer id> );

$answer->setAnswer(<Answer>);

try {
	$answer->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Delete Answer
$answer = new Answer( $client );
$answer->get(<Answer id>);

try {
	$answer->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Commnent Answer
$answer = new Answer( $client );
$answer->get(<Answer Id>);

try {
	$answer->comment(<Comment>); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Vote Answer
$answer = new Answer( $client );
$answer->get(<Answer Id>);

try {
	$answer->vote(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 
```

Comment 

```php
// Get comment
$comment = new Comment( $client );
$comment->get(<Comment Id>);

$votes = $comment->getVotes();
var_dump($votes);

// Update comment
$answer = new Answer( $client );
$answer->get(<Answer id>);

$answer->setAnswer(<Answer>);

try {
	$answer->update(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Delete comment
$comment = new Comment( $client );
$comment->get(<Comment id>);

try {
	$comment->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

// Vote comment
$comment = new Comment( $client );
$comment->get(<Comment id>);

try {
	$comment->vote(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 

```

Vote

```php
// Delete comment
$vote = new Vote( $client );
$vote->get(<Vote id>);

try {
	$vote->delete(); 
} catch( Exception $e ) {
	echo $e->getMessage();
} 
```

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [engineering.linkorb.com](http://engineering.linkorb.com).

Btw, we're hiring!
