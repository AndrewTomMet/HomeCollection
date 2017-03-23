<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CollectionItemStatusType extends AbstractEnumType
{
    const DOWNLOADED = 'D';
    const COLLECTION = 'C';
    const REVISED    = 'V';
    const PASSED     = 'P';
    const WAITING    = 'W';
    const READ       = 'R';

    protected static $choices = [
        self::DOWNLOADED => 'скачаний',
        self::COLLECTION => 'колекційний',
        self::REVISED    => 'переглянутий',
        self::PASSED     => 'пройдено',
        self::WAITING    => 'очікування',
        self::READ       => 'прочитана',
    ];
}
