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

        $this->processContent($this->content);
        $this->excel->getActiveSheet()->insertNewRowBefore(1);
        $headings = (object) array_combine($this->transcriber->getHeadings(), $this->transcriber->getHeadings());
        $this->transcriber->createSet();
        $this->processContent($headings);
        
        return $this->excel;
    }

    /**
     * @param mixed $content
     *
     * @return bool
     */
    private function processContent($content, $key = null)
    {

        if (is_string($content)) {
            $cell = $this->excel->getActiveSheet()->getCell($this->transcriber->getPosition($key, $content));
            $cell->setValue($content);
        }
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $this->transcriber->createSet();
                $this->processContent($value, $key);
            }
        }
        if (is_object($content)) {
            foreach (get_object_vars($content) as $key => $value) {
                $this->processContent($value, $key);
            }
        }
        return true;
    }

    private function getColumnByHeading($heading)
    {
        if (array_key_exists($heading, $this->headings)) {
            return $this->headings[$heading];
        }
        $this->headings[$heading] = count($this->headings);
        return $this->getColumnByHeading($heading);
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
