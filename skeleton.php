<?php
/**
 * The Literary Nook - Bookstore Management System
 * File: skeleton.php (Consolidated Skeleton Tester)
 *
 * Combines index.php, login.php, and register.php into a single,
 * query-param-routed file so the core customer-facing flow
 * (browse home -> log in / register) can be exercised end-to-end
 * from one script during early testing.
 *
 * Routing: ?view=home (default) | ?view=login | ?view=register
 *
 * NOTE: Still placeholder logic throughout - no real DB. This file
 * is meant purely as a functional skeleton for quick testing, not
 * the final multi-page structure. Once real pages/DB are wired up,
 * split back out into separate files (or real includes) as needed.
 */

session_start();

// -------------------------------------------------------
// LOGOUT (skeleton-only convenience - clears the placeholder session
// so the login flow can be re-tested without restarting the server)
// -------------------------------------------------------
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ?view=home');
    exit;
}

// -------------------------------------------------------
// ROUTING: which "page" to render
// -------------------------------------------------------
$allowed_views = ['home', 'login', 'register'];
$view = $_GET['view'] ?? 'home';
if (!in_array($view, $allowed_views, true)) {
    $view = 'home';
}

// -------------------------------------------------------
// SHARED STATE - used in the header regardless of view
// -------------------------------------------------------
$is_logged_in  = isset($_SESSION['customer_name']);
$customer_name = $_SESSION['customer_name'] ?? '';

$nav_links = ["Books", "Non Books", "Bestsellers", "Collections", "Book Reviews", "New!", "Pre-Orders", "Sale"];

