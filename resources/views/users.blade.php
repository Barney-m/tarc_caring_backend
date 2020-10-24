@extends('layouts.app')

@section('content')
    <!-- Chart's container -->
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
            .title('Feedback Sentiment Report in')
            .datasets('bar')

      })

      const chart2 = new Chartisan({
        el: '#chart',
        url: 'http://127.0.0.1:8000/api/chart/feedback_made_chart',
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Cheah Poh Reng is SOHAI')
            .datasets([{ type: 'bar', fill: false }, 'line']),
      })

      const chart3 = new Chartisan({
        el: '#chart',
        url: 'http://127.0.0.1:8000/api/chart/feedback_result_chart',
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Cheah Poh Reng is SOHAI'),
      })
    </script>
@endsection

