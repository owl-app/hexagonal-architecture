<?php

 namespace Owl\Shared\Infrastructure\DataProvider\Orm;

use Owl\Shared\Domain\DataProvider\Exception\InvalidArgumentException;
use Owl\Shared\Domain\DataProvider\Filter\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Filter\FilterInterface;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;

class FilterBuilder implements FilterBuilderInterface
{
    /**
     * The children of the form builder.
     *
     * @var FormBuilderInterface[]
     */
    private $children = [];

    /**
     * The data of children who haven't been converted services.
     *
     * @var array
     */
    private $unresolvedChildren = [];

    private ?string $path;

    public function __construct(private readonly FilterRegistryInterface $registry)
    {
    }

    public function add(?string $path = null, string $filter, array $options = [])
    {
        $this->children[$filter] = null;
        $this->unresolvedChildren[$filter] = [$path, $options];

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
        return \count($this->children);
    }

    /**
     * Converts all unresolved children into registered service.
     */
    private function resolveChildren()
    {
        if($this->countUnresolved() > 0) {
            foreach($this->unresolvedChildren as $name => $info) {
                /**
                 * @var FilterInterface $filterService
                 */
                $filterService = $this->registry->get($name);
                if($info[0]) {
                    $filterService->setPath($info[0]);
                }
                $filterService->setOptions($info[1]);
                $filterService->buildFilter($this);

                $this->children[$name] = $filterService;

                unset($this->unresolvedChildren[$name]);

                $this->resolveChildren();
            }
        }
    }
}
