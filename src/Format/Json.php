<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

class Json implements Format
{

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
