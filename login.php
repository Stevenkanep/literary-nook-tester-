<?php
/**
 * The Literary Nook - Bookstore Management System
 * File: login.php (Customer Login Page)
 *
 * Two-column split screen:
 *   Left  - Returning customers: email + password login form
 *   Right - New customers: prompt to create an account
 *
 * NOTE: No real authentication yet. Login logic is placeholder only.
 * In production, this will verify credentials against the customers table in MySQL via XAMPP.
 * Replace the placeholder block below with a real DB query when ready.
 */

session_start();

// -------------------------------------------------------
// PLACEHOLDER: Redirect if already logged in.
// In production: if (isset($_SESSION['customer_id'])) header('Location: account.php');
// -------------------------------------------------------

// -------------------------------------------------------
// PLACEHOLDER: Handle login form submission.
// In production this will:
//   1. Sanitize inputs
//   2. Query the customers table: SELECT * FROM customers WHERE email = ?
//   3. Verify password with password_verify()
//   4. Set $_SESSION['customer_id'] and $_SESSION['customer_name']
//   5. Redirect to account.php or previous page
// -------------------------------------------------------
$error_message   = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    // PLACEHOLDER: Hardcoded test credentials for UI testing only.
    // Remove this block entirely when real DB auth is implemented.
    if ($email === 'test@theliterarynook.com' && $password === 'password123') {
        $_SESSION['customer_name'] = 'Test User';
        // In production: header('Location: account.php'); exit;
        $success_message = "Login successful! (Placeholder - no redirect yet.)";
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }
}

