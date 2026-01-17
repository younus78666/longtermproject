// Age Verification
document.addEventListener('DOMContentLoaded', function() {
    const ageOverlay = document.getElementById('ageVerification');
    const ageYesBtn = document.getElementById('ageYes');
    const ageNoBtn = document.getElementById('ageNo');

    if (ageOverlay) {
        // Check if user has already verified age
        if (localStorage.getItem('ageVerified') === 'true') {
            ageOverlay.style.display = 'none';
            document.body.classList.remove('no-scroll');
        } else {
            document.body.classList.add('no-scroll');
        }

        ageYesBtn.addEventListener('click', function () {
            localStorage.setItem('ageVerified', 'true');
            ageOverlay.classList.add('fade-out');
            setTimeout(() => {
                ageOverlay.style.display = 'none';
                document.body.classList.remove('no-scroll');
            }, 300);
        });

        ageNoBtn.addEventListener('click', function () {
            window.location.href = 'https://www.google.com';
        });
    }

    // Sticky Header
    const header = document.getElementById('header');
    let lastScroll = 0;

    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }

        lastScroll = currentScroll;
    });

    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function () {
            mobileMenuToggle.classList.toggle('active');
            mobileNav.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });

        // Close mobile menu when clicking a link
        const mobileNavLinks = document.querySelectorAll('.mobile-nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function () {
                mobileMenuToggle.classList.remove('active');
                mobileNav.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '#affiliate-link') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const headerHeight = header.offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Calculator Logic
    const cartonQtyInput = document.getElementById('cartonQty');
    const qtyMinusBtn = document.getElementById('qtyMinus');
    const qtyPlusBtn = document.getElementById('qtyPlus');
    const pricePerCartonEl = document.getElementById('pricePerCarton');
    const totalPriceEl = document.getElementById('totalPrice');
    const totalSavingsEl = document.getElementById('totalSavings');
    const savingsNoteEl = document.getElementById('savingsNote');

    if (cartonQtyInput) {
        const BASE_PACK_PRICE = 5.99;
        const PACKS_PER_CARTON = 10;

        function getPricePerCarton(qty) {
            if (qty >= 50) return 31.00;
            if (qty >= 40) return 32.00;
            if (qty >= 30) return 33.00;
            if (qty >= 20) return 34.00;
            if (qty >= 10) return 35.00;
            return 37.00;
        }

        function updateCalculator() {
            let qty = parseInt(cartonQtyInput.value);
            if (isNaN(qty) || qty < 1) qty = 1;

            const cartonPrice = getPricePerCarton(qty);
            const total = cartonPrice * qty;

            const totalPacks = qty * PACKS_PER_CARTON;
            const costAsPacks = totalPacks * BASE_PACK_PRICE;
            const savings = costAsPacks - total;
            const savingsPerPack = savings / totalPacks;

            pricePerCartonEl.textContent = '$' + cartonPrice.toFixed(2);
            totalPriceEl.textContent = '$' + total.toFixed(2);
            totalSavingsEl.textContent = '$' + savings.toFixed(2);
            savingsNoteEl.textContent = 'You save $' + savingsPerPack.toFixed(2) + ' per pack!';
        }

        qtyMinusBtn.addEventListener('click', () => {
            let qty = parseInt(cartonQtyInput.value);
            if (qty > 1) {
                cartonQtyInput.value = qty - 1;
                updateCalculator();
            }
        });

        qtyPlusBtn.addEventListener('click', () => {
            let qty = parseInt(cartonQtyInput.value);
            cartonQtyInput.value = qty + 1;
            updateCalculator();
        });

        cartonQtyInput.addEventListener('input', updateCalculator);

        // Initial calculation
        updateCalculator();
    }
});
