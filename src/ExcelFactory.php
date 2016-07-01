<?php

namespace RoundPartner\Backup;

use RoundPartner\Backup\Format\Excel;
use RoundPartner\Backup\Format\Format;
use RoundPartner\Backup\Storage\File;
use RoundPartner\Backup\Storage\Storage;

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
    
    public static function asFile($config, $filename)
    {
        $excel = new Excel();
        $excel->setInput($config);
        $fileStorage = new File($filename);
        return self::createBackup($excel, $fileStorage);
    }

    /**
     * @param Format $format
     * @param Storage $storage
     *
     * @return bool
     */
    public static function createBackup($format, $storage)
    {
        $result = $format->getOutput();
        return $storage->store($result);
    }
}
