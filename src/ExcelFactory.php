<?php

namespace RoundPartner\Backup;

use RoundPartner\Backup\Format\Excel;

class ExcelFactory
{

    /**
     * @param array $config
     *
     * @return string
     */
    public static function asString($config)
    {
        $excel = new Excel();
        $excel->setInput($config);
        return $excel->getOutput()->getContents();
    }
}
