@extends('customer.layouts.master')

@section('title')
    Feedback
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <form action="{{('/customer/feedback/add')}}" method="post">
            @csrf
            <label for="" class="text-bold">Message:</label>
            <textarea name="message" id="" cols="30" rows="10" style="resize: none" placeholder="Type your feedback here..." class="form-control" required>
            </textarea><br>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection