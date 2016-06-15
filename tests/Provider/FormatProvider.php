<?php

namespace RoundPartner\Tests\Provider;

class FormatProvider
{
    public static function provide()
    {
        return array(
            array(array(
                (object) array('alpha' => 'Apple', 'bravo' => 'Beer', 'charlie' => 'Charlie', 'delta' => 'Don'),
                (object) array('alpha' => 'Able', 'bravo' => 'Baker', 'charlie' => 'Charlie', 'delta' => 'Dog'),
            ))
        );
    }
}
