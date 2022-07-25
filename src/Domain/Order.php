<?php

declare(strict_types=1);

namespace App\Domain;

use Ecotone\EventSourcing\Attribute\AggregateType;
use Ecotone\EventSourcing\Attribute\Stream;
use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateVersioning;

#[EventSourcingAggregate]
#[Stream(self::STREAM)]
#[AggregateType(self::AGGREGATE_TYPE)]
final class Order
{
    use WithAggregateVersioning;

    public const ASYNCHRONOUS_MESSAGES = 'asynchronous_messages';
    public const STREAM = 'order';
    public const AGGREGATE_TYPE = 'order';

    #[AggregateIdentifier]
    private string $orderId;

    #[CommandHandler]
    public static function placeOrder(PlaceOrder $command): array
    {
        return [new OrderWasPlaced($command->orderId)];
    }

    #[Asynchronous(self::ASYNCHRONOUS_MESSAGES)]
    #[CommandHandler(endpointId: "completeOrder")]
    public function completeOrder(CompleteOrder $command): array
    {
        return [new OrderWasCompleted($command->orderId)];
    }

    #[CommandHandler(routingKey: "addProduct")]
    public function addProduct(AddProduct $command): array
    {
        return [new ProductWasAddedToProduct($command->orderId, $command->productName)];
    }

    #[EventSourcingHandler]
    public function applyOrderWasPlaced(OrderWasPlaced $event): void
    {
        $this->orderId = $event->orderId;
    }
}
