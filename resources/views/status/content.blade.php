@include('filial.dialogs', ['dialog' => 'yes_no'])
@if($status['id'] != 2)
    @include('filial.dialogs', ['dialog' => 'sales_prise'])
@else
    @include('status.dialogs', ['dialog' => 'retry_filial', 'filials'=>$filials_list])
@endif

<div class="contentpanel" id="filial_product">
    @if(isset($status['title']))
        <h3>{{ $status['title'] }} </h3>
    @endif
    @if($products)
        <div class="table-responsive">
            <input type=hidden id="token" value="{{ csrf_token() }}">
            <table class="table table-success mb30">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-1">Заголовок</th>
                        @if($status['id'] != 2)
                            <th class="col-md-1">Филиал</th>
                        @endif
                        @if($status['id'] == 0)
                            <th class="col-md-1">Статус</th>
                        @endif
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Правка</th>
                        
                        @if($status['id'] == 0)
                            <th><i class="glyphicon glyphicon-check"></i> / <i class="fa fa-reply"></i></th>
                        @else
                            @if($status['id'] != 2)
                                <th>Продать</th>
                            @else
                                <th>Вернуть</th>
                            @endif
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $item)
                        <tr>
                            <td>
                                <div class="ckbox ckbox-success">
                                    <input type="checkbox" id="checkboxSuccess_{{$item->id}}" class="checkboxSuccess" value="{{$item->id}}">
                                    <label for="checkboxSuccess_{{$item->id}}"></label>
                                </div>
                            </td>
                            <td>{{ $item->title }}</td>
                            @if($status['id'] != 2)
                                <td> 
                                    @if($item->status->id != 2)
                                        {{ $item->filial->title }} 
                                    @endif
                                </td>
                            @endif
                            @if($status['id'] == 0)
                                <td>{{ $item->status->title }}</td>
                            @endif
                            <td>{{ $item->text }}</td>
                            <td>{{ $item->prise }}</td>
                            
                            <td><button class="btn btn-warning btn-rounded" onclick="document.location='/sales/{{$item->id}}'"><i class="fa fa-pencil"></i></button></td>
                            <td>
                                @if($item->status->id != 2)
                                    <button data-toggle="modal" data-target=".bs-example-modal-sm1" class="sales_product_prise btn btn-primary btn-rounded" id='{{$item->id}}'  prise ='{{$item->prise}}'>
                                        <i class="glyphicon glyphicon-check"></i>
                                    </button>
                                @else
                                    <button data-toggle="modal" data-target=".bs-example-modal-sm2" class="retry_product_filials btn btn-default btn-rounded" id='{{$item->id}}'>
                                        <i class="fa fa-reply"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('status.buttons', ['status' => $status['id'], 'filials'=>$filials_list])
    @endif
</div>