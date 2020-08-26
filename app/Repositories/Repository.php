<?php
namespace Corp\Repositories;
use Illuminate\Support\Facades\DB;
use Corp\Status;
use Menu;

// Главный репозиторий
abstract class Repository{
    
    protected $model = false;

    // Метод для отображения левого меню
    public function getMenu($title, $items){
        $s_builder = Menu::make($title, function($m) use ($items, $title) {
            foreach ($items as $item) {
                $m->add($item['title'], ['url'=>$title.'/'.$item['alias'], 'count'=>$item['count']])->id($item['id']);
            }
        });

        return $s_builder;
    }
}