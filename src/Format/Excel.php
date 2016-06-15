<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\ExcelResult;

class Excel implements Format
{

    /**
     * @var mixed
     */
    protected $content;

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
        $this->content = $input;
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

        $this->processContent($this->content);


        return $result;
    }

    /**
     * @param mixed $content
     *
     * @return bool
     */
    private function processContent($content)
    {
        return true;
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
