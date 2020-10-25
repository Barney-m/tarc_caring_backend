@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="mb-5">
        <h1 class="text-primary">Feedback Sentiment Report</h1>
    </div>
    <form method="GET" action=" {{ route('admin.report.sentiment') }} " class="mb-5">
        <label for="year" class="h1 align-middle text-info">Year: </label>&nbsp;&nbsp;
        <input type="text" name="year" id="year" class="form-control-lg">
        <input type="submit" value="Go" class="form-control-lg">
    </form>
    <div id="chart" class="pt-2" style="height: 300px;"></div>
        <script>
            const chart = new Chartisan({
                el: '#chart',
                data: {
                    chart: { labels: ['{{$labels[0]}}', '{{$labels[1]}}', '{{$labels[2]}}', '{{$labels[3]}}'] },
                    datasets: [
                        { name: 'Positive', values: [{{$positives[0]}}, {{$positives[1]}}, {{$positives[2]}}, {{$positives[3]}}] },
                        { name: 'Neutral', values: [{{$neutrals[0]}}, {{$neutrals[1]}}, {{$neutrals[2]}}, {{$neutrals[3]}},] },
                        { name: 'Negative', values: [{{$negatives[0]}}, {{$negatives[1]}}, {{$negatives[2]}}, {{$negatives[3]}},] }
                    ]
                },
                hooks: new ChartisanHooks()
                    .colors(['#ED4E4E', '#D87340', '#78DF66', '#6686DF'])
                    .responsive()
                    .beginAtZero()
                    .legend({ position: 'bottom' })
                    .title('Feedback Sentiment Report in {{$year ?? date("Y")}}')
                    .datasets('bar')

            })
        </script>
</div>

@endsection
