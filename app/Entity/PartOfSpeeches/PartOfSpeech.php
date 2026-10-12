<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches;

use Bamooz\Simplified\Entity\Translation;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'part_of_speech_type', type: 'string')]
#[ORM\DiscriminatorMap(['noun' => Noun::class, 'verb' => Verb::class])]
abstract class PartOfSpeech
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Translation::class, inversedBy: 'partOfSpeech')]
    #[ORM\JoinColumn(nullable: false)]
    private Translation $translation;

    public function setTranslation(Translation $translation): PartOfSpeech
    {
       $this->translation = $translation;
       return $this;
    }
}
