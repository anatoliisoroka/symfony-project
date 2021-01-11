<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CollectionRepository")
 */
class Collection
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
    private $collectionId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $handle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productUpdatedDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bodyHtml;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sortOrder;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productsCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $collectionType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publishedScope;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $insertAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedBycustomerAt;

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
    public function getCollectionId(): ?string
    {
        return $this->collectionId;
    }

    /**
     * @param string|null $collectionId
     * @return Collection
     */
    public function setCollectionId(?string $collectionId): self
    {
        $this->collectionId = $collectionId;

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
     * @return Collection
     */
    public function setHandle(?string $handle): self
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Collection
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductUpdatedDate(): ?string
    {
        return $this->productUpdatedDate;
    }

    /**
     * @param string $productUpdatedDate
     * @return Collection
     */
    public function setProductUpdatedDate(string $productUpdatedDate): self
    {
        $this->productUpdatedDate = $productUpdatedDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBodyHtml(): ?string
    {
        return $this->bodyHtml;
    }

    /**
     * @param string|null $bodyHtml
     * @return Collection
     */
    public function setBodyHtml(?string $bodyHtml): self
    {
        $this->bodyHtml = $bodyHtml;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     * @return Collection
     */
    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortOrder(): ?string
    {
        return $this->sortOrder;
    }

    /**
     * @param string|null $sortOrder
     * @return Collection
     */
    public function setSortOrder(?string $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductsCount(): ?int
    {
        return $this->productsCount;
    }

    /**
     * @param int|null $productsCount
     * @return Collection
     */
    public function setProductsCount(?int $productsCount): self
    {
        $this->productsCount = $productsCount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCollectionType(): ?string
    {
        return $this->collectionType;
    }

    /**
     * @param string|null $collectionType
     * @return Collection
     */
    public function setCollectionType(?string $collectionType): self
    {
        $this->collectionType = $collectionType;

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
     * @return Collection
     */
    public function setPublishedScope(?string $publishedScope): self
    {
        $this->publishedScope = $publishedScope;

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
     * @return Collection
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getInsertAt(): ?\DateTimeInterface
    {
        return $this->insertAt;
    }

    /**
     * @param \DateTime $insertAt
     * @return Collection
     */
    public function setInsertAt(?\DateTimeInterface $insertAt): self
    {
        $this->insertAt = $insertAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedBycustomerAt(): ?\DateTimeInterface
    {
        return $this->updatedBycustomerAt;
    }

    /**
     * @param \DateTime $updatedBycustomerAt
     * @return Collection
     */
    public function setUpdatedBycustomerAt(?\DateTimeInterface $updatedBycustomerAt): self
    {
        $this->updatedBycustomerAt = $updatedBycustomerAt;

        return $this;
    }
}