// -------------------------------------------------------
// HOME VIEW DATA (from index.php)
// -------------------------------------------------------
$featured_books = [
    ["title" => "The Midnight Library",   "author" => "Matt Haig",          "price" => 549.00, "badge" => "Bestseller", "img" => "placeholder_book.jpg"],
    ["title" => "Lessons in Chemistry",   "author" => "Bonnie Garmus",      "price" => 620.00, "badge" => "New",        "img" => "placeholder_book.jpg"],
    ["title" => "Tomorrow, and Tomorrow", "author" => "Gabrielle Zevin",    "price" => 590.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Iron Flame",             "author" => "Rebecca Yarros",     "price" => 750.00, "badge" => "Sale",       "img" => "placeholder_book.jpg"],
    ["title" => "Happy Place",            "author" => "Emily Henry",        "price" => 480.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Fourth Wing",            "author" => "Rebecca Yarros",     "price" => 720.00, "badge" => "Bestseller", "img" => "placeholder_book.jpg"],
    ["title" => "Demon Copperhead",       "author" => "Barbara Kingsolver", "price" => 610.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Intermezzo",             "author" => "Sally Rooney",       "price" => 530.00, "badge" => "New",        "img" => "placeholder_book.jpg"],
];

// -------------------------------------------------------
// LOGIN HANDLER (from login.php) - relevant on ?view=login
// -------------------------------------------------------
$login_error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $login_email    = trim($_POST['email']    ?? '');
    $login_password = trim($_POST['password'] ?? '');

    // PLACEHOLDER: Hardcoded test credentials for skeleton testing only.
    // Remove this block entirely when real DB auth is implemented.
    if ($login_email === 'test@theliterarynook.com' && $login_password === 'password123') {
        $_SESSION['customer_name'] = 'Test User';
        header('Location: ?view=home');
        exit;
    } else {
        $login_error_message = "Invalid email or password. Please try again.";
    }
}

// -------------------------------------------------------
// REGISTER HANDLER (from register.php) - relevant on ?view=register
// -------------------------------------------------------
$register_errors  = [];
$register_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $reg_first_name       = trim($_POST['first_name']       ?? '');
    $reg_last_name        = trim($_POST['last_name']        ?? '');
    $reg_email            = trim($_POST['email']            ?? '');
    $reg_phone            = trim($_POST['phone']            ?? '');
    $reg_address          = trim($_POST['address']          ?? '');
    $reg_password         = trim($_POST['password']         ?? '');
    $reg_confirm_password = trim($_POST['confirm_password'] ?? '');

    if (empty($reg_first_name))   $register_errors[] = "First name is required.";
    if (empty($reg_last_name))    $register_errors[] = "Last name is required.";
    if (empty($reg_email))        $register_errors[] = "Email address is required.";
    if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) $register_errors[] = "Please enter a valid email address.";
    if (empty($reg_password))     $register_errors[] = "Password is required.";
    if (strlen($reg_password) < 8) $register_errors[] = "Password must be at least 8 characters.";
    if ($reg_password !== $reg_confirm_password) $register_errors[] = "Passwords do not match.";

    if (empty($register_errors)) {
        // PLACEHOLDER: This is where DB insertion goes in production.
        $register_success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if ($view === 'login') {
                echo 'Login - The Literary Nook';
            } elseif ($view === 'register') {
                echo 'Create Account - The Literary Nook';
            } else {
                echo 'The Literary Nook';
            }
        ?>
    </title>

    <!-- Google Fonts: Orelega One (headings) + Quicksand (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Shared stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- ============================================================
     TOP BAR
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
     HEADER
     ============================================================ -->
<header class="header">
    <div class="header__inner">
        <a href="?view=home" class="header__logo">
            <img src="assets/Literary_Nook.png" alt="The Literary Nook">
        </a>

        <form class="header__search" action="" method="GET">
            <input type="hidden" name="view" value="<?php echo htmlspecialchars($view); ?>">
            <input type="text" name="q" placeholder="Search The Literary Nook" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div class="header__actions">
            <?php if ($is_logged_in): ?>
                <a href="?view=home" class="action-link">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($customer_name); ?></span>
                </a>
                <a href="?logout=1" class="action-link">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            <?php else: ?>
                <a href="?view=login" class="action-link">
                    <i class="fas fa-user"></i>
                    <span>Login/Register</span>
                </a>
            <?php endif; ?>

            <a href="#" class="action-link">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>
            <a href="#" class="action-link cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <span class="cart-badge">0</span>
            </a>
        </div>
    </div>
</header>


<!-- ============================================================
     NAVBAR
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


<?php if ($view === 'home'): ?>
<!-- ============================================================
     HOME VIEW (from index.php)
     ============================================================ -->
<main>

    <section class="hero">
        <div class="hero__slide">
            <div class="hero__image">
                <img src="assets/placeholder_banner.jpg" alt="Featured Collection Banner" onerror="this.style.display='none'">
            </div>
            <div class="hero__content">
                <span class="hero__eyebrow">Featured Collection</span>
                <h1 class="hero__title">Summer<br>Reads</h1>
                <p class="hero__subtitle">Collection</p>
                <a href="#" class="btn btn--dark">SHOP NOW</a>
            </div>
        </div>

        <div class="hero__dots">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <span class="hero__dot <?php echo $i === 0 ? 'hero__dot--active' : ''; ?>"></span>
            <?php endfor; ?>
        </div>

        <button class="hero__arrow hero__arrow--prev" aria-label="Previous slide">&#10094;</button>
        <button class="hero__arrow hero__arrow--next" aria-label="Next slide">&#10095;</button>
    </section>


    <section class="section featured-books">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Featured Books</h2>
                <a href="#" class="section__link">View All <i class="fas fa-chevron-right fa-xs"></i></a>
            </div>

            <div class="book-grid">
                <?php foreach ($featured_books as $book): ?>
                    <div class="book-card">
                        <div class="book-card__image-wrap">
                            <img
                                src="assets/<?php echo htmlspecialchars($book['img']); ?>"
                                alt="<?php echo htmlspecialchars($book['title']); ?>"
                                class="book-card__image"
                                onerror="this.src='assets/placeholder_book.jpg'; this.onerror=null;"
                            >
                            <?php if (!empty($book['badge'])): ?>
                                <span class="book-card__badge book-card__badge--<?php echo strtolower($book['badge']); ?>">
                                    <?php echo $book['badge']; ?>
                                </span>
                            <?php endif; ?>
                            <div class="book-card__overlay">
                                <button class="btn btn--primary btn--sm">Add to Cart</button>
                            </div>
                        </div>
                        <div class="book-card__info">
                            <h3 class="book-card__title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-card__author"><?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="book-card__price">Php <?php echo number_format($book['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <section class="promo-strip">
        <div class="promo-strip__inner">
            <div class="promo-strip__text">
                <h2 class="promo-strip__title">New Arrivals</h2>
                <p class="promo-strip__sub">Fresh titles added every week</p>
                <a href="#" class="btn btn--outline">Explore Now</a>
            </div>
        </div>
    </section>


    <section class="section bestsellers">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Bestsellers</h2>
                <a href="#" class="section__link">View All <i class="fas fa-chevron-right fa-xs"></i></a>
            </div>

            <div class="book-grid">
                <?php
                $bestsellers_display = array_slice($featured_books, 0, 4);
                foreach ($bestsellers_display as $book): ?>
                    <div class="book-card">
                        <div class="book-card__image-wrap">
                            <img
                                src="assets/<?php echo htmlspecialchars($book['img']); ?>"
                                alt="<?php echo htmlspecialchars($book['title']); ?>"
                                class="book-card__image"
                                onerror="this.src='assets/placeholder_book.jpg'; this.onerror=null;"
                            >
                            <div class="book-card__overlay">
                                <button class="btn btn--primary btn--sm">Add to Cart</button>
                            </div>
                        </div>
                        <div class="book-card__info">
                            <h3 class="book-card__title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-card__author"><?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="book-card__price">Php <?php echo number_format($book['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php elseif ($view === 'login'): ?>
<!-- ============================================================
     LOGIN VIEW (from login.php)
     ============================================================ -->
<main class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-col">
            <h2 class="auth-col__title">Returning Customers</h2>
            <p class="auth-col__subtitle">If you have an account, sign in with your email address.</p>

            <div class="auth-notice">
                <i class="fas fa-info-circle"></i>
                Welcome to our new website! For previously registered users, please click "Forgot Password" and reset your password to log in.
            </div>

            <?php if (!empty($login_error_message)): ?>
                <div class="form-message form-message--error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($login_error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="?view=login">
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
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Show or hide password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="login" class="btn btn--primary">LOGIN</button>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>
            </form>

            <p class="form-hint" style="margin-top: 14px;">
                Test credentials: test@theliterarynook.com / password123
            </p>
        </div>

        <div class="auth-col auth-col--new">
            <h2 class="auth-col__title">New Customers</h2>
            <p class="auth-col__subtitle">
                Creating an account with The Literary Nook comes with great benefits.
            </p>

            <ul class="new-customer-benefits">
                <li><i class="fas fa-check-circle"></i> Check out faster on every order</li>
                <li><i class="fas fa-check-circle"></i> Save multiple shipping addresses</li>
                <li><i class="fas fa-check-circle"></i> Track your orders anytime</li>
                <li><i class="fas fa-check-circle"></i> Build and manage your Wishlist</li>
                <li><i class="fas fa-check-circle"></i> Get notified on new arrivals and sales</li>
            </ul>

            <a href="?view=register" class="btn btn--primary">CREATE AN ACCOUNT</a>
        </div>

    </div>
</main>

<?php elseif ($view === 'register'): ?>
<!-- ============================================================
     REGISTER VIEW (from register.php)
     ============================================================ -->
<main class="auth-wrapper auth-wrapper--register">
    <div class="register-card">

        <?php if ($register_success): ?>
        <div class="success-box">
            <i class="fas fa-check-circle"></i>
            <h3>Account Created!</h3>
            <p>
                Welcome to The Literary Nook! A confirmation email has been sent to your inbox.
                <br>(Placeholder - email sending not yet implemented.)
            </p>
            <a href="?view=login" class="btn btn--primary">PROCEED TO LOGIN</a>
        </div>

        <?php else: ?>
        <h2 class="register-card__title">Create an Account</h2>
        <p class="register-card__subtitle">Join The Literary Nook and enjoy a better shopping experience.</p>

        <?php if (!empty($register_errors)): ?>
            <div class="error-list">
                <p><i class="fas fa-exclamation-triangle"></i> Please fix the following:</p>
                <ul>
                    <?php foreach ($register_errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="?view=register">

            <p class="form-section-title">Personal Information</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="first_name">
                        First Name <span class="required">*</span>
                    </label>
                    <input
                        class="form-input"
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="e.g. Maria"
                        value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>"
                        required
                    >
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">
                        Last Name <span class="required">*</span>
                    </label>
                    <input
                        class="form-input"
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="e.g. Santos"
                        value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="email">
                        Email Address <span class="required">*</span>
                    </label>
                    <input
                        class="form-input"
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        required
                        autocomplete="email"
                    >
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input
                        class="form-input"
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="e.g. 09XX XXX XXXX"
                        value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input
                    class="form-input"
                    type="text"
                    id="address"
                    name="address"
                    placeholder="Street, Barangay, City, Province"
                    value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>"
                >
            </div>

            <p class="form-section-title">Account Security</p>

            <div class="form-row">
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
                            placeholder="Min. 8 characters"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Show or hide password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <p class="form-hint">At least 8 characters. Use a mix of letters and numbers.</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirm_password">
                        Confirm Password <span class="required">*</span>
                    </label>
                    <div class="input-password-wrap">
                        <input
                            class="form-input"
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            placeholder="Re-enter your password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="password-toggle" id="toggleConfirm" aria-label="Show or hide password">
                            <i class="fas fa-eye" id="toggleIconConfirm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <p class="form-footer__note">
                    Already have an account? <a href="?view=login">Sign in here</a>
                </p>
                <button type="submit" name="register" class="btn btn--primary">
                    CREATE ACCOUNT
                </button>
            </div>

        </form>
        <?php endif; ?>

    </div>
</main>
<?php endif; ?>


<!-- ============================================================
     FOOTER
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
                    <li><a href="?view=login">Login / Register</a></li>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">Order History</a></li>
                    <li><a href="#">Wishlist</a></li>
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
                <form class="newsletter-form" action="" method="POST">
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
     JS: shared across all views (elements missing on the current
     view are simply skipped via the `if` guards below)
     ============================================================ -->
<script>
    // Add-to-cart visual feedback (home view)
    document.querySelectorAll('.btn--primary').forEach(function(btn) {
        if (btn.textContent.trim() === 'Add to Cart') {
            btn.addEventListener('click', function() {
                btn.textContent = 'Added!';
                btn.style.background = '#28a745';
                setTimeout(function() {
                    btn.textContent = 'Add to Cart';
                    btn.style.background = '';
                }, 1200);
            });
        }
    });

    // Hero carousel dots (home view, cosmetic only)
    document.querySelectorAll('.hero__dot').forEach(function(dot) {
        dot.addEventListener('click', function() {
            document.querySelectorAll('.hero__dot').forEach(d => d.classList.remove('hero__dot--active'));
            dot.classList.add('hero__dot--active');
        });
    });

    // Main password show/hide toggle (login + register views)
    const toggleBtn  = document.getElementById('togglePassword');
    const passInput  = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const isHidden = passInput.type === 'password';
            passInput.type = isHidden ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye',       !isHidden);
            toggleIcon.classList.toggle('fa-eye-slash',  isHidden);
        });
    }

    // Confirm-password show/hide toggle (register view only)
    const toggleConfirm     = document.getElementById('toggleConfirm');
    const confirmInput      = document.getElementById('confirm_password');
    const toggleIconConfirm = document.getElementById('toggleIconConfirm');

    if (toggleConfirm) {
        toggleConfirm.addEventListener('click', function () {
            const isHidden = confirmInput.type === 'password';
            confirmInput.type = isHidden ? 'text' : 'password';
            toggleIconConfirm.classList.toggle('fa-eye',       !isHidden);
            toggleIconConfirm.classList.toggle('fa-eye-slash',  isHidden);
        });
    }
</script>

</body>
</html>
