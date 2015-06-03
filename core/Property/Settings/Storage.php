<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Property\Settings;

use Piwik\Tracker\SettingsStorage;

/**
 * Storage for site settings
 */
class Storage extends SettingsStorage
{
    private $idSite = null;

    public function __construct($idSite)
    {
        $this->idSite = $idSite;
    }

    public function getOptionKey()
    {
        return 'Site_' . $this->idSite. '_Settings';
    }
}
