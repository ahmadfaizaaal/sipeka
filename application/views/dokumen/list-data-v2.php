<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h2 class="content-header-title" style="font-family: Calibri !important; font-size: 2.2em;"><?= $title ?></h>
            </div>
            <!-- <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="index.html">Registration</a>
                                </li>
                                <li class="breadcrumb-item active">nikah
                                </li>
                            </ol>
                        </div>
                    </div>
                </div> -->
        </div>
        <div class="content-body">

            <section id="drag-area">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <div class="text-left" style="font-family: Calibri !important; font-size: 1.2rem;">
                                    <a href="" id="btnAdd" class="btn btn-icon btn-success mb-0"><i class="ft-user-plus"></i> &nbsp;Buat Pengajuan Baru</a>
                                </div> -->
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- <div class="alert alert-success" style="display: none;" role="alert"></div> -->

                                    <table class="table " id="dataTableDokumen" style="font-family: Arial !important;" width="100%">
                                        <thead class="text-center">
                                            <tr>
                                                <!-- <th scope="col" style="width: 2%;">No.</th> -->
                                                <!-- <th scope="col" style="width: 15%">Aksi</th> -->
                                                <th scope="col" style="width: 3%">Aksi</th>
                                                <th scope="col" style="width: 15%;">Nomor Surat</th>
                                                <th scope="col" style="width: 3%"></th>
                                                <th scope="col" style="width: 26%;">Nama Gapoktan / Poktan</th>
                                                <th scope="col" style="width: 26%;">Lokasi Kegiatan</th>
                                                <th scope="col" style="width: 15%;">Tanggal Pengajuan</th>
                                                <th scope="col" style="width: 12%;">Status Pengajuan</th>
                                                <!-- <th scope="col" style="width: 2%;"></th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="showDataProposal">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF HEADER SIDE -->


            </section>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- MODAL PREVIEW -->
<div class="modal fade" id="modal-preview-document" tabindex="-1" role="dialog" aria-labelledby="modal-preview-document-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="z-index: 9999999;">
            <div class="modal-header bg-teal bg-lighten-2">
                <h5 class="modal-title text-white font-weight-bold" style="font-family: Calibri;" id="modal-preview-document-label"><strong>Preview Document</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true"><strong>&times;</strong></span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" style="width:100%; height:700px;" frameborder="0" id="doc-frame"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #18D26E; color: #fff;" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnDownload" class="btn btn-success">Download</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AJUKAN PENOMORAN -->
<div class="modal fade" id="modal-ajukan-penomoran" tabindex="-1" role="dialog" aria-labelledby="modal-ajukan-penomoran-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="z-index: 9999999;">
            <div class="modal-header bg-teal bg-lighten-2">
                <h5 class="modal-title text-white font-weight-bold" style="font-family: Calibri;" id="modal-ajukan-penomoran-label"><strong>Preview Document</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true"><strong>&times;</strong></span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('pengajuan/submitForm/', 'class="steps-validation" id="form"'); ?>
                <h6><i class="step-icon ft-map-pin"></i> Lokasi Kegiatan</h6>
                <fieldset class="mt-2">
                    <div class="form-group row">
                        <input type="hidden" name="id-lokasi" id="id-lokasi" value="">
                        <label class="col-md-3 label-control" for="kabupaten">Kabupaten <span class="danger">*</span></label>
                        <div class="col-md-9">
                            <input type="hidden" name="id-kabupaten" id="id-kabupaten">
                            <select type="text" style="width: 100%" id="kabupaten" class="select2 job form-control required" placeholder="PILIH KABUPATEN" name="kabupaten"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="kecamatan">Kecamatan <span class="danger">*</span></label>
                        <div class="col-md-9">
                            <select type="text" style="width: 100%" id="kecamatan" class="select2 job form-control required" placeholder="PILIH KECAMATAN" name="kecamatan"></select>
                            <!-- <p class="text-left text-danger" style="margin-top: 5px;" id="error-kecamatan">This field is required!</p> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="desa">Desa <span class="danger">*</span></label>
                        <div class="col-md-9">
                            <select type="text" style="width: 100%" id="desa" class="select2 job form-control required" placeholder="PILIH DESA" name="desa"></select>
                            <!-- <p class="text-left text-danger" style="margin-top: 5px;" id="error-desa">This field is required!</p> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="koordinat" id="koordinat">
                        <label class="col-md-3 label-control" for="a-koordinat">Koordinat <span class="danger">*</span></label>
                        <div class="col-md-5">
                            <input type="text" id="a-koordinat" class="form-control required" placeholder="" name="a-koordinat" value="">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="b-koordinat" class="form-control required" placeholder="" name="b-koordinat" value="">
                        </div>
                    </div>
                </fieldset>

                <!-- GAPOKTAN / POKTAN -->
                <h6><i class="step-icon ft-users"></i>Gapoktan / Poktan</h6>
                <fieldset class="mt-2">
                    <div class="form-group row">
                        <input type="hidden" name="id-poktan" id="id-poktan" value="">
                        <label class="col-md-3 label-control" for="nama-poktan">Nama Kelompok Tani <span class="danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" id="nama-poktan" class="form-control required" placeholder="" name="nama-poktan" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="nama-ketua">Nama Ketua <span class="danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" id="nama-ketua" class="form-control required" placeholder="" name="nama-ketua" value="">
                        </div>
                    </div>
                </fieldset>
                </form>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
                <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
                <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button> -->
            <!-- <button type="button" class="btn btn-success" style="background-color: #18D26E; color: #fff;" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnSimpan" class="btn btn-success">Simpan Data</button>
            </div> -->
        </div>
    </div>
