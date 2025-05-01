import $ from 'jquery';

class dc_testjs{
    constructor() {
        this.events();
    }

    events(){
        $(document).ready(() => {
            alert("hello world from test js");
        })

    }

}
export default dc_testjs;