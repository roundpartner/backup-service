<?php

namespace RoundPartner\Tests\Provider;

class FormatProvider
{
    public static function provide()
    {
        return array(array(array(
                'sheet1' => array(
                    (object) array('alpha' => 'Apple', 'bravo' => 'Beer', 'charlie' => 'Charlie', 'delta' => 'Don'),
                    (object) array('alpha' => 'Able', 'bravo' => 'Baker', 'charlie' => 'Charlie', 'delta' => 'Dog'),
                )
        )));
    }

    public static function provideTwoWorkSheets()
    {
        return array(array(array(
            'sheet1' => array(
                (object) array('alpha' => 'Apple', 'bravo' => 'Beer', 'charlie' => 'Charlie', 'delta' => 'Don'),
                (object) array('alpha' => 'Able', 'bravo' => 'Baker', 'charlie' => 'Charlie', 'delta' => 'Dog'),
            ),
            'sheet2' => array(
                (object) array('e' => 'E', 'f' => 'F', 'g' => 'G', 'H' => 'h'),
            ),
        )));
    }
}
