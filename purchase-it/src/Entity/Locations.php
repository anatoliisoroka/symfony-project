<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationsRepository")
 */
class Locations
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
    private $locationId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countryCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countryName;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $provinceCode;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $legacy;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $active;

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
    public function getLocationId(): ?string
    {
        return $this->locationId;
    }

    /**
     * @param string|null $locationId
     * @return Locations
     */
    public function setLocationId(?string $locationId): self
    {
        $this->locationId = $locationId;

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
     * @return Locations
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * @param string|null $address1
     * @return Locations
     */
    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string|null $address2
     * @return Locations
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Locations
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * @return Locations
     */
    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     * @return Locations
     */
    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return Locations
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

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
     * @return Locations
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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
     * @return Locations
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
     * @return Locations
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return Locations
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    /**
     * @param string|null $countryName
     * @return Locations
     */
    public function setCountryName(?string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    /**
     * @param string|null $provinceCode
     * @return Locations
     */
    public function setProvinceCode(?string $provinceCode): self
    {
        $this->provinceCode = $provinceCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getLegacy(): ?bool
    {
        return $this->legacy;
    }

    /**
     * @param bool $legacy
     * @return Locations
     */
    public function setLegacy(?bool $legacy): self
    {
        $this->legacy = $legacy;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Locations
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;

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
     * @return Locations
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
     * @return Locations
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
     * @return Locations
     */
    public function setUpdateByCustomerAt(?\DateTimeInterface $updateByCustomerAt): self
    {
        $this->updateByCustomerAt = $updateByCustomerAt;

        return $this;
    }
}
