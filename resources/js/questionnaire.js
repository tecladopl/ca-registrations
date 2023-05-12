
$(document).ready(function () {
    let step = 1;
    $('#font-size-up').on('click', function () {
        if (step <= 2) {
            $('p,li,h1,h3,h4,label,input').each(function (index, value) {
                var k = parseFloat($(this).css('font-size'));
                var redSize = k * 1.2;
                $(this).css('font-size', redSize);
            });
            step++;
        }
    });
    $('#font-size-down').on('click', function () {
        if (step > 1) {
            $('p,li,h1,h3,h4,label,input').each(function (index, value) {
                var k = parseFloat($(this).css('font-size'));
                var redSize = k / 1.2;
                $(this).css('font-size', redSize);
            });
            step--;
        }
    });

    $('.checkAll').click(function () {
        $('input:checkbox').prop('checked', true);
    });

    var calendar = flatpickr(".calendar", {
        dateFormat: "d-m-Y",
        maxDate: new Date(new Date().getFullYear()-18, new Date().getMonth(), new Date().getDay()),
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        },
        wrap: true,
        allowInput: true,
        clickOpens: false,

    });

    $(".calendar-open").on("click", function () {
        calendar.open();
    });

    flatpickr(".calendar2", {
        dateFormat: "Y-m-d H:i:ss",
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        },
        wrap: false,
        allowInput: false,
        clickOpens: true,
        enableTime: true,
        time_24hr: true
    });

    flatpickr(".calendar3", {
        dateFormat: "Y-m-d H:i:ss",
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        },
        wrap: false,
        allowInput: false,
        clickOpens: true,
        enableTime: true,
        time_24hr: true
    });

    $("#clear").on("click", function(e){
        $(':input','form')
            .not(':button, :submit, :reset, :hidden')
            .removeAttr('checked')
            .removeAttr('selected');
    });


});
