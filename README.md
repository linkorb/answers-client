# Answers Client

PHP client library for [Answers](https://github.com/linkorb/answers) application.

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

=======
## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [engineering.linkorb.com](http://engineering.linkorb.com).

Btw, we're hiring!
