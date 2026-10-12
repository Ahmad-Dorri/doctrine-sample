<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches;

use Doctrine\ORM\Mapping as ORM;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\NounGender;
use Bamooz\Simplified\Entity\PartOfSpeeches\Models\NounAnimacy;

#[ORM\Entity]
class Noun extends PartOfSpeech
{
    #[ORM\Column(enumType: NounGender::class)]
    private NounGender $gender;

    public function getGender(): NounGender
    {
        return $this->gender;
    }

    #[ORM\Column(enumType: NounAnimacy::class)]
    private NounAnimacy $animacy;

    public function getAnimacy(): NounAnimacy
    {
        return $this->animacy;
    }


    public function __construct(NounGender $gender, NounAnimacy $animacy)
    {
        $this->animacy = $animacy;
        $this->gender = $gender;
    }
}
