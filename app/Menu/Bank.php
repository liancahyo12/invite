<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Bank implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Bank', [
            'route' => 'boilerplate.bank',
            'active' => 'boilerplate.bank',
            'permission' => 'admin',
            'icon' => 'building-columns',
            'order' => 106,
        ]);
    }
}
