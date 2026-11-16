<?php

use Linkorb\AnswersClient\Client;
use Linkorb\AnswersClient\Comment;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Client.php';
require_once __DIR__ . '/../src/Comment.php';

final class CommentArrayToObjectTest extends TestCase
{
    public function testMapsAllFieldsToTheirAccessors(): void
    {
        $comment = new Comment(new Client('https://example.test', 'user', 'password'));

        $comment->arrayToObject([
            'id' => 42,
            'comment' => 'A comment',
            'username' => 'alice',
            'parent_id' => 7,
            'parent_type' => 'answer',
            'created_at' => '2026-01-01',
            'is_deleted' => false,
            'updated_at' => '2026-01-02',
        ]);

        self::assertSame(42, $comment->getId());
        self::assertSame('A comment', $comment->getComment());
        self::assertSame('alice', $comment->getUsername());
        self::assertSame(7, $comment->getParentId());
        self::assertSame('answer', $comment->getParentType());
        self::assertSame('2026-01-01', $comment->getCreatedAt());
        self::assertFalse($comment->getIsDeleted());
        self::assertSame('2026-01-02', $comment->getUpdatedAt());
    }

    public function testMissingAndNullFieldsUseLiteralNullString(): void
    {
        $comment = new Comment(new Client('https://example.test', 'user', 'password'));
        $comment->arrayToObject(['id' => null]);

        self::assertSame('null', $comment->getId());
        self::assertSame('null', $comment->getComment());
        self::assertSame('null', $comment->getUsername());
        self::assertSame('null', $comment->getParentId());
        self::assertSame('null', $comment->getParentType());
        self::assertSame('null', $comment->getCreatedAt());
        self::assertSame('null', $comment->getIsDeleted());
        self::assertSame('null', $comment->getUpdatedAt());
    }

    public function testFalseyValuesArePreserved(): void
    {
        $comment = new Comment(new Client('https://example.test', 'user', 'password'));
        $comment->arrayToObject(['id' => 0, 'comment' => '', 'is_deleted' => false]);

        self::assertSame(0, $comment->getId());
        self::assertSame('', $comment->getComment());
        self::assertFalse($comment->getIsDeleted());
    }
}
