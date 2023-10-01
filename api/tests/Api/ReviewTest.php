<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ReviewTest extends ApiTestCase
{
    public function testCreateReviewSuccess(): void
    {
        static::createClient()->request('POST', '/review', [
            'json' => [
                'body' => 'this is a test review',
                'rating' => '2',
                'car' => '/cars/1',
            ],
            'headers' => [
                'Content-Type' => 'application/ld+json',
            ],
        ]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/Review',
            '@type' => 'Review',
            'body' => 'this is a test review',
            'rating' => '2',
            'car' => '/cars/1',
        ]);
    }
}
