<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Rekening implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Rekening', [
            'route' => 'boilerplate.rekening',
            'active' => 'boilerplate.rekening',
            'permission' => 'lihat_rekening',
            'icon' => 'money-check-dollar',
            'order' => 102,
        ]);
    }
}
