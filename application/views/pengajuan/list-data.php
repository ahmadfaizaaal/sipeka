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
            <input type="hidden" id="id-jenis" name="id-jenis" value="<?= $id_jenis; ?>">
            <section id="drag-area">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-left" style="font-family: Calibri !important; font-size: 1.2rem;">
                                    <a href="<?= BASE_URL ?>pengajuan/add/<?= $kegiatan ?>" id="btnAdd" class="btn btn-icon btn-success mb-0" style="background-color: #18D26E; color: #fff;"><i class="ft-file-plus"></i> &nbsp;Buat Pengajuan Baru</a>
                                </div>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <!-- <div class="alert alert-success" style="display: none;" role="alert"></div> -->

                                    <table class="table table-striped" id="dataTablePengajuan" style="font-family: Arial !important;">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="width: 2%;">No.</th>
                                                <th scope="col" style="width: 18%">Aksi</th>
                                                <th scope="col" style="width: 27%;">Lokasi Kegiatan</th>
                                                <th scope="col" style="width: 6%;">Nomor Surat</th>
                                                <th scope="col" style="width: 18%;">Nama Gapoktan / Poktan</th>
                                                <th scope="col" style="width: 18%;">Nama Ketua</th>
                                                <th scope="col" style="width: 8%;">Tanggal Pengajuan</th>
                                                <th scope="col" style="width: 5%;">Status Pengajuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showDataPengajuan">

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

