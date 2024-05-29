@extends('layouts.app')
@section('title')
Department
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Komponen - Perfomance Evaluation</li>
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
        template: "ula",
        mouseScrool: OrgChart.none,
        nodeBinding: {
            field_0: "Employee Name",
            field_1: "Title",
            img_0: "Photo"
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
            id: 1,
            "Employee Name": "Indra Anwar",
            Title: "Director",
            Photo: "",
            collapsed: true // Menyembunyikan simpul anak CEO
        },
        {
            id: 2,
            pid: 1,
            tags: ["assistant"],
            "Employee Name": "Andi K N",
            Title: "GM Finance & Accounting",
            Photo: ""
        },
        {
            id: 3,
            pid: 1,
            "Employee Name": "Sarudin Batubara",
            Title: "HRD Manager",
            Photo: ""
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
        {
            id: 9,
            pid: 3,
            "Employee Name": "Hafiz Ali",
            Title: "HR Supervisor",
            Photo: ""
        },
        {
            id: 10,
            pid: 3,
            tags: ["assistant"],
            "Employee Name": "Vacant",
            Title: "HRD Asst.Manager",
            Photo: ""
        },
        {
            id: 11,
            pid: 9,
            "Employee Name": "Vacant",
            Title: "HR Team Leader",
            Photo: ""
        },
        {
            id: 12,
            pid: 4,
            tags: ["assistant"],
            "Employee Name": "Eka Cempaka",
            Title: "QHSE Asst. Manager",
            Photo: ""
        },
        {
            id: 13,
            pid: 4,
            "Employee Name": "Vacant",
            Title: "QHSE Supervisor",
            Photo: ""
        },
        {
            id: 14,
            pid: 13,
            "Employee Name": "Didi Turmudi",
            Title: "QHSE Team Leader",
            Photo: ""
        },
        {
            id: 15,
            pid: 5,
            tags: ["assistant"],
            "Employee Name": " ",
            Title: " ",
            Photo: ""
        },
        {
            id: 16,
            pid: 5,
            "Employee Name": "Nurdiansah",
            Title: "IT Supervisor",
            Photo: ""
        },
        {
            id: 17,
            pid: 16,
            "Employee Name": "Vacant",
            Title: "IT Team Leader",
            Photo: ""
        },
        {
            id: 18,
            pid: 6,
            tags: ["assistant"],
            "Employee Name": "M. Sugeng",
            Title: "Asst. Operation",
            Photo: ""
        },
        {
            id: 19,
            pid: 6,
            "Employee Name": "Santosa",
            Title: "GS Supervisor",
            Photo: ""
        },
        {
            id: 20,
            pid: 6,
            "Employee Name": "Fajar Respati Aji",
            Title: "Mechanic Supervisor",
            Photo: ""
        },
        {
            id: 21,
            pid: 6,
            "Employee Name": "Eman",
            Title: "Operation SPV KJ1-2",
            Photo: ""
        },
        {
            id: 22,
            pid: 6,
            "Employee Name": "Indra Setiawan",
            Title: "Operation SPV KJ3-4",
            Photo: ""
        },
        {
            id: 23,
            pid: 6,
            "Employee Name": "",
            Title: "Operation SPV KJ5",
            Photo: ""
        },
        {
            id: 24,
            pid: 6,
            "Employee Name": "Reza Adji R.",
            Title: "Civil Supervisor",
            Photo: ""
        }
    ]);
</script>
@endpush