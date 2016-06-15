<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

interface Format
{
    /**
     * @return Result
     */
    public function getOutput();
}
