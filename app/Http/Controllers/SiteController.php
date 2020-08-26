<?php
namespace Corp\Http\Controllers;
use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Repositories\FilialsRepository;
// Общий контроллер
class SiteController extends Controller
{
    protected $product_rep;
    protected $status_rep;
    protected $filial_rep;
    protected $template;
    protected $vars = [];

    /**
     * В конструкторе присваиваем репозитории для левого меню
     *
     * @param  Corp\Repositories\StatusRepository $status_rep
     * @param  Corp\Repositories\FilialsRepository $filial_rep
     */
    public function __construct(StatusRepository $status_rep, FilialsRepository $filial_rep) {
        $this->status_rep = $status_rep;
        $this->filial_rep = $filial_rep;
    }

    /**
     * Общий метод для рендеринга контента
     *
     * @return string
     */
    public function renderOutput(){
        $status = $this->status_rep->getMenu('status', $this->status_rep->selectMenu());
        $filials = $this->filial_rep->getMenu('filial', $this->filial_rep->selectMenu());
        $topmenu = view('layouts.topmenu')->render(); 
        $leftpanel = view('layouts.leftpanel')->with(['status' => $status, 'filials' => $filials])->render(); 

        $this->vars = array_add($this->vars, 'topmenu', $topmenu);
        $this->vars = array_add($this->vars, 'leftpanel', $leftpanel);

        return view($this->template['view'])->with($this->vars);
    }

    /**
     * Метод для отображения списка филиалов в нижних кнопках
     *
     * @param  array $select_menu $status_rep
     * @param  integer $id
     * 
     * @return array
     */
    public function getFilialsList($select_menu, $id){
        $filials_list = $select_menu;

        // Удалем пункт ВСЕ
        $filials_list->forget(0); 

        // Удаляем пункт отображаемой страници филиала, если мы на такой
        if(!empty($id)){
            $filials_list->forget($id);
        }

        // Удаляем не нужные свойства каждого пункта
        $filials_list->transform(function($item, $key){
            unset($item['count']); 
            unset($item['alias']); 
            return $item;
        });

        return $filials_list;
    }
}
