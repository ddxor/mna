<?php

namespace Mna;

class Seed
{
    protected static $_stringEntropy = [
        'John', 'David', 'Peter', 'Paul', 'Anthony',
        'Street', 'Hill', 'Lake', 'River', 'Pit',
        'Butcher', 'Cobbler', 'Jones', 'Smith', 'Doe',
    ];

    public static function generateString()
    {
        return self::$_stringEntropy[rand(0, 14)] . ' ' . self::$_stringEntropy[rand(0, 14)];
    }

    public static function generateDob()
    {
        $month = rand(1, 12);
        $year = rand((date('Y') - 120), date('Y'));

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $day = rand(1, $daysInMonth);

        return new \DateTime(
            sprintf(
                '%s/%s/%s 00:00:00',
                $month, $day, $year
            )
        );
    }
}
