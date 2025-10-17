<?php $this->assign('title', 'Reports'); ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar"></i> Reports Dashboard</h2>
        <?= $this->Html->link(
            '<i class="fas fa-file-pdf"></i> Export to PDF',
            ['action' => 'export'],
            [
                'class' => 'btn btn-danger',
                'escape' => false,
                'target' => '_blank'
            ]
        ) ?>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title mb-0">Books by Type</h3>
                </div>
                <div class="card-body">
                    <canvas id="booksChart" style="min-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
<div class="row mb-4">
    <div class="col">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Items Issued Per Month</h3>
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <?= $this->Form->create(null, [
                    'type' => 'get',
                    'class' => 'mb-4'
                ]) ?>
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <?= $this->Form->control('filter_type', [
                            'type' => 'select',
                            'options' => [
                                'year' => 'Filter by Year',
                                'date_range' => 'Filter by Date Range'
                            ],
                            'class' => 'form-control',
                            'value' => $filterType,
                            'label' => 'Filter Type',
                            'id' => 'filter-type'
                        ]) ?>
                    </div>

                    <!-- Year Filter -->
                    <div class="col-md-2" id="year-filter" style="<?= $filterType === 'date_range' ? 'display: none;' : '' ?>">
                        <?= $this->Form->control('year', [
                            'type' => 'select',
                            'options' => array_combine($availableYears, $availableYears),
                            'class' => 'form-control',
                            'value' => $selectedYear,
                            'label' => 'Select Year'
                        ]) ?>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="col-md-3 date-range" style="<?= $filterType === 'year' ? 'display: none;' : '' ?>">
                        <?= $this->Form->control('start_date', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'value' => $startDate,
                            'label' => 'Start Date'
                        ]) ?>
                    </div>
                    <div class="col-md-3 date-range" style="<?= $filterType === 'year' ? 'display: none;' : '' ?>">
                        <?= $this->Form->control('end_date', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'value' => $endDate,
                            'label' => 'End Date'
                        ]) ?>
                    </div>

                    <div class="col-md-2">
                        <?= $this->Form->button('Apply Filter', [
                            'class' => 'btn btn-primary'
                        ]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>

                <<div style="height: 400px;"> <!-- Fixed height container -->
        <canvas id="issuedChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar mr-2"></i>Top 5 Most Issued Books
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="topIssuedBooksChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Pie and Doughnut Charts -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0">Return Status Distribution (Pie)</h3>
                </div>
                <div class="card-body">
                    <canvas id="returnedPieChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">Return Status Distribution (Doughnut)</h3>
                </div>
                <div class="card-body">
                    <canvas id="returnedDoughnutChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php // Load Chart.js from CDN ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/chart.js', ['block' => true]); ?>

<?php $this->append('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Filter type change handler
    document.getElementById('filter-type').addEventListener('change', function() {
        const yearFilter = document.getElementById('year-filter');
        const dateRangeInputs = document.querySelectorAll('.date-range');
        
        if (this.value === 'year') {
            yearFilter.style.display = 'block';
            dateRangeInputs.forEach(el => el.style.display = 'none');
        } else {
            yearFilter.style.display = 'none';
            dateRangeInputs.forEach(el => el.style.display = 'block');
        }
    });

    // Books by Type Bar Chart
    const booksCtx = document.getElementById('booksChart').getContext('2d');
    new Chart(booksCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bookTypes) ?>,
            datasets: [{
                label: 'Number of Books',
                data: <?= json_encode($bookCounts) ?>,
                backgroundColor: [
                    'rgba(255, 159, 64, 0.7)',   // Orange
                    'rgba(75, 192, 192, 0.7)',    // Teal
                    'rgba(153, 102, 255, 0.7)',   // Purple
                    'rgba(255, 99, 132, 0.7)',    // Red
                    'rgba(54, 162, 235, 0.7)',    // Blue
                    'rgba(255, 206, 86, 0.7)',    // Yellow
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribution of Books by Type',
                    font: { 
                        size: 16,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: false // Hide legend as it's redundant for this chart
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Books',
                        font: {
                            size: 14
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Book Type',
                        font: {
                            size: 14
                        }
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

        // Bar Chart
    const barCtx = document.getElementById('issuedChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($months) ?>,
            datasets: [{
                label: 'Number of Items Issued',
                data: <?= json_encode($totals) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                barPercentage: 0.6, // Make bars thinner
                categoryPercentage: 0.7 // Add space between bars
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Changed to true
            aspectRatio: 2, // Control the height relative to width
            plugins: {
                title: {
                    display: true,
                    text: <?= $filterType === 'date_range' ? 
                        "('Items Issued from ' + " . json_encode($startDate) . " + ' to ' + " . json_encode($endDate) . ")" :
                        "('Items Issued for Year ' + " . json_encode($selectedYear) . ")" ?>,
                    font: { size: 16 }
                },
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        stepSize: 1,
                        font: {
                            size: 11 // Smaller font size
                        }
                    },
                    grid: {
                        display: true,
                        drawBorder: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 11 // Smaller font size
                        },
                        maxRotation: 45, // Rotate labels for better fit
                        minRotation: 45
                    }
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 0
                }
            }
        }
    });

    var ctx = document.getElementById('topIssuedBooksChart').getContext('2d');
    
    // Data from controller
    var bookTitles = <?= json_encode($bookTitles) ?>;
    var issueCounts = <?= json_encode($issueCounts) ?>;

    // Create horizontal bar chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bookTitles,
            datasets: [{
                label: 'Number of Times Issued',
                data: issueCounts,
                backgroundColor: [
                    'rgba(60, 141, 188, 0.8)',
                    'rgba(210, 214, 222, 0.8)',
                    'rgba(0, 192, 239, 0.8)',
                    'rgba(0, 166, 90, 0.8)',
                    'rgba(243, 156, 18, 0.8)'
                ],
                borderColor: [
                    'rgba(60, 141, 188, 1)',
                    'rgba(210, 214, 222, 1)',
                    'rgba(0, 192, 239, 1)',
                    'rgba(0, 166, 90, 1)',
                    'rgba(243, 156, 18, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',  // This makes the bar chart horizontal
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Times Issued'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Book Titles'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Top 5 Most Issued Books',
                    font: {
                        size: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Times Issued: ${context.parsed.x}`;
                        }
                    }
                }
            }
        }
    });

    // Common data for Pie and Doughnut charts
    const statusData = {
        labels: <?= json_encode($statuses) ?>,
        datasets: [{
            data: <?= json_encode($statusCounts) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',   // Red
                'rgba(75, 192, 192, 0.8)',   // Green
                'rgba(255, 206, 86, 0.8)',   // Yellow
                'rgba(153, 102, 255, 0.8)',  // Purple
                'rgba(54, 162, 235, 0.8)'    // Blue
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Common options for Pie and Doughnut charts
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: { size: 12 }
                }
            }
        }
    };

    // Pie Chart
    const pieCtx = document.getElementById('returnedPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: statusData,
        options: commonOptions
    });

    // Doughnut Chart
    const doughnutCtx = document.getElementById('returnedDoughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: statusData,
        options: commonOptions
    });
});
</script>
<?php $this->end(); ?>