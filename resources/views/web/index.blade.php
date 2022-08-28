<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('assets/card.css')}}">
    <script>
let interval;

$('#card-form').on('submit',

    function stop(timer){
    clearInterval(interval);
    $.ajax({
    url: "/card-form",
    type:"POST",
    data:{
    "_token": "{{ csrf_token() }}",
    timer:timer
    }
    });

    });
function pause(){
    clearInterval(interval)
}

        function countdown(time,id)
        {
            strDate = time;
            arr = strDate.split(':');
            hour = $.trim(arr[0]);
            min = $.trim(arr[1]) ;
            sec = $.trim(arr[2]) ;

               interval = setInterval(function(){

              if(hour === "00" && min === "00" && sec === "00")clearInterval(interval);
              if( sec !== "00") {
                 sec--;
              }
              if(sec === "00" )
                {
                    sec = 59;
                    if(min!=="00")
                    min--;
                    if(min === "00")
                    {
                        min = 59;
                        hour--;
                    }
                }

    if(hour.toString().length < 2) hour = "0"+hour;
    if(min.toString().length < 2) min = "0"+min;
    if(sec.toString().length < 2) sec = "0"+sec;
    $("#time" + id).html(`${hour}:${min}:${sec}`);
    $("#timerInput"+id).val(`${hour}:${min}:${sec}`);

            },1000)}


    </script>
</head>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <form action="{{route('web.logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn bg-transparent" style="cursor:pointer" >
                        <i class="text-md-left fa fa-sign-out" style="font-size:20px;color:whitesmoke; text-align: end"></i>
                    </button>
                    <span style="color: white"> Hey,{{auth()->user()->name }}</span>
                </form>

            </ul>

        </div>
    </nav>


<!-- Button trigger modal -->
<div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
    Thank you for getting in touch!
</div>
<div style="position: fixed;
width: 100px;
    bottom: 0px;
    right: 0px;
    margin:40px;
    padding:30px;
    border-radius:70%;
">
    <button type="button" style="width: 40px; height: 40px;"  class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
        +
    </button>

</div>

@foreach(auth()->user()->timers as $timer)
    <div class="card" style="width: 250px;  margin: 10px; display:inline-block; background-color: #4a5568 " >
        <form method="POST" action="{{route('timers.update',$timer->id)}}" id="card-form">
            @method('PUT')
            @csrf
        <div class="card-body" >
            <h4 class="card-title" style="text-align: center; font-weight: bold">{{$timer->name}}</h4>
            <h2 class="card-title" id="time{{$timer->id}}" style="text-align: center; font-weight: bold">{{$timer->time}}</h2>
            <button  type="button" onclick="countdown('{{$timer->time}}','{{$timer->id}}')" class="btn btn-dark">start</button>
            <input hidden value="" id="timerInput{{$timer->id}}" name="timerInput">
            <button type="submit" onclick="stop(document.getElementById('timerInput{{$timer->id}}').value)" class="btn btn-dark" id="stop">stop</button>
            <button type="button" onclick="pause()" class="btn btn-dark" style="cursor:pointer" >
                <i class="text-md-left fa fa-pause" style="color:whitesmoke"></i>
            </button>
            <button type="button" onclick="countdown(document.getElementById('timerInput{{$timer->id}}').value,{{$timer->id}})" class="btn btn-dark" style="cursor:pointer" >
                <i class="text-md-left fa fa-play" style="color:whitesmoke"></i>
            </button>
        </div>
        </form>
    </div>

@endforeach


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">timer</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('timers.store')}}" method="POST" id="timer-form">
                @csrf
            <div class="modal-body " >
                <div  >  <label style=" font-weight: bold">set time</label>
                    <input class="form-control" type="text" id="timer" name="time" placeholder="hh:mm:ss" style="width: 200px; border-radius:3px; text-align: center" />
                    <label style=" font-weight: bold">timer's name</label>
                    <br/>
                    <input type="text" id="InputName" name="name" placeholder="enter timer's name" style="width: 200px; border-radius:3px;">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <input type="text" name="user_id" style="width: 200px; border-radius:3px;" hidden value="{{auth()->user()->id}}">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Save timer</button>
            </div>
            </form>
        </div>

    </div>
</div>
<script>
    $('#timer').datetimepicker({
        format: 'hh:mm:ss',
    });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">


    $('#TimerForm').on('submit',function(e){
        e.preventDefault();

        let name = $('#InputName').val();
        let hour = $('#timer').val();


        $.ajax({
            url: "/timer-form",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                name:name,
                timer:timer,
            },
            success:function(response){
                $('#successMsg').show();
                console.log(response);
            },
            error: function(response) {
                $('#nameErrorMsg').text(response.responseJSON.errors.name);
                $('#timerErrorMsg').text(response.responseJSON.errors.timer);

            },
        });
    });
</script>

</body>
</html>
