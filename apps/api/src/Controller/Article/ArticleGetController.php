<?php

declare(strict_types=1);

namespace Owl\Apps\Api\Controller\Article;

use Owl\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ArticleGetController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ['test' => 'test']
        );
    }
}
