@extends('layouts.adminapp')

@section('content')

<div class="container">
    <div class="mb-5">
        <h1 class="text-primary">Feedback Sentiment Report</h1>
    </div>
    <div id="chart" style="height: 300px;"></div>
                            <script>
                            const chart1 = new Chartisan({
                                el: '#chart',
                                url: 'http://127.0.0.1:8000/api/chart/feedback_sentiment_chart',
                                hooks: new ChartisanHooks()
                                    .colors(['#ED4E4E', '#D87340', '#78DF66', '#6686DF'])
                                    .responsive()
                                    .beginAtZero()
                                    .legend({ position: 'bottom' })
                                    .title('Feedback Sentiment Report in {{date("Y")}}')
                                    .datasets('bar')

                            })
                            </script>
</div>

@endsection
