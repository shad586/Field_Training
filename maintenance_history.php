<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <style>
        /* Reset some default styles */
        body {
            font-family: "Helvetica Neue", sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Basic styling for the entire page */
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            margin-bottom: 15px;
            font-size: 30px;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Edit Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            width: 50%;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.3);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Edit Button Styles */
        .edit-button,
        .delete-button {
            background-color: #d9534f;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #c9302c;
        }

        /* Header and Navigation Styles */
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
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
                <li><a  href="dashboard.php">الرئيسية</a></li>
                <li><a href="employees.php">قائمة الموظفين</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>سجل صيانة الموظف</h1>
        
        <?php
        // Replace with your database connection details
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "deptmange"; // Your database name
        
        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if (isset($_GET['employeeID'])) {
            $employeeID = $_GET['employeeID'];
            
            // Fetch employee's maintenance history
            $sql = "SELECT * FROM سجل_صيانة WHERE معرف_الموظف = $employeeID ORDER BY تاريخ_الصيانة DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<strong>تاريخ الصيانة:</strong> " . $row['تاريخ_الصيانة'] . "<br>";
                    echo "<strong>وصف المشكلة:</strong> " . $row['وصف_المشكلة'] . "<br>";
                    echo "<strong>القرار:</strong> " . $row['القرار'] . "<br>";
                    echo '<button class="edit-button" data-maintenance-id="' . $row['معرف_صيانة'] . '" data-date="' . $row['تاريخ_الصيانة'] . '" data-description="' . $row['وصف_المشكلة'] . '" data-resolution="' . $row['القرار'] . '">تعديل</button>';
                    echo '<button class="delete-button" data-maintenance-id="' . $row['معرف_صيانة'] . '">حذف</button>';

                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>لا توجد سجلات صيانة لهذا الموظف.</p>";
            }
        }
        
        // Close the database connection
        $conn->close();
        ?>
        
        <h2>إضافة مشكلة صيانة جديدة</h2>
        <form action="process_add_maintenance.php" method="post">
            <input type="hidden" name="employeeID" value="<?php echo $employeeID; ?>">
            <label for="date">تاريخ الصيانة:</label>
            <input type="date" name="date" required><br>
            <label for="description">وصف المشكلة:</label>
            <textarea name="description" rows="4" required></textarea><br>
            <label for="resolution">القرار:</label>
            <textarea name="resolution" rows="4" required></textarea><br>
            <button type="submit">إضافة</button>
        </form>
        
        <a href="employees.php">العودة إلى قائمة الموظفين</a>
    </div>
    
    <!-- The edit modal -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">×</span>
            <form action="process_edit_maintenance.php" method="post">
                <input type="hidden" name="maintenanceID">
                <label for="date">تاريخ الصيانة:</label>
                <input type="date" name="date" required><br>
                <label for="description">وصف المشكلة:</label>
                <textarea name="description" rows="4" required></textarea><br>
                <label for="resolution">القرار:</label>
                <textarea name="resolution" rows="4" required></textarea><br>
                <button type="submit">حفظ التعديلات</button>
            </form>
        </div>
    </div>
    
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-button');
            const deleteButtons = document.querySelectorAll('.delete-button');
            const modal = document.getElementById('edit-modal');
            const closeButton = modal.querySelector('.close-button');
            const form = modal.querySelector('form');
            const maintenanceIdInput = form.querySelector('[name="maintenanceID"]');
            const dateInput = form.querySelector('[name="date"]');
            const descriptionInput = form.querySelector('[name="description"]');
            const resolutionInput = form.querySelector('[name="resolution"]');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const maintenanceId = button.getAttribute('data-maintenance-id');
                    const date = button.getAttribute('data-date');
                    const description = button.getAttribute('data-description');
                    const resolution = button.getAttribute('data-resolution');
                    
                    maintenanceIdInput.value = maintenanceId;
                    dateInput.value = date;
                    descriptionInput.value = description;
                    resolutionInput.value = resolution;
                    
                    modal.style.display = 'block';
                });
            });

            deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            if (confirm('هل أنت متأكد من حذف هذا السجل؟')) {
                const maintenanceId = button.getAttribute('data-maintenance-id');
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'process_delete_maintenance.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'maintenanceID';
                input.value = maintenanceId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

            closeButton.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            // ... Your other existing JavaScript code ...
        });
    </script>

</body>
</html>
