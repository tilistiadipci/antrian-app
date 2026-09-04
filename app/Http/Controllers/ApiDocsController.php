<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class ApiDocsController extends Controller
{
    public function downloadPostmanCollection()
    {
        $baseUrl = url('/api');
        $items = [];

        foreach (config('api.endpoints') as $endpoint) {
            $query = [];
            foreach ($endpoint['parameters'] as $parameter) {
                $query[] = [
                    'key' => $parameter['name'],
                    'value' => '1',
                    'description' => $parameter['description'],
                    'disabled' => !$parameter['required'],
                ];
            }

            $rawUrl = $baseUrl.$endpoint['path'];
            if (count($query)) {
                $rawUrl = $baseUrl.$endpoint['path'].'?'.implode('&', array_map(function ($parameter) {
                    return $parameter['key'].'='.$parameter['value'];
                }, $query));
            }

            $items[] = [
                'name' => $endpoint['name'],
                'request' => [
                    'method' => $endpoint['method'],
                    'header' => [
                        ['key' => 'Accept', 'value' => 'application/json', 'type' => 'text'],
                        ['key' => 'x-api-key', 'value' => config('api.key'), 'type' => 'text'],
                    ],
                    'url' => [
                        'raw' => $rawUrl,
                        'host' => [$baseUrl],
                        'path' => array_values(array_filter(explode('/', trim($endpoint['path'], '/')))),
                        'query' => $query,
                    ],
                    'description' => $endpoint['description'],
                ],
                'response' => [],
            ];
        }

        $collection = [
            'info' => [
                'name' => 'API ANTRIAN',
                'description' => 'Collection API Sistem Antrian.',
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'item' => $items,
        ];

        return response(json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 200, [
            'Content-Type' => 'application/json; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="API ANTRIAN.postman_collection.json"',
            'Cache-Control' => 'no-store, private',
        ]);
    }

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
