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
            'Phonetic Alphabet' => array(
                (object) array('Letter' => 'A', 'RAF' => 'Apple', 'Nato' => 'Alpha', 'Navy' => 'Apples'),
                (object) array('Letter' => 'B', 'RAF' => 'Beer', 'Nato' => 'Bravo', 'Navy' => 'Butter'),
                (object) array('Letter' => 'C', 'RAF' => 'Charlie', 'Nato' => 'Charlie', 'Navy' => 'Charlie'),
                (object) array('Letter' => 'D', 'RAF' => 'Don', 'Nato' => 'Delta', 'Navy' => 'Duff'),
                (object) array('Letter' => 'E', 'RAF' => 'Edward', 'Nato' => 'Echo', 'Navy' => 'Edward'),
                (object) array('Letter' => 'F', 'RAF' => 'Freddie', 'Nato' => 'Fox', 'Navy' => 'Freddie'),
            ),
            'Planes' => array(
                (object) array('Make' => 'Supermarine', 'Name' => 'Spitfire', 'Produced' => '1938'),
                (object) array('Make' => 'Hawker', 'Name' => 'Hurricane', 'Produced' => '1937'),
                (object) array('Make' => 'Douglas', 'Name' => 'Havoc', 'Produced' => '1939'),
                (object) array('Make' => 'Avro', 'Name' => 'Lancaster', 'Produced' => '1941'),
            ),
        )));
    }
}
