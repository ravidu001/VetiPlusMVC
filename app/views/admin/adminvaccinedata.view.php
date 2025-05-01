<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Add Vaccine Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/adminvaccinedata.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="main-container">
            <div class="data-search">
                <form class="search-form" action="<?= ROOT ?>/AdminVaccineData/createvaccine" method="POST">
                    <div class="search-inputs">
                        <input type="text" name="name" placeholder="Enter Vaccine Name">
                        <input type="text" name="description" placeholder="Enter Vaccine Description">
                        <input type="text" name="brand" placeholder="Enter Vaccine Brand">
                        <select name="type" id="pettype">
                            <option value="">Select Option</option>
                            <?php
                            $uniquepettype = [];
                            foreach ($pettype as $type):
                                if (!in_array($type->species, $uniquepettype)):
                                    $uniquepettype[] = $type->species;
                            ?>
                                    <option value="<?= $type->species ?>"><?= $type->species ?></option>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="search-btn">Add Vaccine Data</button>
                </form>
            </div>

            <div class="data-list">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Pet Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['adminavaccinedata'])) : ?>
                            <?php foreach ($data['adminavaccinedata'] as $vaccinedata) : ?>
                                <tr>
                                    <td><?= $vaccinedata->name ?></td>
                                    <td><?= $vaccinedata->description ?></td>
                                    <td><?= $vaccinedata->brand ?></td>
                                    <td><?= $vaccinedata->petType ?></td>
                                    <td><a href="#" class="btn btn-view" onclick="deleteAccount(<?= $vaccinedata->vaccineID ?>)">Delete</a>
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
        function deleteAccount(vaccineID) {
            const modal = document.getElementById('deleteModal');
            const deleteBtn = document.getElementById('confirmDeleteBtn');

            deleteBtn.href = `<?= ROOT ?>/AdminVaccineData/deletevaccinedata?vaccineID=${vaccineID}`;

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