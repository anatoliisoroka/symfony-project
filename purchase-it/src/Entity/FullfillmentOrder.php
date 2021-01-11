<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FullfillmentOrderRepository")
 */
class FullfillmentOrder
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
    private $fullfillmentId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shopId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $assignedLocationId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fulfillmentServiceHandle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $requestStatus;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $supportedActions = [];

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $destination;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $lineItems = [];

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $assignedLocation;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $merchantRequests = [];

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
    public function getFullfillmentId(): ?string
    {
        return $this->fullfillmentId;
    }

    /**
     * @param string|null $fullfillmentId
     * @return FullfillmentOrder
     */
    public function setFullfillmentId(?string $fullfillmentId): self
    {
        $this->fullfillmentId = $fullfillmentId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShopId(): ?string
    {
        return $this->shopId;
    }

    /**
     * @param string|null $shopId
     * @return FullfillmentOrder
     */
    public function setShopId(?string $shopId): self
    {
        $this->shopId = $shopId;

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
     * @return FullfillmentOrder
     */
    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAssignedLocationId(): ?string
    {
        return $this->assignedLocationId;
    }

    /**
     * @param string|null $assignedLocationId
     * @return FullfillmentOrder
     */
    public function setAssignedLocationId(?string $assignedLocationId): self
    {
        $this->assignedLocationId = $assignedLocationId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFulfillmentServiceHandle(): ?string
    {
        return $this->fulfillmentServiceHandle;
    }

    /**
     * @param string|null $fulfillmentServiceHandle
     * @return FullfillmentOrder
     */
    public function setFulfillmentServiceHandle(?string $fulfillmentServiceHandle): self
    {
        $this->fulfillmentServiceHandle = $fulfillmentServiceHandle;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestStatus(): ?string
    {
        return $this->requestStatus;
    }

    /**
     * @param string|null $requestStatus
     * @return FullfillmentOrder
     */
    public function setRequestStatus(string $requestStatus): self
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSupportedActions(): ?array
    {
        return $this->supportedActions;
    }

    /**
     * @param array|null $supportedActions
     * @return FullfillmentOrder
     */
    public function setSupportedActions(?array $supportedActions): self
    {
        $this->supportedActions = $supportedActions;

        return $this;
    }

    /**
     * @return Object|null
     */
    public function getDestination(): ?Object
    {
        return $this->destination;
    }

    /**
     * @param Object|null $destination
     * @return FullfillmentOrder
     */
    public function setDestination(?Object $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getLineItems(): ?array
    {
        return $this->lineItems;
    }

    /**
     * @param array|null $lineItems
     * @return FullfillmentOrder
     */
    public function setLineItems(?array $lineItems): self
    {
        $this->lineItems = $lineItems;

        return $this;
    }

    /**
     * @return Object|null
     */
    public function getAssignedLocation(): Object
    {
        return $this->assignedLocation;
    }

    /**
     * @param Object|null $assignedLocation
     * @return FullfillmentOrder
     */
    public function setAssignedLocation(?Object $assignedLocation): self
    {
        $this->assignedLocation = $assignedLocation;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getMerchantRequests(): ?array
    {
        return $this->merchantRequests;
    }

    /**
     * @param array|null $merchantRequests
     * @return FullfillmentOrder
     */
    public function setMerchantRequests(?array $merchantRequests): self
    {
        $this->merchantRequests = $merchantRequests;

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
     * @return FullfillmentOrder
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
     * @return FullfillmentOrder
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
