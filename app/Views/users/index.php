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
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Users</h6>
                    <a href="<?= base_url('users/add'); ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>level</th>
                                    <th width=100;>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($users as $u) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $u['fullname']; ?></td>
                                        <td><?= $u['username']; ?></td>
                                        <?php if ($u['level'] == '1') : ?>
                                            <td>admin</td>
                                        <?php elseif ($u['level'] == '2') :  ?>
                                            <td>moderator</td>
                                        <?php else : ?>
                                            <td>user</td>
                                        <?php endif; ?>
                                        <td class="text-center">
                                            <!-- <a href="/users/<?= $u['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></i></a> -->
                                            <a href="<?= base_url(); ?>/users/edit/<?= $u['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pen-square"></i></a>
                                            <form action="<?= base_url(); ?>/users/delete/<?= $u['id']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?');"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>