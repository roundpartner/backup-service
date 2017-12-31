<?php

namespace RoundPartner\Backup\Storage;

use RoundPartner\Backup\Result;

class Cloud implements Storage
{
    /**
     * @var \RoundPartner\Cloud\Cloud
     */
    protected $service;

    /**
     * @var string
     */
    protected $containerName;

    /**
     * @var string
     */
    protected $documentName;

    /**
     * @var string
     */
    protected $region;

    /**
     * @param \RoundPartner\Cloud\Cloud $service
     * @param string $containerName
     * @param string $documentName
     * @param string $region
     */
    public function __construct($service, $containerName, $documentName, $region = 'LON')
    {
        $this->service = $service;
        $this->containerName = $containerName;
        $this->documentName = $documentName;
        $this->region = $region;
    }

    /**
     * @param Result $content
     *
     * @return bool
     */
    public function store($content)
    {
        $response = $this->service->document($this->region)->postDocument(
            $this->containerName,
            $this->documentName,
            $content->getContents()
        );
        return false !== $response;
    }
}
