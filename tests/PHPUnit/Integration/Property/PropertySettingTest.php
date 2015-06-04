<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Tests\Integration\Property;

use Piwik\Access;
use Piwik\Property\PropertySetting;
use Piwik\Settings\Storage;
use Piwik\Tests\Framework\Mock\FakeAccess;
use Piwik\Tests\Framework\TestCase\IntegrationTestCase;

/**
 * @group Core
 */
class PropertySettingTest extends IntegrationTestCase
{

    private function createSetting()
    {
        $setting = new PropertySetting('name', 'test');
        $storage = new Storage('test');
        $setting->setStorage($storage);
        return $setting;
    }

    public function test_setValue_getValue_shouldSucceed_IfEnoughPermission()
    {
        $setting = $this->createSetting();
        $setting->setValue('test');
        $value = $setting->getValue();

        $this->assertSame('test', $value);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage CoreAdminHome_PluginSettingChangeNotAllowed
     */
    public function testSetValue_shouldThrowException_IfOnlyViewPermission()
    {
        $access = new FakeAccess();
        $access->setSuperUserAccess(false);
        $access->setIdSitesView(array(1, 2, 3));
        Access::setSingletonInstance($access);
        $this->createSetting()->setValue('test');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage CoreAdminHome_PluginSettingChangeNotAllowed
     */
    public function testSetValue_shouldThrowException_IfNoPermissionAtAll()
    {
        Access::setSingletonInstance(null);
        $this->createSetting()->setValue('test');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage CoreAdminHome_PluginSettingReadNotAllowed
     */
    public function testGetSettingValue_shouldThrowException_IfNoPermissionToRead()
    {
        Access::setSingletonInstance(null);
        $this->createSetting()->getValue();
    }

}