<!-- MODAL PENGHULU -->
<div class="modal fade" id="modal-preview-document" tabindex="-1" role="dialog" aria-labelledby="modal-preview-document-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="z-index: 9999999;">
            <div class="modal-header bg-teal bg-lighten-2">
                <h5 class="modal-title text-white font-weight-bold" style="font-family: Calibri;" id="modal-preview-document-label"><strong>Preview Document</strong></h5>
                <button type="button" class="close mr-0" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true"><strong>&times;</strong></span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="" style="width:100%; height:700px;" frameborder="0" id="doc-frame"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="background-color: #18D26E; color: #fff;" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnDownload" class="btn btn-success" style="background-color: #18D26E; color: #fff;">Download</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const base_theme = '<?= BASE_THEME; ?>';
        const base_url = '<?= BASE_URL; ?>';
        showDataPengajuan();

        $(document).ready(function() {
            $('#dataTablePengajuan').DataTable({
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                scrollY: "410px"
            });
        });

        // $('#btnDownload').click(function() {
        //     var url = $('#formAddEditPenghulu').attr('action');
        //     var data = $('#formAddEditPenghulu').serialize();
        //     //validate form
        //     var nip = $('input[name=nip]');
        //     var nama = $('input[name=nama]');
        //     var alamat = $('input[name=alamat]');
        //     var noTelp = $('input[name=noTelp]');
        //     var email = $('input[name=email]');
        //     var username = $('input[name=username]');
        //     var password = $('input[name=password]');

        //     if (nip.val() != '' && nama.val() != '' && alamat.val() != '' &&
        //         noTelp.val() != '' && email.val() != '' && username.val() != '' && password.val() != '') {
        //         $.ajax({
        //             type: 'ajax',
        //             method: 'post',
        //             url: url,
        //             data: data,
        //             async: false,
        //             dataType: 'json',
        //             success: function(response) {
        //                 if (response.success) {
        //                     $('#modal-preview-document').modal('hide');
        //                     $('#formAddEditPenghulu')[0].reset();
        //                     if (response.type == 'add') {
        //                         type = 'ditambahkan'
        //                     } else if (response.type == 'update') {
        //                         type = 'diubah'
        //                     }
        //                     swal("Selamat!", "Data pengulu berhasil " + type + "!", "success");
        //                     showDataPengajuan();
        //                 } else {
        //                     swal("Internal Server error 500!", "Error!", "error");
        //                 }
        //             },
        //             error: function() {
        //                 swal("Gagal menambahkan data penghulu!", "Error!", "error");
        //             }
        //         });
        //     } else {
        //         swal("Field tidak boleh kosong!", "Error!", "error");
        //     }
        // });

        //ADD PENGHULU
        // $('#btnAdd').click(function() {
        //     validateMobilePhone();
        //     validateNIP();
        //     $('input[name=nip]').removeAttr('readonly');
        //     $('input[name=nama]').removeAttr('readonly');
        //     $('input[name=alamat]').removeAttr('readonly');
        //     $('input[name=noTelp]').removeAttr('readonly');
        //     $('input[name=email]').removeAttr('readonly');
        //     $('input[name=username]').removeAttr('readonly');
        //     $('input[name=password]').removeAttr('readonly');
        //     $('#btnDownload').show();
        //     $('#modal-preview-document').find('.modal-title').text('TAMBAH DATA PENGHULU');
        //     $('#formAddEditPenghulu').attr('action', '');
        //     $('#formAddEditPenghulu')[0].reset();
        // });

        //EDIT PENGHULU
        // $('#showDataPengajuan').on('click', '.editPenghulu', function() {
        //     var offId = $(this).attr('data');
        //     $('#btnDownload').show();
        //     $('#modal-preview-document').modal('show');
        //     $('#modal-preview-document').find('.modal-title').text('UBAH DATA PENGHULU');

        //     $.ajax({
        //         type: 'ajax',
        //         method: 'post',
        //         
        //         data: {
        //             offId: offId
        //         },
        //         async: false,
        //         dataType: 'json',
        //         success: function(data) {
        //             $('input[name=nip]').removeAttr('readonly');
        //             $('input[name=nama]').removeAttr('readonly');
        //             $('input[name=alamat]').removeAttr('readonly');
        //             $('input[name=noTelp]').removeAttr('readonly');
        //             $('input[name=email]').removeAttr('readonly');
        //             $('input[name=offId]').val(offId);
        //             $('input[name=nip]').val(data.NIP);
        //             $('input[name=nama]').val(data.NAME);
        //             $('input[name=alamat]').val(data.ADDRESS);
        //             $('input[name=noTelp]').val(data.PHONE);
        //             $('input[name=email]').val(data.EMAIL);
        //             $('input[name=username]').attr('readonly', true);
        //             $('input[name=username]').val(data.USERNAME);
        //             $('input[name=password]').attr('readonly', true);
        //             $('input[name=password]').val(data.PASSWORD_LABEL);
        //         },
        //         error: function() {
        //             swal("Internal Server error 500!", "Error!", "error");
        //         }
        //     });
        // });

        //PREVIEW PENGAJUAN
        $('#showDataPengajuan').on('click', '.viewPengajuan', function() {
            let id_pengajuan = $(this).attr('data');
            let kegiatan = '<?= $kegiatan; ?>';
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU DOKUMEN');
            $('#btnDownload').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/lihat-dokumen'; ?>',
                data: {
                    id_pengajuan: id_pengajuan,
                    url: kegiatan
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#doc-frame').attr('src', base_theme + response + '#zoom=100%&toolbar=0');
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

        //DELETE PENGAJUAN
        $('#showDataPengajuan').on('click', '.deletePengajuan', function() {
            var id_pengajuan = $(this).attr('data');
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
                        url: '<?= BASE_URL . 'pengajuan/delete/'; ?>',
                        data: {
                            id_pengajuan: id_pengajuan
                        },
                        async: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                swal("Selamat!", "Data Pengajuan berhasil dihapus!", "success");
                                showDataPengajuan();
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
        function showDataPengajuan() {
            let id_jenis = $('#id-jenis').val();
            let base_url = '<?= BASE_URL ?>';
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/list-pengajuan'; ?>',
                data: {
                    id_jenis: id_jenis
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        let lokasi = `${data[i].kabupaten}, KECAMATAN ${data[i].kecamatan}, DESA ${data[i].kelurahan}`;
                        let disabled = '';
                        let edit = 'warning';
                        let hapus = 'danger';
                        let color = ''

                        if ((data[i].nama_status).toLowerCase() == 'sudah diverifikasi') {
                            disabled = 'disabled';
                            edit = 'light';
                            hapus = 'light';
                            color = 'color: #fff !important;';
                        }

                        //<a href="javascript:;" class="btn btn-sm btn-icon btn-info viewPengajuan" style="margin-left:0px;" data-toggle="tooltip" data-placement="bottom" title="Pratinjau" data="${data[i].id_pengajuan}"><i class="ft-search"></i></a>

                        html += `<tr>
                                    <td scope="col" style="width: 2%;">${ i + 1 }</td>
                                    <td scope="col" style="width: 18%">
                                        
                                        <a href="${ base_url }pengajuan/edit/${ data[i].url }/${data[i].id_pengajuan}" class="btn btn-sm btn-icon btn-${ edit } editPengajuan ${ disabled }" style="margin-left:10px; ${ color }" data-toggle="tooltip" data-placement="bottom" title="Edit" data="${data[i].id_pengajuan}"><i class="ft-edit-2"></i></a>
                                        <a href="javascript:;" class="btn btn-sm btn-icon btn-${ hapus } deletePengajuan ${ disabled }" style="margin-left:10px; ${ color }" data-toggle="tooltip" data-placement="bottom" title="Hapus" data="${data[i].id_pengajuan}"><i class="ft-trash"></i></a>
                                    </td>
                                    <td scope="col" style="width: 27%;">${ lokasi }</td>
                                    <td scope="col" style="width: 6%;">${ data[i].nomor_surat }</td>
                                    <td scope="col" style="width: 18%;">${ data[i].nama_poktan }</td>
                                    <td scope="col" style="width: 18%;">${ data[i].nama_ketua }</td>
                                    <td scope="col" style="width: 8%;">${ data[i].tgl_buat }</td>
                                    <td scope="col" style="width: 5%;" class="text-center">
                                        <div class="badge badge-${ data[i].warna }">${ data[i].nama_status }</div>
                                    </td>
                                </tr>`;
                    }
                    $('#showDataPengajuan').html(html);
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