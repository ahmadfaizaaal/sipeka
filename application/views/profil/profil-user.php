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
        <div class="content-detached content-right">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <!-- <h4 class="card-title">All Contacts</h4> -->
                                    <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">INFORMASI AKUN</h4>
                                    <a class="heading-elements-toggle">
                                        <i class="la la-ellipsis-h font-medium-3"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body" style="font-family: Calibri !important; font-size: 1.3em;">

                                    <?= form_open_multipart('profil/updateProfil', 'id="form-update-profil"'); ?>
                                    <input type="hidden" id="id-user" name="id-user" value="<?= $profil->id_user; ?>">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nama-instansi">Nama Instansi</label>
                                        <div class="col-md-9">
                                            <input type="text" id="nama-instansi" class="form-control " placeholder="" name="nama-instansi" value="<?= $profil->nama; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="komoditas">Alamat Instansi</label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="alamat-instansi" id="alamat-instansi">
                                            <select type="text" style="width: 100%;" id="kabupaten" class="select2-size-xs job form-control required" placeholder="PILIH KABUPATEN" name="kabupaten"></select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nama-kadin">Nama Kepala Dinas </label>
                                        <div class="col-md-9">
                                            <input type="text" id="nama-kadin" class="form-control " placeholder="" name="nama-kadin" value="<?= $profil->nama_kadin; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nip-kadin">NIP </label>
                                        <div class="col-md-9">
                                            <input type="text" id="nip-kadin" class="form-control " placeholder="" name="nip-kadin" value="<?= $profil->nip; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="elevasi">
                                        <label class="col-md-3 label-control" for="jabatan-kadin">Jabatan Kepala Dinas </label>
                                        <div class="col-md-9">
                                            <input type="text" id="jabatan-kadin" class="form-control " placeholder="" name="jabatan-kadin" value="<?= $profil->jabatan; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row" id="elevasi">
                                        <label class="col-md-3 label-control" for="nama-verifikator">Nama Verifikator Lapangan </label>
                                        <div class="col-md-9">
                                            <input type="text" id="nama-verifikator" class="form-control " placeholder="" name="nama-verifikator" value="<?= $profil->nama_verifikator; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <div class="col-md-12">
                                            <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                                <div class="card-content collapse show">
                                                    <div class="card-body">
                                                        <p class="card-text" style="font-family: Calibri !important; font-size: 1em;"><i class="ft-alert-triangle"></i>&nbsp; Jenis tanda tangan digital berupa file gambar yang bertipe <strong>.JPG / .PNG / .JPEG</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="doc-ttd">Tanda tangan Kepala Dinas </label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="hidden" id="prev-ttd" name="prev-ttd" value="<?= $profil->tanda_tangan; ?>">
                                                <input type="file" class="custom-file-input" name="doc-ttd" id="doc-ttd" accept="image/jpg, image/jpeg, image/png" onchange="getFileNameOfImage('doc-ttd', 'label-ttd-kadin')">
                                                <label for="doc-ttd" class="custom-file-label" id="label-ttd-kadin"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row float-md-right mt-2">
                                        <div class="col-md-12" style="font-family: Calibri !important; font-size: 1.5em;">
                                            <!-- <input type="button" id="simpan-profil" class="btn btn-success btn-min-width mb-2" placeholder="" name="simpan-profil" value="Simpan Data" > -->
                                            <!-- <a href="" id="btn-simpan" class="btn btn-icon btn-md btn-teal mb-2 font-medium-2" style="background-color: #18D26E; color: #fff;"><i class="ft-save"></i> &nbsp;Simpan Data</a> -->
                                            <button type="submit" id="btn-simpan" class="btn btn-icon btn-md btn-teal mb-2 font-medium-2" style="background-color: #18D26E; color: #fff;"><i class="ft-save"></i> &nbsp;Simpan Data</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="bug-list-sidebar-content">
                    <!-- Predefined Views -->
                    <div class="card">
                        <div class="card-head">
                            <div class="align-self-center halfway-fab text-center p-3" style="margin-bottom: -15px;">
                                <span class="avatar avatar-lg avatar-online rounded-circle"><img src="<?= BASE_THEME ?>adm/app-assets/images/portrait/small/user.png" alt="avatar"></span>
                            </div>
                            <div class="text-center">
                                <span class="font-medium-3 text-uppercase text-bold-700"><?= $profil->nama_kadin; ?></span>
                                <p class="blue-grey text-uppercase font-small-2">( <?= $profil->jabatan; ?> )</p>
                            </div>
                        </div>

                        <div class="card-body border-top-blue-grey border-top-lighten-5 text-center" style="font-family: Calibri !important;">
                            <a href="javascript:;" id="btn-edit" class="btn btn-icon btn-sm btn-info mb-0" style="color: #fff; font-size: 1em;"><i class="ft-settings"></i> &nbsp;Ubah Profil</a>
                        </div>

                    </div>
                    <!--/ Predefined Views -->

                </div>
            </div>
        </div>
        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="bug-list-sidebar-content">
                    <!-- Predefined Views -->
                    <div class="card">
                        <div class="card-head">
                            <div class="align-self-center halfway-fab text-center p-3" style="margin-bottom: -15px;">
                                <!-- <span class="avatar avatar-lg avatar-online rounded-circle"><img src="<?= BASE_THEME ?>adm/app-assets/images/portrait/small/user.png" alt="avatar"></span> -->
                                <img src="<?= BASE_THEME ?>pengajuan/temp/signature/<?= $profil->tanda_tangan; ?>" alt="avatar" style="width: auto; height: 150px;">
                            </div>
                        </div>

                        <div class="card-body border-top-blue-grey border-top-lighten-5 text-center" style="font-family: Calibri !important;">
                            <span class="font-medium-2 text-uppercase text-bold-700">TANDA TANGAN</span>
                            <p class="blue-grey text-uppercase font-small-2 mb-0">( KEPALA DINAS )</p>
                        </div>
                    </div>
                    <!--/ Predefined Views -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<script>
    $(function() {
        const base_theme = '<?= BASE_THEME; ?>';
        const base_url = '<?= BASE_URL; ?>';

        $('#nama-instansi').attr('readonly', true);
        $('#kabupaten').attr('disabled', true);
        $('#nama-kadin').attr('readonly', true);
        $('#nip-kadin').attr('readonly', true);
        $('#jabatan-kadin').attr('readonly', true);
        $('#nama-verifikator').attr('readonly', true);
        $('#doc-ttd').attr('disabled', true);
        $('#btn-simpan').hide();

        let id_kabupaten = '<?= $profil->id_kabupatenkota; ?>';
        let nama_kabupaten = '<?= $profil->nama_kabupaten; ?>';


        $('#kabupaten').select2({
            width: '100%',
            placeholder: 'PILIH KABUPATEN / KOTA',
            data: [{
                id: id_kabupaten,
                text: nama_kabupaten
            }],
        });

        $('#kabupaten').select2({
            width: '100%',
            placeholder: 'PILIH KABUPATEN / KOTA',
            ajax: {
                url: '<?= BASE_URL ?>pengajuan/cari-kota/',
                dataType: 'json',
                delay: 750,
                data: function(params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function(data) {
                    // console.log(data)
                    return {
                        results: $.map(data, function(item) {
                            if (item.id_kabupatenkota !== '') {
                                return {
                                    id: item.id_kabupatenkota,
                                    text: item.nama
                                };
                            } else {
                                return false;
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#btn-edit').click(function() {
            $('#nama-instansi').attr('readonly', false);
            $('#kabupaten').attr('disabled', false);
            $('#nama-kadin').attr('readonly', false);
            $('#nip-kadin').attr('readonly', false);
            $('#jabatan-kadin').attr('readonly', false);
            $('#nama-verifikator').attr('readonly', false);
            $('#doc-ttd').removeAttr('disabled');
            $('#btn-simpan').show();
        });

        $('#btn-simpan').click(function() {
            let kabupaten = $('#kabupaten').select2('data');
            $('#alamat-instansi').val(kabupaten[0].text);
        });

        // $('#btn-simpan').click(function() {
        //     let url = $('#form-update-profil').attr('action');
        //     let kabupaten = $('#kabupaten').select2('data');
        //     $('#alamat-instansi').val(kabupaten[0].text);
        //     // e.preventDefault();
        //     swal({
        //         title: 'Apakah data Anda sudah benar?',
        //         type: 'warning',
        //         showCancelButton: true,
        //         focusConfirm: false,
        //         confirmButtonColor: '#18d26e',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya',
        //         cancelButtonText: 'Tidak'
        //     }).then(result => {
        //         if (result.value) {

        //             $.ajax({
        //                 type: 'post',
        //                 // method: 'post',
        //                 url: url,
        //                 data: new FormData(this),
        //                 async: false,
        //                 processData: false,
        //                 contentType: false,
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     if (response.success) {
        //                         window.location.href = response.redirect_url;
        //                     }
        //                 },
        //                 error: function() {
        //                     swal("Gagal memperbarui data profil!", "Error!", "error");
        //                 }
        //             });
        //         } else {
        //             window.location.href = base_url + 'profil/user/';
        //         }
        //     })
        // });

        //ADD PENGHULU


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

        //SHOW DATA PENGHULU
        function showDataProposal() {
            let base_url = '<?= BASE_URL ?>';
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/list-proposal'; ?>',
                async: false,
                dataType: 'json',
                success: function(response) {
                    var html = '';
                    var i;
                    for (i = 0; i < response.length; i++) {
                        let disabled = 'disabled';
                        let ajukan = 'light';
                        let style = 'color: #fff !important;';

                        if ((response[i].nama_status).toLowerCase() == 'sudah diverifikasi') {
                            disabled = '';
                            ajukan = 'success';
                            style = 'background-color: #18D26E; color: #fff !important;';
                        }

                        html += `<tr>
                                    <td scope="col" style="width: 2%;">${ i + 1 }</td>
                                    <td scope="col" style="width: 20%">
                                        <a href="javascript:;" class="btn btn-sm btn-icon btn-info viewProposal" style="margin-left:0px;" data-toggle="tooltip" data-placement="bottom" title="Pratinjau" data="${response[i].id_proposal}"><i class="ft-eye"></i></a>
                                        
                                        <a href="javascript:;" class="btn btn-sm btn-icon btn-${ ajukan } deletePengajuan ${ disabled }" style="margin-left:10px; ${ style }" data-toggle="tooltip" data-placement="bottom" title="Hapus" data="${response[i].id_proposal}">Ajukan Penomoran</a>
                                    </td>
                                    <td scope="col" style="width: 20%;" class="text-center">${ response[i].nomor_surat }</td>
                                    <td scope="col" style="width: 20%;" class="text-center">${ response[i].nama_kabupaten }</td>
                                    <td scope="col" style="width: 20%;" class="text-center">${ response[i].tgl_buat }</td>
                                    <td scope="col" style="width: 18%;" class="text-center">
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

    function getFileNameOfImage(inputId, id) {
        let fileName = $('#' + inputId).val().split('\\').pop();
        $('#' + id).addClass('selected').html(fileName);
    }
</script>