<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ApiDocsTest extends TestCase
{
    public function testGuestMustLoginToOpenApiDocs()
    {
        $response = $this->get('/apidocs');

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(url('/login'), $response->headers->get('Location'));
    }

    public function testAuthenticatedUserCanOpenApiDocs()
    {
        $user = new User([
            'name' => 'API Documentation Tester',
            'role' => 'A',
        ]);

        $this->be($user, 'users');

        $response = $this->get('/apidocs');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('Dokumentasi API', $response->getContent());
        $this->assertContains('03-09-2026 16:51', $response->getContent());
        $this->assertContains('x-api-key', $response->getContent());
        $this->assertContains('/call', $response->getContent());
        $this->assertContains('/list-antrian', $response->getContent());
        $this->assertNotContains('/next', $response->getContent());
        $this->assertContains(config('api.key'), $response->getContent());
        $this->assertContains('Download Collection Postman', $response->getContent());
        $this->assertContains('API ANTRIAN.postman_collection.json', $response->getContent());
    }

    public function testAuthenticatedUserCanDownloadCurrentPostmanCollection()
    {
        $user = new User([
            'name' => 'API Documentation Tester',
            'role' => 'A',
        ]);

        $this->be($user, 'users');

        $response = $this->get('/apidocs/postman-collection');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertContains('attachment; filename="API ANTRIAN.postman_collection.json"', $response->headers->get('Content-Disposition'));
        $this->assertContains(url('/api').'/recall', $response->getContent());
        $this->assertContains(config('api.key'), $response->getContent());
    }
}
