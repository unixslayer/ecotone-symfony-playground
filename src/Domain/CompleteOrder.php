<?php

declare(strict_types=1);

namespace App\Domain;

final class CompleteOrder
{
    public function __construct(public readonly string $orderId)
    {
    }
}
