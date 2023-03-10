<?php

declare(strict_types=1);

namespace Owl\Apps\Api\Controller\Article;

use Owl\Article\Application\DataProvider\ArticleSearchDataProvider;
use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParams;
use Owl\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Owl\Article\Domain\Model\Article;

final class ArticleGetController extends ApiController
{
    public function __construct(
        private readonly CollectionDataProviderInterface $collectionDataProvider
    ) {
    }


    public function __invoke(Request $request, CollectionRequestParams $collectionRequestParams): JsonResponse
    {
        $data = $this->collectionDataProvider->get(Article::class, new ArticleSearchDataProvider(), $collectionRequestParams);

        return new JsonResponse(
            ['test' => 'test']
        );
    }
}
