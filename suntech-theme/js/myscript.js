function reload_images() {

    $('#logo a img').attr('src' , '../env-production/suntech-general/src/itop-logo-external-dark.png');
    $('#combodo_logo a img').attr('src' , '../env-production/suntech-general/src/logo-combodo-dark.png');
    $('#itop-breadcrumb img').attr('src' , '../images/home.png');

}


$(document).ready(function(){
    reload_images();
    setTimeout(reload_images , 220);
});