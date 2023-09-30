@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ url('') }}/assets/vendor/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="{{ url('') }}/assets/vendor/toastify-js/src/toastify.css">
@endpush

@section('content')
@include('ketua.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{$title}}</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                Tambah Data
                            </button>

                            <!-- Add -->
                            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="">Tambah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="forminput">
                                                @foreach ($form as $input)
                                                @if ($input['type'] == 'select')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ucwords($input['label'] ?? $input['name'])}}</label>
                                                    <select name="{{$input['name']}}" class="form-control" id="{{$input['name']}}" required>
                                                        @foreach ($input['option'] as $option)
                                                            <option value="{{$option['value']}}">{{ucwords($option['label'] ?? $option['value'])}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @elseif ($input['type'] == 'textarea')
                                                <div class="mb-3">
                                                    <label class="form-label">{{ucwords($input['label'] ?? $input['name'])}}</label>
                                                    <textarea type="{{$input['type']}}" class="form-control" id="{{$input['name']}}" name="{{$input['name']}}" required></textarea>
                                                </div>
                                                @else
                                                <div class="mb-3">
                                                    <label class="form-label">{{ucwords($input['label'] ?? $input['name'])}}</label>
                                                    <input type="{{$input['type']}}" class="form-control" id="{{$input['name']}}" name="{{$input['name']}}" value="{{$input['default'] ?? ''}}" required>
                                                </div>
                                                @endif

                                                @endforeach


                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit -->
                            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="">Ubah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <small>*ceklis data yang ingin diubah</small>
                                            <form id="formupdate">
                                                <input type="hidden" id="editid" value="">
                                                @foreach ($form as $input)
                                                @if ($input['type'] == 'select')
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <input type="checkbox" id="chkd{{$input['name']}}" onclick='checkupdate("{{$input['name']}}")'>
                                                        {{ucwords($input['label'] ?? $input['name'])}}
                                                    </label>
                                                    <select name="{{$input['name']}}" class="form-control" id="edit{{$input['name']}}" disabled>
                                                        @foreach ($input['option'] as $option)
                                                            <option value="{{$option['value']}}">{{ucwords($option['label'] ?? $option['value'])}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @elseif ($input['type'] == 'textarea')
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <input type="checkbox" id="chkd{{$input['name']}}" onclick='checkupdate("{{$input['name']}}")'>
                                                        {{ucwords($input['label'] ?? $input['name'])}}
                                                    </label>
                                                    <textarea type="{{$input['type']}}" class="form-control" id="edit{{$input['name']}}" name="{{$input['name']}}" disabled></textarea>
                                                </div>
                                                @else
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        <input type="checkbox" id="chkd{{$input['name']}}" onclick='checkupdate("{{$input['name']}}")'>
                                                        {{ucwords($input['label'] ?? $input['name'])}}
                                                    </label>
                                                    <input type="{{$input['type']}}" class="form-control" id="edit{{$input['name']}}" name="{{$input['name']}}" value="{{$input['default'] ?? ''}}" disabled>
                                                </div>
                                                @endif

                                                @endforeach

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <label>Show <select name="entry" id="entry" class="form-select form-select-sm" onchange="paginate(this.value)">
                                    <option value="15" selected>15</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                  </select> entries </label>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>
                                    <div class="row">
                                        <div class="col-auto">
                                            Search: <select name="filterby" id="filterby" class="form-select form-select-sm" >
                                                @foreach ($tables as $table)
                                                    @if ($table['rowdata'] != 'action')
                                                        <option value="{{$table['rowdata']}}">{{$table['head']}}</option>
                                                    @endif
                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="col-auto">
                                            <br><input type="search" class="form-control form-control-sm" id="search" onkeyup="search(this.value)">
                                        </div>
                                    </div>

                                </label>
                            </div>
                        </div>

                        <div id="load_table">
                            <h1 class="text-center">
                                <i class="fa-solid fa-circle-notch fa-spin"></i>
                            </h1>
                        </div>

                        <div id="tabelnya">
                            <div class="row dt-row">
                                <div class="col-sm-12">
                                    <div id="table"></div>
                                </div>
                            </div>

                            <div id="halaman"></div>
                    </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection

@push('script')
<script src="{{ url('') }}/assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ url('') }}/assets/vendor/toastify-js/src/toastify.js"></script>
<script>
    function paginate(value) {
        var search = $('#search').val();
        var filterby = $('#filterby').val();
        loadtable("{{url('')}}/api/v1/{{$endpoint}}?filter["+filterby+"]="+search+"&paginate="+value);
    }

    function search(value) {
        var entry = $('#entry').val();
        var filterby = $('#filterby').val();
        loadtable("{{url('')}}/api/v1/{{$endpoint}}?filter["+filterby+"]="+value+"&paginate="+entry);
    }

    function loadtable(urlendpoint) {
            $('#load_table').show();
            $('#tabelnya').hide();
            setTimeout(() => {
                $.ajax({
                    type: "GET",
                    url: urlendpoint,
                    dataType: "json",
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
                    },
                }).done(function(data) {
                    $('#load_table').hide();
                    $('#tabelnya').show();
                    $('#table').html(`<table id="table" class="table table-striped" style="width:100%">
                                <thead>
                                  <tr>
                                    @foreach ($tables as $table)
                                        <th>{{$table['head']}}</th>
                                    @endforeach
                                  </tr>
                                </thead>
                                <tbody id="isitable">
                                </tbody>

                        </table>`);

                    var isitable = '';
                    data.data.forEach(row => {
                        isitable += `<tr>
                    @foreach ($tables as $table)
                        <td>${row.{{$table['rowdata']}}}</td>
                    @endforeach
			    </tr>`;
                    });


                    $('#isitable').html(isitable);

                    $('#halaman').html(`<div class="row">
	  <div class="col-sm-12 col-md-5">
		<div id="show_entry">Showing ${data.meta.from} to ${data.meta.to} of ${data.meta.total} entries</div>
	  </div>
	  <div class="col-sm-12 col-md-7">
        <ul class="pagination" id="paginate">
        </ul>
	  </div>
	</div>`);

                var paginate = '';
                data.meta.links.forEach(link => {
                    if (link.url != null) {
                        paginate += `<li class="paginate_button page-item ${link.active == true ? 'active' : ''}">
			  <a href="#" aria-controls="example" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link" ${link.active == false ? 'onclick=\'loadtable("'+link.url+'")\'' : ''}>${link.label}</a>
			</li>`;
                    }
                });

                $('#paginate').html(paginate);

                }).fail(function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == '401') {
                    Toastify({
                        text: "Session Telah Berakhir, Silahkan Login ulang",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()

                    localStorage.clear();
                    setTimeout(() => {
                        window.location = "{{url('')}}"
                    }, 300);
                } else {
                    var msg = jqXHR.responseJSON.message;
                    Toastify({
                        text: msg,
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()
                }
                })
            }, 500);
        }
        loadtable("{{url('')}}/api/v1/{{$endpoint}}");

        function editdata(value) {
            @foreach ($form as $input)
            $('#edit{{$input['name']}}').val('');
            @endforeach
            setTimeout(() => {
                $.ajax({
                    type: "GET",
                    url: "{{url('')}}/api/v1/{{$endpoint}}/"+value,
                    dataType: "json",
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
                    },
                }).done(function(data) {
                    $('#editid').val(value);
                    @foreach ($form as $input)
                    $('#edit{{$input['name']}}').val(data.data.{{$input['row'] ?? $input['name']}});
                    @endforeach
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == '401') {
                    Toastify({
                        text: "Session Telah Berakhir, Silahkan Login ulang",
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()

                    localStorage.clear();
                    setTimeout(() => {
                        window.location = "{{url('')}}"
                    }, 300);
                } else {
                    var msg = jqXHR.responseJSON.message;
                    Toastify({
                        text: msg,
                        duration: 3000,
                        close: true,
                        backgroundColor: "#dc3545",
                    }).showToast()
                }
                })
            }, 100);
        }

        function checkupdate(value) {
            if ($('#chkd'+value).is(":checked")) {
                $('#edit'+value).prop('disabled', false);
            } else {
                $('#edit'+value).prop('disabled', true);
            }
        }

    $(document).ready(function() {

$('#forminput').on('submit', function(e) {

    e.preventDefault();

    var datas = $("#forminput").serialize();

    $.ajax({
        type: "POST",
        url: "{{ url('') }}/api/v1/{{$endpoint}}",
        dataType: "json",
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
        },
        data: datas
    }).done(function(data) {
        Toastify({
            text: "Berhasil ditambahkan",
            duration: 3000,
            close: true,
            backgroundColor: "#198754",
        }).showToast()
        loadtable("{{url('')}}/api/v1/{{$endpoint}}");
        $('#add').modal('hide')
        document.getElementById("forminput").reset();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status == '401') {
            Toastify({
                text: "Session Telah Berakhir, Silahkan Login ulang",
                duration: 3000,
                close: true,
                backgroundColor: "#dc3545",
            }).showToast()
            $('#add').modal('hide')
            document.getElementById("forminput").reset();

            localStorage.clear();
            setTimeout(() => {
                window.location = "{{url('')}}"
            }, 300);
        } else {
            var msg = jqXHR.responseJSON.message;
            Toastify({
                text: msg,
                duration: 3000,
                close: true,
                backgroundColor: "#dc3545",
            }).showToast()
            $('#add').modal('hide')
            document.getElementById("forminput").reset();
        }
    })
});

$('#formupdate').on('submit', function(e) {

    e.preventDefault();

    var id = $('#editid').val();
    var datas = $("#formupdate").serialize();

    $.ajax({
        type: "PATCH",
        url: "{{ url('') }}/api/v1/{{$endpoint}}/"+id,
        dataType: "json",
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
        },
        data: datas
    }).done(function(data) {
        Toastify({
            text: "Berhasil diupdate",
            duration: 3000,
            close: true,
            backgroundColor: "#198754",
        }).showToast()
        loadtable("{{url('')}}/api/v1/{{$endpoint}}");
        $('#edit').modal('hide')
        document.getElementById("forminput").reset();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status == '401') {
            Toastify({
                text: "Session Telah Berakhir, Silahkan Login ulang",
                duration: 3000,
                close: true,
                backgroundColor: "#dc3545",
            }).showToast()
            $('#edit').modal('hide')
            document.getElementById("formupdate").reset();

            localStorage.clear();
            setTimeout(() => {
                window.location = "{{url('')}}"
            }, 300);
        } else {
            var msg = jqXHR.responseJSON.message;
            Toastify({
                text: msg,
                duration: 3000,
                close: true,
                backgroundColor: "#dc3545",
            }).showToast()
            $('#edit').modal('hide')
            document.getElementById("formupdate").reset();
        }
    })
});

});

function deletedata(value) {
Swal.fire({
    title: "Perhatian!!",
    text: "Apakah Anda Yakin ingin menghapusnya??",
    icon: "warning",
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
}).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{ url('') }}/api/v1/{{$endpoint}}/" + value,
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "Bearer " + localStorage.getItem("access_token"));
            },
        }).done(function(data) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil dihapus',
                timer: 1500
            });
            loadtable("{{url('')}}/api/v1/{{$endpoint}}");

        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == '401') {
                Toastify({
                    text: "Session Telah Berakhir, Silahkan Login ulang",
                    duration: 3000,
                    close: true,
                    backgroundColor: "#dc3545",
                }).showToast()

                localStorage.clear();
                setTimeout(() => {
                    window.location = "{{url('')}}"
                }, 300);
            } else {
                var msg = jqXHR.responseJSON.message;
                Swal.fire({
                    icon: 'error',
                    title: msg,
                    timer: 1500
                });
            }
        })
    }

});
}
</script>
@endpush
