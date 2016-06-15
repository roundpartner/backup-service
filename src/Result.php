<?php

namespace RoundPartner\Backup;

class Result
{
    /**
     * @var mixed
     */
    protected $contents;

    /**
     * @param mixed $contents
     *
     * @return bool
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return true;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }
}
