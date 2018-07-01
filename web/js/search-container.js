/**
 * Created by raul on 3/22/17.
 */

+function () {
    if((hostname = window.location.hostname) == "localhost"){
        hostname+=":8000";
    }

    $(document).ready(function () {
        $('.search-button').on('click',function () {
            if($('.search-container ').css('display') === 'none'){
                $('.search-button > a > span').removeClass('glyphicon-search');
                $('.search-button > a > span').addClass('glyphicon-remove-circle');
                $('.search-container ').css('display','flex');
            }else {
                $('.search-container ').css('display', 'none')
                $('.search-button > a > span').addClass('glyphicon-search');
                $('.search-button > a > span').removeClass('glyphicon-remove-circle');

            }
        })
        $('.btn-search').on("click",function () {
            var text = $('.input-search').val();
            text = text.replace(/\,\s+/,',')
            text = text.toLowerCase()
            window.location.replace("http://"+hostname+"/album/view/"+$('.active').attr('id') + "/" + text);
        });
        $('.input-search').keypress(function (e){
            if(e.which == 13){
                $('.btn-search').trigger("click");
            }
        });
    });
}();