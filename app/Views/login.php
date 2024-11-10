
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    
    <!-- Link to the external CSS file -->
    <?= link_tag('assets/css/style.css') ?>
</head>

<body>
    <!-- app/Views/auth/login_register.php -->
<div class="container" id="container">
    <!-- Sign Up Form -->
    <div class="form-container sign-up-container">
        <form action="/register" method="post">
            <h1>Create Account</h1>
            <span>or use your email for registration</span>
            <input type="text" name="username" placeholder="Name" required />
            <input type="text" name="phone" placeholder="phone" required />
            <input type="email" name="email" placeholder="Email" required />
            <label>Membership Duration:</label>
            <select name="membership_duration" required>
                <option value="3 months">3 Months</option>
                <option value="6 months">6 Months</option>
                <option value="1 year">1 Year</option>
            </select>
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <!-- Sign In Form -->
    <div class="form-container sign-in-container">
        <form action="/authenticate" method="post">
            <h1>Sign in</h1>
            <span>or use your account</span>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <a href="#">Forgot your password?</a>
            <button type="submit">Sign In</button>
        </form>
    </div>

    <!-- Overlay -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<?= script_tag('assets/js/script.js') ?> 
</body>
</html>


