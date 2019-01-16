function load_images() {
    $('#logo a').attr('href' , 'http://www.samanitg.com');
    $('#logo a').attr('target' , '_blank');
    $('#logo a img').attr('src' , '../env-production/suntech-general/src/itop-logo-external.png');
    $('#logo a img').css('height',55);

    $('#combodo_logo a').attr('href' , 'http://www.samanitg.com');
    $('#combodo_logo a').attr('target' , '_blank');
    $('#combodo_logo a img').attr('src' , '../env-production/suntech-general/src/logo-combodo.png');

    $('#login-logo a img').attr('src' , '../env-production/suntech-general/src/itop-logo-external.png');
    $('#login-logo a img').attr('title' , 'Saman IT Group');
    $('#login-logo a').attr('href' , 'http://www.samanitg.com');
    $('#login-logo a').attr('target' , '_blank');
    $('#login-logo').css('height', 70);

    $('#2_national_code').attr('placeholder' , '##########');

    $('#AccordionMenu_iTopHub').css('display' , 'none');

    $('#AccordionMenu_Audit').css('display' , 'none');
    $('#AccordionMenu_AuditCategories').css('display' , 'none');
    $('#AccordionMenu_ConfigEditor').css('display' , 'none');

    
    $('[id*=tk_ResultsToAdd]').remove();
}

function setFAdim(){
    //
    $('#left-pane').css('width',300);
    $('#left-pane').css('right' , 0);
    $('#left-pane').css('left' , 'auto');
    $('#left-pane').siblings().eq(0).css('left' , 0);
    $('#left-pane').siblings().eq(0).css('right' , 'auto');
    
    var winWidth = $(window).innerWidth();
    contWidth = winWidth - 300;
    $('#left-pane').siblings().eq(0).css('width' , contWidth );

    var contWidth = $('#left-pane').siblings().eq(0).innerWidth();
    //$('#left-pane').siblings().eq(4).css('left' , contWidth);
    $('#left-pane').siblings().eq(4).css('display' , 'none');
    
    $('div[id*="ui-accordion-accordion-panel"] ul').css('direction' , 'rtl');
    $('.ui-tabs .ui-tabs-nav li').css('direction' , 'rtl');
    $('.ui-tabs .ui-tabs-nav li').css('float','right');
    $('.wizContainer form').css('direction' ,'rtl');
    $('#block_1').css({'direction': 'rtl', 'text-align':'right'});
    $('.ui-layout-content').css({'direction': 'rtl'});
    $('#accordion h3').css({'text-align': 'center'});
    
    $('div[id*="block"] h1').css({
        'text-align':'right',
        'padding-right':'20px',
    });
    $('div[id*="block"]').css({
        'text-align':'right',
    });
    $('div[id*="block"] a').css('padding-right','20px');
    $('div[id*="block"] .summary-details').css({
        'float':'left'
    });
    $('#Contact table td').css('text-align', 'right');
    
    $('.main_header h1').css('padding-right', '20px');



    //for directions
    $('.field_input_radio_horizontal').css('direction' , 'rtl');
    $('.textSearch').css('direction' , 'rtl');

    $('#global-search-image').css('margin-left', 0);
    
}

$(window).resize(function(){
    setDim();
    setTimeout(setDim , 200);
    setTimeout(setDim , 400);
});

var userRecieved=  0;
var lang;
var user;

function setDim(){
    

    if (lang == 'FA IR'){
       setFAdim();
    }

    $('[for="user"]').parent().remove();
    $('[for="pwd"]').parent().remove();
    $('#user').parent().css('text-align', 'center');
    $('#pwd').parent().css('text-align', 'center');
    $('#user').attr('placeholder', 'username');
    $('#pwd').attr('placeholder', 'password');

    if ($('[type=submit]').val() == 'ورود به سامانه'){
        $('#user').attr('placeholder', 'نام کاربری');
        $('#pwd').attr('placeholder', 'کلمه عبور');
    }
    $("#login p").remove();
}

function setUserLabel(user)
{
    $('.header-menu').append('<div style="color:#FFF; font-family:Tahoma; text-align:center;">' + user + '</div>');
}

function setDirections()
{
    $('[type=text], .textSearch').keyup(function(){
        var c = this.value.codePointAt(0);
        if (c >= 0x0600 && c <=0x06FF || c== 0xFB8A || c==0x067E || c==0x0686 || c==0x06AF){
            $(this).css('direction','rtl');
        }else{
            $(this).css('direction','ltr');
        }

    });
}




$(document).ready(function(){
    
    n = $('.hasDatepicker').length;
    var date_id;
    var i;
    for (i=0; i<n; i++){
        date_id = $('.hasDatepicker').eq(i).attr('id');
        kamaDatepicker(date_id);
    }
    
    setTimeout(function(){
        n = $('.hasDatepicker').length;
        var date_id;
        var i;
        for (i=0; i<n; i++){
            date_id = $('.hasDatepicker').eq(i).attr('id');
            kamaDatepicker(date_id);
        }
        }, 1000);
    userRecieved = 0;

    load_images();
    setDim();
    //setUserLabel();

    setTimeout(load_images , 200);
    setTimeout(setDim , 300);
    setTimeout(function(){
        setUserLabel(newUser);
    } , 300);

    setTimeout(function(){
        $(window).trigger('resize');
    } , 1000);


    $('#open-left-pane').click(function(){
        setDim();
    });
     setInterval(function(){
        $('#go-home').css('display', 'none');
     }, 300);

     $('#top-bar-table-breadcrumb').css('display', 'none');
	 $('#new_config').css('direction', 'ltr');

     setDirections();
    


});



