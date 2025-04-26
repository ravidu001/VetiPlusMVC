<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Add Species Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/adminadddata.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        <div class="main-container">
            <div class="data-search">
                <form class="search-form" action="<?= ROOT ?>/AdminAddData/createdata" method="POST">
                    <div class="search-inputs">
                        <input type="text" name="species" placeholder="Enter Pet Species ">
                        <input type="text" name="breed" placeholder="Enter Pet Breed">
                        <button type="submit" name="submit" class="search-btn">Add Data</button>
                    </div>
                </form>
            </div>

            <div class="data-list">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Species</th>
                            <th>Breed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['adminadddata'])) : ?>
                            <?php foreach ($data['adminadddata'] as $adddata) : ?>
                                <tr>
                                    <td><?= $adddata->species ?></td>
                                    <td><?= $adddata->breed ?></td>
                                    <td><a href="#" class="btn btn-view" onclick="deleteAccount(<?= $adddata->id ?>)">
                                            <i class='bx bx-trash'></i> Delete Account
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="deleteModal" class="modals">
            <div class="modal-contents">
                <span class="closes" onclick="closeModal()">&times;</span>
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this data account?</p>
                <div class="modal-action">
                    <a id="confirmDeleteBtn" href="#" class="btn-view btn">Yes, Delete</a>
                    <button onclick="closeModal()" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </section>
    <script>
        function deleteAccount(id) {
            const modal = document.getElementById('deleteModal');
            const deleteBtn = document.getElementById('confirmDeleteBtn');

            // Dynamically set the href with correct ID
            deleteBtn.href = `<?= ROOT ?>/AdminAddData/deletedata?id=${id}`;

            // Show modal
            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>