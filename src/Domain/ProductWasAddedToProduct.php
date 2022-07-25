<?php

declare(strict_types=1);

namespace App\Domain;

use Ecotone\Modelling\Attribute\NamedEvent;

#[NamedEvent('order.product_was_added')]
final class ProductWasAddedToProduct
{
    public function __construct(public readonly string $orderId, public readonly string $productName)
    {
    }
}
