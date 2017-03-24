<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use AppBundle\DBAL\Types\CollectionItemTagType;

/**
 * Class CollectionType
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CollectionTypeRepository")
 * @ORM\Table(name="collection_types")
 */
class CollectionType
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "collectionType.name.not_blank")
     */
    private $name;

    /**
     * флаг статусу елемента
     * @ORM\Column(type="CollectionItemTagType", nullable=false)
     * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\CollectionItemTagType")
     */
    private $type;

    /**
     * @return CollectionItemTagType | null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param CollectionItemTagType $type
     * @return CollectionType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTypeReadable()
    {
        return CollectionItemTagType::getReadableValue($this->getType());
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CollectionType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
