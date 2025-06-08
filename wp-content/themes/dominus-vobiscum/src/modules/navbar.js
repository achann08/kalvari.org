import $ from 'jquery';

class dc_navbarJS {
    constructor() {
        this.initElements();
        this.events();
        this.initNavbarState();
    }

    initElements() {
        this.$navbar = $('.navbar');
        this.$offcanvas = $('.offcanvas-collapse');
        this.$toggler = $('.navbar-toggler');
        
        // Variabel untuk navbar state
        this.scrollDistance = 50;
        this.header = $('header');
        this.navLinks = $('.navbar-nav .nav-link');
        this.navbar = $('.main-menu');
        this.siteTitle = $('.site-title');
        this.dropdownMenus = $('.dropdown-menu');
        this.dropdownLinks = $('.dropdown-menu .btn-group .nav-link');
    }

    events() {
        $(document).ready(() => {
            // Event untuk offcanvas
            $('[data-toggle="offcanvas"]').on('click', () => this.toggleOffcanvas());
            this.$toggler.on('click', () => this.handleTogglerClick());
            
            // Event untuk positioning
            $(window).on('resize', () => this.positionOffcanvas());
            
            // Event untuk navbar state
            $(window).on("scroll", () => this.updateNavbarState());
            
            // Event untuk dropdown menu
            $('.main-menu .dropdown-toggle').on('click', (e) => this.handleDropdown(e));
            $(document).on('click', (e) => this.closeDropdowns(e));
            
            // Inisialisasi awal
            this.positionOffcanvas();

            // Panggil penyesuaian awal
            this.adjustDropdownPositions();
        });
    }

    toggleOffcanvas() {
        this.$offcanvas.toggleClass('open');
        this.updateNavbarState();
    }

    positionOffcanvas() {
        // Hanya di mobile (<768px)
        if ($(window).width() >= 821) {
            this.$offcanvas.removeAttr('style');
            return;
        }

        if (this.$navbar.length && this.$offcanvas.length) {
            const navbarBottom = this.$navbar[0].getBoundingClientRect().bottom;
            this.$offcanvas.css({
                top: navbarBottom + 'px',
                height: `calc(100vh - ${navbarBottom}px)`
            });
        }
    }

    initNavbarState() {
        this.updateNavbarState();
        this.positionOffcanvas();
    }

    updateNavbarState() {
        const isScrolled = $(window).scrollTop() > this.scrollDistance;
        const isMenuOpen = this.$offcanvas.hasClass('open');
        const isFrontPage = $('body').hasClass('home'); // Cek apakah halaman home

        // Jika bukan front page, langsung set state scrolled
        if (!isFrontPage) {
            this.setScrolledState();
            return;
        }

        // Jika front page, update berdasarkan scroll/menu
        if (isScrolled || isMenuOpen) {
            this.setScrolledState();
        } else {
            this.setTransparentState();
        }
    }

    // Method baru untuk state scrolled
    setScrolledState() {
        this.header.removeClass('bg-transparent').addClass('bg-dark');
        this.siteTitle.removeClass('text-dark').addClass('text-white');
        this.$toggler.removeClass('border-dark').addClass('border-light');
        document.documentElement.style.setProperty('--toggler-color', '#f8f9fa');
        this.dropdownMenus.removeClass('glass-dropdown');
        this.dropdownLinks.css('color', '#212529');
    }

    // Method baru untuk state transparan
    setTransparentState() {
        this.header.removeClass('bg-dark').addClass('bg-transparent');
        this.siteTitle.removeClass('text-dark').addClass('text-white');
        this.$toggler.removeClass('border-dark').addClass('border-light');
        document.documentElement.style.setProperty('--toggler-color', '#f8f9fa');
        this.dropdownMenus.addClass('glass-dropdown');
        this.dropdownLinks.css('color', 'white');
    }

    handleTogglerClick() {
        this.$toggler.toggleClass('active');
        this.positionOffcanvas();
        setTimeout(() => this.updateNavbarState(), 10);
    }

    handleDropdown(e) {
        e.preventDefault();

        const $target = $(e.currentTarget);
        $target.closest('.menu-item-has-children')
            .siblings('.menu-item-has-children')
            .find('.dropdown-menu').removeClass('show');
        
        const dropdownMenu = $target.closest('.menu-item-has-children').find('.dropdown-menu');
        const mainDropdown = dropdownMenu.first();

        mainDropdown.toggleClass('show', function() {
            if ($(this).css("display") === 'none') {
                dropdownMenu.hide();
            }
        });
    }

    closeDropdowns(e) {
        if (!$(e.target).closest('.main-menu').length) {
            $('.dropdown-menu').removeClass('show');
        }
    }

    adjustDropdownPositions() {
        // Hanya di desktop
        if ($(window).width() < 821) return;

        $('.dropdown-menu').each((index, element) => {
            const $dropdown = $(element);
            const $parent = $dropdown.parent();
            
            // Reset class position
            $dropdown.removeClass('ml-auto');
            
            // Hitung posisi dropdown jika ditampilkan
            const parentRect = $parent[0].getBoundingClientRect();
            const dropdownWidth = $dropdown.outerWidth();
            const viewportWidth = $(window).width();
            
            // Hitung posisi kanan dropdown jika tidak ada ml-auto
            const rightPosition = parentRect.left + dropdownWidth;
            
            // Jika dropdown akan keluar dari viewport
            if (rightPosition > viewportWidth) {
                $dropdown.addClass('ml-auto');
            }
        });
    }
}

export default dc_navbarJS;