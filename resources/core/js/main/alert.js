var customAlert = (
    function(){
        function alert(string, callback=null){
            if (callback) {
                callback();
            }else if(string){
                $('.alert-box.alert').addClass('show');
                $('.alert-box .alert-title').text(string);
            }
        }

        function init(){
            $('.btn-alert-confirm').on('click', function () {
                $('.alert-box').removeClass('show');
            });
        }

        return {
            init,
            alert
        }
    }
)(jQuery);

