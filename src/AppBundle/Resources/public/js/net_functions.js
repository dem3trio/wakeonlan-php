


var ping = function(url, objectId) {

    var pingSuccess = function(data) {
        if(data.alive) {
            jQuery("#"+objectId+" .ip-success").show();
            jQuery("#"+objectId+" .ip-fail").hide();
        } else {
            jQuery("#"+objectId+" .ip-success").hide();
            jQuery("#"+objectId+" .ip-fail").show();
        }

        setTimeout(function(){
            ping(url, objectId)
        }, 10000);
    };

    jQuery.ajax({
        url: url,
        success: pingSuccess,
        dataType: 'json'
    });
};

var wakeUp = function (url) {
    var wakeUpSuccess = function(data) {
      console.log(data);
    };

    jQuery.ajax({
        url: url,
        success: wakeUpSuccess,
        dataType: 'json'
    });
};


jQuery(document).ready(function() {
    jQuery('.ip-success').hide();
    jQuery('.ping-check').each(function(i, obj){
        var canPing = jQuery(obj).attr('data-ip-can-ping');
        console.log("can ping:");
        console.log(canPing);
        if (canPing == 'false') return;

        var objectId = jQuery(obj).attr('id');
        var url = jQuery(obj).attr('data-ip-ping');

        console.log(url);
        ping(url, objectId);
    });
});
