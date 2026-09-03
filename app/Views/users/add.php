<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
                </div>
                <div class="card-body">
                    <form class="user" action="<?= base_url(); ?>/users/save" method="post">
                        <!-- //untuk menjaga agar form hanya bisa diinput dari halaman ini saja
                                //menghindari pemalsuan dari halaman lain -->
                        <?= csrf_field(); ?>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">

                            </div>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= old('id'); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="fullname">Fullname</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('fullname'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= old('username'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" value="<?= old('password'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="level">Level</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control  <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" id="level" name="level">
                                    <option value="" selected><?= old('level') ? old('level') : 'Pilih Level...'; ?></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Moderator</option>
                                    <option value="3">User</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('level'); ?>
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