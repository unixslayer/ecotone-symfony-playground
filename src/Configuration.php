<?php

declare(strict_types=1);

namespace App;

use App\Domain\Order;
use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

final class Configuration
{
    #[ServiceContext]
    public function getDbalConfiguration(): DbalConfiguration
    {
        return DbalConfiguration::createWithDefaults()
            ->withTransactionOnCommandBus(isTransactionEnabled: false)
        ;
    }

    #[ServiceContext]
    public function enableMessageChannel(): DbalBackedMessageChannelBuilder
    {
        return DbalBackedMessageChannelBuilder::create(Order::ASYNCHRONOUS_MESSAGES);
    }
}
