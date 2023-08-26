@if(count($qListByDeptSec) > 0)::
<div class="p-2 px-3 mt-1">
    <div class="row gap-2 d-flex justify-content-around">
        @foreach($qListByDeptSec as $key=>$per_soalan)::
        {!! $per_soalan = (object) $per_soalan !!}
        {!! $soalanOrderIndex = $key; !!}
        {!! $soalanOrderIndex = ($maskOrderId == 'true' ? ++$soalanOrderIndex : $per_soalan->soalanOrderId); !!} 
        <div class="col-lg-3  p-1 shadow border border-dark border-1 rounded d-flex justify-content-between" data-bs-toggle="tooltip" title="<div class='text-start'>{{$per_soalan->soalanTitle}}</div>" data-bs-html="true" data-bs-placement="bottom">

            <div class="d-flex flex-row gap-2  w-100 position-relative">
                @if(strlen($per_soalan->soalanOrderId) >=3)::
                <div class="badge badge-white bg-warning hover-number-badge text-dark position-absolute p-1 d-flex align-items-center justify-content-center border border-dark border-3" style="margin-top: -15px;font-size:1rem;;width:40px!important;border-radius:15%!important;height:25px!important;">{{$soalanOrderIndex}}
                </div>
                <div style="margin-top: -15px;left:40px;font-size:1.4rem;width:25px!important;height:25px!important;" class="position-absolute">
                    @if($per_soalan->markDirection == 'asc')::
                    <span id="direction_{{$per_soalan->idSoalan}}" class="fas fa-arrow-right fw-bold  text-secondary onhover " onclick="swapDirectionTo('{{$per_soalan->idSoalan}}','desc')"></span>
                    @else
                    <span id="direction_{{$per_soalan->idSoalan}}" class="fas fa-arrow-left fw-bold  text-danger onhover " onclick="swapDirectionTo('{{$per_soalan->idSoalan}}','asc')"></span>
                    @endif
                </div>
                @else
                <div class="badge badge-white bg-warning hover-number-badge text-dark position-absolute p-1 d-flex align-items-center justify-content-center border border-dark border-3" style="margin-top: -15px;font-size:1rem;border-radius:50%;width:28px!important;height:28px!important;">{{$soalanOrderIndex}}

                </div>
                <div style="margin-top: -15px;left:26px;font-size:1.4rem;width:25px!important;height:25px!important;" class="position-absolute">
                    @if($per_soalan->markDirection == 'asc')::
                    <span id="direction_{{$per_soalan->idSoalan}}" class="fas fa-arrow-right fw-bold  text-secondary onhover" onclick="swapDirectionTo('{{$per_soalan->idSoalan}}','desc')"></span>
                    @else
                    <span id="direction_{{$per_soalan->idSoalan}}" class="fas fa-arrow-left fw-bold  text-danger onhover " onclick="swapDirectionTo('{{$per_soalan->idSoalan}}','asc')"></span>
                    @endif
                </div>

                @endif
                <select class="form-control w-75" onchange="changeDomainSoalan('{{$per_soalan->idSoalan}}',this)">
                    <option value="" selected disabled hidden>Domain</option>
                    @foreach($domain_list as $per_domain)::
                    @object($per_domain):;
                    @php
                    $option_data = !empty($per_domain->kod_domain) ? $per_domain->kod_domain : $per_domain->domain;
                    @endphp
                    <option value="{{ $per_domain->idDomain }}" {{($per_soalan->idDomain == $per_domain->idDomain) ? 'selected' : '' }}>{{ $option_data }}</option>

                    @endforeach
                </select>
                <div class="d-flex justify-content-center align-items-center ">
                    <span class="fas fa-cog fw-bold shadow text-dark hover-secondary" onclick="kemaskiniSoalan('{{$idUjian}}','{{$per_soalan->idSoalan}}','{{$per_soalan->soalanOrderId}}')"></span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<script>
    function kemaskiniSoalan(idUjian, idSoalan, soalanOrderId) {
        let url = '{{base_url()}}pentadbir/ExamManager/kemaskiniSoalan/' + idUjian + '/' + idSoalan;
        let title = 'Soalan ' + soalanOrderId;
        smartBox(url, title, 'lg');
    }

    function changeDomainSoalan(idSoalan, element) {
        let domain = $(element).val();
        fetch('{{base_url()}}pentadbir/ExamManager/kemaskiniDomainSoalan/' + idSoalan + '/' + domain).then(res => res.text()).then(res => {
            alertData('Data telah dikemaskini.');
        })
    }

    function swapDirectionTo(idSoalan, toDirection) {
        fetch('{{base_url()}}pentadbir/ExamManager/swapDirectionSoalan/' + idSoalan + '/' + toDirection).then(res => res.text()).then(res => {
            let oldDirection = '';
            let newDirection = '';
            let oldDirectionCss = '';
            let newDirectionCss = '';

            if (toDirection == 'asc') {
                oldDirectionCss = 'fa-arrow-left text-danger';
                newDirectionCss = 'fa-arrow-right text-secondary';
                oldDirection = 'desc';
                newDirection = 'asc';
            } else {
                oldDirectionCss = 'fa-arrow-right text-secondary';
                newDirectionCss = 'fa-arrow-left text-danger';
                oldDirection = 'asc';
                newDirection = 'desc';
            }
            $("#direction_" + idSoalan).removeClass(oldDirectionCss);
            $("#direction_" + idSoalan).addClass(newDirectionCss);
            $("#direction_" + idSoalan).attr('onclick', 'swapDirectionTo(\'' + idSoalan + '\',\'' + oldDirection + '\')');
            //
            $("#prompt_direction_" + idSoalan).removeClass(oldDirectionCss);
            $("#prompt_direction_" + idSoalan).addClass(newDirectionCss);
            $("#prompt_direction_" + idSoalan).attr('onclick', 'swapDirectionTo(\'' + idSoalan + '\',\'' + oldDirection + '\')');
            // detect if kemaskini popup detected. if detected then refresh the mark order
            let qPopupExist = $("#markDirectionKemaskini").val() != '';
            if(qPopupExist){
                $("#markDirectionKemaskini").val(newDirection);
                changeOptionGroup();
            }
            alertData('<span class=" fas fa-check text-success"></span>&nbsp;Urutan Arah Markah telah diubah .');
        })
    }
</script>