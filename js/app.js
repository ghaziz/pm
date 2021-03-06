/**
 * Created by ebrahim on 16/02/2015.
 */
$.fn.scrollTo = function( target, options, callback ){
    if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
    var settings = $.extend({
        scrollTarget  : target,
        offsetTop     : 50,
        duration      : 500,
        easing        : 'ease-out'
    }, options);
    return this.each(function(){
        var scrollPane = $(this);
        var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
        var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
        scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
            if (typeof callback == 'function') { callback.call(this); }
        });
    });
}
function showModal($url) {
    event.preventDefault();
    $.ajax({
        url: $url,
        type: 'POST',
        beforeSend: function () {
            showModalLoading();
        }
    }).success(function (data) {
        showModalData(data);
    }).error(function (e) {
        showModalError();
    });
}
$(document).ready(function (e) {

    /* Ensures after hide modal content is removed. */
    $('#globalModal').on('hidden.bs.modal', function (e) {
        $(this).removeData('bs.modal');

        // just close modal and reset modal content to default (shows the loader)
        $(this).html('<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="loader"></div></div></div></div>');
    });

    $('body').delegate('#checkAllAccess','click',function(e){
        if($(this).prop('checked')==true){
            $('.access').prop('checked',true);
        }else{
            $('.access').prop('checked',false);
        }
     });

    $('.md-trigger').modalEffects();

    $('body').delegate('.md-close', 'click', function () {
        $('div.md-show').removeClass('md-show');
    });
    $('body').delegate('.date-picker', 'focus', function () {
        if(!$(this).hasClass('date-picker-installed')) {
            $(this).pDatepicker({format: 'YYYY/MM/DD'});
            $(this).addClass('date-picker-installed');
        }
    });
});
function sendAjaxForm($url, formId) {
    event.stopPropagation();
    event.preventDefault();
    var sendBtn = $(this);
    sendBtn.prop('disable',true);

    // Create a jQuery object from the form
    $form = $('#' + formId);

    // Serialize the form data
    formData = new FormData();

    var files = $form.find('[type=file]').prop('files');
    var formTagName = $form.find('[type=file]').prop('name');
    // You should sterilise the file names
    if (files != undefined) {
        for (var i = 0; i < files.length; i++) {
            formData.append(formTagName, files[i]);// + '&'++'[]=' + ;
        }
    }
    var params = $form.serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    $.ajax({
        type: 'POST',
        url: $url,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery wil
        data: formData,
        beforeSend: function () {
            showModalLoading();
        }
    }).success(function (data) {
        sendBtn.prop('disable',false);
        showModalData(data);
    }).error(function (e) {
        //showModalError();
        sendBtn.prop('disable',false);
        showModalData(e.responseText);
    });
}
function showModalData(data) {
    $('#globalModal').html(data);
}
function showModalLoading(data) {
    $('#globalModal .modal-body').html('<div class="loader"></div>');
    $('#globalModal').removeClass('md-show').addClass('md-show');

}
function showModalError() {
    $('#globalModal .modal-body').html('<div class="text-center"><div class="i-circle danger"><i class="fa fa-times"></i></div><p>خطایی رخ داده</p></div>');
    $('#globalModal .modal-footer').html('');
    //$('#globalModal .modal-footer').html('<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">اوکی</button>');
}

function confirmDelete($url, $id, prefixToDel) {
    event.preventDefault();
    var gritter_id=-1;
    r = confirm('آیا مطمئن هستید؟');
    if (r == true) {
        $.ajax({
            url: $url,
            type: 'POST',
            data: {'id': $id},
            beforeSend: function () {
                gritter_id = $.gritter.add({
                    title: '',
                    text: 'در حال حذف...لطفا صبر کنید......',
                    image: 'images/loader.gif',
                    imageSize: 15,
                    class_name: 'clean',
                    time: '999999'
                });
            }
        }).success(function (data) {

            $('#' + prefixToDel + $id).slideUp(1000).remove();
            $.gritter.remove(gritter_id);
            $.gritter.add({
                title: '',
                text: 'با موفقیت انجام شد',
                class_name: 'clean',
                time: ''
            });
        }).error(function (e) {
            $.gritter.remove(gritter_id);
            $.gritter.add({
                title: '',
                text: 'با خطا مواجه شد.لطفا دوباره سعی کنید...',
                class_name: 'clean',
                time: ''
            });
        });
    }
}
//todo this
function UpdateTypeAndDescription($url,$attachmentsId){
    event.stopPropagation();
    event.preventDefault();

    $desc =$("#up"+$attachmentsId+" [name='desc']").val();
    $file_type =$("#up"+$attachmentsId+" [name='file_type']").val();

    // Create a jQuery object from the form
    var gritter_id = -1;
    $.ajax({
        type: 'POST',
        url: $url,
        cache: false,
        data: {'desc':$desc,'file_type':$file_type},
        beforeSend: function () {
            gritter_id = $.gritter.add({
                    title: '',
                    text: 'در حال ویرایش...لطفا صبر کنید',
                    image: 'images/loader.gif',
                    imageSize: 15,
                    class_name: 'clean',
                    time: '999999'
                });
        }
    }).success(function (data) {
        $.gritter.remove(gritter_id);
        $.gritter.add({
            title: '',
            text: 'با موفقیت انجام شد',
            class_name: 'clean',
            time: ''
        });
    }).error(function (e) {
        //showModalError();
        $.gritter.remove(gritter_id);
        $.gritter.add({
            title: '',
            text: 'با خطا مواجه شد.لطفا دوباره سعی کنید...',
            class_name: 'clean',
            time: ''
        });
    });
}
function ansComment($id){
    event.stopPropagation();
    event.preventDefault();
    $blockquote = '<blockquote>'+$("#context-"+$id).html()+'</blockquote>';
    $("#Comment_context").val($blockquote+"\n");
    $("#Comment_context").focus();
    $('body').scrollTo('#Comment_context',{duration:'slow', offsetTop : '50'});
}