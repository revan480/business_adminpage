@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Financial Report</h1>
        </div>
        <div class="card-body">
            <div class="report-summary">
                <div class="summary-item">
                    <h3>Total Payments</h3>
                    <p id="totalPayments">${{ $totalPayments }}</p>
                </div>
                <div class="summary-item">
                    <h3>Total Expenses</h3>
                    <p id="totalExpenses">${{ $totalExpenses }}</p>
                </div>
                <div class="summary-item">
                    <h3>Difference</h3>
                    <p id="difference">${{ $difference }}</p>
                </div>
            </div>
            <div class="filter-container">
    <form id="filterForm" method="POST" action="{{ route('reports.financialReport') }}">
        @csrf
        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="start_date" value="{{ $startDate ?? '' }}">
        </div>
        <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="date" class="form-control" id="endDate" name="end_date" value="{{ $endDate ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
</div>
    

            <div class="chart-container">
                <canvas id="dailyChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        var url = '{{ route("reports.financialReport") }}?start_date=' + startDate + '&end_date=' + endDate;
        window.location.href = url; // Redirect to the filtered report URL
    });
    // Get the daily labels, income, and expenses from the controller
    var dailyLabels = {!! json_encode($dailyLabels) !!};
    var dailyIncome = {!! json_encode($dailyIncome) !!};
    var dailyExpenses = {!! json_encode($dailyExpenses) !!};

    // Create the line chart
    var ctx = document.getElementById('dailyChart').getContext('2d');
    var myChart;

    function updateChart() {
        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [
                    {
                        label: 'Daily Income',
                        data: dailyIncome,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Daily Expenses',
                        data: dailyExpenses,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return '$' + value;
                        }
                    }
                }
            }
        });
    }

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        // Make an AJAX request to the server to get filtered data
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '{{ route("reports.financial") }}?start_date=' + startDate + '&end_date=' + endDate, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('totalPayments').textContent = response.totalPayments;
                document.getElementById('totalExpenses').textContent = response.totalExpenses;
                document.getElementById('difference').textContent = response.difference;
                dailyLabels = response.dailyLabels;
                dailyIncome = response.dailyIncome;
                dailyExpenses = response.dailyExpenses;
                updateChart();
            }
        };
        xhr.send();
    });

    // Initial chart creation
    updateChart();
</script>
@endsection
