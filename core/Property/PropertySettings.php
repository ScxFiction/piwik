<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Property;

use Piwik\Db;
use Piwik\Piwik;
use Piwik\Plugin\Settings;
use Piwik\Property\Settings\Storage;
use Piwik\Settings\Setting;
use Piwik\Type\Type;

class PropertySettings extends Settings
{

    /**
     * @var int
     */
    private $idSite = null;

    /**
     * @var string
     */
    private $idType = null;

    /**
     * @param int $idSite The id of a site. If you want to get settings for a not yet created site just pass an empty value ("0")
     * @param string $idType If no typeId is given, the type of the site will be used.
     *
     * @throws \Exception
     */
    public function __construct($idSite, $idType)
    {
        $this->idSite = $idSite;
        $this->idType = $idType;
        $this->storage = new Storage(Db::get(), $this->idSite);
        $this->pluginName = 'PropertySettings';

        $this->init();
    }

    protected function init()
    {
        $type = Type::getType($this->idType);

        if (empty($type)) {
            throw new \Exception(sprintf('The type %s does not exist', $this->idType)); // TODO plugin was most likely uninstalled, we need to define how to handle such cases
        }

        $type->configurePropertySettings($this);

        Piwik::postEvent('Property.initPropertySettings', array($this, $type));
    }

    public function addSetting(Setting $setting)
    {
        parent::addSetting($setting);
    }

    public function save()
    {
        Piwik::checkUserHasAdminAccess($this->idSite);

        $this->storage->save();
    }

}

