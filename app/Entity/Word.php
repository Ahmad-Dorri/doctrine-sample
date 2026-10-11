<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "words")]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column]
    private string $spelling;

    public function getSpelling(): string
    {
        return $this->spelling;
    }

    #[ORM\Column]
    private string $pronunciation;

    public function getPronunciation(): string
    {
        return $this->pronunciation;
    }

    /** @var Collection<int, Translation> */
    #[ORM\OneToMany(targetEntity: Translation::class, mappedBy: 'word')]
    private Collection $translations;

    public function addTranslation(Translation $translation): Word
    {
        $translation->setWord($this);
        $this->translations->add($translation);
        return $this;
    }

    public function __construct(string $spelling, string $pronunciation)
    {
        $this->spelling = $spelling;
        $this->pronunciation = $pronunciation;
        $this->translations = new ArrayCollection();
    }
}
