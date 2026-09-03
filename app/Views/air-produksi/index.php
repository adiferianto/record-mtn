<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Air Produksi</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Air Produksi</h6>
                    <div class="form-group m-0 row">
                        <div class="pr-1">
                            <a href="<?= base_url('airProduksi/add'); ?>" class="btn btn-primary"><i class="fas fa-tint"></i> Add Air Produksi</a>
                        </div>

                        <form action="airProduksi/export" method="post">
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
                                    <th colspan="3" class="text-center">Clean Water 4"</th>
                                    <th colspan="3" class="text-center">Clean Water 6"</th>
                                    <th colspan="3" class="text-center">Soft Water 4"</th>
                                    <th colspan="3" class="text-center">Soft Water 6"</th>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = (($pager->getCurrentPage('default') - 1) * 20) + 1; ?>
                                <?php foreach ($air_produksi as $ap) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $ap['tanggal']; ?></td>
                                        <td><?= $ap['shift']; ?></td>
                                        <td><?= $ap['cw_4_last']; ?></td>
                                        <td><?= $ap['cw_4']; ?></td>
                                        <td><?= $ap['cw_4_pemakaian']; ?></td>
                                        <td><?= $ap['cw_6_last']; ?></td>
                                        <td><?= $ap['cw_6']; ?></td>
                                        <td><?= $ap['cw_6_pemakaian']; ?></td>
                                        <td><?= $ap['sw_4_last']; ?></td>
                                        <td><?= $ap['sw_4']; ?></td>
                                        <td><?= $ap['sw_4_pemakaian']; ?></td>
                                        <td><?= $ap['sw_6_last']; ?></td>
                                        <td><?= $ap['sw_6']; ?></td>
                                        <td><?= $ap['sw_6_pemakaian']; ?></td>

                                        <td class="text-center">
                                            <!-- <a href="/airProduksi/<?= $ap['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></i></a> -->
                                            <?php if ((session()->get('level') == '1') or
                                                (session()->get('level') == '2') or
                                                (session()->get('level') == '3')
                                            ) : ?>
                                                <a href="<?= base_url() ?>/airProduksi/edit/<?= $ap['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pen-square"></i></i></a>
                                            <?php endif; ?>
                                            <?php if (
                                                session()->get('level') == '1'
                                            ) : ?>
                                                <form action="<?= base_url(); ?>/airProduksi/delete/<?= $ap['id']; ?>" method="post" class="d-inline">
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