<?php

namespace spec\DayTwo;

use DayTwo\NumberDecomposer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberNameSpec extends ObjectBehavior
{
    function it_should_return_number_name()
    {
        $this->name(9)->shouldReturn('nine');
        $this->name(10)->shouldReturn('ten');
        $this->name(99)->shouldReturn('ninety nine');
        $this->name(300)->shouldReturn('three hundred');
        $this->name(310)->shouldReturn('three hundred and ten');
        $this->name(312)->shouldReturn('three hundred and twelve');
        $this->name(1501)->shouldReturn('one thousand, five hundred and one');
        $this->name(12609)->shouldReturn('twelve thousand, six hundred and nine');
        $this->name(512607)->shouldReturn('five hundred and twelve thousand, six hundred and seven');
        $this->name(43112603)->shouldReturn('forty three million, one hundred and twelve thousand, six hundred and three');
        $this->name(543112603)->shouldReturn('five hundred and forty three million, one hundred and twelve thousand, six hundred and three');
    }
}
