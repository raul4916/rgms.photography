/**
 * Created by raul4916 on 12/29/16.
 */


+function () {
    var images = [];
    var totalWidth = 0;

    var url = window.location.pathname;

    url = url.replace("/album/view/", "");
    url = url.split("/");

    if(url == ""){
        var type = "portfolio"
    }

    var type = url[0];
    var filter = "";
    for (var i = 1; i < url.length; i++) {
        filter += url[i];
        if (i != url.length - 1) {
            filter += ","
        }
    }

    $(document).ready(function () {
        getImages(type, filter);
        var hostname = null;
        if((hostname = window.location.hostname) == "localhost"){
            hostname+=":8000";
        }
        for (var i = 0; i < images.length; i++) {
            addCell(images[i].dir + 'display/' + images[i].imageName, images[i].imageName);
        }

        $(window).on('resize',(function () {
            $('.table').html("");
            for (var i = 0; i < images.length; i++) {
                addCell(images[i].dir + 'display/' + images[i].imageName, images[i].imageName);
            }
            addEvents();
            adaptGallery();

        }));
        addEvents();
        var image=[];
        for (var i = 0; i < images.length; i++) {
            var id = images[i].imageName;
            var my_image = new Image();
            my_image.src = window.location.protocol+"//"+hostname+"/uploads/img/full-res/"+id;
            image[id] =my_image;
        }
        var count = $('.cell > img').length;
        $('.cell > img').each(function (index) {

            if ($(this).complete) {
                counter.call();
            } else {
                $(this).one('load', counter)
            }

        })
    });

    function addEvents() {
        $('.cell').on('click','img',function(){
                var id = $(this).attr('id');
                var imageViewer = '<div class="image-viewer"><div class = "exit-viewer"><span class = "glyphicon glyphicon-arrow-left"></span> <span class = "glyphicon glyphicon-remove"></span><span class = "glyphicon glyphicon-download"></span><span class = "glyphicon glyphicon-arrow-right"></span></div><img class="viewer-content" src="'+ window.location.protocol +"//"+hostname+"/uploads/img/full-res/" + id + '"> </div>';
                $('.table').prepend(imageViewer);
                $('.image-viewer').on('click','.glyphicon-arrow-right',function(){
                    for (var i = 0; i < images.length; i++) {
                        if (images[i].imageName == id) {
                            try {
                                id = images[i + 1].imageName;
                                $('.viewer-content').attr('src', window.location.protocol+"//"+hostname+"/uploads/img/full-res/" + id);
                                break;
                            } catch (e) {

                            }
                        }
                    }
                })

                $('.image-viewer').on('click','.glyphicon-arrow-left',function(){
                    for (var i = images.length - 1; i >= 0; i--) {
                        if (images[i].imageName == id) {
                            try {
                                id = images[i - 1].imageName;
                                $('.viewer-content').attr('src',  window.location.protocol+"//"+hostname+"/uploads/img/full-res/" + id);
                                break;
                            } catch (e) {

                            }
                        }
                    }
                });
                $('.exit-viewer').on('swipeleft',function(){
                    for (var i = images.length - 1; i >= 0; i--) {
                        if (images[i].imageName == id) {
                            try {
                                id = images[i - 1].imageName;
                                $('.viewer-content').attr('src',  window.location.protocol+"//"+hostname+"/uploads/img/full-res/" + id);
                                break;
                            } catch (e) {

                            }
                        }
                    }
                });
                $('.exit-viewer').on('swiperight',function(){
                    for (var i = 0; i < images.length; i++) {
                        if (images[i].imageName == id) {
                            try {
                                id = images[i - 1].imageName;
                                $('.viewer-content').attr('src',  window.location.protocol+"//"+hostname+"/uploads/img/full-res/" + id);
                                break;
                            } catch (e) {

                            }
                        }
                    }
                });
                window.addEventListener("orientationchange", function() {
                    // Announce the new orientation number
                    for (var i = 0; i < images.length; i++) {
                        if (images[i].imageName == id) {
                            try {
                                id = images[i].imageName;
                                $('.viewer-content').attr('src', '');
                                $('.viewer-content').attr('src',  window.location.protocol+"//"+hostname+"/uploads/img/full-res/" + id);
                                break;
                            } catch (e) {

                            }
                        }
                    }            }, false);
                $('.image-viewer').on('click','.glyphicon-remove',function(){
                    $('.image-viewer').remove();
                });
            }
        );

    }
    function getImages(type, filter) {
        if(($hostname = window.location.hostname) == "localhost"){
            $hostname+=":8000";
        }
        $.ajax({
            "url": "http://"+$hostname+"/get/images",
            "accepts": "text/json",
            "async": false,
            "success": function (data, status) {
                images = JSON.parse(data);
            },
            "method": "POST",
            "data": {"type": type, "filter": filter}
        });
    }

    function addCell(imgPath, imgName) {
        if((hostname = window.location.hostname) == "localhost"){
            hostname+=":8000";
        }
        var cell = ' <div class = "cell" > <img  id = "' +imgName+ '" src="'+window.location.protocol+'//'+hostname+ '/' + imgPath + '"> </div>';
        $('.table').append(cell);
    }
    function adaptGallery() {
        var totalWidth = 0;
        var currentRow = [];
        $('.cell > img').each(function (index) {
            console.log($(this).width() + "     " + $(this).height());
            currentRow.push($(this));
            totalWidth += parseInt($(this).width());
            var overflow = totalWidth - $('.table').width();

            if (overflow > 0) {
                var scale = (overflow) / totalWidth;
                $(currentRow).each(function (index) {
                    var height = parseInt($(this).height());
                    var width = parseInt($(this).width());
                    if(width > 100)
                        $(this).css({
                            'width': width - width * scale,
                            'height': height - height * scale
                        });


                });
                currentRow = [];
                totalWidth = 0;
            }

        });

    }
    function imageLoaded() {
        adaptGallery();
    }
    function counter(){
        count--;
        if(count === 0){
            imageLoaded();
        }
    }
}();