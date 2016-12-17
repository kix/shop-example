<?php

require_once __DIR__.'/../vendor/autoload.php';

$issuer1 = new \App\Issuer(1);
$issuer2 = new \App\Issuer(2);
$issuer3 = new \App\Issuer(3);

$book1 = new \App\Book($issuer1, new \Money\Money(100, new \Money\Currency('EUR')));
$book2 = new \App\Book($issuer1, new \Money\Money(50, new \Money\Currency('EUR')));
$book3 = new \App\Book($issuer1, new \Money\Money(5, new \Money\Currency('EUR')));

$book4 = new \App\Book($issuer2, new \Money\Money(35, new \Money\Currency('EUR')));
$book5 = new \App\Book($issuer2, new \Money\Money(65, new \Money\Currency('EUR')));

$book6 = new \App\Book($issuer3, new \Money\Money(65, new \Money\Currency('EUR')));
$book7 = new \App\Book($issuer3, new \Money\Money(65, new \Money\Currency('EUR')));

$cart = new \App\Cart([$book1, $book2, $book3, $book4]);
$money = $cart->getTotal();
echo "100 + 50 + 5 + 35, 3 books by one issuer\n";
echo "Total: {$cart->getTotal()->getAmount()} {$money->getCurrency()}\n\n";

$processor = new \App\DiscountProcessor([
    new \App\DiscountRule\BooksBySameIssuerRule(),
    new \App\DiscountRule\CartGreaterThanXRule(new \Money\Money(150, new Money\Currency('EUR'))),
]);
$processor->setVerbose(true);

$processor->process($cart);

echo "Discounted total: {$cart->getTotal()->getAmount()} {$money->getCurrency()}\n";
