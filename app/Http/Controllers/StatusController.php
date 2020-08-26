<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Status;
use Corp\Repositories\FilialsRepository;
use Corp\Filial;
use Corp\Repositories\ProductsRepository;

class StatusController extends SiteController
{
    /**
     * В конструкторе присваиваем репозитории для контента и шаблоны для рендеринга
     *
     * @param  Corp\Repositories\ProductsRepository $product_rep
     */
    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'status.content';
    }

    /**
     * Отображения продуктов в разделе филиал.
     *
     * @param  string  $alias
     * @return String
     */
    public function index($alias)
    {
        $products = $this->product_rep->getProducts('status', $alias);
        $status = $this->show($alias);
        $filials_list = $this->getFilialsList($this->filial_rep->selectMenu(), '');
        $content = view($this->template['content'])->with(['products' => $products, 'filials_list' => $filials_list, "status"=>$status])->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();
    }

    /**
     * Возвращает данные филиала по id или алиас.
     *
     * @param  string  $par
     * @return Array
     */
    public function show($par){
        return $this->status_rep->getStatus($par);
    }
    
    /**
     * Продажа одного продукта
     *
     * @param  Illuminate\Http\Request  $request
     * @return Array
     */
    public function sales_one(Request $request) {
        $this->status_rep->salesOne($request->id, $request->prise);
        return $request->products;
    }

    /**
     * Возврат списка продуктов
     *
     * @param  Illuminate\Http\Request  $request
     * @return Array
     */
    public function retry(Request $request) {   
        $this->status_rep->retryAll($request->products, $request->filial);
        return $request->products;
    }

    /**
     * Возврат одного продукта
     *
     * @param  Illuminate\Http\Request  $request
     * @return Array
     */
    public function retry_one(Request $request) {
        $this->status_rep->retryOne($request->id, $request->filial);
        return ['id' => $request->id, 'filial' => $request->filial];
    }
}
