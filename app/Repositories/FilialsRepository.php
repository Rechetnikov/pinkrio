<?php
namespace Corp\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Corp\Filial;
use Corp\Product;

// Репозиторий Филиалов
class FilialsRepository extends Repository{

    // Присвоение модели филиалов в констркторе
    public function __construct(Filial $filial){
        $this->model = $filial;
    }
    
    // Данные всех филиалов для левого меню. 
    public function selectMenu(){
        $builder[0] = ['id' => 0, 'title' => "Все", "alias" => "all", "count" => 0];
        $filial = $this->model->all();
        $filial->load(['products' => function ($query) { // Подгружаем продукты которые не проданы
            $query->where('status_id', '!=', '2');
        }]);

        foreach($filial as $key => $item){
            $builder = array_add($builder, $key+1, ['id' => $item->id, 'title' => $item->title, "alias" => $item->alias, 'count' => $item->products->count()]);
            $builder[0]["count"] += $item->products->count();
        }
        return collect($builder); 
    }

    // Данные одного филиала по ID или алиасу. 
    public function getFilial($par){
        $filial = false;
        if(is_numeric($par)){
            $status = $this->model->find($par)->first();
        }else{
            if($par == 'all'){
                $filial =  ['id' => 0, 'title' => "Все", "alias" => "all", "count" => 0];
            }else{
                $filial = $this->model->where('alias', $par)->first();
            }
        }
        return $filial;
    }

    // Продажа списка продуктов
    public function salesAll($products){
        foreach(json_decode($products) as $item){
            $sale = Product::find($item);
            $sale->status_id = '2';
            $sale->save();
        }
    }

    // Удаление списка продуктов
    public function destroyAll($products){
        Product::destroy(json_decode($products));
    }
    
    // Перемещение продуктов в филиале
    public function redirectAll($products, $filial){
        foreach(json_decode($products) as $item){
            $sale = Product::find($item);
            $sale->filials_id = $filial;
            $sale->save();
        }
    }
}
