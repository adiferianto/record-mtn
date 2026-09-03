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
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah KWH / Listrik</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/kwh/save" method="post">
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
                                            <input type="hidden" class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" id="id" name="id" value="<?= old('id'); ?>">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal'); ?>">
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
                                            <option value="" selected><?= old('shift') ? old('shift') : 'Pilih Shift...'; ?></option>
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
                                        <label for="induk_pln_wbp">Induk PLN WBP</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('induk_pln_wbp_last') ? 'is-invalid' : ''); ?>" id="induk_pln_wbp_last" name="induk_pln_wbp_last" value="<?= old('induk_pln_wbp_last'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('induk_pln_wbp_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('induk_pln_wbp') ? 'is-invalid' : ''); ?>" id="induk_pln_wbp" name="induk_pln_wbp" value="<?= old('induk_pln_wbp'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('induk_pln_wbp'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="induk_pln_wbp_pemakaian" name="induk_pln_wbp_pemakaian" value="<?= old('induk_pln_wbp_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="induk_pln_lwbp">Induk PLN LWBP</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('induk_pln_lwbp_last') ? 'is-invalid' : ''); ?>" id="induk_pln_lwbp_last" name="induk_pln_lwbp_last" value="<?= old('induk_pln_lwbp_last'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('induk_pln_lwbp_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('induk_pln_lwbp') ? 'is-invalid' : ''); ?>" id="induk_pln_lwbp" name="induk_pln_lwbp" value="<?= old('induk_pln_lwbp'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('induk_pln_lwbp'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="induk_pln_lwbp_pemakaian" name="induk_pln_lwbp_pemakaian" value="<?= old('induk_pln_lwbp_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <hr>
                                <p class="text-center">--KWH WTP--</p>
                                <hr>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="kwh_wtp_am">Angka Meter</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('kwh_wtp_am_last')) ? 'is-invalid' : ''; ?>" id="kwh_wtp_am_last" name="kwh_wtp_am_last" value="<?= old('kwh_wtp_am_last'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kwh_wtp_am'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('kwh_wtp_am')) ? 'is-invalid' : ''; ?>" id="kwh_wtp_am" name="kwh_wtp_am" value="<?= old('kwh_wtp_am'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kwh_wtp_am'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wtp_jp">Jumlah Pemakaian</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="kwh_wtp_jp" name="kwh_wtp_jp" value="<?= old('kwh_wtp_jp'); ?>" onkeyup="sumKwh();" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wtp_pemakaian_wbp">Pemakaian WBP</label>
                                    </div>
                                    <div class="col-md-6 showcase_content_area">
                                        <input type="text" class="form-control" id="kwh_wtp_pemakaian_wbp" name="kwh_wtp_pemakaian_wbp" value="<?= old('kwh_wtp_pemakaian_wbp'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wtp_pemakaian_lwbp">Pemakaian LWBP</label>
                                    </div>
                                    <div class="col-md-6 showcase_content_area">
                                        <input type="text" class="form-control" id="kwh_wtp_pemakaian_lwbp" name="kwh_wtp_pemakaian_lwbp" value="<?= old('kwh_wtp_pemakaian_lwbp'); ?>" readonly>
                                    </div>
                                </div>

                                <hr>
                                <p class="text-center">--KWH WWTP--</p>
                                <hr>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="kwh_wwtp_am">Angka Meter</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('kwh_wwtp_am_last')) ? 'is-invalid' : ''; ?>" id="kwh_wwtp_am_last" name="kwh_wwtp_am_last" value="<?= old('kwh_wwtp_am_last'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kwh_wwtp_am'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('kwh_wwtp_am')) ? 'is-invalid' : ''; ?>" id="kwh_wwtp_am" name="kwh_wwtp_am" value="<?= old('kwh_wwtp_am'); ?>" onkeyup="sumKwh();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kwh_wwtp_am'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wwtp_jp">Jumlah Pemakaian</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="kwh_wwtp_jp" name="kwh_wwtp_jp" value="<?= old('kwh_wwtp_jp'); ?>" onkeyup="sumKwh();" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wwtp_pemakaian_wbp">Pemakaian WBP</label>
                                    </div>
                                    <div class="col-md-6 showcase_content_area">
                                        <input type="text" class="form-control" id="kwh_wwtp_pemakaian_wbp" name="kwh_wwtp_pemakaian_wbp" value="<?= old('kwh_wwtp_pemakaian_wbp'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="kwh_wwtp_pemakaian_lwbp">Pemakaian LWBP</label>
                                    </div>
                                    <div class="col-md-6 showcase_content_area">
                                        <input type="text" class="form-control" id="kwh_wwtp_pemakaian_lwbp" name="kwh_wwtp_pemakaian_lwbp" value="<?= old('kwh_wwtp_pemakaian_lwbp'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row" hidden>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="user">user</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('user')) ? 'is-invalid' : ''; ?>" id="user" name="user" value="<?= session()->get('fullname'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('user'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-1 p-2">
                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>