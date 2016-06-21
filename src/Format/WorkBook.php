<?php

namespace RoundPartner\Backup\Format;

class WorkBook
{
    /**
     * @var \PHPExcel
     */
    protected $excel;

    public function __construct(\PHPExcel $excel)
    {
        $this->excel = $excel;
    }
}
