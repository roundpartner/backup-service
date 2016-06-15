<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

class Excel implements Format
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
        return $result;
    }
}
