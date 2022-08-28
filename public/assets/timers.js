$(document).ready(function() {
    let interval;


    $('#TimerForm').on('submit',

        function stop(timer) {
            clearInterval(interval);
            $.ajax({
                url: "/card-form",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    timer: timer
                }
            });

        });


    function countdown(time, id) {
        strDate = time;
        arr = strDate.split(':');
        hour = $.trim(arr[0]);
        min = $.trim(arr[1]);
        sec = $.trim(arr[2]);

        interval = setInterval(function () {

            if (hour === "00" && min === "00" && sec === "00") clearInterval(interval);
            if (sec !== "00") {
                sec--;
            }
            if (sec === "00") {
                sec = 59;
                min--;
                if (min === "00") {
                    min = 59;
                    hour--;
                }
            }

            if (hour.toString().length < 2) hour = "0" + hour;
            if (min.toString().length < 2) min = "0" + min;
            if (sec.toString().length < 2) sec = "0" + sec;
            $("#time" + id).html(`${hour}:${min}:${sec}`);
            $("#timerInput" + id).val(`${hour}:${min}:${sec}`);

        }, 1000)
    }


    $('#TimerForm').on('submit', function (e) {
        e.preventDefault();

        let name = $('#InputName').val();
        let hour = $('#timer').val();


        $.ajax({
            url: "/timer-form",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                name: name,
                timer: timer,
            },
            success: function (response) {
                $('#successMsg').show();
                console.log(response);
            },
            error: function (response) {
                $('#nameErrorMsg').text(response.responseJSON.errors.name);
                $('#timerErrorMsg').text(response.responseJSON.errors.timer);

            },
        });
    });

})
