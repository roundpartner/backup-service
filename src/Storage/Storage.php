<?php

namespace RoundPartner\Backup\Storage;

use RoundPartner\Backup\Result;

interface Storage
{
    /**
     * @param Result $content
     *
     * @return bool
     */
    public function store($content);
}
