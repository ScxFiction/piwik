<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\WebsiteType;

use Piwik\Property\PropertySettings;

class Type extends \Piwik\Type\Type
{
    const ID = 'website';
    protected $name = 'WebsiteType_Website';
    protected $namePlural = 'WebsiteType_Websites';
    protected $description = 'WebsiteType_WebsiteDescription';
    protected $howToSetupUrl = '?module=CoreAdminHome&action=trackingCodeGenerator';

    public function configurePropertySettings(PropertySettings $settings)
    {
    }
}

