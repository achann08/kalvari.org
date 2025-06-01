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
        });
    }

    toggleOffcanvas() {
        this.$offcanvas.toggleClass('open');
        this.updateNavbarState();
    }

    positionOffcanvas() {
        // Hanya di mobile (<768px)
        if ($(window).width() >= 768) {
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
        this.header.removeClass('bg-transparent').addClass('bg-light');
        this.navbar.removeClass('navbar-dark').addClass('navbar-light');
        this.siteTitle.removeClass('text-white').addClass('text-dark');
        this.$toggler.removeClass('border-white').addClass('border-dark');
        document.documentElement.style.setProperty('--toggler-color', '#343a40');
        this.navLinks.removeClass('text-white').addClass('text-dark');
        this.dropdownMenus.removeClass('glass-dropdown');
    }

    // Method baru untuk state transparan
    setTransparentState() {
        this.header.removeClass('bg-light').addClass('bg-transparent');
        this.navbar.removeClass('navbar-light').addClass('navbar-dark');
        this.siteTitle.removeClass('text-dark').addClass('text-white');
        this.$toggler.removeClass('border-dark').addClass('border-white');
        document.documentElement.style.setProperty('--toggler-color', '#fff');
        this.navLinks.removeClass('text-dark').addClass('text-white');
        this.dropdownMenus.addClass('glass-dropdown');
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
}

export default dc_navbarJS;