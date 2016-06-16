<?php

namespace RoundPartner\Tests\Provider;

class FormatProvider
{
    public static function provide()
    {
        return array(array(array(
            'Phonetic Alphabet' => self::providePhoneticAlphabet(),
        )));
    }

    public static function provideTwoWorkSheets()
    {
        return array(array(array(
            'Phonetic Alphabet' => self::providePhoneticAlphabet(),
            'Planes' => self::provideAircraft(),
        )));
    }

    public static function providePhoneticAlphabet()
    {
        $data = array(
            (object) array('letter' => 'A', 'raf' => 'Apple', 'nato' => 'Alpha', 'navy' => 'Apples'),
            (object) array('letter' => 'B', 'raf' => 'Beer', 'nato' => 'Bravo', 'navy' => 'Butter'),
            (object) array('letter' => 'C', 'raf' => 'Charlie', 'nato' => 'Charlie', 'navy' => 'Charlie'),
            (object) array('letter' => 'D', 'raf' => 'Don', 'nato' => 'Delta', 'navy' => 'Duff'),
            (object) array('letter' => 'E', 'raf' => 'Edward', 'nato' => 'Echo', 'navy' => 'Edward'),
            (object) array('letter' => 'F', 'raf' => 'Freddie', 'nato' => 'Fox', 'navy' => 'Freddie'),
        );
        return array(
            'headings' => array('letter' => 'Letter', 'raf' => 'RAF', 'nato' => 'Nato', 'navy' => 'Navy'),
            'data' => $data,
        );
    }

    public static function provideAircraft()
    {
        $data = array(
            (object) array('make' => 'Supermarine', 'name' => 'Spitfire', 'produced' => 1938),
            (object) array('make' => 'Hawker', 'name' => 'Hurricane', 'produced' => 1937),
            (object) array('make' => 'Douglas', 'name' => 'Havoc', 'produced' => 1939),
            (object) array('make' => 'Avro', 'name' => 'Lancaster', 'produced' => 1941),
        );
        return array(
            'headings' => array('make' => 'Make', 'name' => 'Name', 'produced' => 'Produced'),
            'data' => $data,
        );
    }
}
