<?php

namespace Fg\Bundle\ConfigBundle\Twig\Extension;

use Fg\Bundle\ConfigBundle\Entity\Setting;
use Fg\Bundle\ConfigBundle\Service\SettingService;

class ConfigTemplateExtension extends \Twig_Extension {

    /**
     * @var SettingService $settingService
     */
    protected $settingService;

    /**
     * @inheritdoc
     *
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getFunctions() {
        return array(
            'get_setting' => new \Twig_Function_Method($this, 'getSetting'),
            'get_setting_value' => new \Twig_Function_Method($this, 'getSettingValue')
        );
    }

    /**
     * @param $name
     * @param bool $scopeGroupType
     * @param bool $section
     * @param bool $scopeById
     * @return mixed
     */
    public function getSetting($name, $scopeGroupType = false, $section = false, $scopeById = false)
    {
        /** @var Setting $setting */
        $setting = $this->settingService->getSettingByScope($name, $scopeGroupType, $section, $scopeById);

        return is_object($setting) ? $setting : null;
    }

    public function getSettingValue($name, $scopeGroupType = false, $section = false, $scopeById = false)
    {
        /** @var Setting $setting */
        $setting = $this->settingService->getSettingByScope($name, $scopeGroupType, $section, $scopeById);

        return is_object($setting) ? $setting->getValue() : null;
    }


    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getName()
    {
        return 'fg_config_extension';
    }
}
