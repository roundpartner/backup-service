<?php

namespace RoundPartner\Backup\Format;

class Json implements Format
{

    /**
     * @return string
     */
    public function getOutput()
    {
        return json_encode('');
    }
}
