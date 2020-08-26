<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\StatusRepository;
use Corp\Status;
use Corp\Repositories\FilialsRepository;
use Corp\Filial;
use Corp\Repositories\ProductsRepository;
use Corp\Product;
use Validator;

class ProductController extends SiteController
{
    // Сообщения при валидации
    private $messages = [
        'title.required' => 'Поле "Заголовок" не должно быть пустым',
        'title.max:255' => 'Поле "Заголовок" не должно превышать 255 символов',
        'text.required' => 'Поле "Описание" не должно быть пустым',
        'prise.required' => 'Поле "Цена" не должно быть пустым',
        'prise.numeric' => 'Поле "Цена" должно быть числовым или дробным значением',
        'filial.required' => 'Поле "Филиал" не должно быть пустым',
        'filial.exists' => 'Филиал не найден'
    ];

    // Ключи валидации
    private $for_validate = [
        'title' => 'required|max:255',
        'text' => 'required',
        'prise' => 'required|numeric',
        'filial' => 'required|exists:products,id'
    ];

    /**
     * В конструкторе присваиваем репозитории для контента и шаблоны для рендеринга
     *
     * @param  Corp\Repositories\ProductsRepository $product_rep
     */
    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'product.index';
    }


    /**
     * Рендеринг страници добавления продукта.
     *
     * @return String
     */
    public function index(){
        $filials_list = $this->getFilialsList($this->filial_rep->selectMenu(), '');
        $content = view($this->template['content'])->with('filials', $filials_list)->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();        
    }

    /**
     * Добавления и валидация нового продукта.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->for_validate, $this->messages);

        if($validator->fails()){
            return redirect()->route('sales.index')->withErrors($validator)->withInput();
        }else{
            $this->product_rep->add($request->title, $request->text, $request->filial, $request->prise);
        }

        return redirect()->route('sales.index')->with('status', 'Товар успешно добавлен');
    }

    /**
     * Рендеринг страници правка продукта.
     *
     * @param  int  $id
     * @return String
     */
    public function edit($id)
    {
        $product = $this->product_rep->getModel($id);
        $filials_list = $this->getFilialsList($this->filial_rep->selectMenu(), '');
        $content = view($this->template['content'])->with(['filials' => $filials_list, 'product' => $product])->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();
    }

    /**
     * Правка и валидация нового продукта.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return String
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->for_validate, $this->messages);

        if($validator->fails()){
            return redirect()->route('salesEdit', ['id' => $id])->withErrors($validator)->withInput();
        }else{
            $this->product_rep->edit($id, $request->title, $request->text, $request->filial, $request->prise);
        }

        return redirect()->route('salesEdit', ['id' => $id])->with('status', 'Товар успешно обновлен');
    }
}
