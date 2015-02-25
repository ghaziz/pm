/**
 * Created by ebrahim on 21/02/2015.
 */
var $filequeue,
    $filelist;

$(document).ready(function() {
    $filequeue = $(".pm-upload .filelist.queue");
    $filelist = $(".pm-upload .filelist.complete tbody");

    $(".pm-upload .dropped").dropper({
        action: $filesAction, //this will send from every module that call
        maxSize: $maxFileSize, // 1 mb
        label: 'لطفا فایل مورد نظر خود را درگ و دراپ کنید یا اینچا کلیک کنید برای انتخاب'
    }).on("start.dropper", onStart)
        .on("complete.dropper", onComplete)
        .on("fileStart.dropper", onFileStart)
        .on("fileProgress.dropper", onFileProgress)
        .on("fileComplete.dropper", onFileComplete)
        .on("fileError.dropper", onFileError);

    $(window).one("pronto.load", function() {
        $(".pm-upload .dropped").dropper("destroy").off(".dropper");
    });
});

function onStart(e, files) {
    console.log("Start");

    var html = '';

    for (var i = 0; i < files.length; i++) {
        html += '<li data-index="' + files[i].index + '"><span class="file">' + files[i].name + '</span><span class="progress">Queued</span></li>';
    }

    $filequeue.append(html);
}

function onComplete(e) {
    console.log("Complete");
    // All done!
}

function onFileStart(e, file) {
    console.log("File Start");

    $filequeue.find("li[data-index=" + file.index + "]")
        .find(".progress").text("0%");
}

function onFileProgress(e, file, percent) {
    console.log("File Progress");

    $filequeue.find("li[data-index=" + file.index + "]")
        .find(".progress").text(percent + "%");
}

function onFileComplete(e, file, response) {
    console.log("File Complete");
    response = JSON.parse(response);
    if (response.status === "error") {
        $filequeue.find("li[data-index=" + file.index + "]").addClass("error")
            .find(".progress").text(response.msg);
    } else {
        var $target = $filequeue.find("li[data-index=" + file.index + "]");
        $target.find(".file").text(file.name);
        $target.find(".progress").remove();
        $target.slideUp().remove();
        $target = response.out;;
        $filelist.append($target);
    }
}

function onFileError(e, file, error) {
    console.log("File Error");

    $filequeue.find("li[data-index=" + file.index + "]").addClass("error")
        .find(".progress").text("Error: " + error);
}
