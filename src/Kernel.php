<?php

namespace Malefici\TestCi;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Malefici\TestCi\DependencyInjection\AppExtension;
use Malefici\TestCi\Service\NewsletterGenerator;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
//        echo 1; exit;
        $bundles = [
            new FrameworkBundle(),
            new TwigBundle(),
            new DoctrineBundle(),
            new DoctrineMigrationsBundle(),
            new MakerBundle(),
        ];

//        var_dump($this->getEnvironment()); exit;

        if ('dev' === $this->getEnvironment()) {
            $bundles[] = new WebProfilerBundle();
//            $bundles[] = new MakerBundle();
        }

        return $bundles;
    }

    protected function build(ContainerBuilder $container): void
    {
        $container->registerExtension(new AppExtension());
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import(__DIR__.'/../config/*');

        // register all classes in /src/ as service
        $container->services()
            ->load('Malefici\\TestCi\\', __DIR__.'/*')
            ->public() // for tests
            ->autowire()
            ->autoconfigure()
        ;

        // configure WebProfilerBundle only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $container->extension('web_profiler', [
                'toolbar' => true,
                'intercept_redirects' => false,
            ]);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // import the WebProfilerRoutes, only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
            $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');
        }

        // load the routes defined as PHP attributes
        // (use 'annotation' as the second argument if you define routes as annotations)
        $routes->import(__DIR__.'/Controller/', 'attribute');
    }

    // optional, to use the standard Symfony cache directory
    public function getCacheDir(): string
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    // optional, to use the standard Symfony logs directory
    public function getLogDir(): string
    {
        return __DIR__.'/../var/log';
    }
}