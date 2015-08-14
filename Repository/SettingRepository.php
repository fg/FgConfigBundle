<?php namespace Fg\Bundle\ConfigBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fg\Bundle\ConfigBundle\Entity\Setting;

class SettingRepository extends EntityRepository
{
    public function getSettingByScope(
        $name,
        $scopeGroupType = Setting::SCOPE_GROUP_TYPE_GENERAL,
        $section = Setting::SECTION_GENERAL,
        $scopeById = 0
    )
    {
        $query = $this->_em->createQuery("
            SELECT
                s
            FROM FgConfigBundle:Setting s
            WHERE s.name = :NAME AND s.scopeGroupType = :SCOPE_GROUP_TYPE AND s.section = :SECTION_NAME AND(
              (s.scopeById IS NOT NULL OR s.scopeById > 0) OR s.scopeById = :SCOPE_BY_ID
            )
        ");

        $query
            ->setParameter(':NAME', $name)
            ->setParameter(':SCOPE_GROUP_TYPE', $scopeGroupType)
            ->setParameter(':SECTION_NAME', $section)
            ->setParameter(':SCOPE_BY_ID', $scopeById)
        ;

        return $query->getOneOrNullResult();
    }
}