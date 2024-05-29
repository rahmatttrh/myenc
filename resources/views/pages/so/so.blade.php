@extends('layouts.app')
@section('title')
Struktur Organisasi
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
        </ol>
    </nav>

</div>
<div class="col-md-12">
    <div class="card shadow-none border">
        <div class="card-header d-flex">
            <div class="d-flex  align-items-center">
                <div class="card-title">Struktur Organisasi</div>
            </div>
        </div>
        <div class="card-body">
            <div id="tree"></div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@push('js_footer')
<script>
    //JavaScript
    var chart = new OrgChart(document.getElementById("tree"), {
        // Set the initial zoom level (e.g., 0.8 for 80% zoom)
        scaleInitial: 0.8,

        template: "ula",
        mouseScrool: OrgChart.none,
        nodeBinding: {
            field_0: "Employee Name",
            field_1: "Title"
        },
        editForm: {
            photoBinding: 'Photo'
        },
        nodeMenu: {
            details: {
                text: "Details"
            },
            edit: {
                text: "Edit"
            },
            add: {
                text: "Add"
            },
            remove: {
                text: "Remove"
            }
        }
    });

    // chart.on('init', function(sender) {
    //     sender.editUI.show(1);
    // });

    chart.load([{
            id: 0,
            "Employee Name": "M.Isya Anwar",
            Title: "President Director",
            Photo: "",
            collapsed: true // Menyembunyikan simpul anak CEO
        }, {
            id: 1,
            pid: 0,
            "Employee Name": "Indra Anwar",
            Title: "Director",
            Photo: "",
            collapsed: true // Menyembunyikan simpul anak CEO
        },
        {
            id: 10,
            pid: 0,
            "Employee Name": "Wildan Anwar",
            Title: "Director",
            Photo: ""
        },
        {
            id: 9,
            pid: 1,
            tags: ["assistant"],
            "Employee Name": "Yuliana Halim",
            Title: "Secretary",
            Photo: ""
        },
        {
            id: 2,
            pid: 1,
            "Employee Name": "Andi K N",
            Title: "GM Finance & Accounting",
            Photo: ""
        },
        {
            id: 3,
            pid: 1,
            "Employee Name": "Sarudin Batubara",
            Title: "HRD Manager",
            Photo: "",
            className: "custom-node"
        },
        {
            id: 4,
            pid: 1,
            "Employee Name": "Dudy Iskandar",
            Title: "QHSE Manager",
            Photo: ""
        },
        {
            id: 5,
            pid: 1,
            "Employee Name": "Abdul Rozak",
            Title: "IT Manager",
            Photo: ""
        },
        {
            id: 6,
            pid: 1,
            "Employee Name": "Hartono Purwanto",
            Title: "Shorebase Manager",
            Photo: ""
        },
        {
            id: 7,
            pid: 2,
            "Employee Name": "Andrianto",
            Title: "Finance Manager",
            Photo: ""
        },
        {
            id: 8,
            pid: 2,
            "Employee Name": "Adriansyah",
            Title: "Accounting & Tax Manager",
            Photo: ""
        },
    ]);
</script>
@endpush