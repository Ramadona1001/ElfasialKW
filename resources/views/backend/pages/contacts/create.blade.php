@extends('backend.layouts.master')

@section('title',__('tr.Contactus'))

@section('contactssactive','kt-menu__item  kt-menu__item--active')

@section('stylesheet')

@endsection

@section('content')


    <form action="{{ route('store_contactus') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text"  name="name" class="form-control" id="name">
            </div>

        </div>

        <br> <br>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>

        </div>



        <br> <br>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" id="subject">
            </div>

        </div>


        <br> <br>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="message">Message</label>
                <input type="text" name="message" class="form-control" id="message">
            </div>

        </div>



        <button type="submit"  class="btn btn-primary">Submit</button>
    </form>


@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection