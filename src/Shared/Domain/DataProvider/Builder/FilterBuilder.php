<?php

 namespace Owl\Shared\Domain\DataProvider\Builder;

use Owl\Shared\Domain\DataProvider\Exception\InvalidArgumentException;
use Owl\Shared\Domain\DataProvider\Filter\FilterInterface;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;

class FilterBuilder implements FilterBuilderInterface
{
    /**
     * The children of the form builder.
     *
     * @var FilterInterface[]
     */
    private $children = [];

    /**
     * The data of children who haven't been converted services.
     *
     * @var array
     */
    private $unresolvedChildren = [];

    public function __construct(private readonly FilterRegistryInterface $registry)
    {
    }

    public function add(string $name = null, string $filter, string|array $fields = null, array $options = []): self
    {
        if(is_null($fields)) {
            $filterFields = [$name];
        } else {
            $filterFields = is_string($fields) ? [$fields] : $fields;
        }

        $this->children[$name] = null;
        $this->unresolvedChildren[$name] = [$filter, $filterFields, $options];

        return $this;
    }

    public function get($name)
    {
        if (isset($this->unresolvedChildren[$name])) {
            $this->resolveChildren();
        }

        if (isset($this->children[$name])) {
            return $this->children[$name];
        }

        throw new InvalidArgumentException(sprintf('The child with the name "%s" does not exist.', $name));
    }

    public function remove($name)
    {
        unset($this->unresolvedChildren[$name], $this->children[$name]);

        return $this;
    }

    public function has($name)
    {
        return isset($this->unresolvedChildren[$name]) || isset($this->children[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $this->resolveChildren();

        return $this->children;
    }

    /**
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return \count($this->children);
    }

    public function countUnresolved()
    {
        return \count($this->unresolvedChildren);
    }

    /**
     * Converts all unresolved children into registered service.
     */
    private function resolveChildren()
    {
        if($this->countUnresolved() > 0) {
            foreach($this->unresolvedChildren as $name => $info) {
                $classFilter = $this->registry->get($info[0]);
                /**
                 * @var FilterInterface $filterService
                 */
                $filterService = new $classFilter;
                $filterService->setName($name);
                $filterService->setFields($info[1]);
                $filterService->setOptions($info[2]);
                $filterService->buildFilter($this);

                $this->children[$name] = $filterService;

                unset($this->unresolvedChildren[$name]);

                $this->resolveChildren();
            }
        }
    }
}
