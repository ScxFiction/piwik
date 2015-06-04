<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Property;

use Exception;
use Piwik\Site;

/**
 * Provides access to individual properties.
 */
class Property extends Site
{

    public function getSettingValue($name)
    {
        $settings = new PropertySettings($this->id, $this->getType());
        $setting  = $settings->getSetting($name);

        if (!empty($setting)) {
            return $setting->getValue(); // Calling `getValue` makes sure we respect read permission property
        }

        throw new Exception(sprintf('Setting %s does not exist', $name));
    }
}
