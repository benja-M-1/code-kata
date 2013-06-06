<?php

namespace DayThree;

/**
 * Class Point
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class Point
{
    const UPPER = 'upper';
    const LOWER = 'lower';
    const LEFT  = 'left';
    const RIGHT = 'right';

    /**
     * @var int
     */
    private $position;

    /**
     * @var string
     */
    private $value;

    /**
     * @var Line
     */
    private $line;

    /**
     * @param integer $position
     * @param string  $value
     * @param Line    $line
     */
    public function __construct($position, $value, Line $line)
    {
        $this->line     = $line;
        $this->position = $position;
        $this->value    = $value;
    }

    /**
     * @return \DayThree\Line
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Point
     */
    public function getPrevious()
    {
        return $this->findPoint($this->line, self::LEFT);
    }

    /**
     * @return Point
     */
    public function getNext()
    {
        return $this->findPoint($this->line, self::RIGHT);
    }

    /**
     * @return Point
     */
    public function getUpperLeft()
    {
        return $this->find(self::UPPER, self::LEFT);
    }

    /**
     * @return null|Point
     */
    public function getUpper()
    {
        return $this->find(self::UPPER);
    }

    /**
     * @return null|Point
     */
    public function getUpperRight()
    {
        return $this->find(self::UPPER, self::RIGHT);
    }

    /**
     * @return Point|null
     */
    public function getLower()
    {
        return $this->find(self::LOWER);
    }

    /**
     * @return Point|null
     */
    public function getLowerLeft()
    {
        return $this->find(self::LOWER, self::LEFT);
    }

    /**
     * @return Point|null
     */
    public function getLowerRight()
    {
        return $this->find(self::LOWER, self::RIGHT);
    }

    /**
     * @param $line
     * @param null $point
     * @return Point|null
     */
    private function find($line, $point = null)
    {
        $line  = $this->findLine($line);

        if (null === $line) {
            return null;
        }

        return $this->findPoint($line, $point);
    }

    /**
     * @param $line
     * @return null|Line
     */
    private function findLine($line)
    {
        return $this->getLine()->{'get'.ucfirst($line).'Line'}();
    }

    /**
     * @param Line $line
     * @param null $point
     * @return Point
     */
    private function findPoint(Line $line, $point = null)
    {
        switch ($point) {
            case self::LEFT:
                $point = $line->getPoint($this->getPosition() - 1);
                break;
            case self::RIGHT:
                $point = $line->getPoint($this->getPosition() + 1);
                break;
            default:
                $point = $line->getPoint($this->getPosition());
                break;
        }

        return $point;
    }

    /**
     * @return bool
     */
    public function isAMine()
    {
        return false !== strpos($this->value, '*');
    }

    /**
     * @return int
     */
    public function countMinesAround()
    {
        $points = array(
            $this->getUpperLeft(),
            $this->getUpper(),
            $this->getUpperRight(),
            $this->getPrevious(),
            $this->getNext(),
            $this->getLowerLeft(),
            $this->getLower(),
            $this->getLowerRight()
        );

        $count = 0;
        foreach ($points as $point) {
            if (null === $point) {
                continue;
            }

            if ($point->isAMine()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @return int|string
     */
    public function render()
    {
        return $this->isAMine() ? '*' : $this->countMinesAround();
    }
}