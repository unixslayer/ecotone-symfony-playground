<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\PlaceOrder;
use Ecotone\Modelling\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'order:place')]
final class PlaceOrderCommand extends Command
{
    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->commandBus->send(new PlaceOrder('1'));

        $output->writeln('');

        return self::SUCCESS;
    }
}
