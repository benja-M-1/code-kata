<?php

namespace DayOne;

class CalcStat
{
    private $set;

    public function __construct(array $set)
    {
        $this->set = $set;
    }

    public function min()
    {
        return min($this->set);
    }

    public function max()
    {
        return max($this->set);
    }

    public function count()
    {
        return count($this->set);
    }

    public function avg()
    {
        return round(array_sum($this->set)/$this->count(), 6);
    }
}