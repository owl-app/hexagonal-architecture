<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\Symfony;

use Owl\Shared\Domain\Bus\Command\CommandBusInterface;
use Owl\Shared\Domain\Bus\Command\CommandInterface;

abstract class ApiController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    ) {

    }

    protected function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
