<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Edit Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --body-color: #E4E9F7;
            --primary-color: #6a0dad;
            --secondary-color: #c8a2c8;
            --text-color: #333;
            --background-white: #fff;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profile-container {
            background-color: var(--background-white);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(106, 13, 173, 0.2);
            display: flex;
            overflow: hidden;
            width: 85%;
            height: 95%;
            animation: fadeIn 0.5s ease-out;
        }

        .profile-sidebar {
            width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            color: white;
            position: relative;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--secondary-color);
            margin-bottom: 20px;
            transition: var(--transition);

        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .profile-sidebar h2 {
            margin-bottom: 10px;
            text-align: center;
            color: var(--primary-color);
        }

        .profile-sidebar p {
            opacity: 0.8;
            text-align: center;
            color: var(--text-color);
        }

        .edit-form {
            flex-grow: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        .edit-form h1 {
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 10px rgba(106, 13, 173, 0.1);
        }

        .update-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: bold;
            margin-top: 20px;
        }

        .update-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
                width: 100%;
            }

            .profile-sidebar {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="https://via.placeholder.com/200" alt="Admin Profile" class="profile-image">
            <h2>John Doe</h2>
            <p>Senior Admin</p>
            <p>john.doe@example.com</p>
        </div>
        <form class="edit-form">
            <h1>Edit Profile</h1>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="john.doe@example.com" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" value="+1 (123) 456-7890" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" value="123 Admin Street, Tech City" required>
            </div>
            <button type="submit" class="update-btn">Update Profile</button>
        </form>
    </div>
</body>

</html>