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

        $this->processWorkSheet($this->content);
        
        return $this->excel;
    }


    private function processWorkSheet($content)
    {
        if (null === $content) {
            return false;
        }
        if (!is_array($content)) {
            $excelSheetProcessor = new ExcelSheet($this->excel, $content);
            return $excelSheetProcessor->process();
        }
        foreach (range(1, count($content)) as $worksheet) {
            $this->excel->createSheet();
        }
        $this->excel->removeSheetByIndex(0);

        $sheets = $this->excel->getAllSheets();
        foreach ($content as $workSheetTitle => $workSheetContent) {
            $sheet = array_shift($sheets);
            $sheet->setTitle($workSheetTitle);
            $this->excel->setActiveSheetIndexByName($workSheetTitle);
            $excelSheetProcessor = new ExcelSheet($this->excel, $workSheetContent);
            $excelSheetProcessor->process();
        }
        $this->excel->setActiveSheetIndex(0);
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
