<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Type;

use Piwik\Plugin\Manager as PluginManager;
use Piwik\Property\PropertySettings;

class Type
{
    const ID = '';
    protected $name = '';
    protected $namePlural = 'General_Properties';
    protected $description = '';
    protected $howToSetupUrl = '';

    public function getId()
    {
        $id = static::ID;

        if (empty($id)) {
            $message = 'Type %s does not define an ID. Set the ID constant to fix this issue';;
            throw new \Exception(sprintf($message, get_called_class()));
        }

        return $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNamePlural()
    {
        return $this->namePlural;
    }

    public function getHowToSetupUrl()
    {
        return $this->howToSetupUrl;
    }

    public function configurePropertySettings(PropertySettings $settings)
    {
    }

    /**
     * @return Type[]
     */
    public static function getAllTypes()
    {
        $types = PluginManager::getInstance()->findComponents('Type', '\\Piwik\\Type\\Type');

        return $types;
    }

    /**
     * @param string $typeId
     * @return Type|null
     */
    public static function getType($typeId)
    {
        if ($typeId === 'metasite') {
            // TODO this is just a reminder for metastites plugin to define a type!
        }

        foreach (self::getAllTypes() as $type) {
            if ($type->getId() === $typeId) {
                return $type;
            }
        }
    }
}

