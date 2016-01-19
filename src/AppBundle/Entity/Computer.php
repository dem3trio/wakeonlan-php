<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Computer
 *
 * @ORM\Table(name="computer")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Computer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=255)
     */
    private $mac;

    /**
     * @var integer
     *
     * @ORM\Column(name="port", type="integer")
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="broadcast_ip", type="string", length=255)
     */
    private $broadcastIp;

    /**
     * @var string
     *
     * @ORM\Column(name="ping_ip", type="string", length=255, nullable=true)
     */
    private $pingIp;

    /**
     * @var string
     *
     * @ORM\Column(name="ping_port", type="integer", nullable=true)
     */
    private $pingPort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    public function __construct()
    {
        $this->setBroadcastIp('255.255.255.255');
        $this->setPort(9);
    }

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
     * Set name
     *
     * @param string $name
     * @return Computer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mac
     *
     * @param string $mac
     * @return Computer
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string 
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return Computer
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set broadcastIp
     *
     * @param string $broadcastIp
     * @return Computer
     */
    public function setBroadcastIp($broadcastIp)
    {
        $this->broadcastIp = $broadcastIp;

        return $this;
    }

    /**
     * Get broadcastIp
     *
     * @return string 
     */
    public function getBroadcastIp()
    {
        return $this->broadcastIp;
    }

    /**
     * Set pingIp
     *
     * @param string $pingIp
     * @return Computer
     */
    public function setPingIp($pingIp)
    {
        $this->pingIp = $pingIp;

        return $this;
    }

    /**
     * Get pingIp
     *
     * @return string 
     */
    public function getPingIp()
    {
        return $this->pingIp;
    }

    /**
     * Set pingPort
     *
     * @param string $pingPort
     * @return Computer
     */
    public function setPingPort($pingPort)
    {
        $this->pingPort = $pingPort;

        return $this;
    }

    /**
     * Get pingPort
     *
     * @return string 
     */
    public function getPingPort()
    {
        return $this->pingPort;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Computer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Computer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
