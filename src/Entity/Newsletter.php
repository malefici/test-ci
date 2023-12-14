<?php

namespace Malefici\TestCi\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Malefici\TestCi\Repository\NewsletterRepository;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

//    #[ORM\Column]
//    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    public function __construct()
    {
//        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

//    public function getCreatedAt(): DateTimeImmutable
//    {
//        return $this->createdAt;
//    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
