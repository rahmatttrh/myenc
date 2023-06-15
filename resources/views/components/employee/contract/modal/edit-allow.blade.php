<div class="modal fade" id="modal-edit-allow-{{$allow->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.allowances.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="allowance" id="allowance" value="{{$allow->id}}" hidden>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Allowances Option</label>
                        <select class="form-control" id="option" name="option">
                           <option {{$allow->option == 'Perjalanan Dinas' ? 'selected' : ''}} value="Perjalanan Dinas">Perjalanan Dinas</option>
                           <option {{$allow->option == 'Hari Raya' ? 'selected' : ''}} value="Hari Raya">Hari Raya</option>
                           <option {{$allow->option == 'Kompensasi' ? 'selected' : ''}} value="Kompensasi">Kompensasi</option>
                           <option {{$allow->option == 'Menikah' ? 'selected' : ''}} value="Menikah">Menikah</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Type</label>
                        <select class="form-control" id="amount_option" name="amount_option">
                           <option {{$allow->amount_option == 'IDR' ? 'selected' : ''}} value="IDR">IDR</option>
                           <option {{$allow->amount_option == 'USD' ? 'selected' : ''}} value="USD">USD</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$allow->title}}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Ammount</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{$allow->amount}}" >
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>