@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-12 col-lg-9">
            <div class="col-12 col-xl-12">
                <h3 class="card-title">Map Chart</h3>
                <h6 class="card-subtitle">Jumlah Sebaran Mahasiswa</h6>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="iframe-container d-flex justify-content-between" style="gap: 20px;">
                    <div style="text-align: center; width: 750px;">
                        <iframe src="{{ asset('map_chart3.html') }}" style="width: 100%; height: 600px; border: none;"></iframe>
                        <h4 class="map-title">Jumlah Sebaran Mahasiswa</h4>
                    </div>
                    <div style="text-align: center; width: 750px;">
                        <iframe src="{{ asset('map_chart.html') }}" style="width: 100%; height: 600px; border: none;"></iframe>
                        <h4 class="map-title">Jumlah Sebaran Mahasiswa</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-12">
            <h3 class="card-title">Chart</h3>
            <h6 class="card-subtitle">Jumlah dan Prediksi</h6>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between" style="gap: 20px;">
                            <div style="width: 750px;">
                                <canvas id="jurusanChart" style="width: 750px; height: 400px;"></canvas>
                                <h4 class="chart-title text-center">Jurusan Favorit Berdasarkan Daerah (Top 5 Provinsi)</h4>
                            </div>
                            <div style="width: 750px;">
                                <canvas id="predictionChart" style="width: 750px; height: 400px;"></canvas>
                                <h4 class="chart-title text-center">Prediksi Linear Jumlah Mahasiswa di Provinsi BANTEN</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    fetch('/data.json')
        .then(response => response.json())
        .then(data => {
            const provinsiTotal = data.reduce((acc, curr) => {
                if (!acc[curr.provinsi]) {
                    acc[curr.provinsi] = 0;
                }
                acc[curr.provinsi] += curr.Count;
                return acc;
            }, {});

            const topProvinsi = Object.entries(provinsiTotal)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 5)
                .map(entry => entry[0]);

            const filteredData = data.filter(item => topProvinsi.includes(item.provinsi));

            const jurusan = [...new Set(filteredData.map(item => item.jurusan))];

            const datasets = jurusan.map(jur => {
                return {
                    label: jur,
                    data: topProvinsi.map(prov => {
                        const found = filteredData.find(d => d.provinsi === prov && d.jurusan === jur);
                        return found ? found.Count : 0;
                    }),
                    backgroundColor: getRandomColor(),
                };
            });

            function getRandomColor() {
                const letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            const ctx = document.getElementById('jurusanChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: topProvinsi,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jurusan Favorit Berdasarkan Daerah (Top 5 Provinsi)'
                        }
                    },
                    scales: {
                        x: {
                            stacked: false
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

<script>
    fetch('/linear.json')
        .then(response => response.json())
        .then(data => {
            const years = data.map(item => item.Tahun);
            const predictions = data.map(item => item['Prediksi Jumlah Mahasiswa']);
            const percentageChanges = data.map(item => item['Persentase Kenaikan (%)']);

            const ctx = document.getElementById('predictionChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [
                        {
                            label: 'Prediksi Jumlah Mahasiswa',
                            data: predictions,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4,
                        },
                        {
                            label: 'Persentase Kenaikan (%)',
                            data: percentageChanges,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 2,
                            tension: 0.4,
                            yAxisID: 'y1',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Prediksi Linear Jumlah Mahasiswa di Provinsi BANTEN'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Mahasiswa'
                            }
                        },
                        y1: {
                            beginAtZero: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Persentase Kenaikan (%)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        }
                    }
                }
            });
        });
</script>
@endsection
