<?php

namespace Poowf\LaravelLuis;

use GuzzleHttp\Client;

class LaravelLuis
{

    public function __construct()
    {
        $this->client = $this->initialize();
    }

    public function initialize()
    {

        $client = new Client([
            'base_uri' => config('laravel-luis.base_uri'),
            'query' => [
                'subscription-key' => config('laravel-luis.subscription_key'),
                'staging' => (config('laravel-luis.staging')) ? "true" : "false",
                'timezoneOffset' => config('laravel-luis.timezoneOffset')
            ]
        ]);

        return $client;
    }

    public function query($query)
    {
        $client = $this->client;
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', config('laravel-luis.app_id'), [
            'query' => array_merge(
                $client->getConfig('query'),
                [
                    'q' => $query
                ]
            )
        ]);

        $body = json_decode($response->getBody()->getContents());
//        $intent = $body->topScoringIntent->intent;
//        $entity = $body->entities[0];
//        $entityName = preg_replace('/\s/', '', $entity->entity);
//
//        $model = '\App\Models\\' . $entity->type;
//
//        $invoice = $model::where('nice_invoice_id', $entityName)->first();
//
//        $route = route('invoice.show', [ 'company' => Unicorn::getCompanyKey(), 'invoice' => $invoice->id ]);

        return $body;
    }
}