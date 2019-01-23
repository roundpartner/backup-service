<?php

namespace RoundPartner\Backup\Storage;

use RoundPartner\Backup\Result;
use GuzzleHttp\Client;

class Freezer implements Storage
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $documentName;

    /**
     * @param string $bucket
     * @param string $documentName
     */
    public function __construct($bucket, $documentName)
    {
        $this->client = new Client([
            'base_uri' => 'http://freezer:7332/'
        ]);
        $this->bucket = $bucket;
        $this->documentName = $documentName;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param Result $content
     *
     * @return bool
     */
    public function store($content)
    {
        $response = $this->client->post("{$this->bucket}/{$this->documentName}", [
            'body' => $content->getContents()
        ]);
        if ($response->getStatusCode() !== 204) {
            return false;
        }
        return true;
    }
}
