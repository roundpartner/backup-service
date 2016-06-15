<?php

namespace RoundPartner\Backup;

class ExcelResult extends Result
{

    /**
     * @var $contents \PHPExcel_Writer_Excel2007
     */
    protected $contents;

    /**
     * @return string
     */
    public function getContents()
    {
        ob_start();
        $this->contents->save('php://output');
        $this->contents = ob_get_contents();
        ob_end_clean();
        return $this->contents;
    }
}
