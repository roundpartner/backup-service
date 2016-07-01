<?php

namespace RoundPartner\Backup\Storage;

use RoundPartner\Backup\Result;

class File implements Storage
{

    /**
     * @var string
     */
    protected $filename;

    /**
     * File constructor.
     *
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param Result $content
     *
     * @return bool
     */
    public function store($content)
    {
        $contents = $content->getContents();
        return strlen($contents) === file_put_contents($this->filename, $contents);
    }
}
