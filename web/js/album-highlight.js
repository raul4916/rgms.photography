/**
 * Created by raul on 1/26/17.
 */
+function () {
    var images = [];
    var hostname = window.location.hostname;
    if ((hostname) == "localhost") {
        hostname += ":8000";
    }
    getImages('highlights','');
    var idArray = [];
    $(".album").each(function () {
        idArray.push(this.id);
    });

    $(document).ready(function () {
        for (var i = 0; i < idArray.length; i++) {
            for (var j = 0; j < images.length; j++) {
                if (images[j].categories.includes(idArray[i])) {
                    $('#' + idArray[i]).css('backgroundImage','url(/uploads/img/full-res/' + images[j].imageName + ')');

                    $('#' + idArray[i]).on({"mouseenter":function(){
                        $(this).animate({'height':function(){
                            var height = ((document.body.clientWidth / (16 / 9)));
                            if (height > 900) {
                                return ((1863 / (16 / 9)));
                            }
                            return height;
                        }()});
                },'mouseleave':function(){
                        $(this).animate({'height':function(){
                            var height = ((document.body.clientWidth/2 / (16 / 9)))
                            if (height > 500) {
                                return ((1863/2 / (16 / 9)));
                            }
                            return height
                        }()},400)}});
                    images.splice(j, 1);
                    break;
                }
            }
        }
    });
    function getImages(type, filter) {
        $.ajax({
            "url": "http://" + hostname + "/get/images",
            "accepts": "text/json",
            "async": false,
            "success": function (data, status) {
                images = JSON.parse(data);
            },
            "method": "POST",
            "data": {"type": type, "filter": filter}
        });
    }

}();