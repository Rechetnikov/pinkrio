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
    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'status.content';
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $alias
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  string  $par
     * @return \Illuminate\Http\Response
     */
    public function show($par){
        return $this->status_rep->getStatus($par);
    }
    

    public function sales_one(Request $request) {
        $this->status_rep->salesOne($request->id, $request->prise);
        return $request->products;
    }

    public function retry(Request $request) {   
        $this->status_rep->retryAll($request->products, $request->filial);
        return $request->products;
    }

    public function retry_one(Request $request) {
        $this->status_rep->retryOne($request->id, $request->filial);
        return ['id' => $request->id, 'filial' => $request->filial];
    }
}
