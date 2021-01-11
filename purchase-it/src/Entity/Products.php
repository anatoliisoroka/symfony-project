<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productionId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vendor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $productCreatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $handle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $productUpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $productPublishedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publishedScope;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adminGraphqlApiId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $variantsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $optionsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $optionsName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $optionsValues;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

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
     * @return string
     */
    public function getProductionId(): ?string
    {
        return $this->productionId;
    }

    /**
     * @param string $productionId
     * @return Products
     */
    public function setProductionId(string $productionId): self
    {
        $this->productionId = $productionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Products
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    /**
     * @param string|null $vendor
     * @return Products
     */
    public function setVendor(?string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductType(): ?string
    {
        return $this->productType;
    }

    /**
     * @param string|null $productType
     * @return Products
     */
    public function setProductType(?string $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getProductCreatedAt(): ?\DateTimeInterface
    {
        return $this->productCreatedAt;
    }

    /**
     * @param \DateTime|null $productCreatedAt
     * @return Products
     */
    public function setProductCreatedAt(?\DateTimeInterface $productCreatedAt): self
    {
        $this->productCreatedAt = $productCreatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHandle(): ?string
    {
        return $this->handle;
    }

    /**
     * @param string|null $handle
     * @return Products
     */
    public function setHandle(?string $handle): self
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getProductUpdatedAt(): ?\DateTimeInterface
    {
        return $this->productUpdatedAt;
    }

    /**
     * @param \DateTime|null $productUpdatedAt
     * @return Products
     */
    public function setProductUpdatedAt(?\DateTimeInterface $productUpdatedAt): self
    {
        $this->productUpdatedAt = $productUpdatedAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getProductPublishedAt(): ?\DateTimeInterface
    {
        return $this->productPublishedAt;
    }

    /**
     * @param \DateTime|null $productPublishedAt
     * @return Products
     */
    public function setProductPublishedAt(?\DateTimeInterface $productPublishedAt): self
    {
        $this->productPublishedAt = $productPublishedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublishedScope(): ?string
    {
        return $this->publishedScope;
    }

    /**
     * @param string|null $publishedScope
     * @return Products
     */
    public function setPublishedScope(?string $publishedScope): self
    {
        $this->publishedScope = $publishedScope;

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
     * @return Products
     */
    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

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
     * @return Products
     */
    public function setAdminGraphqlApiId(?string $adminGraphqlApiId): self
    {
        $this->adminGraphqlApiId = $adminGraphqlApiId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVariantsId(): ?string
    {
        return $this->variantsId;
    }

    /**
     * @param string|null $variantsId
     * @return Products
     */
    public function setVariantsId(?string $variantsId): self
    {
        $this->variantsId = $variantsId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOptionsId(): ?string
    {
        return $this->optionsId;
    }

    /**
     * @param string $optionsId
     * @return Products
     */
    public function setOptionsId(string $optionsId): self
    {
        $this->optionsId = $optionsId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOptionsName(): ?string
    {
        return $this->optionsName;
    }

    /**
     * @param string $optionsName
     * @return Products
     */
    public function setOptionsName(string $optionsName): self
    {
        $this->optionsName = $optionsName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return Products
     */
    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOptionsValues(): ?string
    {
        return $this->optionsValues;
    }

    /**
     * @param string|null $optionsValues
     * @return Products
     */
    public function setOptionsValues(?string $optionsValues): self
    {
        $this->optionsValues = $optionsValues;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImages(): ?string
    {
        return $this->images;
    }

    /**
     * @param string|null $images
     * @return Products
     */
    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Products
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

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
