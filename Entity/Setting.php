<?php

namespace Fg\Bundle\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table(name="fg_config_bundle")
 * @ORM\Entity(repositoryClass="Fg\Bundle\ConfigBundle\Repository\SettingRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Setting
{
    const SCOPE_GROUP_TYPE_USER = 'user';
    const SCOPE_GROUP_TYPE_GENERAL = 'general';
    const SCOPE_GROUP_TYPE_USER_GROUP = 'user_group';

    const SECTION_GENERAL = 'general';
    const SECTION_INFORMATION = 'information';
    const SECTION_USER_PROFILE = 'user_profile';

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type = "integer", name = "id")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type = "string", length = 32, name = "scope_group_type")
     */
    protected $scopeGroupType = self::SCOPE_GROUP_TYPE_GENERAL;

    /**
     * @var string
     *
     * @ORM\Column(type = "integer", name = "scope_by_id", nullable = true)
     */
    protected $scopeById = 0;

    /**
     * @var string
     *
     * @ORM\Column(type = "string", length = 32, name = "section")
     */
    protected $section;

    /**
     * @var string
     *
     * @ORM\Column(type = "string", name="name")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type = "string", name="value")
     */
    protected $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type = "datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type = "datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * @inheritdoc
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate() {
        $this->updatedAt= new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getScopeGroupType()
    {
        return $this->scopeGroupType;
    }

    /**
     * @param string $scopeGroupType
     */
    public function setScopeGroupType($scopeGroupType)
    {
        $this->scopeGroupType = $scopeGroupType;
    }

    /**
     * @return string
     */
    public function getScopeById()
    {
        return $this->scopeById;
    }

    /**
     * @param string $scopeById
     */
    public function setScopeById($scopeById)
    {
        $this->scopeById = $scopeById;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param string $section
     */
    public function setSection($section)
    {
        $this->section = $section;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
