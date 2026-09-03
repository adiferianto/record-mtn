<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Air Sumur</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Air Sumur</h6>
                    <div class="form-group m-0 row">
                        <div class="pr-1">
                            <a href="<?= base_url('airSumur/add'); ?>" class="btn btn-primary"><i class="fas fa-tint"></i> Add Air Sumur</a>
                        </div>
                        <form action="airSumur/export" method="post">
                            <button type="submit" class="btn btn-secondary">Export</button>
                        </form>
                    </div>

                </div>
                <?php if (session()->getFlashData('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align : middle;">#</th>
                                    <th rowspan="2" class="text-center" style="vertical-align : middle;">Tanggal</th>
                                    <th rowspan="2" class="text-center" style="vertical-align : middle;">Shift</th>
                                    <th colspan="3" class="text-center">Sumur 1</th>
                                    <th colspan="3" class="text-center">Sumur 2</th>
                                    <th colspan="3" class="text-center">Sumur 3</th>
                                    <th colspan="3" class="text-center">Sumur 4</th>
                                    <th colspan="3" class="text-center">Recycle Dyeing</th>
                                    <?php if (
                                        session()->get('level') == '1' or
                                        (session()->get('level') == '2')
                                    ) : ?>
                                        <th rowspan="2" class="text-center" style="vertical-align : middle;">Aksi</th>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th>Meter Sebelum</th>
                                    <th>Meter Sekarang</th>
                                    <th>Total</th>
                                    <th>Meter Sebelum</th>
                                    <th>Meter Sekarang</th>
                                    <th>Total</th>
                                    <th>Meter Sebelum</th>
                                    <th>Meter Sekarang</th>
                                    <th>Total</th>
                                    <th>Meter Sebelum</th>
                                    <th>Meter Sekarang</th>
                                    <th>Total</th>
                                    <th>Meter Sebelum</th>
                                    <th>Meter Sekarang</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = (($pager->getCurrentPage('default') - 1) * 20) + 1; ?>
                                <?php foreach ($air_sumur as $a) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $a['tanggal']; ?></td>
                                        <td><?= $a['shift']; ?></td>
                                        <td><?= $a['sumur_1_last']; ?></td>
                                        <td><?= $a['sumur_1']; ?></td>
                                        <td><?= $a['sumur_1_pemakaian']; ?></td>
                                        <td><?= $a['sumur_2_last']; ?></td>
                                        <td><?= $a['sumur_2']; ?></td>
                                        <td><?= $a['sumur_2_pemakaian']; ?></td>
                                        <td><?= $a['sumur_3_last']; ?></td>
                                        <td><?= $a['sumur_3']; ?></td>
                                        <td><?= $a['sumur_3_pemakaian']; ?></td>
                                        <td><?= $a['sumur_4_last']; ?></td>
                                        <td><?= $a['sumur_4']; ?></td>
                                        <td><?= $a['sumur_4_pemakaian']; ?></td>
                                        <td><?= $a['recycle_last']; ?></td>
                                        <td><?= $a['recycle']; ?></td>
                                        <td><?= $a['recycle_total']; ?></td>

                                        <td class="text-center">
                                            <!-- <a href="/airSumur/<?= $a['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></i></a> -->
                                            <?php if (
                                                session()->get('level') == '1' or
                                                (session()->get('level') == '2') or
                                                (session()->get('level') == '3')
                                            ) : ?>
                                                <a href="<?= base_url(); ?>/airSumur/edit/<?= $a['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pen-square"></i></a>
                                            <?php endif; ?>
                                            <?php if (
                                                session()->get('level') == '1'
                                            ) : ?>
                                                <form action="<?= base_url(); ?>/airSumur/delete/<?= $a['id']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?');"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            <?= $pager->links("default", "bootstrap_full") ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>