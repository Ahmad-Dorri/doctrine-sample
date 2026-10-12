<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bamooz\Simplified\Entity\PartOfSpeeches\PartOfSpeech;

#[ORM\Entity]
#[ORM\Table(name: "translations")]
#[ORM\UniqueConstraint(name: "uniq_translation_word_position", columns: ["word_id", "position"])]
class Translation
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
    private string $text;

    public function getText(): string
    {
        return $this->text;
    }

    #[ORM\Column]
    private int $position;

    public function getPosition(): int
    {
        return $this->position;
    }

    #[ORM\ManyToOne(inversedBy: "translations")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Word $word;

    public function setWord(Word $word): Translation
    {
        $this->word = $word;
        return $this;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    #[ORM\OneToOne(targetEntity: PartOfSpeech::class, mappedBy: 'translation', cascade: ['persist', 'remove'])]
    private PartOfSpeech $partOfSpeech;

    public function getPartOfSpeech(): PartOfSpeech
    {
        return $this->partOfSpeech;
    }

    public function __construct(Word $word, string $text, int $position, PartOfSpeech $partOfSpeech)
    {
        $this->word = $word;
        $this->text = $text;
        $this->position = $position;
        $this->partOfSpeech = $partOfSpeech;
        $this->partOfSpeech->setTranslation($this);
    }
}
