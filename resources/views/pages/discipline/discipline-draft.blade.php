@extends('layouts.app')
@section('title')
Discipline
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Discipline</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-none border">
                <div class="card-header">
                    <x-tab-discipline :activeTab="request()->route()->getName()" />
                </div>
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">List Draft Discipline assessment</div>
                    </div>
                    <div class="btn-group btn-group-page-header ml-auto">
                        <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <btn id="btnCreate" class="dropdown-item" style="text-decoration: none">Create</btn>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('discipline.apply')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display basic-datatables table table-striped ">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="" id="checkboxAll"></th>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Employe</th>
                                        <th>Alpa</th>
                                        <th>Ijin</th>
                                        <th>Terlambat</th>
                                        <th>Achievement</th>
                                        <th>Keterangan</th>
                                        <th class="text-right">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <div id="button-group mb-2">
                                        <button class="btn btn-sm btn-success" name="apply" value="1" type="submit"><i class="fas fa-check"></i> Terapkan</button>
                                        <button class="btn btn-sm btn-danger" name="delete" value="1" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                    <!-- <button type="submit">SSS</button> -->
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td><input type="checkbox" name="check[]" value="{{$data->id}}" id="check-{{$data->id}}"></td>
                                        <td class="text-center">{{++$i}}</td>
                                        <td>{{getMonthNameIndonesian($data->bulan)}} </td>
                                        <td>{{$data->tahun}}</td>
                                        <td>{{$data->first_name}} {{$data->last_name}}</td>
                                        <td>{{$data->alpa}}</td>
                                        <td>{{$data->ijin}}</td>
                                        <td>{{$data->terlambat}}</td>
                                        <td>
                                            <?php
                                            if ($data->achievement > 2) {
                                                # code...
                                                echo "<span class='badge badge-success'>";
                                            } else {
                                                # code...
                                                echo "<span class='badge badge-danger'>";
                                            }

                                            ?>

                                            {{$data->achievement}}</span>
                                        </td>
                                        <td>
                                            @if($data->employe_count > 1)
                                            <span class='badge badge-warning'> Duplikasi Sebanyak {{$data->employe_count}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete-{{$data->id}}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <x-modal.delete :id="$data->id" :body="'Disipllin  ' . $data->first_name . ' bulan '. date('F Y', strtotime($data->date))   " url="{{route('discipline.delete', enkripRambo($data->id))}}" />
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {
        // $('#button-group').hide();

        // Ketika checkboxAll dicentang, ceklis semua checkbox dengan name=check
        $("#checkboxAll").change(function() {
            $("input[name='check[]']").prop('checked', $(this).prop('checked'));
        });

        // Ketika salah satu checkbox dengan name=check dicentang atau dicentang ulang
        $("input[name='check[]']").change(function() {
            // Periksa apakah semua checkbox dengan name=check tercentang
            var allChecked = ($("input[name='check[]']:checked").length === $("input[name='check[]']").length);

            // Terapkan status checked pada checkboxAll sesuai hasil pengecekan di atas
            $("#checkboxAll").prop('checked', allChecked);
        });

        // Saat tombol Terapkan atau Delete ditekan
        $("#button-group button").click(function() {
            // Dapatkan nilai atribut 'name' dan 'value' dari tombol yang ditekan
            var action = $(this).attr('name');
            var value = $(this).val();

            // Jika tombol yang ditekan adalah 'apply' atau 'delete'
            if (action === 'apply' || action === 'delete') {
                // Lakukan sesuatu sesuai dengan kebutuhan Anda
                // Misalnya, tampilkan pesan alert:
                alert("Tombol " + action + " ditekan dengan nilai " + value);
            }
        });
    })
</script>
@endpush