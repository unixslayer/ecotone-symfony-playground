<?php

declare(strict_types=1);

namespace App\Domain;

use Ecotone\Modelling\Attribute\NamedEvent;

#[NamedEvent('order.order_was_completed')]
final class OrderWasCompleted
{
    public function __construct(public readonly string $orderId)
    {
    }
}
