import $ from 'jquery';

class dc_offcanvas{
    constructor() {
        this.events();
    }

    events(){
        $(document).ready(() => {
            $('[data-toggle="offcanvas"]').on('click', function () {
                $('.offcanvas-collapse').toggleClass('open')
            })
        })

    }

}
export default dc_offcanvas;