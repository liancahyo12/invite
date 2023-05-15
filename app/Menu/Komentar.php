<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Komentar implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Komentar', [
            'route' => 'boilerplate.komentar',
            'active' => 'boilerplate.komentar',
            'permission' => 'lihat_komentar',
            'icon' => 'comments',
            'order' => 104,
        ]);
    }
}
