<?php

namespace spec\DayOne;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalcStatSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array(6, 9, 15, -2, 92, 11));
    }

    function it_should_return_the_minimum_of_a_set_of_values()
    {
        $this->min()->shouldReturn(-2);
    }

    function it_should_return_the_maximum_of_a_set_of_values()
    {
        $this->max()->shouldReturn(92);
    }

    function it_should_return_the_numer_of_elements_in_the_set()
    {
        $this->count()->shouldReturn(6);
    }

    function it_should_return_the_average_value()
    {
        $this->avg()->shouldReturn(21.833333);
    }
}
