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
     * @param \RoundPartner\Cloud\Cloud $service
     * @param string $containerName
     * @param string $documentName
     */
    public function __construct($service, $containerName, $documentName)
    {
        $this->service = $service;
        $this->containerName = $containerName;
        $this->documentName = $documentName;
    }

    /**
     * @param Result $content
     *
     * @return bool
     */
    public function store($content)
    {
        $response = $this->service->document()->postDocument(
            $this->containerName,
            $this->documentName,
            $content->getContents()
        );
        return false !== $response;
    }
}
