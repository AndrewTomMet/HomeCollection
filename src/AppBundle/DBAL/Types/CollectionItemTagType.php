<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CollectionItemTagType extends AbstractEnumType
{
    const TXT   = 'T';
    const AUDIO = 'A';
    const VIDEO = 'V';
    const IMAGE = 'I';

    protected static $choices = [
        self::TXT   => 'текст',
        self::AUDIO => 'аудіо',
        self::VIDEO => 'відео',
        self::IMAGE => 'зображення',
    ];
}
