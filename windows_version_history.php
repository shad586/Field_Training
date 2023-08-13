<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>

        /* Reset default margin and padding */
 /* Reset default styles */
 body {
            font-family: "Helvetica Neue", sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding:0;
            
        }

        /* Basic styling for the entire page */
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: "Helvetica Neue", Arial, sans-serif;
            margin: 0;
          
        }
        html[lang="ar"] {
    direction: rtl;
}
        .container {
            max-width: 1900px;
            margin: 0 auto;
            padding-left: 20px;
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
            max-width: 1200px;
            margin-bottom: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
            max-width: 1200px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="date"],
        textarea {
            width: 100%;
            max-width: 1200px;
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
    <title>سجل نسخ ويندوز</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">الرئيسية</a></li>
                <li><a href="employees.php">قائمة الموظفين</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>
    <div class="history-container">
        <h1>سجل نسخ ويندوز</h1>
        <?php
        // Replace with your database connection details
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "deptmange"; // your database name

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employeeID'])) {
            $employeeID = $_GET['employeeID'];
// Create a prepared statement
$sqlWindows = "SELECT * FROM سجل_نسخ_ويندوز WHERE معرف_الموظف = ? ORDER BY تاريخ_التحديث DESC";
$stmt = $conn->prepare($sqlWindows);

if ($stmt) {
    // Bind the parameter and execute the statement
    $stmt->bind_param("i", $employeeID);
    $stmt->execute();
    
    $resultWindows = $stmt->get_result();

    if ($resultWindows !== false && $resultWindows->num_rows > 0) {
        echo "<ul class='history-list'>";
        while ($rowWindows = $resultWindows->fetch_assoc()) {
            echo "<li class='history-entry'>";
            echo "<p>النسخة: " . $rowWindows['نسخة_ويندوز'] . "</p>";
            echo "<p>تاريخ التحديث: " . $rowWindows['تاريخ_التحديث'] . "</p>";
            echo '<button class="edit-button" data-record-id="' . $rowWindows['معرف_نسخة_ويندوز'] . '">تعديل</button>';
            echo '<button class="delete-button" data-record-id="' . $rowWindows['معرف_نسخة_ويندوز'] . '">حذف</button>';
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>لا يوجد تاريخ نسخ ويندوز متاح.</p>";
    }}}
    

    

        $conn->close();
        ?>
    </div>

    <!-- The edit modal (similar to Code 2) -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">×</span>
            <form action="process_edit_windows.php" method="post">
                <input type="hidden" name="recordID" id="recordID">
                <label for="version">نسخة ويندوز:</label>
                <input type="text" name="version" id="version" required><br>
                <label for="updateDate">تاريخ التحديث:</label>
                <input type="date" name="updateDate" id="updateDate" required><br>
                <button type="submit">حفظ التعديلات</button>
            </form>
        </div>
    </div>
    
    <h2>إضافة نسخة ويندوز جديدة</h2>
    <form action="process_add_windows.php" method="post">
    <input type="hidden" name="employeeID" value="<?php echo $_GET['employeeID']; ?>">
    <label for="windowsVersion">نسخة ويندوز:</label>
    <input type="text" name="version" required><br>
    <label for="updateDate">تاريخ التحديث:</label>
    <input type="date" name="updateDate" required><br>
    <button type="submit">إضافة</button>
</form>

    
    <a href="employees.php">العودة إلى قائمة الموظفين</a>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const editWindowsButtons = document.querySelectorAll('.edit-button');
        const deleteWindowsButtons = document.querySelectorAll('.delete-button');
        const editWindowsModal = document.getElementById('edit-modal');

        editWindowsButtons.forEach(button => {
            button.addEventListener('click', function () {
                const recordID = button.getAttribute('data-record-id');
                const version = button.parentElement.querySelector('p:nth-child(1)').textContent;
                const updateDate = button.parentElement.querySelector('p:nth-child(2)').textContent;

                document.getElementById('recordID').value = recordID;
                document.getElementById('version').value = version;
                document.getElementById('updateDate').value = updateDate;

                editWindowsModal.style.display = 'block';
            });
        });

        deleteWindowsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const windowsId = button.getAttribute('data-record-id');
                if (confirm('هل أنت متأكد من حذف هذا السجل؟')) {
                    $.ajax({
                        url: 'process_delete_windows.php',
                        method: 'POST',
                        data: {
                            windowsID: windowsId
                        },
                        success: function(response) {
                            // Refresh the history list after successful deletion
                            $('.history-container').load(window.location.href + ' .history-container');
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error("AJAX request error:", errorThrown);
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>