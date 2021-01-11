<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemesRepository")
 */
class Themes
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
    private $themeId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $themeStoreId;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $previewable;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $processing;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adminGraphqlApiId;

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
    public function getThemeId(): ?string
    {
        return $this->themeId;
    }

    /**
     * @param string|null $themeId
     * @return Themes
     */
    public function setThemeId(?string $themeId): self
    {
        $this->themeId = $themeId;

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
     * @return Themes
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * @return Themes
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
     * @return Themes
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     * @return Themes
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThemeStoreId(): ?string
    {
        return $this->themeStoreId;
    }

    /**
     * @param string|null $themeStoreId
     * @return Themes
     */
    public function setThemeStoreId(?string $themeStoreId): self
    {
        $this->themeStoreId = $themeStoreId;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPreviewable(): ?bool
    {
        return $this->previewable;
    }

    /**
     * @param bool $previewable
     * @return Themes
     */
    public function setPreviewable(?bool $previewable): self
    {
        $this->previewable = $previewable;

        return $this;
    }

    /**
     * @return bool
     */
    public function getProcessing(): ?bool
    {
        return $this->processing;
    }

    /**
     * @param bool $processing
     * @return Themes
     */
    public function setProcessing(?bool $processing): self
    {
        $this->processing = $processing;

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
     * @return Themes
     */
    public function setAdminGraphqlApiId(?string $adminGraphqlApiId): self
    {
        $this->adminGraphqlApiId = $adminGraphqlApiId;

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
     * @return Themes
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
     * @return Themes
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
