@extends('layouts.app-master')
@section('charts')
    <style>
        .mt-4 {
            width: 100px;
            height: 80px;
        }
    </style>
    <div class="col-md-8">
        <div class="card">
            <div class="mt-4"></div>
            <div class="card-body">
                <p class="card-description"></p>
                <div class="table-responsive">
                    <div style="width: 50%; margin: auto;">
                        <canvas id="areaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('areaChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($data['data']),
                    backgroundColor: @json($data['colors']),
                    borderColor: 'white',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
