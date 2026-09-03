<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12">
            <p>Welcome, <span><strong><?= session()->get('fullname'); ?></strong></span></p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($charts as $key => $c): ?>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= esc($c['label']) ?></h6>
                    <form method="get" class="form-inline">
                        <?php foreach ($charts as $k2 => $c2): if ($k2 === $key) continue; ?>
                            <input type="hidden" name="tahun_<?= esc($k2) ?>" value="<?= esc($c2['selectedYear']) ?>">
                        <?php endforeach; ?>
                        <label for="tahun_<?= esc($key) ?>" class="mr-2 mb-0 small">Tahun:</label>
                        <select name="tahun_<?= esc($key) ?>" id="tahun_<?= esc($key) ?>" class="form-control form-control-sm" onchange="this.form.submit()">
                            <?php foreach ($c['daftarTahun'] as $tahun): ?>
                                <option value="<?= esc($tahun) ?>" <?= ($tahun == $c['selectedYear']) ? 'selected' : '' ?>>
                                    <?= esc($tahun) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <?php if ($c['bulanTertinggi']): ?>
                    <div class="mb-3 small text-gray-600">
                        Tertinggi: <strong><?= esc($c['bulanTertinggi']) ?></strong>
                        (<?= number_format($c['totalTertinggi'], 2) ?> <?= esc($c['unit']) ?>)
                    </div>
                    <?php endif; ?>
                    <canvas id="chart_<?= esc($key) ?>" height="180"></canvas>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="<?= base_url(); ?>/vendor/chart.js/Chart.min.js"></script>
<script>
const chartColors = {
    sumur:    'rgba(78, 115, 223, 0.8)',
    proses:   'rgba(28, 200, 138, 0.8)',
    produksi: 'rgba(33, 150, 243, 0.9)',
    boiler:   'rgba(231, 74, 59, 0.8)',
    wwtp:     'rgba(54, 185, 204, 0.8)',
    sludge:   'rgba(133, 82, 199, 0.8)',
    steam:    'rgba(255, 128, 66, 0.8)',
    kwh:      'rgba(255, 193, 7, 0.9)',
};

<?php foreach ($charts as $key => $c): ?>
new Chart(document.getElementById('chart_<?= esc($key) ?>').getContext('2d'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($c['labels']) ?>,
        datasets: [{
            label: '<?= esc($c['label']) ?> (<?= esc($c['unit']) ?>) - <?= esc($c['selectedYear']) ?>',
            data: <?= json_encode($c['values']) ?>,
            backgroundColor: chartColors['<?= esc($key) ?>'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
    }
});
<?php endforeach; ?>
</script>
<?= $this->endSection(); ?>
