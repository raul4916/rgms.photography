+function () {
    if((hostname = window.location.hostname) == "localhost"){
        hostname+=":8000";
    }

    $(document).ready(function () {
        $('.hamburger-button').on('click',function () {
            console.log( parseInt($('.nav-pills').css('fontSize'),10) )
            $('.hamburger-container').animate({
                'width': function () {
                    if ($('.hamburger-container').css('width') === '0px') {
                        $('.hamburger-nav').css('display','flex');
                        $('.hamburger-container').css('display','flex');
                        return  parseInt($('.nav-pills').css('fontSize'),10)*7;
                    } else {
                        $('.hamburger-nav').css('display','none');
                        $('.hamburger-container').css('display','none');
                        return 0;
                    }
                }
            },400)
        })});
}();