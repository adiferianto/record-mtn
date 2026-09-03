<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">KWH / Listrik</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel KWH / Listrik</h6>
                    <div class="form-group m-0 row">
                        <div class="pr-1">
                            <a href="<?= base_url('kwh/add'); ?>" class="btn btn-primary"><i class="fas fa-tint"></i> Add KWH / Listrik</a>
                        </div>

                        <form action="kwh/export" method="post">
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
                                    <th colspan="3" class="text-center">Listrik PLN WBP</th>
                                    <th colspan="3" class="text-center">Listrik PLN LWBP</th>
                                    <th colspan="5" class="text-center">KWH WTP</th>
                                    <th colspan="5" class="text-center">KWH WWTP</th>
                                    <?php if (
                                        session()->get('level') == '1' or
                                        session()->get('level') == '2' or
                                        session()->get('level') == '3'
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
                                    <th>Angka Meter Sebelum</th>
                                    <th>Angka Meter Sekarang</th>
                                    <th>Jumlah Pemakaian</th>
                                    <th>Pemakaian WBP</th>
                                    <th>Pemakaian LWBP</th>
                                    <th>Angka Meter Sebelum</th>
                                    <th>Angka Meter Sekarang</th>
                                    <th>Jumlah Pemakaian</th>
                                    <th>Pemakaian WBP</th>
                                    <th>Pemakaian LWBP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = (($pager->getCurrentPage('default') - 1) * 20) + 1; ?>
                                <?php foreach ($kwh as $k) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $k['tanggal']; ?></td>
                                        <td><?= $k['shift']; ?></td>
                                        <td><?= $k['induk_pln_wbp_last']; ?></td>
                                        <td><?= $k['induk_pln_wbp']; ?></td>
                                        <td><?= $k['induk_pln_wbp_pemakaian']; ?></td>
                                        <td><?= $k['induk_pln_lwbp_last']; ?></td>
                                        <td><?= $k['induk_pln_lwbp']; ?></td>
                                        <td><?= $k['induk_pln_lwbp_pemakaian']; ?></td>
                                        <td><?= $k['kwh_wtp_am_last']; ?></td>
                                        <td><?= $k['kwh_wtp_am']; ?></td>
                                        <td><?= $k['kwh_wtp_jp']; ?></td>
                                        <td><?= $k['kwh_wtp_pemakaian_wbp']; ?></td>
                                        <td><?= $k['kwh_wtp_pemakaian_lwbp']; ?></td>
                                        <td><?= $k['kwh_wwtp_am_last']; ?></td>
                                        <td><?= $k['kwh_wwtp_am']; ?></td>
                                        <td><?= $k['kwh_wwtp_jp']; ?></td>
                                        <td><?= $k['kwh_wwtp_pemakaian_wbp']; ?></td>
                                        <td><?= $k['kwh_wwtp_pemakaian_lwbp']; ?></td>

                                        <td class="text-center">
                                            <!-- <a href="/kwh/<?= $k['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></i></a> -->
                                            <?php if (
                                                session()->get('level') == '1' or
                                                session()->get('level') == '2' or
                                                session()->get('level') == '3'
                                            ) : ?>
                                                <a href="<?= base_url(); ?>/kwh/edit/<?= $k['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pen-square"></i></a>
                                            <?php endif; ?>
                                            <?php if (
                                                session()->get('level') == '1'
                                            ) : ?>
                                                <form action="<?= base_url(); ?>/kwh/delete/<?= $k['id']; ?>" method="post" class="d-inline">
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