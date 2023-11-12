

@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="mb-2">
            <a href="{{ route('prediction.create') }}" class="btn btn-sm btn-primary">Back To Predict</a>
        </div>

        <div class="mb-3">
            <h4>Prediction Results</h4>
        </div>
        <div class="my-3 col-md-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="qqPlot"></canvas>
                </div>
            </div>
        </div>
        <div class="my-3 col-md-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="correlationChart"></canvas>
                </div>
            </div>
        </div>
        <div class="my-3 col-md-4 col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    Matriks Kebingungan
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Positif</th>
                                <th>Negatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>Positif</td>
                                <td>{{ $truePositives }}</td>
                                <td>{{ $falseNegatives }}</td>
                            </tr>
                            <tr>
                                <td>Negatif</td>
                                <td>{{ $falsePositives }}</td>
                                <td>{{ $trueNegative }}</td>
                            </tr>
                            <tr>
                                <hr>
                            <td>accuracy</td>
                                <td>
                                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="{{ number_format($accuracy * 100)  }}" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: {{ number_format($accuracy * 100)  }}%"> {{ number_format($accuracy * 100)  }}(%)</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <td>precision</td>
                                <td>
                                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="{{ number_format($precision * 100)  }}" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: {{ number_format($precision * 100)  }}%">{{ number_format($precision * 100)  }}(%)</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <td>recall</td>
                                <td>
                                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="{{ number_format($recall * 100)  }}" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: {{ number_format($recall * 100)  }}%">{{ number_format($recall * 100)  }}(%)</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <td>F1-Score</td>
                                <td>
                                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="{{ number_format($f1Score * 100)  }}" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: {{ number_format($f1Score * 100)  }}%">{{ number_format($f1Score * 100)  }}(%)</div>
                                    </div>
                                </td>
                            </tr>
                            <td>Nama :</td>
                                <td>
                                    {{ $nama }}
                                </td>
                            </tr>
                            <td>Npm :</td>
                                <td>
                                    {{ $npm }}
                                </td>
                            </tr>
                            <td>Status Kelulusan! Anda di nyatakan :</td>
                                <td>
                                    {{ $predictedLabel[0] === 1 ? 'Lulus Tepat Waktu' : 'Tidak Tepat Waktu' }}
                                </td>
                            </tr>
                            <td>Dengan ipk  :</td>
                                <td>
                                    {{ $ipk }}
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var theData = @json($theoreticalQuantiles);

    var labels = [];
    for (var i = 0; i < theData.ips1.length; i++) {
        labels.push(i + 1);
    }

    var ctx = document.getElementById('qqPlot').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'scatter',
        data: {
            labels: labels,
            datasets: [{
                label: 'IPS1',
                data: theData.ips1,
                pointBackgroundColor: 'rgba(255, 0, 0, 0.5)',
            }, {
                label: 'IPS2',
                data: theData.ips2,
                pointBackgroundColor: 'rgba(0, 255, 0, 0.5)',
            }, {
                label: 'IPS3',
                data: theData.ips3,
                pointBackgroundColor: 'rgba(0, 0, 255, 0.5)',
            }, {
                label: 'IPS4',
                data: theData.ips4,
                pointBackgroundColor: 'rgba(255, 255, 0, 0.5)',
            }, {
                label: 'IPS5',
                data: theData.ips5,
                pointBackgroundColor: 'rgba(0, 255, 255, 0.5)',
            }],
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: {
                        display: true,
                        text: 'Theoretical Quantiles',
                    },
                },
                y: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Sample Quantiles',
                    },
                },
            },
        },
    });
</script>

<script>
   var ctx = document.getElementById('correlationChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['ips1', 'ips2', 'ips3', 'ips4', 'ips5'],
            datasets: [{
                label: 'Korelasi',
                data: {!! json_encode($correlations) !!}, // Ambil data korelasi dari PHP
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
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
@endpush
