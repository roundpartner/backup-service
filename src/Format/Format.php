<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Result;

interface Format
{
    /**
     * @param string $input
     *
     * @return bool
     */
    public function setInput($input);

    /**
     * @return Result
     */
    public function getOutput();
}
