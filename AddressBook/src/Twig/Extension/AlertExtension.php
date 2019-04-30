<?php

namespace App\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AlertExtension extends AbstractExtension
{
    /** @var FlashBagInterface */
    protected $flashBag;

    /** @var Environment */
    protected $env;

    /**
     * AlertExtension constructor.
     * @param FlashBagInterface $flashBag
     * @param Environment $env
     */
    public function __construct(FlashBagInterface $flashBag, Environment $env)
    {
        $this->flashBag = $flashBag;
        $this->env = $env;
    }


    protected function escape($string)
    {
        return twig_escape_filter($this->env, $string);
    }


    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            // new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('flashAlert', [$this, 'flashAlert'], ['is_safe' => ['html']]),
            new TwigFunction('alert', [$this, 'alert'], ['is_safe' => ['html']]),
        ];
    }

    public function alert($msg, $type = 'success')
    {
        if (!in_array($type, ['success', 'warning', 'danger', 'info', 'primary', 'secondary', 'light', 'dark'])) {
            throw new \Exception('Twig alert function, unknown type');
        }

        $msg = $this->escape($msg);

        return "<div class=\"alert alert-$type\">$msg</div>";
    }

    public function flashAlert($type = 'success')
    {
        $html = '';

        foreach ($this->flashBag->get($type) as $msg) {
            $html .= $this->alert($msg, $type);
        }

        return $html;
    }
}
