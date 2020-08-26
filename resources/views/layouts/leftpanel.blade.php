<div class="leftpanel">
    <h5 class="leftpanel-title"></h5>
    <ul class="nav nav-pills nav-stacked">
        <li class="{{Route::currentRouteName() == 'home' ? 'active' : ''}}"><a href="/"><i class="glyphicon glyphicon-list-alt"></i> <span>Отчет ревизии</span></a></li>
        @if($status)
            <li class="parent {{Route::currentRouteName() == 'status' ? 'active' : ''}}"><a href=""><i class="fa fa-suitcase"></i> <span>Продукты</span></a>
                <ul class="children">
                    @foreach($status->roots() as $item)
                        <li class="{{ Request::url() == $item->url() ? 'active' : ''}}">
                            <a href="{{ $item->url() }}">
                                <span class="pull-right badge">{{ $item->attributes['count'] }}</span>{{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
        @if($filials)
            <li class="parent {{Route::currentRouteName() == 'filial' ? 'active' : ''}}"><a href=""><i class="fa fa-rss"></i> <span>Филиалы</span></a>
                <ul class="children">
                    @foreach($filials->roots() as $item)
                        <li class="{{ Request::url() == $item->url() ? 'active' : ''}}">
                            <a href="{{ $item->url() }}">
                                <span class="pull-right badge">{{ $item->attributes['count'] }}</span>{{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
        <li class="{{Route::currentRouteName() == 'sales.index' ? 'active' : ''}}"><a href="/sales"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Купить</span></a></li>
    </ul>
</div>