<?php

declare(strict_types=1);

namespace App\Domain;

final class AddProduct
{
    public function __construct(public readonly string $orderId, public readonly string $productName)
    {
    }
}
