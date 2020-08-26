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
    private $messages = [
        'title.required' => 'Поле "Заголовок" не должно быть пустым',
        'title.max:255' => 'Поле "Заголовок" не должно превышать 255 символов',
        'text.required' => 'Поле "Описание" не должно быть пустым',
        'prise.required' => 'Поле "Цена" не должно быть пустым',
        'prise.numeric' => 'Поле "Цена" должно быть числовым или дробным значением',
        'filial.required' => 'Поле "Филиал" не должно быть пустым',
        'filial.exists' => 'Филиал не найден'
    ];

    private $for_validate = [
        'title' => 'required|max:255',
        'text' => 'required',
        'prise' => 'required|numeric',
        'filial' => 'required|exists:products,id'
    ];

    public function __construct(ProductsRepository $product_rep){
        Parent::__construct(new StatusRepository(new Status), new FilialsRepository(new Filial));
        $this->product_rep = $product_rep;
        $this->template['view'] = 'index';
        $this->template['content'] = 'product.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $filials_list = $this->getFilialsList($this->filial_rep->selectMenu(), '');
        $content = view($this->template['content'])->with('filials', $filials_list)->render(); 
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show($id)
	{
		dd('show');
	}
}
