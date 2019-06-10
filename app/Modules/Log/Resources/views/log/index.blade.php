

    @if (!$items->isEmpty())
    <table>
            @foreach($items as $item)
					<tr><td>ID: {{$item->id}}</td><td>{{$item->created_at}}</td></tr>
            @endforeach
    </table>
    @else
        <div class="alert alert-info">
            <em>@lang('log::log.noItems')</em>
        </div>
    @endif