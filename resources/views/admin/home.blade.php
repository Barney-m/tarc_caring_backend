@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card border border-rounded border-secondary">
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="card-body">
                        <div id="chart" style="height: 300px;"></div>
                            <script>
                            const chart1 = new Chartisan({
                                el: '#chart',
                                url: 'http://127.0.0.1:8000/api/chart/total_user_chart',
                                hooks: new ChartisanHooks()
                                    .colors(['#ED4E4E', '#4E8FED', '#E8EE62', '#78DF66'])
                                    .responsive()
                                    .beginAtZero()
                                    .legend({ position: 'bottom' })
                                    .title('Current Total Users')
                                    .datasets('bar')
                            })
                            </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border border-rounded border-secondary">
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="card-body">
                        <div id="chart2" style="height: 300px;"></div>
                        <script>
                            const chart2 = new Chartisan({
                                el: '#chart2',
                                url: 'http://127.0.0.1:8000/api/chart/total_feedback_chart',
                                hooks: new ChartisanHooks()
                                    .colors(['#ED4E4E', '#4E8FED', '#E8EE62', '#78DF66'])
                                    .responsive()
                                    .beginAtZero()
                                    .legend({ position: 'bottom' })
                                    .title('Total Feedbacks')
                                    .datasets('line')
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-9">
            <div class="card border border-rounded border-secondary">
                <div class="card-header">{{ __('Dashboard') }}
                    <div class="card-body">
                        <div id="chart3" style="height: 300px;"></div>
                        <script>
                            const chart3 = new Chartisan({
                                el: '#chart3',
                                url: 'http://127.0.0.1:8000/api/chart/priority_chart',
                                hooks: new ChartisanHooks()
                                    .colors(['#ED4E4E', '#4E8FED', '#E8EE62', '#78DF66', '#000FF'])
                                    .responsive()
                                    .beginAtZero()
                                    .legend({ position: 'bottom' })
                                    .title('Priority')
                                    .datasets([{ type: 'line', fill: false}, 'bar'])
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
