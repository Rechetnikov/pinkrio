{{-- Нижние кнопки у страници статусов --}}

<div class="row">
    @if($status != 0)
        <div class="col-md-8">
            @if($filials)
                <select data-placeholder="Choose One" class="width300" id="select_redirect" style="padding: 10px; border-radius: 15px;">
                    <option value="" disabled selected>Выберите филиал</option>
                    @foreach($filials as $item)
                        <option value="{{$item['id']}}">{{$item['title']}}</option>
                    @endforeach
                </select>
                @if($status != 2)    
                    <button class="btn btn-success btn-rounded" id="redirect_filial"><i class="glyphicon glyphicon-log-out"></i> Переместить</button>
                @else
                    <button class="btn btn-default btn-rounded" id="retry_products_all"><i class="fa fa-reply"></i> Вернуть выбранное</button>
                @endif
            @endif
        </div>
    @endif
    @if($status != 0)
        <div class="col-md-1 pull-right">
            @if($status != 2)
                <button class="btn btn-primary btn-rounded pull-right" id="sales_product"><i class="glyphicon glyphicon-check"></i> Продать выбранное</button>
            @endif
        </div>
    @endif

    <div class="col-md-1 pull-left">
        <button id="delete_product" class="btn btn-danger btn-rounded pull-right" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="glyphicon glyphicon-remove"></i> Удалить выбранное</button>
    </div>
</div>
