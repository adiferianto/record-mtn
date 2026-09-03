<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Air Boiler</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Air Boiler</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/airBoiler/update/<?= $air_boiler['id']; ?>" method="post">
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
                                            <input type="hidden" class="form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" id="id" name="id" value="<?= old('id') ? old('id') : $air_boiler['id']; ?>">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal') ? old('tanggal') : $air_boiler['tanggal']; ?>">
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
                                            <option value="<?= $air_boiler['shift']; ?>" selected><?php if ($air_boiler['shift'] == '1') : ?> Shift 1 <?php elseif ($air_boiler['shift'] == '2') : ?> Shift 2 <?php else : ?> Shift 3 <?php endif; ?></option>
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
                                        <label for="ab_1">Air Boiler 1</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_1_last')) ? 'is-invalid' : ''; ?>" id="ab_1_last" name="ab_1_last" value="<?= old('ab_1_last') ? old('ab_1_last') : $air_boiler['ab_1_last']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_1_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_1')) ? 'is-invalid' : ''; ?>" id="ab_1" name="ab_1" value="<?= old('ab_1') ? old('ab_1') : $air_boiler['ab_1']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_1'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="ab_1_pemakaian" name="ab_1_pemakaian" value="<?= old('ab_1_pemakaian') ? old('ab_1_pemakaian') : $air_boiler['ab_1_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_1_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="ab_2">Air Boiler 2</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_2_last')) ? 'is-invalid' : ''; ?>" id="ab_2_last" name="ab_2_last" value="<?= old('ab_2_last') ? old('ab_2_last') : $air_boiler['ab_2_last']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_2_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_2')) ? 'is-invalid' : ''; ?>" id="ab_2" name="ab_2" value="<?= old('ab_2') ? old('ab_2') : $air_boiler['ab_2']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="ab_2_pemakaian" name="ab_2_pemakaian" value="<?= old('ab_2_pemakaian') ? old('ab_2_pemakaian') : $air_boiler['ab_2_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_2_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="ab_3">Air Boiler 3</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sebelum">Meter Sebelum</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_3_last')) ? 'is-invalid' : ''; ?>" id="ab_3_last" name="ab_3_last" value="<?= old('ab_3_last') ? old('ab_3_last') : $air_boiler['ab_3_last']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_3_last'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="sekarang">Meter Sekarang</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('ab_3')) ? 'is-invalid' : ''; ?>" id="ab_3" name="ab_3" value="<?= old('ab_3') ? old('ab_3') : $air_boiler['ab_3']; ?>" onkeyup="sumAb()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_3'); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="pemakaian">Total Pemakaian</label>
                                        <input type="text" class="form-control" id="ab_3_pemakaian" name="ab_3_pemakaian" value="<?= old('ab_3_pemakaian') ? old('ab_3_pemakaian') : $air_boiler['ab_3_pemakaian']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ab_3_pemakaian'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row" hidden>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <label for="user">user</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('user')) ? 'is-invalid' : ''; ?>" id="user" name="user" value="<?= $air_boiler['user']; ?>">
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
                                    <a href="<?= base_url(); ?>/airBoiler" class="btn btn-warning btn-user btn-block">Batal</a>
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