<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --body-color: #E4E9F7;
            --sidebar-color: #FFF;
            --primary-color: #6a0dad;
            --primary-color-light: #f6f5ff;
            --toggle-color: #ddd;
            --text-color: #707070;
            --background-light: #c8a2c8;
            --background-primary: #6a0dad;
            --background-white: #fff;
            --text-black: black;
            --text-primary: #6a0dad;
            --text-white: #fff;
            --shadow-color: slategray;
            --list-item: #ffecff;
            
            --tran-02: all 0.2s ease;
            --tran-03: all 0.3s ease;
            --tran-04: all 0.4s ease;
            --tran-05: all 0.5s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--body-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            left: 0;
            width: 250px;
            height: 100%;
            background: var(--sidebar-color);
            transition: var(--tran-05);
        }

        .sidebar.close {
            width: 88px;
        }

        .home {
            position: relative;
            left: 250px;
            height: 100vh;
            width: calc(100% - 250px);
            background: var(--body-color);
            transition: var(--tran-05);
        }

        .sidebar.close ~ .home {
            left: 88px;
            width: calc(100% - 88px);
        }

        .error-container {
            text-align: center;
            background: var(--background-white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            animation: fadeIn 1s ease-out;
        }

        .dog-illustration {
            max-width: 250px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        .error-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .error-message {
            color: var(--text-color);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            background: var(--primary-color);
            color: var(--text-white);
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            transition: var(--tran-03);
        }

        .btn-home:hover {
            background: var(--background-primary);
            transform: translateY(-3px);
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- <section class="home"> -->
        <div class="error-container">
            <img src="<?= ROOT ?>/assets/images/common/404errorimage.png" alt="Cute Dog" class="dog-illustration">
            <h1 class="error-title">Oops! Page Not Found</h1>
            <p class="error-message">Oops! The page you're looking for doesn't exist or has been moved. Let's get you back home.</p>
            <a href="<?= ROOT ?>/_404/returnPage" class="btn-home">Return to Dashboard</a>
        </div>
        <!-- <?php
            // if(isset($_SESSION['user_id'])) {
            //     echo ($_SESSION['user_id']);
            //     echo($_SESSION['type']);
            // } else {
            //     echo ("mukuth naa");
            // }
        ?> -->
    <!-- </section> -->

    <script>
        document.querySelector('.dog-illustration').addEventListener('click', () => {
            const illustration = document.querySelector('.dog-illustration');
            illustration.style.animation = 'none';
            illustration.offsetHeight;
            illustration.style.animation = 'bounce 0.5s';
        });
    </script>
</body>
</html>