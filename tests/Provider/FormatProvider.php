<?php

namespace RoundPartner\Tests\Provider;

class FormatProvider
{
    public static function provide()
    {
        return array(
            array(
                (object) array('alpha' => 'a', 'bravo' => 'b'),
            )
        );
    }
}
