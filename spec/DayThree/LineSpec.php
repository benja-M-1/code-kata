<?php

namespace spec\DayThree;

use DayThree\Line;
use DayThree\MineField;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LineSpec extends ObjectBehavior
{
    function it_should_be_the_first_line(MineField $field)
    {
        $this->beConstructedWith(1, '', $field);
        $this->getNumber()->shouldBe(1);
    }

    function it_should_have_four_points(MineField $field)
    {
        $this->beConstructedWith(1, '*...', $field);
        $this->getPoints()->shouldHaveCount(4);
    }

    function it_should_return_upper_line(Line $line, MineField $field)
    {
        $field->getLine(1)->willReturn($line);

        $this->beConstructedWith(2, '*...', $field);
        $this->getUpperLine()->shouldReturn($line);
    }

    function it_should_return_not_upper_line(MineField $field)
    {
        $field->getLine(0)->willReturn(null);

        $this->beConstructedWith(1, '*...', $field);
        $this->getUpperLine()->shouldReturn(null);
    }

    function it_should_return_lower_line(Line $line, MineField $field)
    {
        $field->getLine(2)->willReturn($line);

        $this->beConstructedWith(1, '*...', $field);
        $this->getLowerLine()->shouldReturn($line);
    }

    function it_should_return_not_lower_line(MineField $field)
    {
        $field->getLine(2)->willReturn(null);

        $this->beConstructedWith(1, '*...', $field);
        $this->getLowerLine()->shouldReturn(null);
    }

    function it_should_render_a_line(MineField $field)
    {
        $this->beConstructedWith(1, '*...', $field);
        $this->render()->shouldReturn('*100');
    }
}
