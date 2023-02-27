<?php

declare(strict_types=1);

namespace Owl\Apps\Api\Controller\Article;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ArticleGetController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ['test' => 'test']
        );
    }
}
