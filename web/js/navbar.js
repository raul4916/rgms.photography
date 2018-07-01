/**
 * Created by raul on 3/29/17.
 */


navBar = {
    "resize":
        function() {
            $(".nav-tabs,.nav-pills").css('font-size', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 30) {
                    return 30 + "pt";
                }
                else if (wid < 14) {
                    return 14 + "pt";
                }
                return wid + "pt";
            });

            $(".nav-pills > li, .nav-pills > li").css('margin-top', function () {
                var height = ((document.body.clientWidth * 50) / (1863 + (document.body.clientWidth * .5)));
                if (height > 50) {
                    return 50;
                }
                return height;
            });
            $(".middle-logo").css('margin-top', function () {
                var height = ((document.body.clientHeight * 25) / 1863);
                if (height > 25) {
                    return 25;
                }
                return height;

            });
            $(".middle-logo").css('width', function () {
                var height = ((document.body.clientWidth * 400) / 1863);
                if (height > 400) {
                    return 400;
                } else if (height < 150) {
                    return 150;
                }
                return height;

            });
            $(".middle-logo").css('margin-left', function () {
                var wid = ((document.body.clientWidth * 50) / 1863);
                if (wid > 50) {
                    return 50;
                }
                return wid;

            });
            $(".album > .nav > li ").css('borderWidth', function () {
                var width = ((document.body.clientWidth * 25) / (1863));
                if (width > 25) {
                    return 25;
                }
                return width;
            });



            if((document.body.clientWidth) < 720){
                this.toHamburger()
            }else {
                this.toTab()
            }
        },
        "toHamburger":function () {
            $(".nav-tab").css('display','none');
            $(".hamburger-button").css('display','block');
        },
        "toTab":function () {
            $(".nav-tab").css('display','block');
            $(".hamburger-button").css('display','none');
            $('.hamburger-nav').css('display','none');
            $('.hamburger-container').css('display','none');
            $(".hamburger-container").css('width','0px');

        }
};