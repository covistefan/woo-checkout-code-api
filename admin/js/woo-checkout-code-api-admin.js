var jQ = jQuery.noConflict();

function showhideAuthRow(v) {
     if (parseInt(v)==2) {
        jQ('.auth_data').show();
        jQ('.api_client').show();
        jQ('.basic_user').hide();
    } else if (parseInt(v)==1) {
        jQ('.auth_data').show();
        jQ('.api_client').hide();
        jQ('.basic_user').show();
    } else {
        jQ('.auth_data').hide();
    }
}

function initTablist() {
    var tlo = false;
    jQ('.tabcontent').hide();
    jQ('.tablist li').each(function(){
        if (jQ(this).hasClass('active')) { 
            tlo = true;
            var t = jQ(this).find('a').attr('href');
            jQ('#tablist-data').val(t);
            jQ(t).show();
        }
    });
    if (tlo===false) {
        jQ('.tablist li').first().addClass('active');
        jQ('.tabcontent').hide();
        var t = jQ('.tablist li').first().find('a').attr('href');
        jQ('#tablist-data').val(t);
        jQ(t).show();
    }
}

jQ('document').ready(function(){
    
    initTablist();
    
    jQ('.tablist li a').click(function(e) {
        e.preventDefault();
        jQ('.tablist li').removeClass('active');
        jQ(this).parent('li').addClass('active');
        var t = jQ(this).attr('href');
        jQ('.tabcontent').hide();
        jQ('#tablist-data').val(t);
        jQ(t).show();
    });
    
});

