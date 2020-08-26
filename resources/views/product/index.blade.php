{{-- Layout добавления и правка продукта --}}

<div class="contentpanel" id="filial_product">
    @if(isset($errors))
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>{{$error}}</strong>
            </div>
        @endforeach
    @endif
    
    @if(session('status'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('status') }}
        </div>
    @endif

    <form id="basicForm" method="post" novalidate="novalidate">
        @if(Route::currentRouteName() == 'salesEdit')
            <input type="hidden" name="_method" value="PUT">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{ Route::currentRouteName() == 'salesEdit' ? 'Изменение' : 'Покупка нового'}} товара</h4>
            </div><!-- panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Наименование <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ isset($product->title) ? $product->title : old('title') }}" type="text" name="title" class="form-control" placeholder="Наименование товара..." required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Описание <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                            <textarea rows="5" name="text" class="form-control" placeholder="Описание товара..." required="">{{ isset($product->text) ? $product->text : old('text') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цена <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ isset($product->prise) ? $product->prise : old('prise') }}" type="text" name="prise" class="form-control" placeholder="Цена..." required="">
                        </div>
                    </div>

                    <div class="form-group">
                        @php $product_temp = (isset($product->filial) ? $product->filial->id : old('filial')) @endphp
                        <label class="col-sm-3 control-label">Филиал <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                            @if(isset($filials))
                                <select name="filial" data-placeholder="Choose One" class="form-control" id="select_redirect">
                                    <option value="" disabled {{ (empty($product_temp) ? 'selected' : '') }} >Выберите филиал</option>
                                    @foreach($filials as $item)
                                        <option {{ ($product_temp == $item['id'] ? 'selected' : '') }} value="{{$item['id']}}">{{$item['title']}}</option>
                                    @endforeach
                                </select>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">{{ Route::currentRouteName() == 'salesEdit' ? 'Изменить' : 'Купить'}}</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>