/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function () {
    // $('#date-picker').datepicker({
    //     todayBtn: 'linked',
    //     format: 'yyyy-mm-dd',
    //     autoclose: true
    // })

    $('#deadline').datetimepicker({
        ownerDocument: document,
        contentWindow: window,

        value: '',
        rtl: false,

        format: 'Y/m/d H:i',
        formatTime: 'H:i',
        formatDate: 'Y/m/d',
        hours12: true,
        step: 60,
        monthChangeSpinner: true,

        closeOnDateSelect: false,
        closeOnTimeSelect: true,
        closeOnWithoutClick: true,
        closeOnInputClick: true,
        openOnFocus: true,

        timepicker: true,
        datepicker: true,
        weeks: false,
        initTime: true,
        allowTimes: [],
        timeHeightInTimePicker: 25,



    });
});

if (jQuery().timepicker && $(".timepicker").length) {
    $(".timepicker").timepicker({
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down'
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


if (jQuery().summernote) {
    $(".summernote").summernote({
        dialogsInBody: true,
        minHeight: 250,
    });
    $(".summernote-simple").summernote({
        dialogsInBody: true,
        minHeight: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]
        ]
    });
}
