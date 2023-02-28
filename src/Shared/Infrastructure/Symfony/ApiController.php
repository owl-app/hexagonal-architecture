<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\Symfony;

use Owl\Shared\Domain\Bus\Command\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\HandleTrait;

abstract class ApiController
{
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    protected function handleCommand(CommandInterface $command): void
    {
        $this->handle($command);
    }
}
