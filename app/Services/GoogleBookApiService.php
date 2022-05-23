<?php

namespace App\Services;

use App\Contracts\BookInterface;
use GuzzleHttp\Client;

class GoogleBookApiService implements BookInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function search($search)
    {
        $response = $this->client->request('get', 'https://www.googleapis.com/books/v1/volumes?q=' . $search);
        return json_decode($response->getBody())->items;
    }

    public function info(string $book_id)
    {
        $response = $this->client->request('get', 'https://www.googleapis.com/books/v1/volumes/' . $book_id);
        return json_decode($response->getBody());
    }
}
