<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\MobileAppType;

use Piwik\Property\PropertySetting;
use Piwik\Property\PropertySettings;

class Type extends \Piwik\Type\Type
{
    const ID = 'mobileapp';
    protected $name = 'MobileAppType_MobileApp';
    protected $namePlural = 'MobileAppType_MobileApps';
    protected $description = 'MobileAppType_MobileAppDescription';
    protected $howToSetupUrl = 'http://developer.piwik.org/api-reference/tracking-api'; // todo we need a dedicated page for that

    public function configurePropertySettings(PropertySettings $settings)
    {
        $appId = new PropertySetting('app_id', 'App-ID');
        $settings->addSetting($appId);
    }

}

