<?php

namespace DayTwo;

class NumberName
{
    const UNIT     = 1;
    const TEN      = 2;
    const HUNDRED  = 3;
    const THOUSAND = 4;
    const MILLION  = 7;

    private $names = array(
        0  => 'zero',
        1  => 'one',
        2  => 'two',
        3  => 'three',
        4  => 'four',
        5  => 'five',
        6  => 'six',
        7  => 'seven',
        8  => 'height',
        9  => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'heighty',
        90 => 'ninety',
    );

    public function name($number)
    {
        if (array_key_exists($number, $this->names)) {
            return $this->names[$number];
        }

        return $this->format($number);
    }

    /**
     * Format the name of a number.
     *
     * @param $number
     * @param array $names
     * @return string
     */
    private function format($number, $names = [])
    {
        $names = $this->formatTens($number);
        $names = $this->formatHundreds($number, $names);
        $names = $this->formatThousands($number, $names);
        $names = $this->formatMillions($number, $names);

        return implode(' ', array_reverse($names));
    }

    /**
     * Format tens of a number.
     *
     * @param $number
     * @param array $names
     * @return array
     */
    private function formatTens($number, $names = [])
    {
        $tens = (int) substr((string) $number, -self::TEN, 2);

        if ($tens > 0 && array_key_exists($tens, $this->names)) {
            $names[self::TEN] = $this->names[$tens];
        } else {
            $units = (int) substr((string) $number, -self::UNIT, 1);

            if ($units > 0) {
                $names[self::UNIT] = $this->names[$units];
            }

            $tens  = (int) substr((string) $number, -self::TEN, 1) * 10;

            if ($tens > 0) {
                $names[self::TEN] = $this->names[$tens];
            }
        }

        return $names;
    }

    /**
     * Format hundreds of a number.
     *
     * @param $number
     * @param array $names
     * @return array
     */
    private function formatHundreds($number, $names = [])
    {
        if (strlen((string) $number) < self::HUNDRED) {
            return $names;
        }

        $hundreds = (int) substr((string) $number, -self::HUNDRED, 1);

        if ($hundreds > 0) {
            $names[self::HUNDRED] = $this->names[$hundreds] . ' hundred';

            if (isset($names[self::TEN]) || isset($names[self::UNIT])) {
                $names[self::HUNDRED] .= ' and';
            }
        }

        return $names;
    }

    /**
     * Format thousands of a number.
     *
     * @param $number
     * @param array $names
     * @return array
     */
    private function formatThousands($number, $names = [])
    {
        if (strlen((string) $number) >= self::THOUSAND) {
            $thousands = (int) substr(substr((string) $number, 0, -self::THOUSAND + 1), -3);
            $names[self::THOUSAND] = $this->format($thousands, $names) . ' thousand';

            if (count($names) > 1) {
                $names[self::THOUSAND] .= ',';
            }
        }

        return $names;
    }

    /**
     * Format millions of a number.
     *
     * @param $number
     * @param array $names
     * @return array
     */
    private function formatMillions($number, $names = [])
    {
        if (strlen((string) $number) >= self::MILLION) {
            $millions = (int) substr((int) substr((string) $number, 0, -self::MILLION + 1), -3);
            $names[self::MILLION] = $this->format($millions, $names) . ' million';

            if (count($names) > 1) {
                $names[self::MILLION] .= ',';
            }
        }

        return $names;
    }
}