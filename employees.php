
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>قائمة الموظفين</title>
    <style>
/* Reset some default styles */
   body {
            font-family: "Helvetica Neue", sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Basic styling for the entire page */
        .content-container {
            width: 80%;
            margin: 50px auto;
        }

        .content-container form {
            text-align: center;
            margin-bottom: 20px;
        } 
 
        

/* Styling for clickable elements */
a, button {
    display: inline-block;
    padding: 10px 20px;
    margin: 5px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

a:hover, button:hover {
    background-color: #0056b3;
}

/* Specific styles for the Arabic language */
html[lang="ar"] {
    direction: rtl;
}

/* Styling for headings */
h1, h2, h3 {
    margin-bottom: 15px;
}

/* Styling for the title */
.title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Styling for paragraphs */
p {
    line-height: 1.6;
    margin-bottom: 15px;
}

/* Styling for links */
a {
    font-weight: 600;
    text-decoration: none;
}

/* Styling for buttons */
button {
    font-weight: 600;
    border: none;
}

/* Styling for different form elements */
.button-form {
    background-color: #fff;
    color: #000;
    border: 2px solid #000;
}

.button-form:hover {
    background-color: #000;
    color: #fff;
}

/* Styling for main content */
.main-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
}

/* Styling for lists */


.search {
            text-align: center;
            padding: 20px 0;
        }

        .search input[type="text"],
        .search button {
            margin: 5px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .search input[type="text"]:focus,
        .search button:focus {
            outline: none;
            border-color: #000;
        }

        /* Styling for list borders */
        .employee-list {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        /* Styling for each employee's information */
                .employee {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

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
<div class="content-container">
        <form action="employee_list.php" method="get">
            <input type="text" name="search" placeholder="البحث باسم الموظف أو القسم" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">بحث</button>
        </form>

        <div class="employee-list">
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
            
            $search = "";
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                $search = $_GET["search"];
            }
            
            $sql = "SELECT * FROM الموظفون WHERE الاسم LIKE '%$search%' OR القسم LIKE '%$search%'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='employee'>";
                    echo "<p>الاسم: " . $row['الاسم'] . "</p>";
                    echo "<p>القسم: " . $row['القسم'] . "</p>";
                    // Display other attributes
                    
                    $employeeID = $row['معرف_الموظف'];
                    $sqlWindows = "SELECT نسخة_ويندوز, تاريخ_التحديث FROM سجل_نسخ_ويندوز WHERE معرف_الموظف = $employeeID ORDER BY تاريخ_التحديث DESC LIMIT 1";
                    $sqlAntivirus = "SELECT حالة_التحديث, تاريخ_التحديث FROM سجل_تحديث_مكافحة_الفيروسات WHERE معرف_الموظف = $employeeID ORDER BY تاريخ_التحديث DESC LIMIT 1";
                    $resultWindows = $conn->query($sqlWindows);
                    $resultAntivirus = $conn->query($sqlAntivirus);
                    
                    if ($resultWindows->num_rows > 0) {
                        $rowWindows = $resultWindows->fetch_assoc();
                        echo "<p>آخر إصدار لنسخة Windows: <a class='link-button' href='windows_version_history.php?employeeID=$employeeID'>" . $rowWindows['نسخة_ويندوز'] . "</a></p>";
                    }
                    
                    if ($resultAntivirus->num_rows > 0) {
                        $rowAntivirus = $resultAntivirus->fetch_assoc();
                        $updateStatus = $rowAntivirus['حالة_التحديث'] ? 'تم التحديث' : 'لم يتم التحديث';
                        echo "<p>آخر تحديث لمضاد الفيروسات: <a class='link-button' href='antivirus_update_history.php?employeeID=$employeeID'>$updateStatus</a></p>";
                    }
                    
                    echo "<a href='edit_employee.php?employeeID=$employeeID' class='action-button'>تعديل المعلومات</a>";
                    echo "<a href='maintenance_history.php?employeeID=$employeeID' class='action-button'>سجل الصيانة</a>";
                    echo "<a href='process_delete_employee.php?employeeID=$employeeID' class='action-button delete-button'>حذف</a>";
            
                    echo "</div>";
                }
            } else {
                echo "<p>لم يتم العثور على موظفين.</p>";
            }
            
            $conn->close();
            ?>
        </div>
        
        <!-- زر إضافة موظف -->
        <a class="add-button" href="add_employee.php">إضافة موظف</a>
    </div>
</body>
</html>
