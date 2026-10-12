<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches;

use Doctrine\ORM\Mapping as ORM;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\VerbComposition;

#[ORM\Entity]
class Verb extends PartOfSpeech
{
    #[ORM\Column(enumType: VerbComposition::class)]
    private VerbComposition $composition;

    public function getComposition(): VerbComposition
    {
        return $this->composition;
    }

    #[ORM\Column]
    private string $pastForm;

    public function getPastForm(): string
    {
        return $this->pastForm;
    }

    #[ORM\Column]
    private string $presentForm;

    public function getPresentForm(): string
    {
        return $this->presentForm;
    }

    public function __construct(VerbComposition $composition, string $pastForm, string $presentForm)
    {
        $this->composition = $composition;
        $this->pastForm = $pastForm;
        $this->presentForm = $presentForm;
    }
}
