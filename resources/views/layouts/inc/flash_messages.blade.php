@if(\Session::has('notices'))
    @foreach(\Session::get('notices') as $type => $msgs)
        <div class="alert alert-{{ $type }} alert-dismissible">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <ul>
                @foreach($msgs as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endif

@if(\Session::has('errors'))
    <div class="alert alert-danger alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <ul>
            @foreach(\Session::get('errors')->messages() as $msgs)
                @foreach($msgs as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif