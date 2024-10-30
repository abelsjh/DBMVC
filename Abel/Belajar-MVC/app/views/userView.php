<?php
require_once 'config/database.php';
require_once 'app/controllers/UserController.php';
require_once 'app/views/userView.php';
$nomor = 1;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pertemuan 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>Abel</h1>
        <div class="container mt-5">
            <button type="button" class="btn btn-primary" id="toggleFormBtn">Tambah Data</button>

            <div id="inputForm" class="mt-3" style="display: none;">
                <h3>Input Data</h3>
                <form method="POST" action="index.php?controllers=UserController&action=store" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Data</button>
                    <button type="button" class="btn btn-secondary" id="closeFormBtn">Tutup</button>
                </form>
            </div>
        </div>

        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning editBtn"
                                data-id="<?php echo $user['id']; ?>"
                                data-name="<?php echo $user['name']; ?>"
                                data-email="<?php echo $user['email']; ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal">
                                Edit
                            </button>
                            <button type="button" class="btn btn-warning hapusBtn"
                                data-id="<?php echo $user['id']; ?>"
                                data-name="<?php echo $user['name']; ?>"
                                data-email="<?php echo $user['email']; ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusModal">
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit User Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="index.php?controllers=UserController&action=update">

                        <input type="hidden" class="form-control" id="editId" name="id" required>

                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal untuk Hapus -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Hapus Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="hapusForm" method="POST" action="index.php?controllers=UserController&action=delete">

                        <input type="hidden" class="form-control" id="hapusId" name="id" readonly>
                        <td>Yakin Hapus Data Ini?</td>
                        <td>Nama</td>
                        <input type="text" class="form-control" id="hapusName" name="nama" readonly>
                        <td>Email</td>
                        <input type="text" class="form-control" id="hapusEmail" name="email" readonly>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Hapus Data</button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#toggleFormBtn').click(function() {
                        $('#inputForm').toggle(); // Tampilkan atau sembunyikan form
                    });

                    $('#closeFormBtn').click(function() {
                        $('#inputForm').hide(); // Sembunyikan form
                    });

                    // Event ketika modal edit dibuka
                    $('#editModal').on('show.bs.modal', function(event) {
                        const button = $(event.relatedTarget); // Tombol yang memicu modal
                        const id = button.data('id');
                        const name = button.data('name');
                        const email = button.data('email');

                        const modal = $(this);
                        modal.find('#editId').val(id);
                        modal.find('#editName').val(name);
                        modal.find('#editEmail').val(email);
                    });
                    // Hapus
                    $('#hapusModal').on('show.bs.modal', function(event) {
                        const button = $(event.relatedTarget); // Tombol yang memicu modal
                        const id = button.data('id');
                        const name = button.data('name');
                        const email = button.data('email');

                        const modal = $(this);
                        modal.find('#hapusId').val(id);
                        modal.find('#hapusName').val(name);
                        modal.find('#hapusEmail').val(email);
                    });
                });
            </script>



</body>

</html>