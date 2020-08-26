<?php
namespace Corp\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Corp\Product;
use Corp\Status;
use Corp\Filial;
class ProductsRepository extends Repository{
    public function __construct(Product $product){
        $this->model = $product;
    }
    
    public function getProducts($type, $alias){
        $where = false;
		if($alias != 'all'){
            if($type == 'status'){
                $where = Status::select('id')->where('alias', $alias)->first()->id;
            }elseif($type == 'filials'){
                $where = Filial::select('id')->where('alias', $alias)->first()->id;

            }
		}

        if(!$where){
            if($type == 'status'){
                $products = $this->model->all();
            }elseif($type == 'filials'){

                $products = $this->model->select('*')->where('status_id', '!=', '2')->get();


            }
        }else{
            if($type == 'status'){
                $products = $this->model->select('*')->where($type.'_id', $where)->get();
            }elseif($type == 'filials'){
                $products = $this->model->select('*')->where([$type.'_id' => $where, ['status_id', '!=', '2']])->get();
            }
        }



        return $products;
    }

    public function getDashboard(){
        $dashboard = [];

        $products = $this->model->select(
            'products.id',
            'products.title', 
            'products.text', 
            'products.prise', 
            'products.status_id', 
            'products.filials_id', 
            'status.dashboard',
            DB::raw('status.title AS status_title'), 
            DB::raw('filials.title AS filial_title')
        )
        ->leftJoin('status', 'products.status_id', '=', 'status.id')
        ->leftJoin('filials', 'products.filials_id', '=', 'filials.id')
        ->where('dashboard', '1')
        ->orderBy('status_id')
        ->get();

        foreach($products as $key => $item){
            $dashboard[$item->status_id]['filials'][$item->filials_id]['items'][$item->id]['title'] = $item->title;
            $dashboard[$item->status_id]['filials'][$item->filials_id]['items'][$item->id]['prise'] = $item->prise;
            $dashboard[$item->status_id]['filials'][$item->filials_id]['items'][$item->id]['text'] = $item->text;
            $dashboard[$item->status_id]['filials'][$item->filials_id]['title'] = $item->filial_title;
            $dashboard[$item->status_id]['title'] = $item->status_title;
        }
        return collect($dashboard);
    }

    public function add($title, $text, $filial, $prise){
        $product = new Product;
        $product->title = $title;
        $product->text = $text;
        $product->filials_id = $filial;
        $product->prise = $prise;
        $product->status_id = '1';
        $product->save();
    }

    public function edit($id, $title, $text, $filial, $prise){
        $product = Product::find($id);
        $product->title = $title;
        $product->text = $text;
        $product->filials_id = $filial;
        $product->prise = $prise;
        $product->save();
    }

    public function getModel($id){
        return $this->model->find($id);
    }
}
