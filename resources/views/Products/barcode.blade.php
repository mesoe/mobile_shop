@extends('admin.layouts.app')
@section('title') Dashboard Page @stop
@section('content')
    <div class="container">
        <div class="col-md-3" style="margin-top: 50px">
           @foreach($pds as $pd)
                <p class="text-center">Name:{{$pd->name}}</p>
               <p class="text-center"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($pd->barcode,'C93')}}")/></p>
               @endforeach
        </div>
    </div>
@endsection
