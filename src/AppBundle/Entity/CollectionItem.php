<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Collection
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CollectionItemRepository")
 * @ORM\Table(name="collection_items")
 */
class CollectionItem
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * тип колекціі (фільм книжка гра)
     * @ORM\ManyToOne(targetEntity="CollectionType")
     */
    private $collectionType;
    /**
     * тип ітема (серіал, кремінал, комедія) (онлайн, офлайн)
     * @ORM\ManyToMany(targetEntity="ItemType", indexBy="collectionItems")
     * @ORM\JoinTable(name="itemtype_collection")
     */
    private $itemType;
    /**
     * Англійска назва
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank(message = "nameEng.not_blank")
     */
    private $nameEng;
    /**
     * назва на укр якщо є
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nameUkr;
    /**
     * рік створення
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 1900,
     *      max = 3000,
     *      minMessage = "Не меньше ніж {{ limit }}",
     *      maxMessage = "Не більше ніж {{ limit }}"
     * )
     */
    private $year;
    /**
     * розширення (для фільмів)
     * @ORM\ManyToOne(targetEntity="Resolution")
     */
    private $resolution;
    /**
     * біт рейт (для фільмів)
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bitrate;
    /**
     * переводи
     * @ORM\ManyToMany(targetEntity="Translation", indexBy="collectionItems")
     * @ORM\JoinTable(name="translation_collection")
     */
    private $translation;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pathLocal;
    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Url()
     */
    private $pathDownload;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionOfficial;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionMy;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $createdAt;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ratingOwn;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ratingImgb;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ratingKinopoisk;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="collectionItems")
     */
    private $user;
    /**
     * флаг подивився, виграв, прочитав
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $completed;
    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $completedAt;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     */
    private $image;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemType = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nameEng
     *
     * @param string $nameEng
     *
     * @return CollectionItem
     */
    public function setNameEng($nameEng)
    {
        $this->nameEng = $nameEng;

        return $this;
    }

    /**
     * Get nameEng
     *
     * @return string
     */
    public function getNameEng()
    {
        return $this->nameEng;
    }

    /**
     * Set nameUkr
     *
     * @param string $nameUkr
     *
     * @return CollectionItem
     */
    public function setNameUkr($nameUkr)
    {
        $this->nameUkr = $nameUkr;

        return $this;
    }

    /**
     * Get nameUkr
     *
     * @return string
     */
    public function getNameUkr()
    {
        return $this->nameUkr;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return CollectionItem
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set bitrate
     *
     * @param integer $bitrate
     *
     * @return CollectionItem
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;

        return $this;
    }

    /**
     * Get bitrate
     *
     * @return integer
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * Set pathLocal
     *
     * @param string $pathLocal
     *
     * @return CollectionItem
     */
    public function setPathLocal($pathLocal)
    {
        $this->pathLocal = $pathLocal;

        return $this;
    }

    /**
     * Get pathLocal
     *
     * @return string
     */
    public function getPathLocal()
    {
        return $this->pathLocal;
    }

    /**
     * Set pathDownload
     *
     * @param string $pathDownload
     *
     * @return CollectionItem
     */
    public function setPathDownload($pathDownload)
    {
        $this->pathDownload = $pathDownload;

        return $this;
    }

    /**
     * Get pathDownload
     *
     * @return string
     */
    public function getPathDownload()
    {
        return $this->pathDownload;
    }

    /**
     * Set descriptionOfficial
     *
     * @param string $descriptionOfficial
     *
     * @return CollectionItem
     */
    public function setDescriptionOfficial($descriptionOfficial)
    {
        $this->descriptionOfficial = $descriptionOfficial;

        return $this;
    }

    /**
     * Get descriptionOfficial
     *
     * @return string
     */
    public function getDescriptionOfficial()
    {
        return $this->descriptionOfficial;
    }

    /**
     * Set descriptionMy
     *
     * @param string $descriptionMy
     *
     * @return CollectionItem
     */
    public function setDescriptionMy($descriptionMy)
    {
        $this->descriptionMy = $descriptionMy;

        return $this;
    }

    /**
     * Get descriptionMy
     *
     * @return string
     */
    public function getDescriptionMy()
    {
        return $this->descriptionMy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CollectionItem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ratingOwn
     *
     * @param string $ratingOwn
     *
     * @return CollectionItem
     */
    public function setRatingOwn($ratingOwn)
    {
        $this->ratingOwn = $ratingOwn;

        return $this;
    }

    /**
     * Get ratingOwn
     *
     * @return string
     */
    public function getRatingOwn()
    {
        return $this->ratingOwn;
    }

    /**
     * Set ratingImgb
     *
     * @param string $ratingImgb
     *
     * @return CollectionItem
     */
    public function setRatingImgb($ratingImgb)
    {
        $this->ratingImgb = $ratingImgb;

        return $this;
    }

    /**
     * Get ratingImgb
     *
     * @return string
     */
    public function getRatingImgb()
    {
        return $this->ratingImgb;
    }

    /**
     * Set ratingKinopoisk
     *
     * @param string $ratingKinopoisk
     *
     * @return CollectionItem
     */
    public function setRatingKinopoisk($ratingKinopoisk)
    {
        $this->ratingKinopoisk = $ratingKinopoisk;

        return $this;
    }

    /**
     * Get ratingKinopoisk
     *
     * @return string
     */
    public function getRatingKinopoisk()
    {
        return $this->ratingKinopoisk;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return CollectionItem
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set completedAt
     *
     * @param \DateTime $completedAt
     *
     * @return CollectionItem
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * Get completedAt
     *
     * @return \DateTime
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return CollectionItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set collectionType
     *
     * @param \AppBundle\Entity\CollectionType $collectionType
     *
     * @return CollectionItem
     */
    public function setCollectionType(\AppBundle\Entity\CollectionType $collectionType = null)
    {
        $this->collectionType = $collectionType;

        return $this;
    }

    /**
     * Get collectionType
     *
     * @return \AppBundle\Entity\CollectionType
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Add itemType
     *
     * @param \AppBundle\Entity\ItemType $itemType
     *
     * @return CollectionItem
     */
    public function addItemType(\AppBundle\Entity\ItemType $itemType)
    {
        $this->itemType[] = $itemType;

        return $this;
    }

    /**
     * Remove itemType
     *
     * @param \AppBundle\Entity\ItemType $itemType
     */
    public function removeItemType(\AppBundle\Entity\ItemType $itemType)
    {
        $this->itemType->removeElement($itemType);
    }

    /**
     * Get itemType
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * Set resolution
     *
     * @param \AppBundle\Entity\Resolution $resolution
     *
     * @return CollectionItem
     */
    public function setResolution(\AppBundle\Entity\Resolution $resolution = null)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get resolution
     *
     * @return \AppBundle\Entity\Resolution
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Add translation
     *
     * @param \AppBundle\Entity\Translation $translation
     *
     * @return CollectionItem
     */
    public function addTranslation(\AppBundle\Entity\Translation $translation)
    {
        $this->translation[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\Translation $translation
     */
    public function removeTranslation(\AppBundle\Entity\Translation $translation)
    {
        $this->translation->removeElement($translation);
    }

    /**
     * Get translation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return CollectionItem
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
