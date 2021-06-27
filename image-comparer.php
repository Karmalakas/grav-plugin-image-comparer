<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Plugin\ImageComparer\Twig\ImageComparerExtension;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class ImageComparerPlugin
 * @package Grav\Plugin
 */
class ImageComparerPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            $this->enable(
                [
                    'onGetPageTemplates'  => ['onGetPageTemplates', 0],
                    'onGetPageBlueprints' => ['onGetPageBlueprints', 0],
                ]
            );

            return;
        }

        $this->enable(
            [
                'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
                'onTwigExtensions'    => ['onTwigExtensions', 0],
            ]
        );
    }

    /**
     * Add blueprint directory to page templates.
     */
    public function onGetPageTemplates(Event $event): void
    {
        $locator = Grav::instance()['locator'];
        $event->types->scanTemplates($locator->findResource('plugin://' . $this->name . '/templates'));
    }

    /**
     * Extend page blueprints with additional configuration options.
     *
     * @param Event $event
     */
    public function onGetPageBlueprints($event): void
    {
        $locator = Grav::instance()['locator'];
        $event->types->scanBlueprints($locator->findResource('plugin://' . $this->name . '/blueprints'));
    }

    /**
     * Register templates
     *
     * @return void
     */
    public function onTwigTemplatePaths(): void
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * @return void
     */
    public function onTwigExtensions(): void
    {
        $this->grav['twig']->twig->addExtension(new ImageComparerExtension());
    }
}
