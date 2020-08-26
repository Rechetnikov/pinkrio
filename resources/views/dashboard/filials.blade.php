{{-- Подключен для отображения филиалов инклюдится в статусах --}}
@if($filials) 
    <table class="table table-{{ $status['title']=='Возвращено' ? 'danger' : 'success' }} mb30">
        <thead>
            <tr>
                <th colspan="3">{{ $filials['title'] }}</th>
            </tr>
            <tr>
                <td class="col-md-1">Заголовок</td>
                <td>Описание</th>
                <td class="col-md-1">Цена</td>
            </tr>
        </thead>
        <tbody>
            @foreach($filials['items'] as $item)
                @include('dashboard.product', ['products'=>$item])
            @endforeach
        </tbody>
    </table>
@endif