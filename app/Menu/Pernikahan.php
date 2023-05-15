<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Pernikahan implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Pernikahan', [
            'route' => 'boilerplate.pernikahan',
            'active' => 'boilerplate.pernikahan',
            'permission' => 'lihat_pernikahan',
            'icon' => 'user-group',
            'order' => 101,
        ]);
    }
}
