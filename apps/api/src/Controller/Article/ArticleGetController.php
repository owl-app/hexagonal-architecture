<?php

declare(strict_types=1);

namespace Owl\Apps\Api\Controller\Article;

use Owl\Article\Domain\DataProvider\ArticleSearchDataProviderInterface;
use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParams;
use Owl\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Owl\Article\Domain\Model\Article;
use Owl\Article\Infrastructure\DataProvider\ArticleSearchDataProviderCopy;
use Owl\Shared\Domain\Bus\Command\CommandBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class ArticleGetController extends ApiController
{
    public function __construct(
        private readonly CollectionDataProviderInterface $collectionDataProvider,
        private readonly ArticleSearchDataProviderInterface $articleSearchDataProvider,
        private readonly CommandBusInterface $commandBus,
        private readonly SerializerInterface $serializer
    ) {
        parent::__construct($commandBus, $serializer);
    }


    public function __invoke(Request $request, CollectionRequestParams $collectionRequestParams): JsonResponse
    {
        $data2 = $this->collectionDataProvider->get(Article::class, new ArticleSearchDataProviderCopy(), $collectionRequestParams);

        $data = $this->collectionDataProvider->get(Article::class, $this->articleSearchDataProvider, $collectionRequestParams);

        return $this->responseJson($data);
    }
}
