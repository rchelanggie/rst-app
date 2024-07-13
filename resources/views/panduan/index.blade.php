@extends('layout.one-frame')

@section('content')
    <div id="main">
        <div class="content m-5">
            <h2 style="color: #001F3F; font-size:4rem">Panduan Aplikasi</h2>
            @foreach ($data as $item)
                <ul>
                    <div class="d-inline-flex" style="margin-top:20px;">
                        <div
                            style="background-color: #001F3F;
                            position: absolute;
                            width: 65px;
                            height: 65px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                            margin-right: 20px;">
                            <img style="width: 30px; height: 30px;" src="images/{{ $item->icon }}.png" alt="Circle Image">
                        </div>
                        <div
                            style="padding-left: 50px; margin-left: 30px; padding-top:8px; background-color: #EBEBEB; width: 700px; border-radius: 20px; display: flex; align-items: center; margin-top:10px;">
                            <p style="font-size: 1.2rem; font-weight:500">{{ $item->panduan }}</p>
                        </div>
                    </div>
                </ul>
            @endforeach
        </div>
    </div>
@endsection
