@extends('layouts.app')
@section('title')
KPA
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">KPA</li>
        </ol>
    </nav>
    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Summary KPI</div>
                    </div>

                </div>
                <form action="{{route('kpa.summary.detail')}}" method="GET">
                    @csrf
                    <div class="card-body">

                        <div class="form-group form-group-default">
                            <label>Employee</label>
                            <select class="form-control" name="employe_id" id="employe_id" required>
                                <option value="">--- Choose Employe ---</option>
                                @foreach ($employes as $employe)
                                <option value="{{$employe->id}}" {{ $karyawan->id == $employe->id ? 'selected' : '' }}>{{$employe->biodata->first_name}} {{$employe->biodata->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Semester</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control form-select date" name="semester">
                                        <option value="I" {{ $semester == 'I' ? 'selected' : '' }}>I</option>
                                        <option value="II" {{ $semester == 'II' ? 'selected' : '' }}>II</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control form-select date" id="tahun" name="tahun">
                                        <option value="{{ date('Y') }}" {{ $tahun == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                                        <option value="{{ date('Y') -1 }}" {{ $tahun == date('Y') -1 ? 'selected' : '' }}>{{ date('Y') -1 }}</option>
                                        <!-- Tambahkan opsi tahun sesuai kebutuhan -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-check"></i> Cek</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="badge badge-danger">
                        Chart
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-light shadow-none border">
                <div class="card-header">
                    <div class="card-list">
                        <div class="item-list">
                            <div class="avatar avatar-xl avatar-online">

                                <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">
                                    <h3>{{$karyawan->biodata->first_name}} {{$karyawan->biodata->last_name}}</h3>
                                </div>
                                <div class="status">{{$karyawan->contract->designation->name ?? ''}} {{$karyawan->contract->department->name ?? ''}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link  text-left pl-3" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">
                            <i class="fas fa-address-book mr-1"></i>
                            Priode - <b> Semester {{$semester}} {{$tahun}} </b>
                        </a>
                        <a class="nav-link  text-left pl-3" id="v-pills-contract-tab" data-toggle="pill" href="#v-pills-contract" role="tab" aria-controls="v-pills-contract" aria-selected="false">
                            <i class="fas fa-star mr-1"></i>

                            Achievement <b> {{$rating}} </b>
                        </a>

                        <!-- <a class="nav-link text-left pl-3" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="false">
                            <i class="fas fa-user mr-1"></i>
                            Personal
                        </a>
                        <a class="nav-link  text-left pl-3" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="false">
                            <i class="fas fa-credit-card mr-1"></i>
                            Account
                        </a>

                        <a class="nav-link text-left pl-3" id="v-pills-document-tab" data-toggle="pill" href="#v-pills-document" role="tab" aria-controls="v-pills-document" aria-selected="false">
                            <i class="fas fa-file mr-1"></i>
                            Document
                        </a> -->

                    </div>

                </div>
                <div class="card-footer">

                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste unde beatae inventore.</small>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-none border">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('kpa')}}">Monthly</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Summary</a>
                        </li>
                    </ul>
                </div>
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">List Performance Apprasial <a class="text-primary">{{$karyawan->biodata->fullName()}}</a></div>
                    </div>
                    <div class="btn-group btn-group-page-header ml-auto">
                        <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <!-- <div class="dropdown-divider"></div> -->
                            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display basic-datatables table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Achievement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kpas as $kpa)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td> {{$kpa->employe->biodata->fullName()}} </td>
                                    <td>{{date('F Y', strtotime($kpa->date))  }}</td>
                                    <td><span class="badge badge-primary badge-lg"><b>{{$kpa->achievement}}</b></span></td>
                                </tr>
                                <x-modal.submit :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.submit', enkripRambo($kpa->id))}}" />
                                <x-modal.delete :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.delete', enkripRambo($kpa->id))}}" />
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        let semester = "{{$semester}}";
        // ambil dari laravel
        var achievementData = @json($achievementData);

        // konversi object ke array
        var dataArray = Object.values(achievementData);


        if (semester == 'I') {
            console.log('Test');

            var bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun"];

        } else {

            var bulan = ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        }

        var barChart = document.getElementById('barChart').getContext('2d');

        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: "Achievement",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: dataArray,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
            }
        });

    })
</script>
@endpush