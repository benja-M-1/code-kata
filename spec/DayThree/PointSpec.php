<?php

namespace spec\DayThree;

use DayThree\Line;
use DayThree\MineField;
use DayThree\Point;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PointSpec extends ObjectBehavior
{
    function it_should_be_the_first_point(Line $line)
    {
        $this->beConstructedWith(1, '.', $line);
        $this->getPosition()->shouldBe(1);
        $this->getValue()->shouldBe('.');
    }

    function it_should_return_previous_point(Line $line, Point $point)
    {
        $point->getPosition()->willReturn(1);
        $line->getPoint(1)->willReturn($point);

        $this->beConstructedWith(2, '.', $line);
        $this->getPrevious()->shouldReturn($point);
    }

    function it_should_return_the_new_point(Line $line, Point $point)
    {
        $point->getPosition()->willReturn(2);
        $line->getPoint(2)->willReturn($point);

        $this->beConstructedWith(1, '.', $line);
        $this->getNext()->shouldReturn($point);
    }

    function it_should_return_the_upper_left_point(Line $line, Line $upperLine, Point $point)
    {
        $line->getUpperLine()->willReturn($upperLine);
        $upperLine->getPoint(1)->willReturn($point);

        $this->beConstructedWith(2, '.', $line);
        $this->getUpperLeft()->shouldReturn($point);
    }

    function it_should_return_the_upper_point(Line $line, Line $upperLine, Point $point)
    {
        $line->getUpperLine()->willReturn($upperLine);
        $upperLine->getPoint(1)->willReturn($point);

        $this->beConstructedWith(1, '.', $line);
        $this->getUpper()->shouldReturn($point);
    }

    function it_should_return_the_upper_right_point(Line $line, Line $upperLine, Point $point)
    {
        $line->getUpperLine()->willReturn($upperLine);
        $upperLine->getPoint(2)->willReturn($point);

        $this->beConstructedWith(1, '.', $line);
        $this->getUpperRight()->shouldReturn($point);
    }

    function it_should_not_find_upper_line(Line $line)
    {
        $line->getUpperLine()->willReturn(null);

        $this->beConstructedWith(1, '.', $line);
        $this->getUpper()->shouldReturn(null);
    }

    function it_should_not_find_lower_line(Line $line)
    {
        $line->getLowerLine()->willReturn(null);

        $this->beConstructedWith(1, '.', $line);
        $this->getLower()->shouldReturn(null);
    }

    function it_should_return_the_lowerer_point(Line $line, Line $lowerLine, Point $point)
    {
        $line->getLowerLine()->willReturn($lowerLine);
        $lowerLine->getPoint(1)->willReturn($point);

        $this->beConstructedWith(1, '.', $line);
        $this->getLower()->shouldReturn($point);
    }

    function it_should_return_the_lowerer_left_point(Line $line, Line $lowerLine,Point $point)
    {
        $line->getLowerLine()->willReturn($lowerLine);
        $lowerLine->getPoint(1)->willReturn($point);

        $this->beConstructedWith(2, '.', $line);
        $this->getLowerLeft()->shouldReturn($point);
    }

    function it_should_return_the_lowerer_right_point(Line $line, Line $lowerLine,Point $point)
    {
        $line->getLowerLine()->willReturn($lowerLine);
        $lowerLine->getPoint(3)->willReturn($point);

        $this->beConstructedWith(2, '.', $line);
        $this->getLowerRight()->shouldReturn($point);
    }

    function it_should_be_a_mine(Line $line)
    {
        $this->beConstructedWith(1, '*', $line);
        $this->shouldBeAMine();
    }

    function it_should_have_1_mines_around(Line $line, Point $leftMine, Point $rightPoint)
    {
        $leftMine->isAMine()->willReturn(true);
        $rightPoint->isAMine()->willReturn(false);
        $line->getUpperLine()->willReturn(null);
        $line->getLowerLine()->willReturn(null);
        $line->getPoint(1)->willReturn($leftMine);
        $line->getPoint(3)->willReturn($rightPoint);

        $this->beConstructedWith(2, '.', $line);
        $this->countMinesAround()->shouldReturn(1);
    }

    function it_should_have_8_mines_around(
        Line $line,
        Line $upper,
        Line $lower,
        Point $ul,
        Point $u,
        Point $ur,
        Point $p,
        Point $n,
        Point $ll,
        Point $l,
        Point $lr
    )
    {
        $ul->isAMine()->willReturn(true);
        $u->isAMine()->willReturn(true);
        $ur->isAMine()->willReturn(true);
        $p->isAMine()->willReturn(true);
        $n->isAMine()->willReturn(true);
        $ll->isAMine()->willReturn(true);
        $l->isAMine()->willReturn(true);
        $lr->isAMine()->willReturn(true);

        $line->getUpperLine()->willReturn($upper);
        $line->getLowerLine()->willReturn($lower);

        $upper->getPoint(0)->willReturn($ul);
        $upper->getPoint(1)->willReturn($u);
        $upper->getPoint(2)->willReturn($ur);
        $line->getPoint(0)->willReturn($p);
        $line->getPoint(2)->willReturn($n);
        $lower->getPoint(0)->willReturn($ll);
        $lower->getPoint(1)->willReturn($l);
        $lower->getPoint(2)->willReturn($lr);

        $this->beConstructedWith(1, '.', $line);
        $this->countMinesAround()->shouldReturn(8);
    }

    function it_should_render_a_point(Line $line)
    {
        $this->beConstructedWith(2, '.', $line);
        $this->render()->shouldReturn(0);
    }

    function it_should_render_a_mine(Line $line)
    {
        $this->beConstructedWith(2, '*', $line);
        $this->render()->shouldReturn('*');
    }


    function it_should_render_a_point_surrounded_by_8_mines_around(
        Line $line,
        Line $upper,
        Line $lower,
        Point $ul,
        Point $u,
        Point $ur,
        Point $p,
        Point $n,
        Point $ll,
        Point $l,
        Point $lr
    )
    {
        $ul->isAMine()->willReturn(true);
        $u->isAMine()->willReturn(true);
        $ur->isAMine()->willReturn(true);
        $p->isAMine()->willReturn(true);
        $n->isAMine()->willReturn(true);
        $ll->isAMine()->willReturn(true);
        $l->isAMine()->willReturn(true);
        $lr->isAMine()->willReturn(true);

        $line->getUpperLine()->willReturn($upper);
        $line->getLowerLine()->willReturn($lower);

        $upper->getPoint(0)->willReturn($ul);
        $upper->getPoint(1)->willReturn($u);
        $upper->getPoint(2)->willReturn($ur);
        $line->getPoint(0)->willReturn($p);
        $line->getPoint(2)->willReturn($n);
        $lower->getPoint(0)->willReturn($ll);
        $lower->getPoint(1)->willReturn($l);
        $lower->getPoint(2)->willReturn($lr);

        $this->beConstructedWith(1, '.', $line);
        $this->render()->shouldReturn(8);
    }
}
