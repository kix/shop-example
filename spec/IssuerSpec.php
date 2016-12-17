<?php

namespace spec\App;

use App\Issuer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IssuerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Issuer::class);
    }

    function it_has_an_identifier()
    {
        $this->getId()->shouldReturn(1);
    }
}
