<?php

use Linkorb\AnswersClient\Client;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Client.php';

final class ClientTest extends TestCase
{
    public function testUsernameIsAvailableAfterConstruction(): void
    {
        $client = new Client('https://example.test', 'ada', 'secret');

        self::assertSame('ada', $client->getUsername());
    }
}
