<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class CarTest extends ApiTestCase
{
    public function testCreateCarSuccess(): void
    {
        static::createClient()->request('POST', '/car', [
            'json' => [
                'brand' => 'Test_BMW',
                'model' => 'X33',
                'color' => 'red',
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/Car',
            '@type' => 'Car',
            'brand' => 'Test_BMW',
            'model' => 'X33',
            'color' => 'red'
        ]);
    }
}
