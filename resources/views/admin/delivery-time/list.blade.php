@extends('admin.layouts.master')

@section('title')
    Delivery time
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Delivery Time List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/districts">delivery time list</a></p>
            </div>
          </div>
        </div>
        <form class="form-inline" method="POST" action="/admin/delivery-time/add">
            @csrf
            <label class="form-control-sm" for="start">Start</label>
            <input type="time" class="form-control form-control-sm mb-2 mr-sm-2" id="start" placeholder="Start" name="start">
          
            <label class="form-control-sm" for="end">End</label>
            <input type="time" class="form-control form-control-sm mb-2 mr-sm-2" id="end" placeholder="End" name="end">
          
            <label class="form-control-sm" for="charge">Charge(₹)</label>
            <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="charge" placeholder="End" name="charge" min="0" step="1" value="0">
            <button type="submit" class="btn btn-sm btn-primary mb-2">Add</button>
          </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Charges(₹)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($times as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->start}}</td>
                        <td>{{$item->end}}</td>
                        <td>{{$item->charge}}</td>
                        <td>
                        <button data-toggle="modal" id="getModal" data-target="#modalEdit" class="btn btn-sm btn-inverse-dark btn-icon" data-url="{{ url('/admin/delivery-time/edit',['id'=>$item->id])}}">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <form action="{{url('/admin/delivery-time/delete',['id'=>$item->id])}}" method="post" id="pd-{{$item->id}}" hidden>
                        @csrf
                        </form>
                        <button type="submit" form="pd-{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon">
                          <i class="mdi mdi-delete-forever"></i>
                        </button>
                        </td>
                    </tr>
                @endforeach
                @if (count($times) == 0)
                    <tr>
                        <td colspan="10">no time set</td>
                    </tr>
                @endif
            </tbody>
          </table>
          @if ($times->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $times->url($times->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($times->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $times->lastPage(); $i++)
            <a href="{{ $times->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($times->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $times->url($times->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($times->currentPage() == $times->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- Edit Modal --}}
<div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content message-modal">
       </div>
    </div>
 </div>
 
<script>
    // edit address ajax
    $(document).on('click', '#getModal', function(e){
        e.preventDefault();
        $('.page-loader').show();
        var url = $(this).data('url');
        $('.message-modal').html(''); 
        $('#modal-loader').show();     
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
            $('.page-loader').hide();
           // console.log(data);  
            $('.message-modal').html('');    
            $('.message-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('.page-loader').hide();
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });
 </script>
@endsection