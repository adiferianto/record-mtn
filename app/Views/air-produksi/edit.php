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
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Air Produksi</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/airProduksi/update/<?= $air_produksi['id']; ?>" method="post">
                        <!-- //untuk menjaga agar form hanya bisa diinput dari halaman ini saja
                                //menghindari pemalsuan dari halaman lain -->
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="hidden" class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" id="id" name="id" value="<?= old('id') ? old('id') : $air_produksi['id']; ?>">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal') ? old('tanggal') : $air_produksi['tanggal']; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="shift">Shift</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control  <?= ($validation->hasError('shift')) ? 'is-invalid' : ''; ?>" id="shift" name="shift">
                                            <option value="<?= $air_produksi['shift']; ?>" selected><?php if ($air_produksi['shift'] == '1') : ?> Shift 1 <?php elseif ($air_produksi['shift'] == '2') : ?> Shift 2 <?php else : ?> Shift 3 <?php endif; ?></option>
                                            <option value="1">Shift 1</option>
                                            <option value="2">Shift 2</option>
                                            <option value="3">Shift 3</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('shift'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="cw_4">Clean Water 4</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('cw_4_last')) ? 'is-invalid' : ''; ?>" id="cw_4_last" name="cw_4_last" value="<?= old('cw_4_last') ? old('cw_4_last') : $air_produksi['cw_4_last']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_4_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('cw_4')) ? 'is-invalid' : ''; ?>" id="cw_4" name="cw_4" value="<?= old('cw_4') ? old('cw_4') : $air_produksi['cw_4']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_4'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="cw_4_pemakaian" name="cw_4_pemakaian" value="<?= old('cw_4_pemakaian') ? old('cw_4_pemakaian') : $air_produksi['cw_4_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_4_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="cw_6">Clean Water 6</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('cw_6_last')) ? 'is-invalid' : ''; ?>" id="cw_6_last" name="cw_6_last" value="<?= old('cw_6_last') ? old('cw_6_last') : $air_produksi['cw_6_last']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_6_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('cw_6')) ? 'is-invalid' : ''; ?>" id="cw_6" name="cw_6" value="<?= old('cw_6') ? old('cw_6') : $air_produksi['cw_6']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_6'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="cw_6_pemakaian" name="cw_6_pemakaian" value="<?= old('cw_6_pemakaian') ? old('cw_6_pemakaian') : $air_produksi['cw_6_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('cw_6_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sw_4">Soft Water 4</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sw_4_last')) ? 'is-invalid' : ''; ?>" id="sw_4_last" name="sw_4_last" value="<?= old('sw_4_last') ? old('sw_4_last') : $air_produksi['sw_4_last']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_4_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sw_4')) ? 'is-invalid' : ''; ?>" id="sw_4" name="sw_4" value="<?= old('sw_4') ? old('sw_4') : $air_produksi['sw_4']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_4'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="sw_4_pemakaian" name="sw_4_pemakaian" value="<?= old('sw_4_pemakaian') ? old('sw_4_pemakaian') : $air_produksi['sw_4_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_4_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sw_6">Soft Water 6</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sw_6_last')) ? 'is-invalid' : ''; ?>" id="sw_6_last" name="sw_6_last" value="<?= old('sw_6_last') ? old('sw_6_last') : $air_produksi['sw_6_last']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_6_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sw_6')) ? 'is-invalid' : ''; ?>" id="sw_6" name="sw_6" value="<?= old('sw_6') ? old('sw_6') : $air_produksi['sw_6']; ?>" onkeyup="sumCw()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_6'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="sw_6_pemakaian" name="sw_6_pemakaian" value="<?= old('sw_6_pemakaian') ? old('sw_6_pemakaian') : $air_produksi['sw_6_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sw_6_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row" hidden>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="user">user</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('user')) ? 'is-invalid' : ''; ?>" id="user" name="user" value="<?= $air_produksi['user']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('user'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-1 p-1">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?= base_url(); ?>/airProduksi" class="btn btn-warning btn-user btn-block">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>