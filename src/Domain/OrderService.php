<?php

declare(strict_types=1);

namespace App\Domain;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\CommandHandler;

final class OrderService
{
    public const ASYNCHRONOUS_MESSAGES = 'asynchronous_messages';

    #[CommandHandler()]
    public function placeOrder(PlaceOrder $command): void
    {
        echo "Handling command: ".$command->orderId;
    }

    #[Asynchronous(self::ASYNCHRONOUS_MESSAGES)]
    #[CommandHandler(endpointId: "completeOrder")]
    public function completeOrder(CompleteOrder $command): void
    {
        echo "Handling command: ".$command->orderId;
    }
}
