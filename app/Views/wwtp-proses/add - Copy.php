<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">WTP/WWTP Proses</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah WTP/WWTP Proses</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/wwtp/save" method="post">
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
                                        <label for="wwtp_in_1">WWTP IN 1</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_in_1_last') ? 'is-invalid' : ''); ?>" id="wwtp_in_1_last" name="wwtp_in_1_last" value="<?= old('wwtp_in_1_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_in_1_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_in_1') ? 'is-invalid' : ''); ?>" id="wwtp_in_1" name="wwtp_in_1" value="<?= old('wwtp_in_1'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_in_1'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="wwtp_in_1_pemakaian" name="wwtp_in_1_pemakaian" value="<?= old('wwtp_in_1_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="wwtp_in_2">WWTP IN 2</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_in_2_last') ? 'is-invalid' : ''); ?>" id="wwtp_in_2_last" name="wwtp_in_2_last" value="<?= old('wwtp_in_2_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_in_2_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_in_2') ? 'is-invalid' : ''); ?>" id="wwtp_in_2" name="wwtp_in_2" value="<?= old('wwtp_in_2'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_in_2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="wwtp_in_2_pemakaian" name="wwtp_in_2_pemakaian" value="<?= old('wwtp_in_2_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="wwtp_out">WWTP OUT</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_out_last') ? 'is-invalid' : ''); ?>" id="wwtp_out_last" name="wwtp_out_last" value="<?= old('wwtp_out_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_out_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_out') ? 'is-invalid' : ''); ?>" id="wwtp_out" name="wwtp_out" value="<?= old('wwtp_out'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_out'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="wwtp_out_pemakaian" name="wwtp_out_pemakaian" value="<?= old('wwtp_out_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="wwtp_out2">WWTP OUT 2</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_out2_last') ? 'is-invalid' : ''); ?>" id="wwtp_out2_last" name="wwtp_out2_last" value="<?= old('wwtp_out2_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_out2_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('wwtp_out2') ? 'is-invalid' : ''); ?>" id="wwtp_out2" name="wwtp_out2" value="<?= old('wwtp_out2'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('wwtp_out2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="wwtp_out2_pemakaian" name="wwtp_out2_pemakaian" value="<?= old('wwtp_out2_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="ap">Adjust Pool</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ap_last') ? 'is-invalid' : ''); ?>" id="ap_last" name="ap_last" value="<?= old('ap_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ap_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ap') ? 'is-invalid' : ''); ?>" id="ap" name="ap" value="<?= old('ap'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ap'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="ap_pemakaian" name="ap_pemakaian" value="<?= old('ap_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="ld">Limbah Domestik</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ld_last') ? 'is-invalid' : ''); ?>" id="ld_last" name="ld_last" value="<?= old('ld_last'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ld_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ld') ? 'is-invalid' : ''); ?>" id="ld" name="ld" value="<?= old('ld'); ?>" onkeyup="sumWwtp();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ld'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="ld_pemakaian" name="ld_pemakaian" value="<?= old('ld_pemakaian'); ?>" readonly>
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