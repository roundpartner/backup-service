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
        $this->processContent($this->content['data']);
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
     * @param mixed $content
     *
     * @return bool
     */
    private function processContent($content, $key = null)
    {
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $this->transcriber->createSet();
                $this->processContent($value, $key);
            }
            return true;
        }
        if (is_object($content)) {
            foreach (get_object_vars($content) as $key => $value) {
                $this->processContent($value, $key);
            }
            return true;
        }

        $cell = $this->excel->getActiveSheet()->getCell($this->transcriber->getPosition($key, $content));
        $cell->getStyle()->getFont()->setBold();
        $cell->setValue($content);
        return true;
    }
}
