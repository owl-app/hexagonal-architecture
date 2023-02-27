<?php

declare(strict_types=1);

namespace Owl\Article\Domain\Model;

final class Article
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $description
    ) {
    }

    public static function fromPrimitives(array $primitives): Article
    {
        return new self($primitives['id'], $primitives['title'], $primitives['description']);
    }

    public function toPrimitives(): array
    {
        return [
            'id'       => $this->id,
            'title'     => $this->title,
            'description' => $this->description,
        ];
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}
