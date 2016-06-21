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

    /**
     * @param array $content
     *
     * @return bool|\PHPExcel_Worksheet
     *
     * @throws \PHPExcel_Exception
     */
    public function process($content)
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
        return true;
    }
}
