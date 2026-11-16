<?php

use Linkorb\AnswersClient\Client;
use Linkorb\AnswersClient\Question;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Client.php';
require_once __DIR__ . '/../src/Question.php';

final class QuestionArrayToObjectTest extends TestCase
{
    public function testMapsEveryProvidedField(): void
    {
        $question = new Question(new Client('https://example.test', 'user', 'password'));

        $question->arrayToObject([
            'id' => 123,
            'question' => 'How does it work?',
            'username' => 'alice',
            'description' => 'Please explain',
            'topic_id' => 45,
            'created_at' => '2024-01-02',
            'is_deleted' => false,
            'updated_at' => '2024-01-03',
        ]);

        self::assertSame(123, $question->getId());
        self::assertSame('How does it work?', $question->getQuestion());
        self::assertSame('alice', $question->getUsername());
        self::assertSame('Please explain', $question->getDescription());
        self::assertSame(45, $question->getTopicId());
        self::assertSame('2024-01-02', $question->getCreatedAt());
        self::assertFalse($question->getIsDeleted());
        self::assertSame('2024-01-03', $question->getUpdatedAt());
    }

    public function testMissingAndNullFieldsUseLiteralNullString(): void
    {
        $question = new Question(new Client('https://example.test', 'user', 'password'));
        $question->setId(123)->setQuestion('old question')->setUsername('alice')
            ->setDescription('old description')->setTopicId(45)->setCreatedAt('old date')
            ->setIsDeleted(true)->setUpdatedAt('old date');

        $question->arrayToObject(['id' => null]);

        self::assertSame('null', $question->getId());
        self::assertSame('null', $question->getQuestion());
        self::assertSame('null', $question->getUsername());
        self::assertSame('null', $question->getDescription());
        self::assertSame('null', $question->getTopicId());
        self::assertSame('null', $question->getCreatedAt());
        self::assertSame('null', $question->getIsDeleted());
        self::assertSame('null', $question->getUpdatedAt());
    }
}
