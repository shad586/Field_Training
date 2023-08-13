<!DOCTYPE html>
<html lang="ar">
<head>
<style>
/* Apply basic styling to the entire page */
body {
font-family: "Helvetica Neue", sans-serif;
background-color: #f4f4f4;   
  text-align: center;
}

/* Style the container for the form */
.add-employee-container {
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
    width: 95%;
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
    text-align: center;
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
    <div class="add-employee-container">
        <h1>إضافة موظف جديد</h1>
        <form action="process_add_employee.php" method="post">
        <label for="name">اسم الموظف:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="department">القسم:</label>
    <input type="text" id="department" name="department" required>
    
    <label for="macAddress">عنوان MAC:</label>
    <input type="text" id="macAddress" name="macAddress">
    
    <label for="ram">RAM الذاكرة:</label>
    <input type="text" id="ram" name="ram">
    
    <label for="osType">نوع النظام:</label>
    <input type="text" id="osType" name="osType">
    
    <button type="submit" name="addEmployee">إضافة موظف</button>
</form>
        
        <a class="back-button" href="employees.php">العودة إلى قائمة الموظفين</a>
    </div>
</body>
</html>
