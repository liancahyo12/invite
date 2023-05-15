<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Galeri implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Galeri', [
            'route' => 'boilerplate.galeri',
            'active' => 'boilerplate.galeri',
            'permission' => 'lihat_galeri',
            'icon' => 'images',
            'order' => 105,
        ]);
    }
}
