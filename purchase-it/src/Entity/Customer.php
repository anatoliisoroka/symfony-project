<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomersRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerId;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="customer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
    * @ORM\OneToMany(targetEntity="Orders", mappedBy="customer")
    */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="boolean" ,options={"default":false})
     */
    private $acceptsMarketing;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordersCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalSpent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastOrderId;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $verifiedEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $miltipassIdentifier;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $taxExampt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastOrderName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $addresses = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $acceptsMarketingUpdatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marketingOptInLevel;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $taxExemptions = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adminGraphqlApiId;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $defaultAddress;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $insertByCustomerAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateByCustomerAt;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
 
    /**
     * @param User $user
     * @return Customer
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
 
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    /**
     * @param string|null $customerId
     * @return Customer
     */
    public function setCustomerId(?string $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }
    // /**
    //  * @return Orders
    //  */
    // public function getOrders(): Orders
    // {
    //     return $this->orders;
    // }
 
    // /**
    //  * @param Orders $orders
    //  * @return Customer
    //  */
    // public function setOrders(Orders $orders): self
    // {
    //     $this->orders = $orders;
 
    //     return $this;
    // }

    /**
     * @return bool
     */
    public function getAcceptsMarketing(): ?bool
    {
        return $this->acceptsMarketing;
    }

    /**
     * @param bool $acceptsMarketing
     * @return Customer
     */
    public function setAcceptsMarketing(?bool $acceptsMarketing): self
    {
        $this->acceptsMarketing = $acceptsMarketing;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return Customer
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return Customer
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrdersCount(): ?int
    {
        return $this->ordersCount;
    }

    /**
     * @param string|null $ordersCount
     * @return Customer
     */
    public function setOrdersCount(?int $ordersCount): self
    {
        $this->ordersCount = $ordersCount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return Customer
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalSpent(): ?string
    {
        return $this->totalSpent;
    }

    /**
     * @param string|null $totalSpent
     * @return Customer
     */
    public function setTotalSpent(?string $totalSpent): self
    {
        $this->totalSpent = $totalSpent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastOrderId(): ?string
    {
        return $this->lastOrderId;
    }

    /**
     * @param string|null $lastOrderId
     * @return Customer
     */
    public function setLastOrderId(?string $lastOrderId): self
    {
        $this->lastOrderId = $lastOrderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return Customer
     */
    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return bool
     */
    public function getVerifiedEmail(): ?bool
    {
        return $this->verifiedEmail;
    }

    /**
     * @param bool $verifiedEmail
     * @return Customer
     */
    public function setVerifiedEmail(?bool $verifiedEmail): self
    {
        $this->verifiedEmail = $verifiedEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMiltipassIdentifier(): ?string
    {
        return $this->miltipassIdentifier;
    }

    /**
     * @param string|null $miltipassIdentifier
     * @return Customer
     */
    public function setMiltipassIdentifier(?string $miltipassIdentifier): self
    {
        $this->miltipassIdentifier = $miltipassIdentifier;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTaxExampt(): ?bool
    {
        return $this->taxExampt;
    }

    /**
     * @param bool $taxExampt
     * @return Customer
     */
    public function setTaxExampt(?bool $taxExampt): self
    {
        $this->taxExampt = $taxExampt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Customer
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @param string|null $tags
     * @return Customer
     */
    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastOrderName(): ?string
    {
        return $this->lastOrderName;
    }

    /**
     * @param string|null $lastOrderName
     * @return Customer
     */
    public function setLastOrderName(?string $lastOrderName): self
    {
        $this->lastOrderName = $lastOrderName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return Customer
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAddresses(): ?array
    {
        return $this->addresses;
    }

    /**
     * @param array|null $addresses
     * @return Customer
     */
    public function setAddresses(?array $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getAcceptsMarketingUpdatedAt(): ?\DateTimeInterface
    {
        return $this->acceptsMarketingUpdatedAt;
    }

    /**
     * @param \DateTime|null $acceptsMarketingUpdatedAt
     * @return Customer
     */
    public function setAcceptsMarketingUpdatedAt(?\DateTimeInterface $acceptsMarketingUpdatedAt): self
    {
        $this->acceptsMarketingUpdatedAt = $acceptsMarketingUpdatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMarketingOptInLevel(): ?string
    {
        return $this->marketingOptInLevel;
    }

    /**
     * @param string|null $marketingOptInLevel
     * @return Customer
     */
    public function setMarketingOptInLevel(?string $marketingOptInLevel): self
    {
        $this->marketingOptInLevel = $marketingOptInLevel;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTaxExemptions(): ?array
    {
        return $this->taxExemptions;
    }

    /**
     * @param array|null $taxExemptions
     * @return Customer
     */
    public function setTaxExemptions(?array $taxExemptions): self
    {
        $this->taxExemptions = $taxExemptions;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdminGraphqlApiId(): ?string
    {
        return $this->adminGraphqlApiId;
    }

    /**
     * @param string|null $adminGraphqlApiId
     * @return Customer
     */
    public function setAdminGraphqlApiId(?string $adminGraphqlApiId): self
    {
        $this->adminGraphqlApiId = $adminGraphqlApiId;

        return $this;
    }

    /**
     * @return Object|null
     */
    public function getDefaultAddress(): ?Object
    {
        return $this->defaultAddress;
    }

    /**
     * @param Object|null $defaultAddress
     * @return Customer
     */
    public function setDefaultAddress(?Object $defaultAddress): self
    {
        $this->defaultAddress = $defaultAddress;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getInsertByCustomerAt(): ?\DateTimeInterface
    {
        return $this->insertByCustomerAt;
    }

    /**
     * @param \DateTime|null $insertByCustomerAt
     * @return Customer
     */
    public function setInsertByCustomerAt(?\DateTimeInterface $insertByCustomerAt): self
    {
        $this->insertByCustomerAt = $insertByCustomerAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdateByCustomerAt(): ?\DateTimeInterface
    {
        return $this->updateByCustomerAt;
    }

    /**
     * @param \DateTime|null $updateByCustomerAt
     * @return Customer
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
