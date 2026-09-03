<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiQueueListTest extends TestCase
{
    public function testQueueListReturnsAtMostFiveWaitingQueues()
    {
        $apiKey = 'AbCdEfGhIjKlMnOpQrStUvWxYz123456';
        config(['api.key' => $apiKey]);

        $response = $this->get('/api/list-antrian', [
            'x-api-key' => $apiKey,
            'Accept' => 'application/json',
        ]);

        $content = json_decode($response->getContent(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('success', $content['status']);
        $this->assertLessThanOrEqual(5, count($content['data']));
    }
}
