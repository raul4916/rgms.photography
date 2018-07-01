+function() {
    $(document).ready(function() {
        checkOuter =  0;
        resize();
        $(window).on('resize', (resize));

        function resize()
        {
            $("p").css('font-size', function () {
                var wid = ((document.body.clientWidth * 20) / 1863)
                if (wid > 20) {
                    return 20 + "pt";
                }
                return wid + "pt";
            });

            $(".content-div").css('width', function () {
                var width = document.body.clientWidth;
                console.log(width);

                if (width >= 1863) {
                    return 1863;
                }

                return "100%";
            });

            $("#laptop-design").css('width', function () {
                var wid = ((document.body.clientWidth * 1000) / 1863)
                if (wid > 1000) {
                    return 1000 + "px";
                }
                return wid + "px";
            });
            navBar.resize();

            $(".home-step-content > h2").css('font-size', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 30) {
                    return 30 + "pt";
                }else if (wid < 10) {
                    return 10 + "pt";
                }
                return wid + "pt";
            });
            $(".home-step-content > p").css('marginTop', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 50) {
                    return 50;
                }
                return wid;
            });
            $(".subtitle").css('font-size', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 30) {
                    return 30 + "pt";
                }else if (wid < 10) {
                    return 10 + "pt";
                }
                return wid + "pt";
            });
            $(".home-step-content-1 > h2,.home-step-content-1 > p").css('font-size', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 30) {
                    return 30 + "pt";
                }else if (wid < 10) {
                    return 10 + "pt";
                }
                return wid + "pt";
            });
            $(".home-step-content-1 > p").css('marginTop', function () {
                var wid = ((document.body.clientWidth * 50) / 1863)
                if (wid > 50) {
                    return 50;
                }
                return wid;
            });
            $("li > h2").css('font-size', function () {
                var wid = ((document.body.clientWidth * 30) / 1863)
                if (wid > 30) {
                    return 30 + "pt";
                }if (wid < 15) {
                    return 15 + "pt";
                }
                return wid + "pt";
            });

            $(".header-bold").css('font-size', function () {
                var wid = ((document.body.clientWidth * 20) / 1863)
                if (wid > 20) {
                    return 20 + "pt";
                }
                return wid + "pt";
            });


            if( window.location.pathname == "/") {
                $(".header").css('height', function () {
                    var height = ((document.body.clientWidth / (16 / 9)));
                    if (document.body.clientWidth > 1863) {
                        return ((1863 / (16 / 9)));
                    }
                    return height;

                });
            }else{
                $(".header").css('height', function () {
                    var height = ((document.body.clientWidth * 400) / 1863);
                    if (height > 300) {
                        return  300;
                    } if (height <200) {
                        return  200;
                    }
                    return height;

                });
            }
            $(".home-step").css('height', function () {
                var height = ((document.body.clientWidth/(16/9)));
                if (height > 900) {
                    return ((1863/(16/9)));
                }
                return height;

            });
            $(".album").css('height', function () {
                var height = (((document.body.clientWidth/2)/(16/9)));
                if (height > 900) {
                    return ((1863/(16/9)));
                }
                return height;

            });
            $(".search-group ").css('width', function () {
                var width = ((document.body.clientWidth*600)/(1863));
                if (width > 600) {
                    return 600;
                }
                if (width < 300) {
                    return 300;
                }
                return width;
            });
            $(".social-media-logos").css('width', function () {
                var width = ((document.body.clientWidth*100)/(1863));
                if (width > 100) {
                    return 100;
                }
                if (width < 35) {
                    return 35;
                }
                return width;
            });
            if(document.body.clientWidth < 1350) {
                $(".bio-content").addClass("flex-enable-column");
                $(".bio-content").removeClass("flex-enable");
            }else{
                $(".bio-content").removeClass("flex-enable-column");
                $(".bio-content").addClass("flex-enable");
            }

        }
    });

}();