<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Property;

use Piwik\Cache;
use Piwik\Piwik;
use Piwik\Site;

/**
 * Provides access to individual properties.
 */
class Property extends Site
{

    public function getSetting($name)
    {
        $cache    = Cache::getTransientCache();
        $cacheKey = 'PropertySettings_' . $this->id . 'login' . Piwik::getCurrentUserLogin();

        if ($cache->contains($cacheKey)) {
            $settings = $cache->fetch($cacheKey);
        } else {
            $settings = new PropertySettings($this->id, $this->getType());
            $cache->save($cacheKey, $settings);
        }

        $setting = $settings->getSetting($name);

        if (!empty($setting)) {
            return $setting->getValue(); // Calling `getValue` makes sure we respect read permission property
        }
    }
}
