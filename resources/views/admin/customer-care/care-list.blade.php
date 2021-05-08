@extends('admin.layouts.master')

@section('title')
    Customer care
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Customer care List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/customer-cares">customer care list</a></p>
            </div>
          </div>
          <form class="form-inline mt-3" method="POST" action="/admin/customer-care/add" enctype="multipart/form-data">
              @csrf
              <label class="sr-only" for="inlineFormInputName">Name</label>
              <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 @error('name') is-invalid @enderror" id="inlineFormInputName" placeholder="Name" name="name" value="{{ old('name') }}">
              <label class="sr-only" for="inlineFormInputPhone">Phone</label>
              <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 @error('phone') is-invalid @enderror" id="inlineFormInputPhone" placeholder="Phone" name="phone" value="{{ old('phone') }}">
              <label class="sr-only" for="inlineFormInputUsecase">Usecase</label>
              <select class="form-control form-control-sm mb-2 mr-sm-2 @error('usecase') is-invalid @enderror" id="inlineFormInputUsecase" placeholder="Usecase" name="usecase">
                <option value="customer">Customer</option>
                <option value="delivery-boy">DeliveryBoy</option>
              </select>
              <button type="submit" class="btn btn-sm btn-primary mb-2">Add</button>
            </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Usecase</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $customercare->perPage() * ($customercare->currentPage() - 1) + 1; ?>
              @foreach ($customercare as $care)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$care->name}}</td>
                    <td>{{$care->phone}}</td>
                    <td>{{$care->usecase}}</td>
                    <td>
                      <a href="/admin/customer-care/edit/{{$care->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil"></i></a>
                  </td>
                  
                  </tr>
              @endforeach
              @if ($customercare->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($customercare->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $customercare->url($customercare->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($customercare->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $customercare->lastPage(); $i++)
            <a href="{{ $customercare->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($customercare->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $customercare->url($customercare->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($customercare->currentPage() == $customercare->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection