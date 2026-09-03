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
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Air Sumur</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/airSumur/save" method="post">
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
                                        <label for="sumur_1">Sumur 1</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_1_last')) ? 'is-invalid' : ''; ?>" id="sumur_1_last" name="sumur_1_last" value="<?= old('sumur_1_last'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_1_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_1')) ? 'is-invalid' : ''; ?>" id="sumur_1" name="sumur_1" value="<?= old('sumur_1'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_1'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_1_pemakaian')) ? 'is-invalid' : ''; ?>" id="sumur_1_pemakaian" name="sumur_1_pemakaian" value="<?= old('sumur_1_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sumur_2">Sumur 2</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_2_last')) ? 'is-invalid' : ''; ?>" id="sumur_2_last" name="sumur_2_last" value="<?= old('sumur_2_last'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_2_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_2')) ? 'is-invalid' : ''; ?>" id="sumur_2" name="sumur_2" value="<?= old('sumur_2'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_2_pemakaian')) ? 'is-invalid' : ''; ?>" id="sumur_2_pemakaian" name="sumur_2_pemakaian" value="<?= old('sumur_2_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sumur_3">Sumur 3</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_3_last')) ? 'is-invalid' : ''; ?>" id="sumur_3_last" name="sumur_3_last" value="<?= old('sumur_3_last'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_3_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_3')) ? 'is-invalid' : ''; ?>" id="sumur_3" name="sumur_3" value="<?= old('sumur_3'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_3'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_3_pemakaian')) ? 'is-invalid' : ''; ?>" id="sumur_3_pemakaian" name="sumur_3_pemakaian" value="<?= old('sumur_3_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="sumur_4">Sumur 4</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_4_last')) ? 'is-invalid' : ''; ?>" id="sumur_4_last" name="sumur_4_last" value="<?= old('sumur_4_last'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_4_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_4')) ? 'is-invalid' : ''; ?>" id="sumur_4" name="sumur_4" value="<?= old('sumur_4'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('sumur_4'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('sumur_4_pemakaian')) ? 'is-invalid' : ''; ?>" id="sumur_4_pemakaian" name="sumur_4_pemakaian" value="<?= old('sumur_4_pemakaian'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="recycle">Recycle Dyeing</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('recycle_last')) ? 'is-invalid' : ''; ?>" id="recycle_last" name="recycle_last" value="<?= old('recycle_last'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('recycle_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('recycle')) ? 'is-invalid' : ''; ?>" id="recycle" name="recycle" value="<?= old('recycle'); ?>" onkeyup="sum()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('recycle'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('recycle_total')) ? 'is-invalid' : ''; ?>" id="recycle_total" name="recycle_total" value="<?= old('recycle_total'); ?>" readonly>
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