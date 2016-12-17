<?php

namespace App;

use Money\Money;

interface ItemInterface
{
    public function getPrice(): Money;
}
