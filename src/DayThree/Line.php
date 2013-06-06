<?php

namespace DayThree;

/**
 * Class Line
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
/**
 * Class Line
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class Line
{
    /**
     * @var
     */
    private $number;

    /**
     * @var string
     */
    private $content;

    /**
     * @var MineField
     */
    private $field;

    /**
     * @var array
     */
    private $points = array();

    /**
     * @param integer   $number
     * @param string    $content
     * @param MineField $field
     */
    public function __construct($number, $content, MineField $field)
    {
        $this->number  = $number;
        $this->content = $content;
        $this->field   = $field;

        $this->compile();
    }

    private function compile()
    {
        $points = str_split($this->content);

        foreach ($points as $position => $value) {
            $this->points[$position] = new Point($position, $value, $this);
        }
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param $position
     * @return Point
     */
    public function getPoint($position)
    {
        return isset($this->points[$position]) ? $this->points[$position] : null;
    }

    /**
     * @return \DayThree\MineField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return null|Line
     */
    public function getUpperLine()
    {
        return $this->getField()->getLine($this->getNumber() - 1);
    }

    /**
     * @return null|Line
     */
    public function getLowerLine()
    {
        return $this->getField()->getLine($this->getNumber() + 1);
    }

    /**
     * @return string
     */
    public function render()
    {
        $output = '';

        foreach ($this->getPoints() as $point) {
            $output .= $point->render();
        }

        return $output;
    }
}