// Nav links — same as index.php for consistency
$nav_links = ["Books", "Non Books", "Bestsellers", "Collections", "Book Reviews", "New!", "Pre-Orders", "Sale"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Literary Nook</title>

    <!-- Google Fonts: Cinzel Decorative (headings) + Quicksand (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Shared stylesheet — same css/styles.css used across all pages -->
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>

<!-- ============================================================
     TOP BAR - reused from index.php
     ============================================================ -->
<div class="top-bar">
    <div class="top-bar__left">
        Free shipping for minimum order of <strong>Php799</strong>.
    </div>
    <div class="top-bar__right">
        <a href="#">Bulk Purchase</a>
        <a href="#">Discount Card</a>
        <a href="#">Blog</a>
        <a href="#">Store Locator</a>
        <a href="#">Help <i class="fas fa-chevron-down fa-xs"></i></a>
    </div>
</div>


<!-- ============================================================
     HEADER - reused from index.php
     ============================================================ -->
<header class="header">
    <div class="header__inner">
        <a href="index.php" class="header__logo">
            <span class="logo-text">THE LITERARY NOOK</span>
        </a>

        <form class="header__search" action="search.php" method="GET">
            <input type="text" name="q" placeholder="Search The Literary Nook" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div class="header__actions">
            <!-- On the login page, always show Login/Register link -->
            <a href="login.php" class="action-link">
                <i class="fas fa-user"></i>
                <span>Login/Register</span>
            </a>
            <a href="wishlist.php" class="action-link">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>
            <a href="cart.php" class="action-link cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <span class="cart-badge">0</span>
            </a>
        </div>
    </div>
</header>


<!-- ============================================================
     NAVBAR - reused from index.php
     ============================================================ -->
<nav class="navbar">
    <ul class="navbar__list">
        <?php foreach ($nav_links as $link): ?>
            <li class="navbar__item">
                <a href="#" class="navbar__link"><?php echo $link; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>


<!-- ============================================================
     LOGIN CONTENT AREA
     Two-column split card: Left = login form, Right = new customers
     ============================================================ -->
<main class="auth-wrapper">
    <div class="auth-card">

        <!-- ====================================================
             LEFT COLUMN - RETURNING CUSTOMERS
             Email + password form with error/success feedback.
             ==================================================== -->
        <div class="auth-col">
            <h2 class="auth-col__title">Returning Customers</h2>
            <p class="auth-col__subtitle">If you have an account, sign in with your email address.</p>

            <!-- Notice box — like the one on Fully Booked's login page -->
            <div class="auth-notice">
                <i class="fas fa-info-circle"></i>
                Welcome to our new website! For previously registered users, please click "Forgot Password" and reset your password to log in.
            </div>

            <!-- Error or success message shown after form submit -->
            <?php if (!empty($error_message)): ?>
                <div class="form-message form-message--error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="form-message form-message--success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <!-- Login form -->
            <!-- PLACEHOLDER: action="" posts to self; in production point to a handler or keep as self-post -->
            <form method="POST" action="login.php">

                <!-- Email field -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        Email <span class="required">*</span>
                    </label>
                    <input
                        class="form-input"
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        required
                        autocomplete="email"
                    >
                </div>

                <!-- Password field with show/hide toggle -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        Password <span class="required">*</span>
                    </label>
                    <div class="input-password-wrap">
                        <input
                            class="form-input"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <!-- Toggle button — JS below handles show/hide -->
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Show or hide password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Actions row: Login button + Forgot Password -->
                <div class="form-actions">
                    <button type="submit" name="login" class="btn btn--primary">LOGIN</button>
                    <!-- Links to forgot-password.php (to be built) -->
                    <a href="forgot-password.php" class="forgot-link">Forgot Password?</a>
                </div>

            </form>
        </div><!-- /auth-col (left) -->


        <!-- ====================================================
             RIGHT COLUMN - NEW CUSTOMERS
             Short pitch + benefits list + Create Account button.
             ==================================================== -->
        <div class="auth-col auth-col--new">
            <h2 class="auth-col__title">New Customers</h2>
            <p class="auth-col__subtitle">
                Creating an account with The Literary Nook comes with great benefits.
            </p>

            <!-- Benefits list — static copy, can be managed via CMS later -->
            <ul class="new-customer-benefits">
                <li><i class="fas fa-check-circle"></i> Check out faster on every order</li>
                <li><i class="fas fa-check-circle"></i> Save multiple shipping addresses</li>
                <li><i class="fas fa-check-circle"></i> Track your orders anytime</li>
                <li><i class="fas fa-check-circle"></i> Build and manage your Wishlist</li>
                <li><i class="fas fa-check-circle"></i> Get notified on new arrivals and sales</li>
            </ul>

            <!-- Button links to the registration page -->
            <a href="register.php" class="btn btn--primary">CREATE AN ACCOUNT</a>
        </div><!-- /auth-col (right) -->

    </div><!-- /auth-card -->
</main><!-- /auth-wrapper -->


<!-- ============================================================
     FOOTER - reused from index.php (condensed version)
     ============================================================ -->
<footer class="footer">
    <div class="footer__top">
        <div class="container footer__grid">
            <div class="footer__col footer__col--brand">
                <span class="logo-text logo-text--footer">THE LITERARY NOOK</span>
                <p class="footer__tagline">Your cozy corner for every story.</p>
                <div class="footer__socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer__col">
                <h4 class="footer__col-title">Shop</h4>
                <ul class="footer__col-links">
                    <li><a href="#">Books</a></li>
                    <li><a href="#">Non Books</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Bestsellers</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4 class="footer__col-title">My Account</h4>
                <ul class="footer__col-links">
                    <li><a href="login.php">Login / Register</a></li>
                    <li><a href="account.php">My Profile</a></li>
                    <li><a href="orders.php">Order History</a></li>
                    <li><a href="wishlist.php">Wishlist</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4 class="footer__col-title">Help</h4>
                <ul class="footer__col-links">
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Store Locator</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer__col footer__col--newsletter">
                <h4 class="footer__col-title">Stay in the Loop</h4>
                <p>Get notified about new arrivals and exclusive deals.</p>
                <form class="newsletter-form" action="newsletter.php" method="POST">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn--primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> The Literary Nook. All rights reserved.</p>
            <p>Built on XAMPP (localhost) - switch to a live server for production deployment.</p>
        </div>
    </div>
</footer>


<!-- ============================================================
     SIMPLE JS: Password show/hide toggle
     Toggles the input type between 'password' and 'text'.
     No libraries needed - plain vanilla JS.
     ============================================================ -->
<script>
    const toggleBtn  = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            // Switch between showing and hiding the password
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';

            // Swap the eye icon accordingly
            toggleIcon.classList.toggle('fa-eye',      !isHidden);
            toggleIcon.classList.toggle('fa-eye-slash', isHidden);
        });
    }
</script>

</body>
</html>
