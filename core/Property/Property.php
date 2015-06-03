<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Property;

/**
 * Provides access to individual properties.
 * @api
 * @since Piwik 3.0.0
 */
class Property extends \Piwik\Site
{

    public function getSetting($name)
    {
        // todo this could be slow as we always recreate settings for each getSetting call, we could just
        // cache that instance similar to $infoSites.
        $settings = new PropertySettings($this->id, $this->getType());
        $setting  = $settings->getSetting($name);

        if (!empty($setting)) {
            return $setting->getValue(); // Calling `getValue` makes sure we respect read permission property
        }
    }
}
