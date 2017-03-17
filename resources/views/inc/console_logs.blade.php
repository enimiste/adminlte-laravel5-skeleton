<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Historique de traitement (Logs) :
        </h3>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody>
            <tr>
                <th style="text-align: center;min-width: 100px;">Type</th>
                <th style="text-align: center;">Message</th>
                <th style="text-align: center;min-width: 150px;">User</th>
                <th style="text-align: center;min-width: 150px;">Traçé le</th>
            </tr>
            @foreach($console_logs as $clog)
                <tr>
                    <td style="text-align: center;">{{ strtoupper($clog->type) }}</td>
                    <td>{{ $clog->message }}</td>
                    <td>{{ $clog->by_user }}</td>
                    <td>{{ show_date_time($clog->created_at) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if(is_paginator($console_logs))
        <div class="box-footer" style="text-align: center;">
            {{ $console_logs->render() }}
        </div>
    @endif
</div>