<!-- resources/views/components/summary-appraisal.blade.php -->
<div class="card shadow-none border">
    <div class="card-header bg-primary">
        <div class="card-title text-white text-center">RANGKUMAN HASIL PENILAIAN AKHIR </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="displays table table-striped ">
                <thead>
                    <tr>
                        <th rowspan="2" colspan="2" class="text-white text-center">Indikator</th>
                        <th rowspan="2" class="text-white text-center">Total Indikator</th>
                        <th rowspan="2" class="text-white text-center">Bobot</th>
                        <th rowspan="2" class="text-white text-center"> Nilai</th>
                        <!-- <th rowspan="2" class="text-white text-center"> Nilai 4</th> -->
                        <th rowspan="2" class="text-white text-center"> (Bobot/100)xNilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td class="text-center">DISIPLIN</td>
                        <td class="text-center">3</td>
                        <td class="text-center">15</td>
                        <td class="text-center"><b>{{round(($pdAchievement/15)*100)}}</b></td>
                        <!-- <td class="">{{round((4.00/4)* 4 , 2)}}</td> -->
                        <td class="text-center text-bold"><b>{{ $pdAchievement }}</b></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="text-center">KPI</td>
                        <td class="text-center">{{$datas->count()}}</td>
                        <td class="text-center">{{$kpa->weight}}</td>
                        <td class="text-center text-bold"><b>{{$kpa->achievement }}</b></td>
                        <!-- <td class="  text-bold"><b>{{ ($kpa->achievement/100) * 4 }}</b></td> -->
                        <td class="text-center text-bold"><b>{{$kpa->contribute_to_pe}}</b></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="text-center">BEHAVIOR</td>
                        @if(isset($pba))
                        <td class="text-center">{{$behaviors->count()}}</td>
                        <td class="text-center">{{$pba->weight}}</td>
                        <td class="text-center text-bold"><b>{{round(($pba->achievement / $pba->weight) * 100)}}</b></td>
                        <td class="text-center text-bold"><b>{{$pba->contribute_to_pe}}</b></td>
                        @else
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center text-bold"><b>-</b></td>
                        <td class="text-center text-bold"><b>-</b></td>
                        @endif
                    </tr>
                    <tr>
                        <td>4</td>
                        <td colspan="4" class="text-center">PENGURANG (SP)</td>
                        <td class="text-center text-bold"><b>({{$pe->pengurang}})</b></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">
                            <h3><b> Total Nilai </b></h3>
                        </th>
                        <th class="text-center"><span id="totalAcvBehavior" name="totalAcvBehavior">
                                <h3>
                                    <b> {{$pe->achievement}} </b>
                                </h3>
                            </span></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive mt-3">
            <table class="displays table table-striped ">
                <tr>
                    <td colspan="2">Note : </td>
                    <td colspan="2">Pengurang</td>
                    <td colspan="4">Bobot Pencapaian</td>
                </tr>
                <tbody>
                    <tr>
                        <td>MGR</td>
                        <td>: Manager</td>
                        <td>SP</td>
                        <td>0</td>
                        <td colspan="2">100 - 91</td>
                        <td colspan="2">Memuaskan</td>
                    </tr>
                    <tr>
                        <td>SPV</td>
                        <td>: Supervisor</td>
                        <td></td>
                        <td></td>
                        <td colspan="2">90 - 76</td>
                        <td colspan="2">Baik</td>
                    </tr>
                    <tr>
                        <td>KDR</td>
                        <td>: Koordinator</td>
                        <td></td>
                        <td></td>
                        <td colspan="2">75 - 61</td>
                        <td colspan="2">Cukup</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>: Staff</td>
                        <td></td>
                        <td></td>
                        <td colspan="2">60 - 51</td>
                        <td colspan="2">Kurang</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td colspan="2">50 - 0</td>
                        <td colspan="2">Sangat Kurang</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>