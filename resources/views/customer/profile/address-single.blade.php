<div class="modal-header">
    <h4 class="modal-title">Edit Address #{{$address->id}}</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body">
    <div class="popupMessageContainer">
       <form action="{{url('/customer/address/update/'.$address->id)}}" method="post" id="addressUpdate">
          @csrf
          <div class="form-group row">
             <label for="" class="col-md-3">Door no. & Street</label>
             <div class="col-md-9">
                <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" value="{{$address->door_no}}" required>
                @if ($errors->has('door_no'))
                <span class="invalid feedback"role="alert">
                {{ $errors->first('door_no') }}.
                </span>
                @endif
             </div>
          </div>
          <div class="form-group row">
             <label for="" class="col-md-3">Village</label>
             <div class="col-md-9">
                <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" value="{{$address->village}}" required>
                @if ($errors->has('village'))
                <span class="invalid feedback"role="alert">
                {{ $errors->first('village') }}.
                </span>
                @endif
             </div>
          </div>
          <div class="form-group row">
             <label for="" class="col-md-3">District</label>
             <div class="col-md-9">
                <select name="district" class="form-control form-control-sm">
                @foreach ($districts as $district)
                <option value="{{$district->id}}" {{$address->district == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                @endforeach
                </select>
                @if ($errors->has('district'))
                <span class="invalid feedback"role="alert">
                {{ $errors->first('district') }}.
                </span>
                @endif
             </div>
          </div>
          <div class="form-group row">
             <label for="" class="col-md-3">Pincode</label>
             <div class="col-md-9">
                <input type="number" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" value="{{$address->pincode}}" required>
                @if ($errors->has('pincode'))
                <span class="invalid feedback"role="alert">
                {{ $errors->first('pincode') }}.
                </span>
                @endif
             </div>
          </div>
       </form>
    </div>
    <div class="modal-footer">
       <button type="submit" class="btn btn-sm btn-cus" form="addressUpdate">Update</button>
       <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
    </div>
 </div>