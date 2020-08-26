{{-- Диалоги для страници статусов --}}
@if($dialog =='retry_filial')
    <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="product_id" class="form-control" value=''>
                    <h4 class="modal-title">Выбор филиала</h4>
                </div>
                <div class="modal-body">
                @if($filials)
                    <select data-placeholder="Choose One" id="select_filial_retry" style="width: 270px; padding: 10px; border-radius: 15px;">
                        <option value="0" disabled selected>Выберите филиал</option>
                        @foreach($filials as $item)
                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                        @endforeach
                    </select>
                @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-rounded" aria-hidden="true" data-dismiss="modal" id="retry_product_btn">Вернуть</button>
                    <button class="btn btn-default btn-rounded" aria-hidden="true" data-dismiss="modal" id='closer_retry'>Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endif