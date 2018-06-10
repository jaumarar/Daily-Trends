<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChannelRepository")
 * @ORM\Table(name="channel")
 */
class Channel
{

    const PULL_ENABLED = 1;
    const PULL_DISABLED = 0;

    const ACCESS_AVAILABLE = 1;
    const ACCESS_UNAVAILABLE = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     *
     * @var \DateTime|null
     * @ORM\Column(name="updatedDate", type="datetime", nullable=true)
     */
    private $updatedDate;
    /**
     *
     *
     * @var \DateTime
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;
    /**
     *
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;
    /**
     *
     *
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=90)
     */
    private $url;
    /**
     *
     *
     * @var int
     *
     * @ORM\Column(name="pull_state", type="smallint")
     */
    private $pullState;
    /**
     *
     *
     * @var int
     *
     * @ORM\Column(name="access_state", type="smallint")
     */
    private $accessState;
    /**
     *
     *
     * @var \DateTime
     * @ORM\Column(name="lastPullDate", type="datetime", nullable=true)
     */
    private $lastPullDate;


    public function __construct($name, $url)
    {
        $this->setName($name);
        $this->setUrl($url);
        $this->createdDate = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param \DateTime|null $updatedDate
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getPullState()
    {
        return $this->pullState;
    }

    /**
     * @param int $pullState
     */
    public function setPullState($pullState)
    {
        $this->pullState = $pullState;
    }

    /**
     * @return int
     */
    public function getAccessState()
    {
        return $this->accessState;
    }

    /**
     * @param int $accessState
     */
    public function setAccessState($accessState)
    {
        $this->accessState = $accessState;
    }

    /**
     * @return \DateTime
     */
    public function getLastPullDate()
    {
        return $this->lastPullDate;
    }

    /**
     * @param \DateTime $lastPullDate
     */
    public function setLastPullDate($lastPullDate)
    {
        $this->lastPullDate = $lastPullDate;
    }
}