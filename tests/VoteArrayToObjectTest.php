<?php

use Linkorb\AnswersClient\Client;
use Linkorb\AnswersClient\Vote;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Client.php';
require_once __DIR__ . '/../src/Vote.php';

final class VoteArrayToObjectTest extends TestCase
{
    public function testItMapsProvidedFieldsIncludingFalsyValues(): void
    {
        $vote = new Vote($this->createStub(Client::class));

        $vote->arrayToObject([
            'id' => 0,
            'parent_id' => 42,
            'parent_type' => 'answer',
            'username' => '',
            'created_at' => '2024-01-01',
            'updated_at' => false,
        ]);

        self::assertSame(0, $vote->getId());
        self::assertSame(42, $vote->getParentId());
        self::assertSame('answer', $vote->getParentType());
        self::assertSame('', $vote->getUsername());
        self::assertSame('2024-01-01', $vote->getCreatedAt());
        self::assertFalse($vote->getUpdatedAt());
    }

    public function testItReplacesMissingAndNullFieldsWithStringNull(): void
    {
        $vote = new Vote($this->createStub(Client::class));
        $vote->arrayToObject([
            'id' => 1,
            'parent_id' => 2,
            'parent_type' => 'question',
            'username' => 'ada',
            'created_at' => 'before',
            'updated_at' => 'after',
        ]);

        $vote->arrayToObject(['id' => null]);

        self::assertSame('null ', $vote->getId());
        self::assertSame('null ', $vote->getParentId());
        self::assertSame('null ', $vote->getParentType());
        self::assertSame('null ', $vote->getUsername());
        self::assertSame('null ', $vote->getCreatedAt());
        self::assertSame('null ', $vote->getUpdatedAt());
    }
}
