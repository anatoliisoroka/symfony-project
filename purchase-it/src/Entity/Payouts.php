<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PayoutsRepository")
 */
class Payouts
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
    private $payoutId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $currency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $summary;

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
    public function getPayoutId(): ?string
    {
        return $this->payoutId;
    }

    /**
     * @param string|null $payoutId
     * @return Payouts
     */
    public function setPayoutId(?string $payoutId): self
    {
        $this->payoutId = $payoutId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Payouts
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     * @return Payouts
     */
    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Payouts
     */
    public function setCurrency(string $currency): self
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
     * @return Payouts
     */
    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getSummary(): ?object
    {
        return $this->summary;
    }

    /**
     * @param object|null $summary
     * @return Payouts
     */
    public function setSummary(?object $summary): self
    {
        $this->summary = $summary;

        return $this;
    }
}
