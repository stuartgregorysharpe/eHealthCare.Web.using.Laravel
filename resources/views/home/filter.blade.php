@extends('layouts.homeapp')

@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="homeBody">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 form-group">
                <form action="{{action('HomeController@searching')}}" method="get">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="text" class="form-control" id="search_text"
                            placeholder="Search doctors with name, speciality, address...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <div class="working_content">
        <div class="row search_filter_result">
            @foreach($doctors as $doctor)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="card-img-top" src="{{asset('images/default.png')}}" alt="Card image">
                                </div>
                                <div class="col-md-9">
                                    <div>
                                        <h3>
                                            {{str_replace('"}', '', str_replace('{"en":"', '', $doctor->name))}}
                                        </h3>
                                    </div>
                                    <div>
                                        <p>{{$doctor->specialist}}</p>
                                    </div>
                                    <div>
                                        <p>{{$doctor->address[0]}}</p>
                                    </div>
                                    <div>
                                        <p>doctor review</p>
                                    </div>
                                    <div>
                                        <p>doctor experience</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                @for($par = 0 ; $par < 12 ; $par ++) @php $add='+' .$par.' days'; $date=date('Y-m-d',strtotime($add)) @endphp
                                <div class="col-md-2 margin-bottom-10">
                                    <div class="datearea">
                                        <p class="date">{{$date}}</p>
                                        <p class="dayofweek">{{Carbon::parse($date)->dayName}}</p>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row promised_area">

        </div>
    </div>
</div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search_text').change(function(){
            $.ajax({
                url: '/searching',
                method: 'post',
                data: {
                    text: $('#search_text').val(),
                    _token: "{{ csrf_token() }}"
                }
            }).done(function (response) {
            });
        });

    });

</script>


<style>
    .homeBody {
        padding-top: 20px;
    }

    .searcharea {
        background-color: #e2f0ff;
        margin-left: 200px;
        margin-right: 200px;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    h1 {
        font-weight: 900 !important;
    }

    .justifycontentspacearound {
        justify-content: space-around;
    }

    .working_content {
        padding: 20px;
        padding-left: 100px;
        padding-right: 100px;
    }

    .card {
        width: 100%;
    }

    .card-img-top {
        width: 100%;
        height: auto;
    }

    .datearea {
        background-color: yellow;
        width: 100%;
        height: 80px;
    }
    .margin-bottom-10{
        text-align: center;
        margin-bottom: 12px;
    }
    .date{
        padding-top: 15px;
        padding-bottom: 0px;
        margin-bottom: 0px;
    }
    .dayofweek{
        padding : 0px;
        margin : 0px;
    }
    p{
        margin: 0px!important;
        padding: 0px;
    }
</style>