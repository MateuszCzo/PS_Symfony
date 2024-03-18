<?php

namespace SymfonyModule\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class YoutubeComment
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_product_comment", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @var int
     *
     * @ORM\Column(name="id_product", type="integer")
     */
    private ?int $productId = null;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_name", type="string", length=64)
     */
    private ?string $customerName = null;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64)
     */
    private ?string $title = null;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private ?string $content = null;

    /**
     * @var int
     *
     * @ORM\Column(name="grade", type="integer")
     */
    private ?int $grade = null;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     *
     * @return ProductComment
     */
    public function setProductId(?string $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     *
     * @return ProductComment
     */
    public function setCustomerName(?string $customerName): self
    {
        $this->customerName = $customerName;

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
     *
     * @return ProductComment
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return ProductComment
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int
     */
    public function getGrade(): ?int
    {
        return $this->grade;
    }

    /**
     * @param int $grade
     *
     * @return ProductComment
     */
    public function setGrade(?int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): ?array
    {
        return [
            'id_product' => $this->getProductId(),
            'id_product_comment' => $this->getId(),
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'customer_name' => $this->getCustomerName(),
            'grade' => $this->getGrade(),
        ];
    }
}
