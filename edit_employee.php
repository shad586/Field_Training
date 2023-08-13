<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>تعديل معلومات الموظف</title>
    <style>
        /* Apply some basic styling to the form */
        body {
            font-family: "Helvetica Neue", sans-serif;
    background-color: #f4f4f4;
    
    text-align: center;
}
.edit-employee-container {
    max-width: 400px;
    color: #333;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: right; /* For Arabic text alignment */
}
html[lang="ar"] {
    direction: rtl;
}

h1 {
    text-align: center;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    color: #333;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;

}

button[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
}

.back-button {
            
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
            margin-top: 10px;
           text-align: center;
        }
        .back-button:hover {
            background-color: #0056b3;
        }

/* Style for validation error messages */
input:invalid {
    border-color: #f44336;
}

/* Responsive styling */
@media (max-width: 480px) {
    .edit-employee-container {
        max-width: 90%;
    }
}
header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-bottom: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
            background-color: #333;
            border:none;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
            
        }

        nav ul li a:hover {
            color: #ffd700;
        }
</style>
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a class="mm" href=dashboard.php">الرئيسية</a></li>
                <li><a href="employees.php">قائمة الموظفين</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>
    <div class="edit-employee-container">
        <h1>تعديل معلومات الموظف</h1>

        <?php
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "deptmange";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employeeID'])) {
            $employeeID = $_GET['employeeID'];

            $sql = "SELECT * FROM الموظفون WHERE معرف_الموظف = $employeeID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form action="update_employee.php" method="post">
                    <input type="hidden" name="employeeID" value="<?php echo $employeeID; ?>">
                    <label for="name">الاسم:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['الاسم']; ?>" required>
                    <label for="department">القسم:</label>
                    <input type="text" id="department" name="department" value="<?php echo $row['القسم']; ?>" required>

                    <label for="systemType">نوع النظام:</label>
                    <input type="text" id="systemType" name="systemType" value="<?php echo $row['نوع_النظام']; ?>" required>

                    <label for="ramMemory">الذاكرة (RAM):</label>
                    <input type="text" id="ramMemory" name="ramMemory" value="<?php echo $row['RAM_الذاكره']; ?>" required>

                    <label for="macAddress">عنوان MAC:</label>
                    <input type="text" id="macAddress" name="macAddress" value="<?php echo $row['MAC_عنوان']; ?>" required>

                    <button type="submit">حفظ التغييرات</button>
                </form>
        <?php
            } else {
                echo "<p>الموظف غير موجود.</p>";
            }
        }

        $conn->close();
        ?>

        <a class="back-button" href="employees.php">العودة لقائمة الموظفين</a>
    </div>
</body>
</html>
