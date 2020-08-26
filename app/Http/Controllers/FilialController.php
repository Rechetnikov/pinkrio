<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Status;
use Corp\Repositories\FilialsRepository;
use Corp\Filial;
use Corp\Repositories\ProductsRepository;

class FilialController extends SiteController
{
    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'filial.content';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alias)
    {
        $products = $this->product_rep->getProducts('filials', $alias);
        $filial = $this->show($alias);
        $filials_list = $this->getFilialsList($this->filial_rep->selectMenu(), (isset($filial->id) ? $filial->id : ''));
        $content = view($this->template['content'])->with(['products' => $products, "filial"=>$filial, 'filials_list'=>$filials_list, ['status', '!=', '2']])->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $par
     * @return \Illuminate\Http\Response
     */
    public function show($par)
    {
        return $this->filial_rep->getFilial($par);
    }


    /**
     * Продажа списком.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request) {
        $this->filial_rep->salesAll($request->products);
        return $request->products;
    }

    /**
     * Удаление списком.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request) {
        $this->filial_rep->destroyAll($request->products);
        return $request->products;
    }
    
    /**
     * Перемещение в филиал списком.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request) {
        $this->filial_rep->redirectAll($request->products, $request->filial);
        return $request->products;
    }
    
}
