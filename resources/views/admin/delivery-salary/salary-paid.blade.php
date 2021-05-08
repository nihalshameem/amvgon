@extends('admin.layouts.master')

@section('title')
    Runner Salary List
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Paid Salaries</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-salaries">runner-salary list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/paid-salary">paid-salary list</a></p>
            </div>
          </div>
        </div>
        <form class="form-inline mt-3" method="POST" action="/admin/paid-salary/search" enctype="multipart/form-data">
          @csrf
          <label class="sr-only" for="inlineFormInputName2">Search</label>
          <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 " id="inlineFormInputName2" placeholder="Search..." name="paid_search" value="{{ $paid_search }}">
          <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-magnify"></i></button>
        </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                  <th>Sl.No</th>
                <th>Runner ID</th>
                <th>Order Count</th>
                <th>Distance</th>
                <th>Salary</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = $paid_salaries->perPage() * ($paid_salaries->currentPage() - 1) + 1; ?>
              @if (!$paid_salaries->isEmpty())
              @foreach ($paid_salaries as $item)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$item->delivery_id}}</td>
                <td>{{$item->order_count}}</td>
                <td>{{$item->distance}} km</td>
                <td>₹ {{$item->total_amount}}</td>
                <td>{{$item->start_date}}</td>
                <td>{{$item->created_at->format('Y-m-d')}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-inverse-dark" data-toggle="modal" data-target="#DetailModal{{$item->id}}">
                        <i class="mdi mdi-eye"></i>
                      </button>
                </td>
              </tr>
          @endforeach
              @else
                  <td colspan="10">No data</td>
              @endif
            </tbody>
          </table>
          @if ($paid_salaries->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $paid_salaries->url($paid_salaries->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($paid_salaries->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $paid_salaries->lastPage(); $i++)
            <a href="{{ $paid_salaries->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($paid_salaries->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $paid_salaries->url($paid_salaries->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($paid_salaries->currentPage() == $paid_salaries->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Paid salary details modal --}}
  @foreach ($paid_salaries as $item)
  <div class="modal fade" id="DetailModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Salary Details #{{$item->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-sm table-striped">
              <tr>
                  <th>Order Count</th>
                  <td>:</td>
                  <td>{{$item->order_count}}</td>
              </tr>
              <tr>
                  <th>Distance</th>
                  <td>:</td>
                  <td>{{$item->distance}}</td>
              </tr>
              <tr>
                  <th>Runner Charges</th>
                  <td>:</td>
                  <td>{{$item->delivery_charge}}</td>
              </tr>
              <tr>
                  <th>Weekly Incentive</th>
                  <td>:</td>
                  <td>{{$item->weekly_incentive}}</td>
              </tr>
              <tr>
                  <th>Order Incentive</th>
                  <td>:</td>
                  <td>{{$item->order_incentive}}</td>
              </tr>
              <tr>
                  <th>Amount Incentive</th>
                  <td>:</td>
                  <td>{{$item->amount_incentive}}</td>
              </tr>
              <tr>
                  <th>Bonus</th>
                  <td>:</td>
                  <td>{{$item->bonus}}</td>
              </tr>
              <tr>
                  <th>Total Amount</th>
                  <td>:</td>
                  <td>{{$item->total_amount}}</td>
              </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection