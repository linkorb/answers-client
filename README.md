Answers Client
==============

Create questions for Answers

## Installation
```
composer require linkorb/answers-client
```

## Example
```php
use Linkorb\AnswersClient\Client as AnswersClient;
use Linkorb\AnswersClient\Question as AnswersQuestion;

// get the client
$client = new TicketBoxClient(
    < Answers API URL >,
    < Answers Username >,
    < Answers Password >'
);

// Create Question 
$answer = new AnswersQuestion();
$answer->setQuestion('this is new question?');
$answer->setDescription('this is new question description');
$answer->setTopicId('1');
$answer->create( $client ); // pass client


```