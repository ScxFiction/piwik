<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\SitesManager;

use Piwik\Menu\MenuAdmin;
use Piwik\Piwik;
use Piwik\Type\Type;

class Menu extends \Piwik\Plugin\Menu
{
    public function configureAdminMenu(MenuAdmin $menu)
    {
        if (Piwik::isUserHasSomeAdminAccess()) {

            $model = new Model();
            $typeIds = $model->getUsedTypeIds();

            $menuName = 'General_Properties';

            if (count($typeIds) === 1) {
                $typeId = reset($typeIds);
                $type = Type::getType($typeId);
                if ($type) {
                    $menuName = $type->getNamePlural();
                }
            }

            $menu->addManageItem($menuName,
                                 $this->urlForAction('index'),
                                 $order = 1);
        }
    }
}
