<?php
/**
 * The Literary Nook - Bookstore Management System
 * File: index.php (Homepage / Landing Page)
 * 
 * This is the main entry point of the website.
 * It displays the homepage with navigation, hero banner, featured books, and footer.
 * 
 * NOTE: Database connection is handled via XAMPP's MySQL (localhost).
 * To change DB settings later, go to /includes/db.php (to be created).
 * For now, all data below is hardcoded as placeholder content.
 */

// -------------------------------------------------------
// SESSION START
// Used later for login/cart functionality.
// For now, it's just initialized here so we don't break anything later.
// -------------------------------------------------------
session_start();

// -------------------------------------------------------
// PLACEHOLDER: Simulated "is user logged in?" check.
// In the real system, this will check the session after DB login.
// Replace this with: $is_logged_in = isset($_SESSION['customer_id']);
// -------------------------------------------------------
$is_logged_in = false;
$customer_name = ""; // Will come from $_SESSION['customer_name'] later

// -------------------------------------------------------
// PLACEHOLDER: Hardcoded featured books for display.
// In the real system, this will be fetched from the books table in MySQL.
// SQL example: SELECT * FROM books WHERE is_featured = 1 LIMIT 8;
// -------------------------------------------------------
$featured_books = [
    ["title" => "The Midnight Library", "author" => "Matt Haig",         "price" => 549.00, "badge" => "Bestseller", "img" => "placeholder_book.jpg"],
    ["title" => "Lessons in Chemistry", "author" => "Bonnie Garmus",     "price" => 620.00, "badge" => "New",        "img" => "placeholder_book.jpg"],
    ["title" => "Tomorrow, and Tomorrow", "author" => "Gabrielle Zevin", "price" => 590.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Iron Flame",            "author" => "Rebecca Yarros",   "price" => 750.00, "badge" => "Sale",       "img" => "placeholder_book.jpg"],
    ["title" => "Happy Place",           "author" => "Emily Henry",      "price" => 480.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Fourth Wing",           "author" => "Rebecca Yarros",   "price" => 720.00, "badge" => "Bestseller", "img" => "placeholder_book.jpg"],
    ["title" => "Demon Copperhead",      "author" => "Barbara Kingsolver","price" => 610.00, "badge" => "",           "img" => "placeholder_book.jpg"],
    ["title" => "Intermezzo",            "author" => "Sally Rooney",     "price" => 530.00, "badge" => "New",        "img" => "placeholder_book.jpg"],
];

// -------------------------------------------------------
// PLACEHOLDER: Hardcoded nav categories.
// In the real system these can be fetched from a 'categories' table.
// -------------------------------------------------------
$nav_links = ["Books", "Non Books", "Bestsellers", "Collections", "Book Reviews", "New!", "Pre-Orders", "Sale"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title — changes per page in the real system -->
    <title>The Literary Nook</title>

    <!-- Google Fonts: Cinzel Decorative (headings) + Quicksand (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- ============================================================
     TOP BAR
     The thin strip above the main header.
     Shows free shipping info + utility links (Blog, Store Locator, etc.)
     ============================================================ -->
<div class="top-bar">
    <div class="top-bar__left">
        <!-- Promotional message — can be pulled from a CMS/settings table later -->
        Free shipping for minimum order of <strong>Php799</strong>.
    </div>
    <div class="top-bar__right">
        <!-- Utility links — static for now, can become dynamic CMS links -->
        <a href="#">Bulk Purchase</a>
        <a href="#">Discount Card</a>
        <a href="#">Blog</a>
        <a href="#">Store Locator</a>
        <a href="#">Help <i class="fas fa-chevron-down fa-xs"></i></a>
    </div>
</div><!-- /top-bar -->


<!-- ============================================================
     MAIN HEADER
     Contains: Logo | Search Bar | User actions (Login, Wishlist, Cart)
     ============================================================ -->
<header class="header">
    <div class="header__inner">

        <!-- Logo — links to homepage -->
        <a href="index.php" class="header__logo">
            <!-- PLACEHOLDER: Replace with actual logo image if available -->
            <!-- <img src="assets/logo.png" alt="The Literary Nook"> -->
            <span class="logo-text">THE LITERARY NOOK</span>
        </a>

        <!-- Search bar — form action points to search.php (to be created) -->
        <form class="header__search" action="search.php" method="GET">
            <input type="text" name="q" placeholder="Search The Literary Nook" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- Right-side icon actions: Login, Wishlist, Cart -->
        <div class="header__actions">

            <!-- Login / Profile link -->
            <!-- PLACEHOLDER: If logged in, show customer name; if not, show Login/Register -->
            <?php if ($is_logged_in): ?>
                <a href="account.php" class="action-link">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($customer_name); ?></span>
                </a>
            <?php else: ?>
                <a href="login.php" class="action-link">
                    <i class="fas fa-user"></i>
                    <span>Login/Register</span>
                </a>
            <?php endif; ?>

            <!-- Wishlist link — requires login in the full system -->
            <!-- See: Section 1.2 Customer Profiles > Wishlist -->
            <a href="wishlist.php" class="action-link">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <!-- Cart icon with item count badge -->
            <!-- PLACEHOLDER: Cart count will come from $_SESSION['cart_count'] or DB -->
            <a href="cart.php" class="action-link cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Cart</span>
                <!-- Item count badge — 0 for now; will be dynamic -->
                <span class="cart-badge">0</span>
            </a>

        </div><!-- /header__actions -->
    </div><!-- /header__inner -->
</header><!-- /header -->


<!-- ============================================================
     NAVIGATION BAR
     Main category navigation strip — orange background, white text.
     Each link will eventually point to category/filter pages.
     ============================================================ -->
<nav class="navbar">
    <ul class="navbar__list">
        <?php foreach ($nav_links as $link): ?>
            <!-- PLACEHOLDER: href="#" — real links will go to category.php?slug=books etc. -->
            <li class="navbar__item">
                <a href="#" class="navbar__link"><?php echo $link; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav><!-- /navbar -->


<!-- ============================================================
     HERO BANNER
     Large promotional carousel area.
     For now it's a single static banner.
     PLACEHOLDER: Add JS slideshow or PHP-driven CMS banners later.
     See: Section 6 Reporting > Promotional Alerts for tie-in
     ============================================================ -->
<section class="hero">
    <div class="hero__slide">
        <!-- PLACEHOLDER: Replace hero__bg with a real banner image -->
        <!-- img src="assets/placeholder_banner.jpg" would go inside .hero__image -->
        <div class="hero__image">
            <img src="assets/placeholder_banner.jpg" alt="Featured Collection Banner" onerror="this.style.display='none'">
        </div>
        <div class="hero__content">
            <span class="hero__eyebrow">Featured Collection</span>
            <h1 class="hero__title">Summer<br>Reads</h1>
            <p class="hero__subtitle">Collection</p>
            <a href="collections.php" class="btn btn--dark">SHOP NOW</a>
        </div>
    </div>

    <!-- Carousel nav dots — will need JS to become functional -->
    <div class="hero__dots">
        <?php for ($i = 0; $i < 6; $i++): ?>
            <span class="hero__dot <?php echo $i === 0 ? 'hero__dot--active' : ''; ?>"></span>
        <?php endfor; ?>
    </div>

    <!-- Carousel arrow buttons — wired to JS later -->
    <button class="hero__arrow hero__arrow--prev" aria-label="Previous slide">&#10094;</button>
    <button class="hero__arrow hero__arrow--next" aria-label="Next slide">&#10095;</button>
</section><!-- /hero -->


<!-- ============================================================
     FEATURED BOOKS SECTION
     Displays a grid of featured/highlighted books.
     Pulled from $featured_books array above (hardcoded for now).
     In the real system: fetched from 'books' table WHERE is_featured = 1
     See: Section 2.1 Book Catalog > Book management
     ============================================================ -->
<section class="section featured-books">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">Featured Books</h2>
            <a href="books.php" class="section__link">View All <i class="fas fa-chevron-right fa-xs"></i></a>
        </div>

        <div class="book-grid">
            <?php foreach ($featured_books as $book): ?>
                <!-- Individual book card -->
                <div class="book-card">

                    <!-- Book cover image -->
                    <div class="book-card__image-wrap">
                        <!-- PLACEHOLDER: src points to a placeholder image -->
                        <!-- In production: src="assets/covers/<?= $book['img'] ?>" -->
                        <img
                            src="assets/<?php echo htmlspecialchars($book['img']); ?>"
                            alt="<?php echo htmlspecialchars($book['title']); ?>"
                            class="book-card__image"
                            onerror="this.src='assets/placeholder_book.jpg'; this.onerror=null;"
                        >

                        <!-- Badge (Bestseller / New / Sale) — conditionally shown -->
                        <?php if (!empty($book['badge'])): ?>
                            <span class="book-card__badge book-card__badge--<?php echo strtolower($book['badge']); ?>">
                                <?php echo $book['badge']; ?>
                            </span>
                        <?php endif; ?>

                        <!-- Quick-add overlay button -->
                        <!-- PLACEHOLDER: Will POST to cart.php with book_id in the real system -->
                        <div class="book-card__overlay">
                            <button class="btn btn--primary btn--sm">Add to Cart</button>
                        </div>
                    </div>

                    <!-- Book info below the cover -->
                    <div class="book-card__info">
                        <h3 class="book-card__title"><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p class="book-card__author"><?php echo htmlspecialchars($book['author']); ?></p>
                        <p class="book-card__price">Php <?php echo number_format($book['price'], 2); ?></p>
                    </div>

                </div><!-- /book-card -->
            <?php endforeach; ?>
        </div><!-- /book-grid -->
    </div><!-- /container -->
</section><!-- /featured-books -->


<!-- ============================================================
     PROMOTIONAL BANNER STRIP
     A full-width strip for highlighting a campaign or category.
     PLACEHOLDER: Image and text will come from a CMS or settings table.
     ============================================================ -->
<section class="promo-strip">
    <div class="promo-strip__inner">
        <div class="promo-strip__text">
            <h2 class="promo-strip__title">New Arrivals</h2>
            <p class="promo-strip__sub">Fresh titles added every week</p>
            <a href="new.php" class="btn btn--outline">Explore Now</a>
        </div>
        <!-- PLACEHOLDER: background image set via CSS class or inline style later -->
    </div>
</section><!-- /promo-strip -->


<!-- ============================================================
     BESTSELLERS SECTION
     Same structure as featured books but filtered by bestseller flag.
     PLACEHOLDER: In production — SELECT * FROM books WHERE is_bestseller = 1
     ============================================================ -->
<section class="section bestsellers">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title">Bestsellers</h2>
            <a href="bestsellers.php" class="section__link">View All <i class="fas fa-chevron-right fa-xs"></i></a>
        </div>

        <!-- Reusing the same book-grid layout for consistency -->
        <div class="book-grid">
            <?php
            // PLACEHOLDER: Showing first 4 from the same array as a demo.
            // In production this will be a separate DB query for bestsellers.
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
</section><!-- /bestsellers -->


<!-- ============================================================
     FOOTER
     Contains: logo, nav columns, copyright
     PLACEHOLDER: Newsletter form will tie into email notifications (Section 5)
     ============================================================ -->
<footer class="footer">
    <div class="footer__top">
        <div class="container footer__grid">

            <!-- Footer brand column -->
            <div class="footer__col footer__col--brand">
                <span class="logo-text logo-text--footer">THE LITERARY NOOK</span>
                <p class="footer__tagline">Your cozy corner for every story.</p>
                <!-- Social icons — PLACEHOLDER: links to social pages -->
                <div class="footer__socials">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <!-- Footer nav column: Shop -->
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

            <!-- Footer nav column: Account -->
            <div class="footer__col">
                <h4 class="footer__col-title">My Account</h4>
                <ul class="footer__col-links">
                    <!-- These pages will be built in later sprints -->
                    <li><a href="login.php">Login / Register</a></li>
                    <li><a href="account.php">My Profile</a></li>
                    <li><a href="orders.php">Order History</a></li>
                    <li><a href="wishlist.php">Wishlist</a></li>
                </ul>
            </div>

            <!-- Footer nav column: Help -->
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

            <!-- Newsletter signup — ties into Section 5: Email Notifications -->
            <div class="footer__col footer__col--newsletter">
                <h4 class="footer__col-title">Stay in the Loop</h4>
                <p>Get notified about new arrivals and exclusive deals.</p>
                <!-- PLACEHOLDER: This form will POST to newsletter.php or an email handler -->
                <form class="newsletter-form" action="newsletter.php" method="POST">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn--primary">Subscribe</button>
                </form>
            </div>

        </div><!-- /footer__grid -->
    </div><!-- /footer__top -->

    <!-- Bottom bar with copyright -->
    <div class="footer__bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> The Literary Nook. All rights reserved.</p>
            <p>Built on XAMPP (localhost) — switch to a live server for production deployment.</p>
        </div>
    </div>
</footer><!-- /footer -->


<!-- ============================================================
     SIMPLE INLINE JAVASCRIPT
     Bare-bones cart interaction placeholder.
     In production: cart.js will handle AJAX add-to-cart with session/DB sync.
     ============================================================ -->
<script>
    // PLACEHOLDER: Add-to-cart button click handler
    // In production this will POST to cart.php via fetch() or form submit
    document.querySelectorAll('.btn--primary').forEach(function(btn) {
        if (btn.textContent.trim() === 'Add to Cart') {
            btn.addEventListener('click', function() {
                // Temporary visual feedback — replace with real cart logic later
                btn.textContent = 'Added!';
                btn.style.background = '#28a745';
                setTimeout(function() {
                    btn.textContent = 'Add to Cart';
                    btn.style.background = '';
                }, 1200);
            });
        }
    });

    // PLACEHOLDER: Hero carousel dot interaction (cosmetic only for now)
    document.querySelectorAll('.hero__dot').forEach(function(dot, i) {
        dot.addEventListener('click', function() {
            document.querySelectorAll('.hero__dot').forEach(d => d.classList.remove('hero__dot--active'));
            dot.classList.add('hero__dot--active');
            // Real slide switching will go here once multiple slides are added
        });
    });
</script>

</body>
</html>
