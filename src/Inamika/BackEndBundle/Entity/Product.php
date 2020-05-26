<?php

namespace Inamika\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Inamika\BackEndBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"code"}, repositoryMethod="getUniqueNotDeleted")
 * @ExclusionPolicy("all")
 */
class Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32)
     * @Assert\NotBlank()
     * @Expose
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\NotBlank()
     * @Expose
     */
    private $price;
    
    /**
     * @var float
     *
     * @Expose
     */
    private $priceCostoCI;
    /**
     * @var float
     *
     * @Expose
     */
    private $priceCostoSI;
    /**
     * @var float
     *
     * @Expose
     */
    private $priceListaCI;
    /**
     * @var float
     *
     * @Expose
     */
    private $priceListaSI;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Expose
     */
    private $name;
   
    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     * @Expose
     */
    private $description;

    /**
     * @var boolean
     *
     * @Expose
     */
    private $isFavorite=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_delete", type="boolean")
     */
    private $isDelete=false;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return Product
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price.
     *
     * @param float|null $price
     *
     * @return Product
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float|null
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Set priceCostoCI.
     *
     * @param float|null $priceCostoCI
     *
     * @return Product
     */
    public function setPriceCostoCI($priceCostoCI = null)
    {
        $this->priceCostoCI = $priceCostoCI;

        return $this;
    }

    /**
     * Get priceCostoCI.
     *
     * @return float|null
     */
    public function getPriceCostoCI()
    {
        return $this->priceCostoCI;
    }
    
    /**
     * Set priceCostoSI.
     *
     * @param float|null $priceCostoSI
     *
     * @return Product
     */
    public function setPriceCostoSI($priceCostoSI = null)
    {
        $this->priceCostoSI = $priceCostoSI;

        return $this;
    }

    /**
     * Get priceCostoSI.
     *
     * @return float|null
     */
    public function getPriceCostoSI()
    {
        return $this->priceCostoSI;
    }
    
    /**
     * Set priceListaCI.
     *
     * @param float|null $priceListaCI
     *
     * @return Product
     */
    public function setPriceListaCI($priceListaCI = null)
    {
        $this->priceListaCI = $priceListaCI;

        return $this;
    }

    /**
     * Get priceListaCI.
     *
     * @return float|null
     */
    public function getPriceListaCI()
    {
        return $this->priceListaCI;
    }
    
    /**
     * Set priceListaSI.
     *
     * @param float|null $priceListaSI
     *
     * @return Product
     */
    public function setPriceListaSI($priceListaSI = null)
    {
        $this->priceListaSI = $priceListaSI;

        return $this;
    }

    /**
     * Get priceListaSI.
     *
     * @return float|null
     */
    public function getPriceListaSI()
    {
        return $this->priceListaSI;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return Product
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isFavorite.
     *
     * @return bool
     */
    public function getIsFavorite()
    {
        return $this->isFavorite;
    }
    
    /**
     * Set isFavorite.
     *
     * @param bool $isFavorite
     *
     * @return Product
     */
    public function setIsFavorite($isFavorite)
    {
        $this->isFavorite = $isFavorite;

        return $this;
    }

    /**
     * Get isDelete.
     *
     * @return bool
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt=new \DateTime();
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt=new \DateTime();
    }
}
