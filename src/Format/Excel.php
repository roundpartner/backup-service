<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\ExcelResult;
use RoundPartner\Backup\Transcriber\Transcribe;

class Excel implements Format
{

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var \PHPExcel
     */
    protected $excel;

    /**
     * @var Transcribe
     */
    protected $transcriber;

    /**
     * @var array
     */
    protected $headings;

    public function __construct()
    {
        $this->headings = array();
        $this->transcriber = new \RoundPartner\Backup\Transcriber\Excel();
        $this->content = array();
    }

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
        $excel = $this->getWorkBook();

        $excelWriter = new \PHPExcel_Writer_Excel2007($excel);

        $result = new ExcelResult();
        $result->setContents($excelWriter);

        return $result;
    }

    /**
     * @return \PHPExcel
     *
     * @throws \PHPExcel_Exception
     */
    public function getWorkBook()
    {
        $this->excel = $this->getExcelInstance();

        foreach ($this->content as $option => $value) {
            $processMethod = 'process' . $option;
            $this->{$processMethod}($value);
        }
        return $this->excel;
    }

    public function processProperties($properties)
    {
        $documentProperties = $this->excel->getProperties();
        foreach ($properties as $property => $value) {
            $setter = 'set' . $property;
            $documentProperties->$setter($value);
        }
    }

    private function processWorkSheets($content)
    {
        $workBook = new WorkBook($this->excel);
        return $workBook->process($content);
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
