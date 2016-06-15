<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

class Json implements Format
{

    /**
     * @param string $input
     *
     * @return bool
     */
    public function setInput($input)
    {
        return true;
    }

    /**
     * @return Result
     */
    public function getOutput()
    {
        $result = new Result();
        $result->setContents(json_encode(''));
        return $result;
    }
}
