<?php

namespace Malefici\TestCi\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Malefici\TestCi\Entity\Newsletter;

class NewsletterFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $newsletter = new Newsletter();
        $newsletter->setTitle('Title');
        $newsletter->setContent(<<<MARKDOWN
# Hello

This is fixture
MARKDOWN
);
        $manager->persist($newsletter);

        $manager->flush();
    }
}
