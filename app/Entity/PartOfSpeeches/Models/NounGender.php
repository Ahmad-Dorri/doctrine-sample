<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches\Models;

enum NounGender: string
{
    case Feminine = "feminine";
    case Masculine = "masculine";
    case Neuter = "neuter";
}
