<?php

declare(strict_types=1);

namespace Owl\Article\Domain\Repository;

use Owl\Article\Domain\Model\Article;

interface ArticleRepositoryInterface
{
    public function save(Article $course): void;
}