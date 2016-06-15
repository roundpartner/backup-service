<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\ExcelResult;
use RoundPartner\Backup\Result;

class Excel implements Format
{

    /**
     * @var PHPExcel
     */
    protected $excel;

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
     * @return ExcelResult
     */
    public function getOutput()
    {
        $this->excel = $this->getExcelInstance();

        $excelWriter = new \PHPExcel_Writer_Excel2007($this->excel);

        $result = new ExcelResult();
        $result->setContents($excelWriter);

        return $result;
    }

    /**
     * @return \PHPExcel
     *
     * @throws \PHPExcel_Exception
     */
    private function getExcelInstance()
    {
        $workSheet = new \PHPExcel();
        $workSheet->setActiveSheetIndex(0);
        return $workSheet;
    }
}
