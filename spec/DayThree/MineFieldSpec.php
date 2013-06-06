<?php

namespace spec\DayThree;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MineFieldSpec extends ObjectBehavior
{
    function let()
    {
        $field = <<<TEXT
*...*..
..*...*
....***
TEXT;
        $this->beConstructedWith($field);
    }

    function it_should_create_a_field()
    {
        $output = <<<TEXT
*212*21
12*335*
0112***
TEXT;
        $this->output()->shouldReturn($output);
    }

    function it_should_create_3_lines()
    {
        $this->compile();
        $this->getLines()->shouldHaveCount(3);
    }
}
