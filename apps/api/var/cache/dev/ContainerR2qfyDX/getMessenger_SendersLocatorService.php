<?php

namespace ContainerR2qfyDX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMessenger_SendersLocatorService extends Owl_Apps_Api_ApiKernelDevDebugContainer
{
    /**
     * Gets the private 'messenger.senders_locator' shared service.
     *
     * @return \Symfony\Component\Messenger\Transport\Sender\SendersLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 6).'/vendor/symfony/messenger/Transport/Sender/SendersLocatorInterface.php';
        include_once \dirname(__DIR__, 6).'/vendor/symfony/messenger/Transport/Sender/SendersLocator.php';

        return $container->privates['messenger.senders_locator'] = new \Symfony\Component\Messenger\Transport\Sender\SendersLocator([], ($container->privates['messenger.retry_strategy_locator'] ??= new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [], [])));
    }
}
