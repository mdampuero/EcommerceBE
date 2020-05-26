<?php

namespace Inamika\BackEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="Inamika\BackEndBundle\Repository\CustomerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, repositoryMethod="getUniqueNotDeleted")
 */
class Customer
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="document", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $document;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_seller", type="boolean")
     */
    private $isSeller=false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="provence", type="string", length=255, nullable=true)
     */
    private $provence;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observations", type="string", length=255, nullable=true)
     */
    private $observations;

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
     * @return Customer
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
     * Set document.
     *
     * @param string|null $document
     *
     * @return Customer
     */
    public function setDocument($document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document.
     *
     * @return string|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Customer
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set isSeller.
     *
     * @param bool $isSeller
     *
     * @return Customer
     */
    public function setIsSeller($isSeller)
    {
        $this->isSeller = $isSeller;

        return $this;
    }

    /**
     * Get isSeller.
     *
     * @return bool
     */
    public function getIsSeller()
    {
        return $this->isSeller;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return Customer
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Customer
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set provence.
     *
     * @param string|null $provence
     *
     * @return Customer
     */
    public function setProvence($provence = null)
    {
        $this->provence = $provence;

        return $this;
    }

    /**
     * Get provence.
     *
     * @return string|null
     */
    public function getProvence()
    {
        return $this->provence;
    }

    /**
     * Set observations.
     *
     * @param string|null $observations
     *
     * @return Customer
     */
    public function setObservations($observations = null)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations.
     *
     * @return string|null
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Customer
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
     * @return Customer
     */
    public function setUpdateAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return Customer
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

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
