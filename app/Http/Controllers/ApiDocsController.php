<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class ApiDocsController extends Controller
{
    public function index()
    {
        $version = config('api.version');
        $updatedAt = Carbon::createFromFormat('d-m-Y H:i', $version, config('app.timezone'));
        $elapsedSeconds = max(0, Carbon::now()->timestamp - $updatedAt->timestamp);

        if ($elapsedSeconds < 60) {
            $updatedAgo = 'baru saja';
        } elseif ($elapsedSeconds < 3600) {
            $updatedAgo = floor($elapsedSeconds / 60).' menit lalu';
        } elseif ($elapsedSeconds < 86400) {
            $updatedAgo = floor($elapsedSeconds / 3600).' jam lalu';
        } else {
            $updatedAgo = floor($elapsedSeconds / 86400).' hari lalu';
        }

        $baseUrl = url('/api');
        $endpoints = config('api.endpoints');

        foreach ($endpoints as &$endpoint) {
            $query = [];
            foreach ($endpoint['parameters'] as $parameter) {
                $query[$parameter['name']] = 1;
            }

            $endpoint['example_url'] = $baseUrl.$endpoint['path'];
            if (count($query)) {
                $endpoint['example_url'] .= '?'.http_build_query($query);
            }
        }
        unset($endpoint);

        return view('user.apidocs.index', [
            'apiKey' => config('api.key'),
            'baseUrl' => $baseUrl,
            'endpoints' => $endpoints,
            'version' => $version,
            'updatedAtTimestamp' => $updatedAt->timestamp,
            'updatedAgo' => $updatedAgo,
        ]);
    }
}
