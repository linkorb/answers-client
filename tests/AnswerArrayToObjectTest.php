<?php

use Linkorb\AnswersClient\Answer;
use Linkorb\AnswersClient\Client;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Client.php';
require_once __DIR__ . '/../src/Answer.php';

final class AnswerArrayToObjectTest extends TestCase
{
    public function testGetPopulatesAnswerFromResponse(): void
    {
        $answer = $this->answerForResponse([
            'id' => 42,
            'answer' => 'A response',
            'username' => 'ada',
            'question_id' => 7,
            'created_at' => '2024-01-01',
            'is_deleted' => false,
            'updated_at' => '2024-01-02',
        ]);

        $answer->get(42);

        self::assertSame(42, $answer->getId());
        self::assertSame('A response', $answer->getAnswer());
        self::assertSame('ada', $answer->getUsername());
        self::assertSame(7, $answer->getQuestionId());
        self::assertSame('2024-01-01', $answer->getCreatedAt());
        self::assertFalse($answer->getIsDeleted());
        self::assertSame('2024-01-02', $answer->getUpdatedAt());
    }

    public function testGetUsesStringNullForMissingOrNullFields(): void
    {
        $answer = $this->answerForResponse(['id' => null]);

        $answer->get(42);

        self::assertSame('null', $answer->getId());
        self::assertSame('null', $answer->getAnswer());
        self::assertSame('null', $answer->getUsername());
        self::assertSame('null', $answer->getQuestionId());
        self::assertSame('null', $answer->getCreatedAt());
        self::assertSame('null', $answer->getIsDeleted());
        self::assertSame('null', $answer->getUpdatedAt());
    }

    private function answerForResponse(array $data): Answer
    {
        $http = new class($data) {
            private $data;

            public function __construct(array $data)
            {
                $this->data = $data;
            }

            public function request($method, $path)
            {
                return new class($this->data) {
                    private $data;

                    public function __construct(array $data)
                    {
                        $this->data = $data;
                    }

                    public function getBody()
                    {
                        return json_encode($this->data);
                    }
                };
            }
        };

        $client = $this->createStub(Client::class);
        $client->method('get')->willReturn($http);

        return new Answer($client);
    }
}
