<?php

namespace RoundPartner\Backup\Format;

use RoundPartner\Backup\Transcriber\Transcribe;

class ExcelSheet
{
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

    /**
     * @var array
     */
    protected $content;

    public function __construct(\PHPExcel $excel, $content)
    {
        $this->excel = $excel;
        $this->headings = array();
        $this->transcriber = new \RoundPartner\Backup\Transcriber\Excel();
        $this->content = $content;
    }

    /**
     * @return \PHPExcel_Worksheet
     */
    public function process()
    {
        $this->processHeading();
        $this->processRows($this->content['data']);
        return $this->excel->getActiveSheet();
    }

    private function processHeading()
    {
        $this->excel->getActiveSheet()->insertNewRowBefore(1);
        $headings = $this->content['headings'];
        $this->transcriber->createSet();
        foreach ($headings as $heading => $value) {
            $cell = $this->excel->getActiveSheet()->getCell($this->transcriber->getPosition($heading, $heading));
            $cell->getStyle()->getFont()->setBold(true);
            $cell->setValue($value);
        }
    }

    /**
     * @param array $content
     *
     * @return bool
     */
    private function processRows($content)
    {
        foreach ($content as $value) {
            $this->transcriber->createSet();
            $this->processRow($value);
        }
        return true;
    }

    /**
     * @param array $content
     *
     * @return bool
     */
    private function processRow($content)
    {
        if (is_object($content)) {
            $content = get_object_vars($content);
        }
        foreach ($content as $key => $value) {
            $this->processContent($value, $key);
        }
        return true;
    }

    /**
     * @param mixed $content
     *
     * @return bool
     */
    private function processContent($content, $key = null)
    {
        $cell = $this->excel->getActiveSheet()->getCell($this->transcriber->getPosition($key, $content));
        $cell->getStyle()->getFont()->setBold();
        $cell->setValue($content);
        return true;
    }
}
