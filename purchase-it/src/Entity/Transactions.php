<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionsRepository")
 */
class Transactions
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
    private $transactionId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $payoutId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $payoutStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $net;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceOrderId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceOrderTransactionId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $processedAt;

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
    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    /**
     * @param string|null $transactionId
     * @return Transactions
     */
    public function setTransactionId(?string $transactionId): self
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Transactions
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayoutId(): ?string
    {
        return $this->payoutId;
    }

    /**
     * @param string|null $payoutId
     * @return Transactions
     */
    public function setPayoutId(?string $payoutId): self
    {
        $this->payoutId = $payoutId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayoutStatus(): ?string
    {
        return $this->payoutStatus;
    }

    /**
     * @param string|null $payoutStatus
     * @return Transactions
     */
    public function setPayoutStatus(?string $payoutStatus): self
    {
        $this->payoutStatus = $payoutStatus;

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
     * @return Transactions
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @param string|null $amount
     * @return Transactions
     */
    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFee(): ?string
    {
        return $this->fee;
    }

    /**
     * @param string|null $fee
     * @return Transactions
     */
    public function setFee(?string $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNet(): ?string
    {
        return $this->net;
    }

    /**
     * @param string|null $net
     * @return Transactions
     */
    public function setNet(?string $net): self
    {
        $this->net = $net;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    /**
     * @param string|null $sourceId
     * @return Transactions
     */
    public function setSourceId(?string $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceType(): ?string
    {
        return $this->sourceType;
    }

    /**
     * @param string|null $sourceType
     * @return Transactions
     */
    public function setSourceType(?string $sourceType): self
    {
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceOrderId(): ?string
    {
        return $this->sourceOrderId;
    }

    /**
     * @param string|null $sourceOrderId
     * @return Transactions
     */
    public function setSourceOrderId(?string $sourceOrderId): self
    {
        $this->sourceOrderId = $sourceOrderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceOrderTransactionId(): ?string
    {
        return $this->sourceOrderTransactionId;
    }

    /**
     * @param string|null $sourceOrderTransactionId
     * @return Transactions
     */
    public function setSourceOrderTransactionId(?string $sourceOrderTransactionId): self
    {
        $this->sourceOrderTransactionId = $sourceOrderTransactionId;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processedAt;
    }

    /**
     * @param \DateTime|null $processedAt
     * @return Transactions
     */
    public function setProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;

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
     * @return Transactions
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
     * @return Transactions
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
