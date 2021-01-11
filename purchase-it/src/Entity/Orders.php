<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orders",cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $realCustomerId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $closedAt;

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
    private $number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gateway;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtotalPrice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalWeight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalTax;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $taxesIncluded;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $financialStatus;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $confirmed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalDiscounts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalLineItemsPrice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cartToken;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $buyerAcceptsMarketing;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referringSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $landingSite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelledAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cancelReason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalPriceUsd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $checkoutToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locationId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceIdentifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceUrl;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $processedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diviceId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerLocale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $browserIp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $discountApplications = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $discountCodes = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $noteAttributes = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentGatewayNames;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $processingMethod;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $checkoutId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sourceName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullfillmentStatus;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $taxLines = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderStatusUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $presentmentCurrency;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $totalLineItemsPriceSet = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $totalDiscountsSet = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $totalShippingPriceSet = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $subtotalPriceSet = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $totalPriceMoney = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $totalTaxSet = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $lineItems = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $fulfillments = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $refunds = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalTipReceived;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adminGraphqlApiId;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $shippingLines = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $billingAddress = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $shippingAddress = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $clientDetails = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $paymentDetails = [];

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
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @param string|null $orderId
     * @return Orders
     */
    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRealCustomerId(): ?string
    {
        return $this->realCustomerId;
    }

    /**
     * @param string|null $realCustomerId
     * @return Orders
     */
    public function setRealCustomerId(?string $realCustomerId): self
    {
        $this->realCustomerId = $realCustomerId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Orders
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closedAt;
    }

    /**
     * @param \DateTime|null $closedAt
     * @return Orders
     */
    public function setClosedAt(?\DateTimeInterface $closedAt): self
    {
        $this->closedAt = $closedAt;

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
     * @return Orders
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
     * @return Orders
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     * @return Orders
     */
    public function setNumber(?int $number): self
    {
        $this->number = $number;

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
     * @return Orders
     */
    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return Orders
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGateway(): ?string
    {
        return $this->gateway;
    }

    /**
     * @param string|null $gateway
     * @return Orders
     */
    public function setGateway(?string $gateway): self
    {
        $this->gateway = $gateway;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    /**
     * @param string|null $totalPrice
     * @return Orders
     */
    public function setTotalPrice(?string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubtotalPrice(): ?string
    {
        return $this->subtotalPrice;
    }

    /**
     * @param string|null $subtotalPrice
     * @return Orders
     */
    public function setSubtotalPrice(?string $subtotalPrice): self
    {
        $this->subtotalPrice = $subtotalPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalWeight(): ?string
    {
        return $this->totalWeight;
    }

    /**
     * @param string|null $totalWeight
     * @return Orders
     */
    public function setTotalWeight(?string $totalWeight): self
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalTax(): ?string
    {
        return $this->totalTax;
    }

    /**
     * @param string|null $totalTax
     * @return Orders
     */
    public function setTotalTax(?string $totalTax): self
    {
        $this->totalTax = $totalTax;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTaxesIncluded(): ?bool
    {
        return $this->taxesIncluded;
    }

    /**
     * @param bool $taxesIncluded
     * @return Orders
     */
    public function setTaxesIncluded(?bool $taxesIncluded): self
    {
        $this->taxesIncluded = $taxesIncluded;

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
     * @return Orders
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFinancialStatus(): ?string
    {
        return $this->financialStatus;
    }

    /**
     * @param string|null $financialStatus
     * @return Orders
     */
    public function setFinancialStatus(?string $financialStatus): self
    {
        $this->financialStatus = $financialStatus;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     * @return Orders
     */
    public function setConfirmed(?bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalDiscounts(): ?string
    {
        return $this->totalDiscounts;
    }

    /**
     * @param string|null $totalDiscounts
     * @return Orders
     */
    public function setTotalDiscounts(?string $totalDiscounts): self
    {
        $this->totalDiscounts = $totalDiscounts;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalLineItemsPrice(): ?string
    {
        return $this->totalLineItemsPrice;
    }

    /**
     * @param string|null $totalLineItemsPrice
     * @return Orders
     */
    public function setTotalLineItemsPrice(?string $totalLineItemsPrice): self
    {
        $this->totalLineItemsPrice = $totalLineItemsPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCartToken(): ?string
    {
        return $this->cartToken;
    }

    /**
     * @param string|null $cartToken
     * @return Orders
     */
    public function setCartToken(?string $cartToken): self
    {
        $this->cartToken = $cartToken;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBuyerAcceptsMarketing(): ?bool
    {
        return $this->buyerAcceptsMarketing;
    }

    /**
     * @param bool $buyerAcceptsMarketing
     * @return Orders
     */
    public function setBuyerAcceptsMarketing(?bool $buyerAcceptsMarketing): self
    {
        $this->buyerAcceptsMarketing = $buyerAcceptsMarketing;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Orders
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferringSite(): ?string
    {
        return $this->referringSite;
    }

    /**
     * @param string|null $referringSite
     * @return Orders
     */
    public function setReferringSite(?string $referringSite): self
    {
        $this->referringSite = $referringSite;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLandingSite(): ?string
    {
        return $this->landingSite;
    }

    /**
     * @param string|null $landingSite
     * @return Orders
     */
    public function setLandingSite(?string $landingSite): self
    {
        $this->landingSite = $landingSite;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCancelledAt(): ?\DateTimeInterface
    {
        return $this->cancelledAt;
    }

    /**
     * @param \DateTime|null $cancelledAt
     * @return Orders
     */
    public function setCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $this->cancelledAt = $cancelledAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCancelReason(): ?string
    {
        return $this->cancelReason;
    }

    /**
     * @param string|null $cancelReason
     * @return Orders
     */
    public function setCancelReason(?string $cancelReason): self
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalPriceUsd(): ?string
    {
        return $this->totalPriceUsd;
    }

    /**
     * @param string|null $totalPriceUsd
     * @return Orders
     */
    public function setTotalPriceUsd(?string $totalPriceUsd): self
    {
        $this->totalPriceUsd = $totalPriceUsd;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheckoutToken(): ?string
    {
        return $this->checkoutToken;
    }

    /**
     * @param string|null $checkoutToken
     * @return Orders
     */
    public function setCheckoutToken(?string $checkoutToken): self
    {
        $this->checkoutToken = $checkoutToken;

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
     * @return Orders
     */
    public function setUserId(?string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocationId(): ?string
    {
        return $this->locationId;
    }

    /**
     * @param string|null $locationId
     * @return Orders
     */
    public function setLocationId(?string $locationId): self
    {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceIdentifier(): ?string
    {
        return $this->sourceIdentifier;
    }

    /**
     * @param string|null $sourceIdentifier
     * @return Orders
     */
    public function setSourceIdentifier(?string $sourceIdentifier): self
    {
        $this->sourceIdentifier = $sourceIdentifier;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceUrl(): ?string
    {
        return $this->sourceUrl;
    }

    /**
     * @param string|null $sourceUrl
     * @return Orders
     */
    public function setSourceUrl(?string $sourceUrl): self
    {
        $this->sourceUrl = $sourceUrl;

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
     * @return Orders
     */
    public function setProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiviceId(): ?string
    {
        return $this->diviceId;
    }

    /**
     * @param string|null $diviceId
     * @return Orders
     */
    public function setDiviceId(?string $diviceId): self
    {
        $this->diviceId = $diviceId;

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
     * @return Orders
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerLocale(): ?string
    {
        return $this->customerLocale;
    }

    /**
     * @param string|null $customerLocale
     * @return Orders
     */
    public function setCustomerLocale(?string $customerLocale): self
    {
        $this->customerLocale = $customerLocale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppId(): ?string
    {
        return $this->appId;
    }

    /**
     * @param string|null $appId
     * @return Orders
     */
    public function setAppId(?string $appId): self
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBrowserIp(): ?string
    {
        return $this->browserIp;
    }

    /**
     * @param string|null $browserIp
     * @return Orders
     */
    public function setBrowserIp(?string $browserIp): self
    {
        $this->browserIp = $browserIp;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    /**
     * @param int|null $orderNumber
     * @return Orders
     */
    public function setOrderNumber(?int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDiscountApplications(): ?array
    {
        return $this->discountApplications;
    }

    /**
     * @param array|null $discountApplications
     * @return Orders
     */
    public function setDiscountApplications(?array $discountApplications): self
    {
        $this->discountApplications = $discountApplications;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDiscountCodes(): ?array
    {
        return $this->discountCodes;
    }

    /**
     * @param array|null $discountCodes
     * @return Orders
     */
    public function setDiscountCodes(?array $discountCodes): self
    {
        $this->discountCodes = $discountCodes;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getNoteAttributes(): ?array
    {
        return $this->noteAttributes;
    }

    /**
     * @param array|null $noteAttributes
     * @return Orders
     */
    public function setNoteAttributes(?array $noteAttributes): self
    {
        $this->noteAttributes = $noteAttributes;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentGatewayNames(): ?string
    {
        return $this->paymentGatewayNames;
    }

    /**
     * @param string|null $paymentGatewayNames
     * @return Orders
     */
    public function setPaymentGatewayNames(?string $paymentGatewayNames): self
    {
        $this->paymentGatewayNames = $paymentGatewayNames;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProcessingMethod(): ?string
    {
        return $this->processingMethod;
    }

    /**
     * @param string|null $processingMethod
     * @return Orders
     */
    public function setProcessingMethod(?string $processingMethod): self
    {
        $this->processingMethod = $processingMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCheckoutId(): ?string
    {
        return $this->checkoutId;
    }

    /**
     * @param string|null $checkoutId
     * @return Orders
     */
    public function setCheckoutId(?string $checkoutId): self
    {
        $this->checkoutId = $checkoutId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceName(): ?string
    {
        return $this->sourceName;
    }

    /**
     * @param string|null $sourceName
     * @return Orders
     */
    public function setSourceName(?string $sourceName): self
    {
        $this->sourceName = $sourceName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullfillmentStatus(): ?string
    {
        return $this->fullfillmentStatus;
    }

    /**
     * @param string|null $fullfillmentStatus
     * @return Orders
     */
    public function setFullfillmentStatus(?string $fullfillmentStatus): self
    {
        $this->fullfillmentStatus = $fullfillmentStatus;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTaxLines(): ?array
    {
        return $this->taxLines;
    }

    /**
     * @param array|null $taxLines
     * @return Orders
     */
    public function setTaxLines(?array $taxLines): self
    {
        $this->taxLines = $taxLines;

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
     * @return Orders
     */
    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    /**
     * @param string|null $contactEmail
     * @return Orders
     */
    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderStatusUrl(): ?string
    {
        return $this->orderStatusUrl;
    }

    /**
     * @param string|null $orderStatusUrl
     * @return Orders
     */
    public function setOrderStatusUrl(?string $orderStatusUrl): self
    {
        $this->orderStatusUrl = $orderStatusUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPresentmentCurrency(): ?string
    {
        return $this->presentmentCurrency;
    }

    /**
     * @param string|null $presentmentCurrency
     * @return Orders
     */
    public function setPresentmentCurrency(?string $presentmentCurrency): self
    {
        $this->presentmentCurrency = $presentmentCurrency;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getTotalLineItemsPriceSet(): ?object
    {
        return $this->totalLineItemsPriceSet;
    }

    /**
     * @param object|null $totalLineItemsPriceSet
     * @return Orders
     */
    public function setTotalLineItemsPriceSet(?object $totalLineItemsPriceSet): self
    {
        $this->totalLineItemsPriceSet = $totalLineItemsPriceSet;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getTotalDiscountsSet(): ?object
    {
        return $this->totalDiscountsset;
    }

    /**
     * @param object|null $totalDiscountsSet
     * @return Orders
     */
    public function setTotalDiscountsSet(?object $totalDiscountsSet): self
    {
        $this->totalDiscountsSet = $totalDiscountsSet;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getTotalShippingPriceSet(): ?object
    {
        return $this->totalShippingPriceSet;
    }

    /**
     * @param object|null $totalShippingPriceSet
     * @return Orders
     */
    public function setTotalShippingPriceSet(?object $totalShippingPriceSet): self
    {
        $this->totalShippingPriceSet = $totalShippingPriceSet;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getSubtotalPriceSet(): ?object
    {
        return $this->subtotalPriceSet;
    }

    /**
     * @param object|null $subtotalPriceSet
     * @return Orders
     */
    public function setSubtotalPriceSet(?object $subtotalPriceSet): self
    {
        $this->subtotalPriceSet = $subtotalPriceSet;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getTotalPriceMoney(): ?object
    {
        return $this->totalPriceMoney;
    }

    /**
     * @param object|null $totalPriceMoney
     * @return Orders
     */
    public function setTotalPriceMoney(?object $totalPriceMoney): self
    {
        $this->totalPriceMoney = $totalPriceMoney;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getTotalTaxSet(): ?object
    {
        return $this->totalTaxSet;
    }

    /**
     * @param object|null $totalTaxSet
     * @return Orders
     */
    public function setTotalTaxSet(?object $totalTaxSet): self
    {
        $this->totalTaxSet = $totalTaxSet;

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
     * @return Orders
     */
    public function setLineItems(?array $lineItems): self
    {
        $this->lineItems = $lineItems;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getFulfillments(): ?array
    {
        return $this->fulfillments;
    }

    /**
     * @param array|null $fulfillments
     * @return Orders
     */
    public function setFulfillments(?array $fulfillments): self
    {
        $this->fulfillments = $fulfillments;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRefunds(): ?array
    {
        return $this->refunds;
    }

    /**
     * @param array|null $refunds
     * @return Orders
     */
    public function setRefunds(?array $refunds): self
    {
        $this->refunds = $refunds;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTotalTipReceived(): ?string
    {
        return $this->totalTipReceived;
    }

    /**
     * @param string|null $totalTipReceived
     * @return Orders
     */
    public function setTotalTipReceived(?string $totalTipReceived): self
    {
        $this->totalTipReceived = $totalTipReceived;

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
     * @return Orders
     */
    public function setAdminGraphqlApiId(?string $adminGraphqlApiId): self
    {
        $this->adminGraphqlApiId = $adminGraphqlApiId;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getShippingLines(): ?array
    {
        return $this->shippingLines;
    }

    /**
     * @param array|null $shippingLines
     * @return Orders
     */
    public function setShippingLines(?array $shippingLines): self
    {
        $this->shippingLines = $shippingLines;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getBillingAddress(): ?object
    {
        return $this->billingAddress;
    }

    /**
     * @param object|null $billingAddress
     * @return Orders
     */
    public function setBillingAddress(?object $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getShippingAddress(): ?object
    {
        return $this->shippingAddress;
    }

    /**
     * @param object|null $shippingAddress
     * @return Orders
     */
    public function setShippingAddress(?object $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getClientDetails(): ?object
    {
        return $this->clientDetails;
    }

    /**
     * @param object|null $clientDetails
     * @return Orders
     */
    public function setClientDetails(?object $clientDetails): self
    {
        $this->clientDetails = $clientDetails;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getPaymentDetails(): ?object
    {
        return $this->paymentDetails;
    }

    /**
     * @param object|null $paymentDetails
     * @return Orders
     */
    public function setPaymentDetails(?object $paymentDetails): self
    {
        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
 
    /**
     * @param Customer $customer
     * @return Orders
     */
    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
 
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
     * @return Orders
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
     * @return Orders
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
