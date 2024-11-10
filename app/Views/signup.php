<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- Internal CSS for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2.header-title {
            color: #333;
            text-align: center;
        }

        form {
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5a67d8;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #434190;
        }
    </style>

</head>
<body>
<form action="/register" method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br>
    
    <label>Membership Duration:</label>
    <select name="membership_duration" required>
        <option value="3 months">3 Months</option>
        <option value="6 months">6 Months</option>
        <option value="1 year">1 Year</option>
    </select><br>
    
    <button type="submit">Sign Up</button>
</form>

</body>
</html>
