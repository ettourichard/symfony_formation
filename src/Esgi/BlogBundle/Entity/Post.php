<?php

namespace Esgi\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation as Serializer;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Esgi\BlogBundle\Repository\PostRepository")
 */
class Post
{

    /**
     * The category of this post
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Serializer\Exclude
     */
    private $category;

    /**
     * The Author of this post
     * @var Author
     * @ORM\ManyToOne(targetEntity="\Esgi\UserBundle\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * @Serializer\Exclude
     */
    private $author;

    /**
     * The posts associated to this category
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @Serializer\Expose
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Expose
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublished", type="boolean")
     */
    private $isPublished = false;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var activeComment
     *
     * @ORM\Column(name="activeComment", type="boolean")
     */
    private $activeComment;


    /**
    * @var string
    *
    * @Gedmo\Slug(fields={"title"}, updatable=false, separator="-")
    * @ORM\Column(name="slug", type="string", length=255)
    */
    private $slug;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Post
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($title)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $slug->slug;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set category
     *
     * @param \Esgi\BlogBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\Esgi\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Esgi\BlogBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add comments
     *
     * @param \Esgi\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\Esgi\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Esgi\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Esgi\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set activeComment
     *
     * @param boolean $activeComment
     * @return Post
     */
    public function setActiveComment($activeComment)
    {
        $this->activeComment = $activeComment;

        return $this;
    }

    /**
     * Get activeComment
     *
     * @return boolean 
     */
    public function getActiveComment()
    {
        return $this->activeComment;
    }

    /**
     * Set author
     *
     * @param \Esgi\UserBundle\Entity\User $author
     * @return Post
     */
    public function setAuthor(\Esgi\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Esgi\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
