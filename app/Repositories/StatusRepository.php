<?php
namespace Corp\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Corp\Status;
use Corp\Product;
class StatusRepository extends Repository{
    public function __construct(Status $status){
        $this->model = $status;
    }
    
    public function selectMenu(){
        $builder[0] = ['id' => 0, 'title' => "Все", "alias" => "all", "count" => 0];
        $status = $this->model->all();
        $status->load('products');
        foreach($status as $key => $item){
            $builder = array_add($builder, $key+1, ['id' => $item->id, 'title' => $item->title, "alias" => $item->alias, 'count' => $item->products->count()]);
            $builder[0]["count"] += $item->products->count();
        }
        return collect($builder); 
    }

    public function getStatus($par){
        $status = false;
        if(is_numeric($par)){
            $status = $this->model->find($par)->first();
        }else{
            if($par == 'all'){
                $status =  ['id' => 0, 'title' => "Все", "alias" => "all", "count" => 0];
            }else{
                $status = $this->model->where('alias', $par)->first();
            }
        }
        return $status;
    }

    public function retryAll($products, $filial){
        foreach(json_decode($products) as $item){
            $sale = Product::find($item);
            $sale->filials_id = $filial;
            $sale->status_id = '3';
            $sale->save();
        }
    }

    public function salesOne($id, $prise){
        $sale = Product::find($id);
        $sale->prise = $prise;
        $sale->status_id = '2';
        $sale->save();
    }

    public function retryOne($id, $filial){
        $sale = Product::find($id);
        $sale->filials_id = $filial;
        $sale->status_id = '3';
        $sale->save();
    }
}
