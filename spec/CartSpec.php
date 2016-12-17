<?php

namespace spec\App;

use App\Cart;
use App\Discount;
use App\ItemInterface;
use Money\Currency;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Cart::class);
    }

    function it_allows_adding_items(ItemInterface $item)
    {
        $this->addItem($item);

        $this->getItems()->shouldBe([$item]);
    }

    function it_allows_adding_discounts(Discount $discount)
    {
        $this->addDiscount($discount);

        $this->getDiscounts()->shouldBe([$discount]);
    }

    function it_returns_price_with_no_discounts(ItemInterface $item)
    {
        $item->getPrice()->willReturn(new Money(100, new Currency('EUR')));
        $this->addItem($item);
        $this->addItem($item);

        $this->getTotal()->shouldBeSameMoneyAs(new Money(200, new Currency('EUR')));
    }

    function it_applies_all_discounts_to_total(ItemInterface $item, Discount $amountDiscount, Discount $percentDiscount)
    {
        $item->getPrice()->willReturn(new Money(100, new Currency('EUR')));
        $this->addItem($item);

        $amountDiscount->apply(Argument::type(Money::class))->willReturn(new Money(90, new Currency('EUR')));
        $percentDiscount->apply(Argument::type(Money::class))->willReturn(new Money(81, new Currency('EUR')));

        $this->addDiscount($amountDiscount);
        $this->addDiscount($percentDiscount);

        $this->getTotal()->shouldBeSameMoneyAs(new Money(81, new Currency('EUR')));
    }

    /**
     * @TODO Extract to an extension
     * @return array
     */
    public function getMatchers()
    {
        return [
            'beSameMoneyAs' => function(Money $subject, Money $target) {
                return $subject->compare($target) === 0;
            }
        ];
    }
}
