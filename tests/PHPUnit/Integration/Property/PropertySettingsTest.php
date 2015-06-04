<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Tests\Integration\Property;

use Piwik\Access;
use Piwik\Db;
use Piwik\Plugins\MobileAppType\Type as MobileAppType;
use Piwik\Plugins\SitesManager\Model as SitesManagerModel;
use Piwik\Property\Property;
use Piwik\Property\PropertySetting;
use Piwik\Property\PropertySettings;
use Piwik\Tests\Framework\Fixture;
use Piwik\Tests\Framework\TestCase\IntegrationTestCase;

/**
 * @group Core
 */
class PropertySettingsTest extends IntegrationTestCase
{
    private $idSite = 1;

    /**
     * @var PropertySettings
     */
    private $settings;

    public function setUp()
    {
        parent::setUp();

        if (!Fixture::siteCreated($this->idSite)) {
            Fixture::createWebsite('2015-01-01 00:00:00');
            $model = new SitesManagerModel();
            $model->updateSite(array('type' => MobileAppType::ID), $this->idSite);
        }

        $this->settings = $this->createSettings();
    }

    public function test_init_shouldAddSettingsFromType()
    {
        $this->assertNotEmpty($this->settings->getSetting('app_id'));
    }

    public function test_save_shouldActuallyStoreValues()
    {
        $this->settings->getSetting('test2')->setValue('value2');
        $this->settings->getSetting('test3')->setValue('value3');

        $this->assertStoredSettingsValue(null, 'test2');
        $this->assertStoredSettingsValue(null, 'test3');

        $this->settings->save();

        $this->assertStoredSettingsValue('value2', 'test2');
        $this->assertStoredSettingsValue('value3', 'test3');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage General_ExceptionPrivilegeAccessWebsite
     */
    public function test_save_shouldCheckAdminPermissionsForThatSite()
    {
        Access::setSingletonInstance(null);

        $this->settings->save();
    }

    private function createSettings()
    {
        $settings = new PropertySettings($this->idSite, MobileAppType::ID);
        $settings->addSetting($this->createSetting('test2'));
        $settings->addSetting($this->createSetting('test3'));

        return $settings;
    }

    private function createSetting($name)
    {
        return new PropertySetting($name, $name . ' Name');
    }

    private function assertStoredSettingsValue($expectedValue, $settingName)
    {
        $settings = $this->createSettings();
        $value    = $settings->getSetting($settingName)->getValue();

        $this->assertSame($expectedValue, $value);
    }
}
