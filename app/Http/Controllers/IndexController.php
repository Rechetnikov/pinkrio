<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Status;
use Corp\Repositories\FilialsRepository;
use Corp\Filial;
use Corp\Repositories\ProductsRepository;

class IndexController extends SiteController
{
    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'dashboard.content';
    }
    
    public function index()
    {
        $dashboard = $this->product_rep->getDashboard();
        $content = view($this->template['content'])->with('dashboard', $dashboard)->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();
    }

}
