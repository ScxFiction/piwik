<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\CoreHome;

use Piwik\Property\PropertySettings;

class Type extends \Piwik\Type\Type
{
    const ID = 'universal';
    protected $name = 'Universal';
    protected $description = 'Universal type that can be used for anything';
    protected $howtoSetupUrl = 'http://developer.piwik.org/api-reference/tracking-api'; // todo we need a dedicated page for that

    public function configurePropertySettings(PropertySettings $settings)
    {
    }

}

