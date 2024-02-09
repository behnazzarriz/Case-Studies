<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[Vich\Uploadable]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoFileName = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'customer', fileNameProperty: 'logoName', size: 'logoSize')]
    private ?File $logoFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $logoName = null;

    #[ORM\Column(nullable: true)]
    private ?int $logoSize = null;
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    #[ORM\Column(nullable: true)]
    private ?bool $status = false;

    #[ORM\OneToMany(targetEntity: CaseStudy::class, mappedBy: 'customer', cascade: ['persist', 'remove'])]
    private Collection $caseStudies;

    public function __construct()
    {
        $this->caseStudies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }


    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool|null $status
     */
    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Collection<int, CaseStudy>
     */
    public function getCaseStudies(): Collection
    {
        return $this->caseStudies;
    }

    public function addCaseStudy(CaseStudy $caseStudy): static
    {
        if (!$this->caseStudies->contains($caseStudy)) {
            $this->caseStudies->add($caseStudy);
            $caseStudy->setCustomer($this);
        }

        return $this;
    }

    public function removeCaseStudy(CaseStudy $caseStudy): static
    {
        if ($this->caseStudies->removeElement($caseStudy)) {
            // set the owning side to null (unless already changed)
            if ($caseStudy->getCustomer() === $this) {
                $caseStudy->setCustomer(null);
            }
        }

        return $this;
    }

    public function setLogoFile(?File $logoFile = null): void
    {
        $this->logoFile = $logoFile;

        if (null !== $logoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoName(?string $logoName): void
    {
        $this->logoName = $logoName;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    public function setLogoSize(?int $logoSize): void
    {
        $this->logoSize = $logoSize;
    }

    public function getLogoSize(): ?int
    {
        return $this->logoSize;
    }

    /**
     * @return string|null
     */
    public function getLogoFileName(): ?string
    {
        return $this->logoFileName;
    }

    /**
     * @param string|null $logoFileName
     */
    public function setLogoFileName(?string $logoFileName): void
    {
        $this->logoFileName = $logoFileName;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


}
