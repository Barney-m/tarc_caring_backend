@extends('layouts.adminapp')

@section('content')

<div class="container">
    <div class="mb-5">
        <h1 class="text-primary">Feedback Made Report</h1>
    </div>
    <form method="GET" action=" {{ route('admin.report.made') }} " class="mb-5">
        <label for="year" class="h1 align-middle text-info">Year: </label>&nbsp;&nbsp;
        <input type="text" name="year" id="year" class="form-control-lg">
        <input type="submit" value="Go" class="form-control-lg">
    </form>
    <div id="chart" style="height: 300px;"></div>
                            <script>
                            const chart1 = new Chartisan({
                                el: '#chart',
                                data: {
                                    chart: { labels: ['{{$labels[0]}}', '{{$labels[1]}}', '{{$labels[2]}}', '{{$labels[3]}}'] },
                                    datasets: [
                                        { name: 'Students', values: [{{$students[0]}}, {{$students[1]}}, {{$students[2]}}, {{$students[3]}}] },
                                        { name: 'Lecturers', values: [{{$lecturers[0]}}, {{$lecturers[1]}}, {{$lecturers[2]}}, {{$lecturers[3]}},] },
                                        { name: 'Services', values: [{{$staffs[0]}}, {{$staffs[1]}}, {{$staffs[2]}}, {{$staffs[3]}},] }
                                    ]
                                },
                                hooks: new ChartisanHooks()
                                    .colors(['#ED4E4E', '#D87340', '#78DF66', '#6686DF'])
                                    .responsive()
                                    .beginAtZero()
                                    .legend({ position: 'bottom' })
                                    .title('Feedback Made Report in {{$year ?? date("Y")}}')
                                    .datasets('bar')
                            })
                            </script>
</div>

@endsection