</div>


<script>
    $(function() {
        const base_theme = '<?= BASE_THEME; ?>';
        const base_url = '<?= BASE_URL; ?>';
        showDataProposal();

        $(document).ready(function() {
            $('#dataTableDokumen').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                scrollY: "410px",
                rowsGroup: [0, 1],
                ordering: false
            });
        });

        $('#btnDownload').click(function() {
            var url = $('#formAddEditPenghulu').attr('action');
            var data = $('#formAddEditPenghulu').serialize();
            //validate form
            var nip = $('input[name=nip]');
            var nama = $('input[name=nama]');
            var alamat = $('input[name=alamat]');
            var noTelp = $('input[name=noTelp]');
            var email = $('input[name=email]');
            var username = $('input[name=username]');
            var password = $('input[name=password]');

            if (nip.val() != '' && nama.val() != '' && alamat.val() != '' &&
                noTelp.val() != '' && email.val() != '' && username.val() != '' && password.val() != '') {
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#modal-preview-document').modal('hide');
                            $('#formAddEditPenghulu')[0].reset();
                            if (response.type == 'add') {
                                type = 'ditambahkan'
                            } else if (response.type == 'update') {
                                type = 'diubah'
                            }
                            swal("Selamat!", "Data pengulu berhasil " + type + "!", "success");
                            showDataProposal();
                        } else {
                            swal("Internal Server error 500!", "Error!", "error");
                        }
                    },
                    error: function() {
                        swal("Gagal menambahkan data penghulu!", "Error!", "error");
                    }
                });
            } else {
                swal("Field tidak boleh kosong!", "Error!", "error");
            }
        });

        //ADD PENGHULU
        $('#btnAdd').click(function() {
            validateMobilePhone();
            validateNIP();
            $('input[name=nip]').removeAttr('readonly');
            $('input[name=nama]').removeAttr('readonly');
            $('input[name=alamat]').removeAttr('readonly');
            $('input[name=noTelp]').removeAttr('readonly');
            $('input[name=email]').removeAttr('readonly');
            $('input[name=username]').removeAttr('readonly');
            $('input[name=password]').removeAttr('readonly');
            $('#btnDownload').show();
            $('#modal-preview-document').find('.modal-title').text('TAMBAH DATA PENGHULU');
            $('#formAddEditPenghulu').attr('action', '<?= BASE_URL . 'staff/addPenghulu'; ?>');
            $('#formAddEditPenghulu')[0].reset();
        });

        //EDIT PENGHULU
        $('#showDataProposal').on('click', '.editPenghulu', function() {
            var offId = $(this).attr('data');
            $('#btnDownload').show();
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('UBAH DATA PENGHULU');
            $('#formAddEditPenghulu').attr('action', '<?= BASE_URL . 'staff/updatePenghulu' ?>');
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'staff/getDetailPenghulu'; ?>',
                data: {
                    offId: offId
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    $('input[name=nip]').removeAttr('readonly');
                    $('input[name=nama]').removeAttr('readonly');
                    $('input[name=alamat]').removeAttr('readonly');
                    $('input[name=noTelp]').removeAttr('readonly');
                    $('input[name=email]').removeAttr('readonly');
                    $('input[name=offId]').val(offId);
                    $('input[name=nip]').val(data.NIP);
                    $('input[name=nama]').val(data.NAME);
                    $('input[name=alamat]').val(data.ADDRESS);
                    $('input[name=noTelp]').val(data.PHONE);
                    $('input[name=email]').val(data.EMAIL);
                    $('input[name=username]').attr('readonly', true);
                    $('input[name=username]').val(data.USERNAME);
                    $('input[name=password]').attr('readonly', true);
                    $('input[name=password]').val(data.PASSWORD_LABEL);
                },
                error: function() {
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        //PREVIEW PENGAJUAN
        $('#showDataProposal').on('click', '.viewProposal', function() {
            let id_proposal = $(this).attr('data');
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU DOKUMEN');
            $('#btnDownload').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/lihat-proposal'; ?>',
                data: {
                    id_proposal: id_proposal
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#doc-frame').attr('src', base_theme + response);
                },
                error: function() {
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });


        //INPUT SYARAT PENOMORAN
        $('#showDataProposal').on('click', '.ajukan-penomoran', function() {
            let id_pengajuan = $(this).attr('data');

            $('#modal-ajukan-penomoran').modal('show');
            $('#modal-ajukan-penomoran').find('.modal-title').text('SYARAT PENOMORAN');
            // $.ajax({
            //     type: 'ajax',
            //     method: 'post',
            //     url: '<?= BASE_URL . 'pengajuan/lihat-proposal'; ?>',
            //     data: {
            //         id_pengajuan: id_pengajuan
            //     },
            //     async: false,
            //     dataType: 'json',
            //     success: function(response) {
            //         $('#doc-frame').attr('src', base_theme + response);
            //     },
            //     error: function() {
            //         swal("Internal Server error 500!", "Error!", "error");
            //     }
            // });
        });

        $("#modal-preview-document").on('hide.bs.modal', function() {
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/clear-temp-files'; ?>',
                async: false,
                dataType: 'json',
                success: function(response) {
                    // console.log('200 OK');
                },
                error: function() {
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        //DELETE PENGHULU
        $('#showDataProposal').on('click', '.deletePenghulu', function() {
            var offId = $(this).attr('data');
            swal({
                title: 'Apakah anda yakin ingin menghapus data ini?',
                type: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonColor: '#18d26e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        type: 'ajax',
                        method: 'post',
                        url: '<?= BASE_URL . 'staff/deletePenghulu/'; ?>',
                        data: {
                            offId: offId
                        },
                        async: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                swal("Selamat!", "Data Penghulu berhasil dihapus!", "success");
                                showDataProposal();
                            } else {
                                swal("Error!", "Gagal Hapus data!", "error");
                            }
                        },
                        error: function() {
                            swal("Internal Server error 500!", "Error!", "error");
                        }
                    });
                }
            });
        });

        //SHOW DATA PROPOSAL
        function showDataProposal() {
            let base_url = '<?= BASE_URL ?>';
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/list-proposal'; ?>',
                async: false,
                dataType: 'json',
                success: function(response) {
                    let html = '';
                    let i;

                    const nomorSurat = {};
                    const obj = response;
                    obj.forEach(function(x) {
                        nomorSurat[x.nomor_surat] = (nomorSurat[x.nomor_surat] || 0) + 1;
                    });

                    let repeated = false;
                    let jmlTerverif = 0
                    for (i = 0; i < response.length; i++) {
                        let disabled = '';
                        let ajukan = '';
                        let style = '';

                        let totalSpan = 0;
                        if (nomorSurat.hasOwnProperty(response[i].nomor_surat)) {
                            totalSpan = nomorSurat[response[i].nomor_surat];
                        }

                        if (totalSpan > 1) {
                            if (!repeated) {
                                for (let j = 0, idx = i; j < totalSpan; j++) {
                                    if ((response[idx].kode).toLowerCase() == 'dvr' || (response[idx].kode).toLowerCase() == 'ppnmr') {
                                        jmlTerverif++;
                                    }
                                    idx++;
                                }
                            }
                            disabled = jmlTerverif == totalSpan ? '' : 'disabled';
                            ajukan = jmlTerverif == totalSpan ? 'success' : 'light';
                            style = jmlTerverif == totalSpan ? 'background-color: #18D26E; color: #fff !important;' : 'color: #fff !important;';
                            console.log(jmlTerverif)
                            repeated = true;
                        } else {
                            if ((response[i].kode).toLowerCase() == 'dvr') {
                                style = 'background-color: #18D26E; color: #fff !important;';
                            } else {
                                disabled = 'disabled';
                                ajukan = 'light';
                                style = 'color: #fff !important;';
                            }
                        }

                        if ((response[i].kode).toLowerCase() == 'dvr') {
                            style = 'background-color: #18D26E; color: #fff !important;';
                        } else {
                            disabled = 'disabled';
                            ajukan = 'light';
                            style = 'color: #fff !important;';
                        }

                        /*
                        <td scope="col" style="width: 15%">
                                        <a href="javascript:;" class="btn btn-sm btn-icon btn-info viewProposal" style="margin-left:0px; vertical-align: middle;" data-toggle="tooltip" data-placement="bottom" title="Unduh Dokumen Verifikasi" data="${response[i].id_proposal}"><i class="ft-download"></i>&nbsp; Unduh Dokumen</a>
                                        
                                    </td>
                        */

                        html += `<tr>
                                    <td scope="col" style="width: 3%;" >
                                        <span class="dropdown">
                                            <button id="btnSearchDrop12" type="button" 
                                                class="btn btn-sm btn-icon btn-pure font-medium-2"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="ft-more-vertical"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop12" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="javascript:;" class="dropdown-item viewProposal" data="${response[i].id_proposal}">
                                                    <i class="ft-download"></i> Unduh Dokumen Verifikasi</a>
                                                <a href="#" class="dropdown-item ${ (response[i].kode).toLowerCase() == 'vr' ? 'disabled' : '' }">
                                                    <i class="ft-search"></i> Pratinjau Syarat Penomoran</a>
                                                <a href="#" class="dropdown-item">
                                                    <i class="ft-download"></i> Unduh Format Kelengkapan Berkas</a>
                                            </span>
                                        </span>
                                    </td>
                                    
                                    <td scope="col" style="width: 15%;" >${ response[i].nomor_surat }</td>
                                    <td scope="col" style="width: 3%;" >
                                        <a href="${ base_url }pengajuan/ajukan-penomoran/${ response[i].url }/${ response[i].id_pengajuan }" class="btn btn-sm btn-icon btn-${ ajukan } ${ disabled }" style="margin-left:0px; ${ style }" data-toggle="tooltip" data-placement="bottom" title="Input Syarat Penomoran" data="${response[i].id_pengajuan}"><i class="ft-edit-3"></i></a>
                                    </td>
                                    <td scope="col" style="width: 26%;" >${ response[i].nama_poktan }</td>
                                    <td scope="col" style="width: 26%;" >KECAMATAN ${ response[i].nama_kecamatan }</td>
                                    <td scope="col" style="width: 15%;" >${ response[i].tgl_buat }</td>
                                    <td scope="col" style="width: 12%;" class="text-center">
                                        <div class="badge badge-${ response[i].warna }">${ response[i].nama_status }</div>
                                    </td>
                                </tr>`;
                    }
                    $('#showDataProposal').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function() {
                    swal("Error!", "Could not get Data from Database!", "error");
                }
            });
        }

        function validateMobilePhone() {
            $('#noTelp').on('keyup', function(e) {
                numberLength = $('#noTelp').val().length;
            });

            $('#noTelp').on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                var currentNum = 48;
                // for 12 digit number only
                if ($this.val().length > 11) {
                    e.preventDefault();
                    return false;
                }
                if (numberLength == 0) {
                    currentNum = 48;
                } else if (numberLength == 1) {
                    currentNum = 56;
                }
                if (e.charCode != currentNum && e.charCode > 47 && e.charCode < 58) {
                    if ($this.val().length == 0) {
                        e.preventDefault();
                        return false;
                    } else {
                        var result = e.charCode != currentNum && numberLength == 1 ? false : true;
                        return result;
                    }
                }
                if (regex.test(str)) {
                    currentNum = 56;
                    return true;
                }
                e.preventDefault();
                return false;
            });
        }

        function validateNIP() {
            $('#nip').on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                // for 16 digit number only
                if ($this.val().length > 17) {
                    e.preventDefault();
                    return false;
                }
                if (regex.test(str)) {
                    currentNum = 56;
                    return true;
                }
                e.preventDefault();
                return false;
            });
        }
    });
</script>