@extends('layouts.adminapp')

@section('content')

<div class="container">
    <div class="mb-5">
        <h1 class="text-primary">Feedback Result Report</h1>
    </div>
    <form method="GET" action=" {{ route('admin.report.result') }} " class="mb-5">
        <label for="year" class="h1 align-middle text-info">Year: </label>&nbsp;&nbsp;
        <input type="text" name="year" id="year" class="form-control-lg">
        <input type="submit" value="Go" class="form-control-lg">
    </form>
    <div id="chart" style="height: 450px;"></div>
        <script>
            const chart1 = new Chartisan({
                el: '#chart',
                data: {
                    chart: { labels: ['{{$labels[0]}}', '{{$labels[1]}}'] },
                    datasets: [
                        { name: 'Quantity', values: [{{$solved[0]}}, {{$dismissed[0]}}] },

                    ]
                },
                hooks: new ChartisanHooks()
                    .pieColors(['#ED4E4E', '#D87340', '#78DF66', '#6686DF'])
                    .responsive()
                    .legend({ position: 'bottom' })
                    .title('Feedback Result Report in {{$year ?? date("Y")}}')
                    .datasets('pie')

            })
        </script>
        <div class="card border border-rounded border-secondary mt-3 mb-4">
            <div class="card-header bg-info">
                <div class="card-body bg-info ml-5">
                <h2>Total Feedback Solved: <strong>{{$solved[0]}}</strong></h2>
                <h2>Total Feedback Dismissed: <strong>{{$dismissed[0]}}</strong></h2>
                <h2>Solving Rate: <strong>@if($solved[0] != 0 || $dismissed[0] != 0){{number_format(($solved[0] / ($solved[0] + $dismissed[0])) * 100, 2, '.', ',')}}%@else 0% @endif</strong></h2>
                </div>
            </div>
        </div>
</div>

@endsection
