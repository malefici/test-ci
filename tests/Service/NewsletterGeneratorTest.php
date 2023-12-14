<?php

namespace Malefici\TestCi\Tests\Service;

use Malefici\TestCi\Service\NewsletterGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NewsletterGeneratorTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        // (3) run some service & test the result
        /** @var NewsletterGenerator $newsletterGenerator */
        $newsletterGenerator = $container->get(NewsletterGenerator::class);
        $newsletter = $newsletterGenerator->generateMonthlyNews(/* ... */);

        $this->assertEquals('...', $newsletter->getContent());
    }
}