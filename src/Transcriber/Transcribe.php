<?php

namespace RoundPartner\Backup\Transcriber;

interface Transcribe
{
    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return string
     */
    public function getPosition($key, $value);

    /**
     * @return bool
     */
    public function createSet();
}
