<?php

declare(strict_types=1);

namespace Owl\Apps\Api\Controller\Article;

use Owl\Article\Application\DataProvider\ArticleSearchDataProvider;
use Owl\Article\Domain\Repository\ArticleRepositoryInterface;
use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParams;
use Owl\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ArticleGetController extends ApiController
{
    public function __construct(
        private readonly ArticleRepositoryInterface $repository,
        private readonly CollectionDataProviderInterface $collectionDataProvider
    ) {
    }


    public function __invoke(Request $request, CollectionRequestParams $collectionRequestParams): JsonResponse
    {
        $this->collectionDataProvider->get($this->repository, new ArticleSearchDataProvider(), $collectionRequestParams);

        return new JsonResponse(
            ['test' => 'test']
        );
    }
}
