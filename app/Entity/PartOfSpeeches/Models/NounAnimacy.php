<?php

declare(strict_types=1);

namespace Bamooz\Simplified\Entity\PartOfSpeeches\Models;

enum NounAnimacy: string
{
    case Human = "human";
    case Animal = "animal";
    case Inanimate = "inanimate";
    case Abstract = "abstract";
}
