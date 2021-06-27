<?php

namespace Grav\Plugin\ImageComparer\Twig;

use Grav\Common\Config\Config;
use \Grav\Common\Grav;
use Grav\Common\Twig\Twig;
use Twig_SimpleFunction;

class ImageComparerExtension extends \Twig_Extension
{
    /**
     * @var Grav
     */
    protected $grav;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Twig
     */
    protected $twig;

    /**
     * SwiperJSExtension constructor
     */
    public function __construct()
    {
        $this->grav   = Grav::instance();
        $this->config = $this->grav['config'];
    }

    /**
     * Returns extension name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'ImageComparerExtension';
    }

    /**
     * @return Twig_SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new Twig_SimpleFunction('image_comparer', [$this, 'imageComparer']),
        ];
    }

    /**
     * @param string $wrappers_selector
     *
     * @return void
     */
    public function imageComparer(string $wrappers_selector): void
    {
        if ($this->config->get('plugins.image-comparer')['enabled'] === false) {
            return;
        }

        $this->addAssets($wrappers_selector);
    }

    /**
     * @param string $wrappers_selector
     *
     * @return $this
     */
    protected function addAssets(string $wrappers_selector): ImageComparerExtension
    {
        if ($this->config->get('plugins.image-comparer.built_in_js')) {
            $this->grav['assets']->addJs('plugin://image-comparer/assets/js/image-comparer.min.js');
        }

        if ($this->config->get('plugins.image-comparer.built_in_css')) {
            $this->grav['assets']->addCss('plugin://image-comparer/assets/css/image-comparer.min.css');
        }

        $this->grav['assets']->addInlineJs(
            sprintf('imageComparer("%s");', $wrappers_selector),
            ['group' => 'bottom', 'priority' => 35]
        );

        return $this;
    }
}
