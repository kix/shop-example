<?php

namespace spec\App;

use App\Book;
use App\Issuer;
use Money\Currency;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BookSpec extends ObjectBehavior
{
    function let(Issuer $issuer)
    {
        $this->beConstructedWith($issuer, new Money(10, new Currency('EUR')));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Book::class);
    }

    function it_has_an_issuer(Issuer $issuer)
    {
        $this->beConstructedWith($issuer, new Money(10, new Currency('EUR')));

        $this->getIssuer()->shouldBe($issuer);
    }

    function it_has_a_price(Issuer $issuer)
    {
        $price = new Money(10, new Currency('EUR'));
        $this->beConstructedWith($issuer, $price);
        $this->getPrice()->shouldBe($price);
    }
}
