<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches\Models;

enum VerbComposition: string
{
    case Simple = "simple";
    case Compound = "compound";
    case Derived = "derived";
    case Phrasal = "phrasal";
}
