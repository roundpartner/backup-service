<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

class Json implements Format
{

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @param string $input
     *
     * @return bool
     */
    public function setInput($input)
    {
        $this->content = $input;
        return true;
    }

    /**
     * @return Result
     */
    public function getOutput()
    {
        $result = new Result();
        $result->setContents(json_encode($this->content));
        return $result;
    }
}
