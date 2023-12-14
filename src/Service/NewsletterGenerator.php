<?php

namespace Malefici\TestCi\Service;

use Malefici\TestCi\Entity\Newsletter;

class NewsletterGenerator
{

    public function generateMonthlyNews(): Newsletter
    {
        return (new Newsletter())->setContent('...');
    }
}