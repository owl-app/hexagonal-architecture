<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\Symfony;

use Owl\Shared\Domain\Aggregate\AggregateRoot;
use Owl\Shared\Domain\Bus\Command\CommandBusInterface;
use Owl\Shared\Domain\Bus\Command\CommandInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

abstract class ApiController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly SerializerInterface $serializer
    ) {

    }

    protected function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }

    protected function responseJson(mixed $data): JsonResponse
    {
        return (new JsonResponse)::fromJsonString($this->serializer->serialize($data, 'json', [
                AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true
            ])
        );
    }
}
