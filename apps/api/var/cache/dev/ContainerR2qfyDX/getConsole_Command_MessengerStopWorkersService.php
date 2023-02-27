<?php

namespace ContainerR2qfyDX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Command_MessengerStopWorkersService extends Owl_Apps_Api_ApiKernelDevDebugContainer
{
    /**
     * Gets the private 'console.command.messenger_stop_workers' shared service.
     *
     * @return \Symfony\Component\Messenger\Command\StopWorkersCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 6).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 6).'/vendor/symfony/messenger/Command/StopWorkersCommand.php';

        $container->privates['console.command.messenger_stop_workers'] = $instance = new \Symfony\Component\Messenger\Command\StopWorkersCommand(($container->privates['cache.messenger.restart_workers_signal'] ?? $container->load('getCache_Messenger_RestartWorkersSignalService')));

        $instance->setName('messenger:stop-workers');
        $instance->setDescription('Stop workers after their current message');

        return $instance;
    }
}
