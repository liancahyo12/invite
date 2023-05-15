<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Tamu implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Tamu', [
            'route' => 'boilerplate.tamu',
            'active' => 'boilerplate.tamu',
            'permission' => 'lihat_tamu',
            'icon' => 'list',
            'order' => 103,
        ]);
    }
}
