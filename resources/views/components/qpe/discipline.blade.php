<!-- resources/views/components/discipline.blade.php -->
<div class="card shadow-none border">
    <div class="card-header d-flex bg-primary">
        <div class="d-flex  align-items-center">
            <small class=" text-white">Discipline</small>
        </div>
    </div>
    <div class="card-body">
        <form>
            @csrf
            <div class="form-group form-group-default">
                <label>Alpa</label>
                <label for="" class="float-right">{{ $pd ? $pd->alpa : 0 }}</label>
            </div>
            <div class="form-group form-group-default">
                <label>Ijin</label>
                <label for="" class="float-right">{{ $pd ? $pd->ijin : 0 }}</label>
            </div>
            <div class="form-group form-group-default">
                <label>Terlambat</label>
                <label for="" class="float-right">{{ $pd ? $pd->terlambat : 0 }}</label>
            </div>
            <div class="form-group form-group-default bg-success">
                <label>Value</label>
                <label for="" class="float-right">{{ $pd ? $pd->achievement : 0 }}</label>
            </div>
            <div class="form-group form-group-default ">
                <label>Bobot</label>
                <label for="" class="float-right">{{ $pd ? $pd->weight : 0 }}</label>
            </div>
            <div class="form-group form-group-default bg-success">
                <label> <b>Achievement</b></label>
                <label for="" class="float-right">
                    <h3>{{ $pd ? $pd->contribute_to_pe : 0 }}</h3>
                </label>
            </div>
        </form>
    </div>
</div>