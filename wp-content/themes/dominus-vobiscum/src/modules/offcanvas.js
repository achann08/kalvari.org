import $ from 'jquery';

class dc_offcanvas {
    constructor() {
        this.initElements();
        this.events();
    }

    initElements() {
        this.$navbar = $('.navbar');
        this.$offcanvas = $('.offcanvas-collapse');
        this.$toggler = $('.navbar-toggler');
    }

    events() {
        $(document).ready(() => {
            // Event toggle offcanvas
            $('[data-toggle="offcanvas"]').on('click', () => this.toggleOffcanvas());
            
            // Event handlers untuk positioning
            this.positionOffcanvas();
            $(window).on('resize', () => this.positionOffcanvas());
            this.$toggler.on('click', () => this.positionOffcanvas());
        });
    }

    toggleOffcanvas() {
        this.$offcanvas.toggleClass('open');
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
}

export default dc_offcanvas;