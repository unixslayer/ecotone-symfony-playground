<?php

declare(strict_types=1);

namespace App\Command;

use App\Domain\AddProduct;
use Ecotone\Modelling\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'order:add')]
final class AddProductCommand extends \Symfony\Component\Console\Command\Command
{
    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->commandBus->sendWithRouting('addProduct', new AddProduct('1', 'Milk'));

        $output->writeln('');

        return self::SUCCESS;
    }
}
