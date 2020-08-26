<?php
namespace Corp\Http\Controllers;
use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Repositories\FilialsRepository;

class SiteController extends Controller
{
    protected $product_rep;
    protected $status_rep;
    protected $filial_rep;
    protected $template;
    protected $vars = [];

    public function __construct(StatusRepository $status_rep, FilialsRepository $filial_rep) {
        $this->status_rep = $status_rep;
        $this->filial_rep = $filial_rep;
    }

    public function renderOutput(){
        $status = $this->status_rep->getMenu('status', $this->status_rep->selectMenu());
        $filials = $this->filial_rep->getMenu('filial', $this->filial_rep->selectMenu());
        $topmenu = view('layouts.topmenu')->render(); 
        $leftpanel = view('layouts.leftpanel')->with(['status' => $status, 'filials' => $filials])->render(); 


        $this->vars = array_add($this->vars, 'topmenu', $topmenu);
        $this->vars = array_add($this->vars, 'leftpanel', $leftpanel);
        

        return view($this->template['view'])->with($this->vars);
    }


    public function getFilialsList($select_menu, $id){
        $filials_list = $select_menu;
        $filials_list->forget(0); 
        if(!empty($id)){
            $filials_list->forget($id);
        }
        $filials_list->transform(function($item, $key){
            unset($item['count']); 
            unset($item['alias']); 
            return $item;
        });

        return $filials_list;
    }
}
