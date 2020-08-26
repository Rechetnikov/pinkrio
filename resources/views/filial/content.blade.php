{{-- Контент филиалов  --}}

@include('filial.dialogs', ['dialog' => 'yes_no'])

@include('filial.dialogs', ['dialog' => 'sales_prise'])

<div class="contentpanel" id="filial_product">
    @if(isset($filial['title']))
        <h3>{{ $filial['title'] }}</h3>
    @endif
    @if($products)
        <div class="table-responsive">
            <input type=hidden id="token" value="{{ csrf_token() }}">
            <table class="table table-success mb30">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-1">Заголовок</th>
                        @if($filial['id'] == 0)
                            <th class="col-md-1">Филиал</th>
                        @endif
                        <th class="col-md-1">Статус</th>
                        <th>Описание</th>
                        <th class="col-md-1">Цена</th>
                        <th>Правка</th>
                        <th>Продать</th>
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
                        @if($filial['id'] == 0)
                            <td>{{ $item->filial->title }}</td>
                        @endif
                        <td>{{ $item->status->title }}</td>
                        <td>{{ $item->text }}</td>
                        <td>{{ $item->prise }}</td>
                        <td><button class="btn btn-warning btn-rounded" onclick="document.location='/sales/{{$item->id}}'"><i class="fa fa-pencil"></i></button></td>
                        <td>
                            <button data-toggle="modal" data-target=".bs-example-modal-sm1" class="sales_product_prise btn btn-primary btn-rounded" id='{{$item->id}}'  prise ='{{$item->prise}}'>
                                <i class="glyphicon glyphicon-check"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('filial.buttons', ['filials'=>$filials_list])

    @endif
</div>