@extends('admin.layouts.master')

@section('title')
    Feedback
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>feedback List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/feedback">feedbac list</a></p>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Name</th>
                <th>email</th>
                <th>message</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $feedbacks->perPage() * ($feedbacks->currentPage() - 1) + 1; ?>
              @foreach ($feedbacks as $item)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{\Str::limit($item->message, 20)}}</td>
                    <td>
                      <a href="/admin/feedback/detail/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-eye"></i></a>
                  </td>
                  
                  </tr>
              @endforeach
              @if ($feedbacks->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($feedbacks->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $feedbacks->url($feedbacks->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($feedbacks->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $feedbacks->lastPage(); $i++)
            <a href="{{ $feedbacks->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($feedbacks->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $feedbacks->url($feedbacks->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($feedbacks->currentPage() == $feedbacks->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection