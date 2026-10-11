<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "words")]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private string $spelling;

    #[ORM\Column]
    private string $pronunciation;

    public function __construct(string $spelling, string $pronunciation)
    {
        $this->spelling = $spelling;
        $this->pronunciation = $pronunciation;
    }
}
