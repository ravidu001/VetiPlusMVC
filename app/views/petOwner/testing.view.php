<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <p>Hello</p>
        <p><?= $this->myText ?></p>
        <p><?= $this->getText ?></p>
        <p><?= $this->oho ?></p>

        <script>
            // let aha = `<?= $this->myText ?>`;
            console.log(`<?= $this->getText ?>`);
        </script>
    </body>
</html>