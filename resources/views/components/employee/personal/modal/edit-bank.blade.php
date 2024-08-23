<div class="modal fade" id="modal-edit-bank-{{$acc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('bank.account.update')}}" method="POST">
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="account" id="account" value="{{$acc->id}}" hidden>
               <div class="row mt-3">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Bank</label>
                        <select class="form-control" id="bank" name="bank">
                           @foreach ($banks as $bank)
                              <option {{$acc->bank_id == $bank->id ? 'selected' : ''}} value="{{$bank->id}}">{{$bank->name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Expired Date</label>
                        <input type="date" class="form-control" value="{{$acc->expired_date}}" name="expired_date" id="expired_date">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Rekening Number</label>
                        <input type="text" class="form-control" value="{{$acc->account_no}}" name="account_no" id="account_no" placeholder="Fill Account Number">
                     </div>
                  </div>
                  
                  
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               @if (auth()->user()->hasRole('Administrator|HRD|HRD-Staff|HRD-Recruitment'))
               <button type="submit" class="btn btn-dark ">Update</button>
               @endif
            </div>
         </form>
      </div>
   </div>
</div>