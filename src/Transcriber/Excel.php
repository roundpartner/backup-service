<?php

namespace RoundPartner\Backup\Transcriber;

class Excel implements Transcribe
{

    /**
     * @var integer
     */
    protected $row;

    /**
     * @var integer
     */
    protected $column;

    /**
     * @var array
     */
    protected $headings;

    public function __construct()
    {
        $this->row = 0;
        $this->column = 0;
        $this->headings = array();
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return string
     */
    public function getPosition($key, $value)
    {
        if (!array_key_exists($key, $this->headings)) {
            $this->headings[$key] = count($this->headings);
        }
        $this->column = $this->headings[$key];

        return $this->getCellString();
    }

    /**
     * @return bool
     */
    public function createSet()
    {
        $this->row++;
        return true;
    }

    public function getCellString()
    {
        return \PHPExcel_Cell::stringFromColumnIndex($this->column) . $this->row;
    }

    /**
     * @return array
     */
    public function getHeadings()
    {
        $this->row = 0;
        return array_keys($this->headings);
    }
}
