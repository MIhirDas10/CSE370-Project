<?php
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "gym_system");

    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if (!$connection) {
        die("Connection failed");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <link rel="stylesheet" href="profileStyle.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1.text {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .container {
            height: 620px;
            width: 600px;
            margin: 15px auto;
            background: #fff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .wrapper {
            padding: 30px;
            text-align: center;
        }

        .wrapper img {
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            text-align: left;
        }

        ul li {
            font-size: 1.1rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        ul hr {
            border: 0.5px solid #ddd;
        }

        .btn {
            display: inline-block;
            /* margin-top: 20px; */
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <!-- <h1 class="text" style="text-align:center; color:black; margin-top:40px;">My Profile <i class="icon icon-user"></i></h1> -->

    <div class="container">
        <div class="wrapper">
            <?php
            $select = mysqli_query($connection, "SELECT * FROM `admin` WHERE admin_id = 1") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            if ($fetch['image'] == '') {
                echo '<img src="images/default-avatar.png" height="110" width="110">';
            } else {
                echo '<img height="110" width="120" src="uploaded_img/' . $fetch['image'] . '">';
            }
            ?>

            <ul>
                <li><?php echo 'Name : ' . $fetch['fullname']; ?></li>
                <hr>
                <li><?php echo 'ID : ' . $fetch['admin_id']; ?></li>
                <hr>
                <li><?php echo 'Email : ' . $fetch['email']; ?></li>
                <hr>
                <li><?php echo 'Address : ' . $fetch['address']; ?></li>
                <hr>
                <li><?php echo 'Designation : ' . $fetch['designation']; ?></li>
                <hr>
                <li><?php echo 'Gender : ' . $fetch['gender']; ?></li>
                <hr>
                <li><?php echo 'Contact : ' . $fetch['contact']; ?></li>
                <hr>
            </ul>
            <a href="update_profile.php" class="btn">Edit</a>
        </div>
    </div>
</body>

</html>
