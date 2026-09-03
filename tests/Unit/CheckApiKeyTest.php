<?php

namespace Tests\Unit;

use App\Http\Middleware\CheckApiKey;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckApiKeyTest extends TestCase
{
    public function testItRejectsARequestWithoutTheApiKey()
    {
        config(['api.key' => 'AbCdEfGhIjKlMnOpQrStUvWxYz123456']);

        $response = (new CheckApiKey)->handle(
            Request::create('/api/get-layanan', 'GET'),
            function () {
                return response()->json(['success' => true]);
            }
        );

        $this->assertSame(401, $response->getStatusCode());
    }

    public function testItAllowsARequestWithTheConfiguredApiKey()
    {
        $apiKey = 'AbCdEfGhIjKlMnOpQrStUvWxYz123456';
        config(['api.key' => $apiKey]);

        $request = Request::create('/api/get-layanan', 'GET');
        $request->headers->set('x-api-key', $apiKey);

        $response = (new CheckApiKey)->handle($request, function () {
            return response()->json(['success' => true]);
        });

        $this->assertSame(200, $response->getStatusCode());
    }
}
