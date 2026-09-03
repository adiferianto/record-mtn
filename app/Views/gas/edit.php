<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sludge Dryer & Boiler</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Sludge Dryer & Boiler</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/gas/update/<?= $gas['id']; ?>" method="post">
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
                                            <input type="hidden" class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" id="id" name="id" value="<?= old('id') ? old('id') : $gas['id']; ?>">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal') ? old('tanggal') : $gas['tanggal']; ?>">
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
                                            <option value="<?= $gas['shift']; ?>" selected><?php if ($gas['shift'] == '1') : ?> Shift 1 <?php elseif ($gas['shift'] == '2') : ?> Shift 2 <?php else : ?> Shift 3 <?php endif; ?></option>
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
                                        <label for="gas">Sludge Dryer</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('gas_last') ? 'is-invalid' : ''); ?>" id="gas_last" name="gas_last" value="<?= old('gas_last') ? old('gas_last') : $gas['gas_last']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gas_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('gas') ? 'is-invalid' : ''); ?>" id="gas" name="gas" value="<?= old('gas') ? old('gas') : $gas['gas']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gas'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="gas_pemakaian" name="gas_pemakaian" value="<?= old('gas_pemakaian') ? old('gas_pemakaian') : $gas['gas_pemakaian']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="boiler_1_2">Boiler 1 & 2</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('boiler_1_2_last') ? 'is-invalid' : ''); ?>" id="boiler_1_2_last" name="boiler_1_2_last" value="<?= old('boiler_1_2_last') ? old('boiler_1_2_last') : $gas['boiler_1_2_last']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('boiler_1_2_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('boiler_1_2') ? 'is-invalid' : ''); ?>" id="boiler_1_2" name="boiler_1_2" value="<?= old('boiler_1_2') ? old('boiler_1_2') : $gas['boiler_1_2']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('boiler_1_2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="boiler_1_2_pemakaian" name="boiler_1_2_pemakaian" value="<?= old('boiler_1_2_pemakaian') ? old('boiler_1_2_pemakaian') : $gas['boiler_1_2_pemakaian']; ?>" onkeyup="sumGas();" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="boiler_3">Boiler 3</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('boiler_3_last') ? 'is-invalid' : ''); ?>" id="boiler_3_last" name="boiler_3_last" value="<?= old('boiler_3_last') ? old('boiler_3_last') : $gas['boiler_3_last']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('boiler_3_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('boiler_3') ? 'is-invalid' : ''); ?>" id="boiler_3" name="boiler_3" value="<?= old('boiler_3') ? old('boiler_3') : $gas['boiler_3']; ?>" onkeyup="sumGas();">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('boiler_3'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="boiler_3_pemakaian" name="boiler_3_pemakaian" value="<?= old('boiler_3_pemakaian') ? old('boiler_3_pemakaian') : $gas['boiler_3_pemakaian']; ?>" onkeyup="sumGas();" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="total_pemakaian_boiler_1_2_3">Total Pemakaian Boiler 1 + 2 + 3</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control <?= ($validation->hasError('total_pemakaian_boiler_1_2_3')) ? 'is-invalid' : ''; ?>" id="total_pemakaian_boiler_1_2_3" name="total_pemakaian_boiler_1_2_3" value="<?= old('total_pemakaian_boiler_1_2_3') ? old('total_pemakaian_boiler_1_2_3') : $gas['total_pemakaian_boiler_1_2_3']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row" hidden>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="user">user</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('user')) ? 'is-invalid' : ''; ?>" id="user" name="user" value="<?= $gas['user']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('user'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-1 p-2">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?= base_url(); ?>/gas" class="btn btn-warning btn-user btn-block">Batal</a>
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