<?php

namespace DayThree;

/**
 * Class MineField
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class MineField
{
    /**
     * @var
     */
    private $field;

    /**
     * @var array
     */
    private $lines = array();

    /**
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;

        $this->compile();
    }

    /**
     * @return string
     */
    public function output()
    {
        $output = [];

        foreach ($this->lines as $line) {
            $output[] = $line->render();
        }

        return implode("\n", $output);
    }

    /**
     *
     */
    public function compile()
    {
        $lines = explode("\n", $this->field);
        $this->lines = [];

        foreach ($lines as $line => $parts)
        {
            $this->lines[$line] = new Line($line, $parts, $this);
        }
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param $number
     * @return mixed
     */
    public function getLine($number)
    {
        return isset($this->lines[$number]) ? $this->lines[$number] : null;
    }
}