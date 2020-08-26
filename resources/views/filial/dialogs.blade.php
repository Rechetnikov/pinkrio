@if($dialog =='yes_no')
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Удаление</h4>
                </div>
                <div class="modal-body">
                    <h3>Вы уверены, что хотите удалить выбранное?</h3>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-rounded" aria-hidden="true" data-dismiss="modal" id="delete_product">Удалить</button>
                    <button class="btn btn-default btn-rounded" aria-hidden="true" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endif


@if($dialog =='sales_prise')
    <div class="modal fade bs-example-modal-sm1" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="product_id" class="form-control" value=''>
                    <h4 class="modal-title">Продажа</h4>
                </div>
                <div class="modal-body">
                    <h5>Продать по цене:</h5>
                    <input type="text" id="product_prise" class="form-control" value=''>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-rounded" aria-hidden="true" data-dismiss="modal" id="salest_product_btn">Продать</button>
                    <button class="btn btn-default btn-rounded" aria-hidden="true" data-dismiss="modal" id='closer'>Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endif