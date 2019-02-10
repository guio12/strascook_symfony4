<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeChefRepository")
 * @Vich\Uploadable
 */
class LeChef
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
    private $titre1;

    /**
     * @ORM\Column(type="text")
     */
    private $description1;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image1;

    /**
     * @Vich\UploadableField(mapping="lechef_images", fileNameProperty="image1")
     * @var File
     */
    private $imageFile1;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt1;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre2;

    /**
     * @ORM\Column(type="text")
     */
    private $description2;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image2;

    /**
     * @Vich\UploadableField(mapping="lechef_images", fileNameProperty="image2")
     * @var File
     */
    private $imageFile2;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt2;

    
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre1(): ?string
    {
        return $this->titre1;
    }

    public function setTitre1(string $titre1): self
    {
        $this->titre1 = $titre1;

        return $this;
    }

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }
    
    public function setImageFile1(File $image1 = null)
    {
        $this->imageFile1 = $image1;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image1) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt1 = new \DateTime('now');
        }
    }
    
    public function getImageFile1()
    {
        return $this->imageFile1;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    public function getUpdatedAt1(): ?\DateTimeInterface
    {
        return $this->updatedAt1;
    }

    public function setUpdatedAt1(\DateTimeInterface $updatedAt1): self
    {
        $this->updatedAt1 = $updatedAt1;

        return $this;
    }

    public function getTitre2(): ?string
    {
        return $this->titre2;
    }

    public function setTitre2(string $titre2): self
    {
        $this->titre2 = $titre2;

        return $this;
    }

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): self
    {
        $this->description2 = $description2;

        return $this;
    }

    public function setImageFile2(File $image2 = null)
    {
        $this->imageFile2 = $image2;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image2) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt2 = new \DateTime('now');
        }
    }
    
    public function getImageFile2()
    {
        return $this->imageFile2;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2($image2)
    {
        $this->image2 = $image2;
      
    }

    public function getUpdatedAt2(): ?\DateTimeInterface
    {
        return $this->updatedAt2;
    }

    public function setUpdatedAt2(\DateTimeInterface $updatedAt2): self
    {
        $this->updatedAt2 = $updatedAt2;

        return $this;
    }
   
}
