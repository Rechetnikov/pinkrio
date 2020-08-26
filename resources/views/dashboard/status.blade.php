@if($status)
    <h3> {{ $status['title'] }} </h3>
    @foreach($status['filials'] as $item)
        <div class="table-responsive">
            @include('dashboard.filials', ['filials'=>$item])
        </div>
    @endforeach 
@endif