<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GiftCardsRepository")
 */
class GiftCard
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
    private $giftCardId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $balance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $initialValue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disabledAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lineItemId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apiClientId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expiresOn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $templateSuffix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastCharacters;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderId;

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
     * @return string|null
     */
    public function getGiftCardId(): ?string
    {
        return $this->giftCardId;
    }

    /**
     * @param string|null $giftCardId
     * @return GiftCard
     */
    public function setGiftCardId(?string $giftCardId): self
    {
        $this->giftCardId = $giftCardId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBalance(): ?string
    {
        return $this->balance;
    }

    /**
     * @param string|null $balance
     * @return GiftCard
     */
    public function setBalance(?string $balance): self
    {
        $this->balance = $balance;

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
     * @return GiftCard
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return GiftCard
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
     * @return GiftCard
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInitialValue(): ?string
    {
        return $this->initialValue;
    }

     /**
     * @param string|null $initialValue
     * @return GiftCard
     */
    public function setInitialValue(?string $initialValue): self
    {
        $this->initialValue = $initialValue;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDisabledAt(): ?\DateTimeInterface
    {
        return $this->disabledAt;
    }

    /**
     * @param \DateTime|null $disabledAt
     * @return GiftCard
     */
    public function setDisabledAt(?\DateTimeInterface $disabledAt): self
    {
        $this->disabledAt = $disabledAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLineItemId(): ?string
    {
        return $this->lineItemId;
    }

    /**
     * @param string|null $lineItemId
     * @return GiftCard
     */
    public function setLineItemId(?string $lineItemId): self
    {
        $this->lineItemId = $lineItemId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiClientId(): ?string
    {
        return $this->apiClientId;
    }

    /**
     * @param string|null $apiClientId
     * @return GiftCard
     */
    public function setApiClientId(?string $apiClientId): self
    {
        $this->apiClientId = $apiClientId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param string|null $userId
     * @return GiftCard
     */
    public function setUserId(?string $userId): self
    {
        $this->userId = $userId;

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
     * @return GiftCard
     */
    public function setCustomerId(?string $customerId): self
    {
        $this->customerId = $customerId;

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
     * @return GiftCard
     */
    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpiresOn(): ?string
    {
        return $this->expiresOn;
    }

    /**
     * @param string|null $expiresOn
     * @return GiftCard
     */
    public function setExpiresOn(?string $expiresOn): self
    {
        $this->expiresOn = $expiresOn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTemplateSuffix(): ?string
    {
        return $this->templateSuffix;
    }

    /**
     * @param string|null $templateSuffix
     * @return GiftCard
     */
    public function setTemplateSuffix(?string $templateSuffix): self
    {
        $this->templateSuffix = $templateSuffix;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastCharacters(): ?string
    {
        return $this->lastCharacters;
    }

    /**
     * @param string|null $lastCharacters
     * @return GiftCard
     */
    public function setLastCharacters(?string $lastCharacters): self
    {
        $this->lastCharacters = $lastCharacters;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @param string|null $orderId
     * @return GiftCard
     */
    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;

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
     * @return GiftCard
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
     * @return GiftCard
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
