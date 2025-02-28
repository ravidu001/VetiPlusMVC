<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <!-- <p>Hello</p>
        <p><?= $this->myText ?></p>
        <p><?= $this->getText ?></p>
        <p><?= $this->oho ?></p> -->

        <select name="selectUser" id="selectUser">
            <option value="all">All</option>
            <option value="po">Pet Owners</option>
            <option value="doc">Vet Doctors</option>
            <option value="adm">System Admins</option>
        </select>
        <ul id="dataShower"></ul>
        <?php
            $myStr = "Greetings from PHP"
        ?>

        <script  defer>
            console.log(`<?= $myStr ?>`);

            const selectUser = document.getElementById('selectUser');
            const dataShower = document.getElementById('dataShower');

            selectUser.addEventListener('change', () => {
                const type = selectUser.value;
                let action;

                if (type == 'all')
                    action = 'testing/getAllUsers';
                else if (type == 'po')
                    action = 'testing/getPetOwners';
                else if (type == 'doc')
                    action = 'testing/getVetDoctors';
                else if (type == 'adm')
                    action = 'testing/getAdmins';

                fetch(action, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    dataShower.innerHTML = data.map(x => `<li>${x.email}</li>`).join('');
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                    alert('An error occurred. Please try again later.');
                });
            });

        </script>
    </body>
</html>