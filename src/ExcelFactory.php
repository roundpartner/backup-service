<?php

namespace RoundPartner\Backup;

use RoundPartner\Backup\Format\Excel;
use RoundPartner\Backup\Format\Format;
use RoundPartner\Backup\Storage\Cloud;
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

    /**
     * @param array $config
     * @param string $filename
     *
     * @return bool
     */
    public static function asFile($config, $filename)
    {
        $excel = new Excel();
        $excel->setInput($config);
        $fileStorage = new File($filename);
        return self::createBackup($excel, $fileStorage);
    }

    /**
     * @param array $config
     * @param \RoundPartner\Cloud\Cloud $service
     * @param string $containerName
     * @param string $documentName
     * @param string $region
     *
     * @return bool
     */
    public static function asCloud($config, $service, $containerName, $documentName, $region = 'LON')
    {
        $excel = new Excel();
        $excel->setInput($config);
        $cloud = new Cloud($service, $containerName, $documentName, $region);
        return self::createBackup($excel, $cloud);
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
