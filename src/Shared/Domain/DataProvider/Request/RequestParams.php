<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Request;

class RequestParams implements RequestParamsInterface
{
    protected array $parameters;

    protected array $query;

    public function __construct(array $parameters, array $query)
    {
        $this->parameters = $parameters;
        $this->query = $query;
    }

    /**
     * @return array|string|null
     */
    public function getRepositoryMethod()
    {
        if (!isset($this->parameters['repository'])) {
            return null;
        }

        $repository = $this->parameters['repository'];

        return is_array($repository) ? $repository['method'] : $repository;
    }

    /**
     * @return array
     */
    public function getRepositoryArguments()
    {
        if (!isset($this->parameters['repository'])) {
            return [];
        }

        $repository = $this->parameters['repository'];

        if (!isset($repository['arguments'])) {
            return [];
        }

        return is_array($repository['arguments']) ? $repository['arguments'] : [$repository['arguments']];
    }
}
