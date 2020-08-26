<div class="contentpanel">
    @if($dashboard)
        @foreach($dashboard as $item)
            <div class="col-md-6">
                @include('dashboard.status', ['status'=>$item])
            </div>
        @endforeach
    @endif
</div>