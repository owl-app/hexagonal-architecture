<?php

namespace ContainerR2qfyDX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getArticleGetControllerService extends Owl_Apps_Api_ApiKernelDevDebugContainer
{
    /**
     * Gets the public 'Owl\Apps\Api\Controller\Article\ArticleGetController' shared autowired service.
     *
     * @return \Owl\Apps\Api\Controller\Article\ArticleGetController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Controller/Article/ArticleGetController.php';

        return $container->services['Owl\\Apps\\Api\\Controller\\Article\\ArticleGetController'] = new \Owl\Apps\Api\Controller\Article\ArticleGetController();
    }
}
