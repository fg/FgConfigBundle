<?php

namespace Fg\Bundle\ConfigBundle\Service;

use Doctrine\ORM\EntityManager;
use Fg\Bundle\ConfigBundle\Entity\Setting;

class SettingService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var \Fg\Bundle\ConfigBundle\Repository\SettingRepository
     */
    protected $repository;

    /**
     * @inheritdoc
     *
     * @param EntityManager $entityManager
     * @param $entityName
     */
    public function __construct(EntityManager $entityManager, $entityName)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($entityName);
    }

    /**
     * Return setting collection from db
     *
     * @param $name
     * @param bool $scopeGroupType
     * @param bool $section
     * @param bool $scopeById
     * @return mixed
     */
    public function getSettingByScope($name, $scopeGroupType = false, $section = false, $scopeById = false)
    {
        return $this->repository->getSettingByScope($name, $scopeGroupType, $section, $scopeById);
    }

    /**
     * @param $name
     * @param $value
     * @param $scopeGroupType
     * @param $section
     * @param int $scopeById
     *
     * @return Setting
     */
    public function create($name, $value, $scopeGroupType, $section, $scopeById = 0)
    {
        $setting = new Setting();
        $setting->setName($name);
        $setting->setValue($value);
        $setting->setSection($section);
        $setting->setScopeGroupType($scopeGroupType);
        $setting->setScopeById($scopeById);

        $this->entityManager->persist($setting);
        $this->entityManager->flush($setting);

        return $setting;
    }
}