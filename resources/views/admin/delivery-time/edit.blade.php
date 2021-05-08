<div class="modal-header">
    <h4 class="modal-title">Edit Delivery Time #{{$time->id}}</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body">
    <div class="popupMessageContainer">
       <form action="{{url('/admin/delivery-time/update/'.$time->id)}}" method="post" id="timeUpdate">
          @csrf
          <div class="form-group row">
             <label for="" class="col-md-3">Start Time</label>
             <div class="col-md-9">
                <input type="time" class="form-control form-control-sm" name="start" value="{{date('H:i',strtotime($time->start))}}" required>
                </span>
             </div>
          </div>
          <div class="form-group row">
             <label for="" class="col-md-3">End Time</label>
             <div class="col-md-9">
                <input type="time" class="form-control form-control-sm" name="end" value="{{date('H:i',strtotime($time->end))}}" required>
                </span>
             </div>
          </div>
          <div class="form-group row">
             <label for="" class="col-md-3">Charge(₹)</label>
             <div class="col-md-9">
                <input type="number" class="form-control form-control-sm" name="charge" value="{{$time->charge}}" min="0" step="1" required>
                </span>
             </div>
          </div>
       </form>
    </div>
    <div class="modal-footer">
       <button type="submit" class="btn btn-sm btn-primary" form="timeUpdate">Update</button>
       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
    </div>
 </div>