@extends('admin.layouts.master')
@section('breadcrumb')
<ol class="breadcrumb float-sm-left">
    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard', []) }}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('admin/log-viewer', []) }}">Logs</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection
@section('content')
<style>


    .page-header {
        border-bottom: 1px solid #8a8a8a;
    }

    /*
     * Navbar
     */

    .navbar-brand {
        padding: .75rem 1rem;
        font-size: 1rem;
    }

    .navbar-nav .nav-link {
        padding-right: .5rem;
        padding-left: .5rem;
    }

    /*
     * Boxes
     */

    .box {
        display: block;
        padding: 0;
        min-height: 70px;
        background: #fff;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: .25rem;
    }

    .box > .box-icon > i,
    .box .box-content .box-text,
    .box .box-content .box-number {
        color: #FFF;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }

    .box > .box-icon {
        border-radius: 2px 0 0 2px;
        display: block;
        float: left;
        height: 70px; width: 70px;
        text-align: center;
        font-size: 40px;
        line-height: 70px;
        background: rgba(0,0,0,0.2);
    }

    .box .box-content {
        padding: 5px 10px;
        margin-left: 70px;
    }

    .box .box-content .box-text {
        display: block;
        font-size: 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 600;
    }

    .box .box-content .box-number {
        display: block;
    }

    .box .box-content .progress {
        background: rgba(0,0,0,0.2);
        margin: 5px -10px 5px -10px;
    }

    .box .box-content .progress .progress-bar {
        background-color: #FFF;
    }

    /*
     * Log Menu
     */

    .log-menu .list-group-item.disabled {
        cursor: not-allowed;
    }

    .log-menu .list-group-item.disabled .level-name {
        color: #D1D1D1;
    }

    /*
     * Log Entry
     */

    .stack-content {
        color: #AE0E0E;
        font-family: consolas, Menlo, Courier, monospace;
        white-space: pre-line;
        font-size: .8rem;
    }

    /*
     * Colors: Badge & Infobox
     */

    .badge.badge-env,
    .badge.badge-level-all,
    .badge.badge-level-emergency,
    .badge.badge-level-alert,
    .badge.badge-level-critical,
    .badge.badge-level-error,
    .badge.badge-level-warning,
    .badge.badge-level-notice,
    .badge.badge-level-info,
    .badge.badge-level-debug,
    .badge.empty {
        color: #FFF;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }

    .badge.badge-level-all,
    .box.level-all {
        background-color: {{ log_styler()->color('all') }};
    }

    .badge.badge-level-emergency,
    .box.level-emergency {
        background-color: {{ log_styler()->color('emergency') }};
    }

    .badge.badge-level-alert,
    .box.level-alert  {
        background-color: {{ log_styler()->color('alert') }};
    }

    .badge.badge-level-critical,
    .box.level-critical {
        background-color: {{ log_styler()->color('critical') }};
    }

    .badge.badge-level-error,
    .box.level-error {
        background-color: {{ log_styler()->color('error') }};
    }

    .badge.badge-level-warning,
    .box.level-warning {
        background-color: {{ log_styler()->color('warning') }};
    }

    .badge.badge-level-notice,
    .box.level-notice {
        background-color: {{ log_styler()->color('notice') }};
    }

    .badge.badge-level-info,
    .box.level-info {
        background-color: {{ log_styler()->color('info') }};
    }

    .badge.badge-level-debug,
    .box.level-debug {
        background-color: {{ log_styler()->color('debug') }};
    }

    .badge.empty,
    .box.empty {
        background-color: {{ log_styler()->color('empty') }};
    }

    .badge.badge-env {
        background-color: #6A1B9A;
    }

    #entries {
        overflow-wrap: anywhere;
    }
</style>
    <div class="page-header mb-4">
        <h4>@lang('Log Dashboard')</h4>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
            <a class="btn btn-primary btn-lg btn-block" href="{{url('admin/log-viewer/logs')}}" type="button">
                <i class="fas fa-list-ol"></i> Logs by Date                </a>
        </div>

        <div class="col-md-6 col-lg-9">
            <div class="row">
                @foreach($percents as $level => $item)
                    <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                        <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                            <div class="box-icon">
                                {!! log_styler()->icon($level) !!}
                            </div>

                            <div class="box-content">
                                <span class="box-text">{{ $item['name'] }}</span>
                                <span class="box-number">
                                    {{ $item['count'] }} @lang('entries') - {!! $item['percent'] !!} %
                                </span>
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endsection
