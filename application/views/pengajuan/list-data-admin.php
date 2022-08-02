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
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">LOKASI KEGIATAN</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show" style="font-family: Calibri !important; font-size: 1.3em;">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="provinsi">Provinsi <span class="danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id-provinsi" id="id-provinsi">
                                            <select style="width: 100%" id="provinsi" class="select2 job form-control required" placeholder="PILIH PROVINSI" name="provinsi"></select>
                                            <p class="text-left text-danger" style="margin-top: 5px;" id="error-provinsi">This field is required!</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="kabupaten">Kabupaten <span class="danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id-kabupaten" id="id-kabupaten">
                                            <select style="width: 100%" id="kabupaten" class="select2 job form-control required" placeholder="PILIH KABUPATEN" name="kabupaten"></select>
                                            <p class="text-left text-danger" style="margin-top: 5px;" id="error-kabupaten">This field is required!</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nomor-surat">Nomor Surat Proposal <span class="danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="id-proposal" id="id-proposal">
                                            <select style="width: 100%" id="nomor-surat" class="select2 job form-control required" placeholder="PILIH NOMOR SURAT" name="nomor-surat"></select>
                                            <p class="text-left text-danger" style="margin-top: 5px;" id="error-nomor-surat">This field is required!</p>
                                        </div>
                                    </div>

                                    <div class="form-group row float-md-right">
                                        <div class="col-md-12">
                                            <input type="button" id="nextToShow" class="btn btn-md btn-min-width mb-1" style="background-color: #18D26E; color: #fff;" placeholder="" name="nextToShow" value="Tampilkan Data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="detailSection">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">DAFTAR PENGAJUAN</h4>
                                <!-- <div class="text-left" style="font-family: Calibri !important; font-size: 1.2rem;">
                                    <a href="<?= BASE_URL ?>pengajuan/add/<?= $kegiatan ?>" id="btnAdd" class="btn btn-icon btn-success mb-0"><i class="ft-plus"></i> &nbsp;Buat Pengajuan Baru</a>
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

                                    <table class="table table-striped table-responsive" id="dataTablePengajuan" style="font-family: Arial !important;" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="width: 2%;">No.</th>
                                                <th scope="col" style="width: 5%"></th>
                                                <th scope="col" style="width: 24%;">Lokasi Kegiatan</th>
                                                <th scope="col" style="width: 5%;">Luas Layanan (Ha)</th>
                                                <th scope="col" style="width: 10%;">Perkiraan Biaya (Rp)</th>
                                                <th scope="col" style="width: 27%;">Bentuk Konstruksi</th>
                                                <th scope="col" style="width: 22%;">Hasil Telaah</th>
                                                <th scope="col" style="width: 5%;">Kelayakan / Status</th>
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

<!-- MODAL APPROVAL -->
<div class="modal fade" id="modal-approval" tabindex="-1" role="dialog" aria-labelledby="modal-approval-label" aria-hidden="true" style="font-family: Calibri !important; font-size: 1.3em;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="z-index: 9999999;">
            <div class="modal-header bg-teal bg-lighten-2">
                <h5 class="modal-title text-white font-weight-bold" id="modal-approval-label" style="font-family: Calibri !important;"><strong>Preview Document</strong></h5>
                <button type="button" class="close mr-0" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true"><strong>&times;</strong></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . 'pengajuan/simpan-telaah' ?>" method="post" id="formTelaahPengajuan">
                    <label>Catatan : </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="hidden" id="id-pengajuan" name="id-pengajuan">
                        <textarea class="form-control" id="catatan" rows="7"></textarea>
                        <p class="text-left"><small class="text-muted">Kosongkan apabila tidak ada catatan.</small></p>
                        <div class="form-control-position">
                            <i class="la la-pencil-square font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnSimpan" class="btn btn-success" style="background-color: #18D26E; color: #fff;">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const base_theme = '<?= BASE_THEME; ?>';

        $('#kabupaten').prop('disabled', true);
        $('#nomor-surat').prop('disabled', true);
        $('#error-provinsi').hide();
        $('#error-kabupaten').hide();
        $('#error-nomor-surat').hide();

        $("#kabupaten").select2({
            placeholder: "PILIH KABUPATEN / KOTA",
        });

        $("#nomor-surat").select2({
            placeholder: "PILIH NOMOR SURAT PROPOSAL",
        });

        $('#provinsi').select2({
            width: '100%',
            placeholder: 'PILIH PROVINSI',
            language: {
                noResults: function(params) {
                    return "Tidak ada Data yang cocok dengan Keyword.";
                },
                searching: function(params) {
                    return "Mencari...";
                },
                inputTooShort: function(params) {
                    var x = params.minimum - params.input.length;
                    return "Masukkan " + x + " karakter lagi";
                }
            },
            minimumInputLength: 1,
            ajax: {
                url: '<?= BASE_URL ?>pengajuan/cari-provinsi',
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
                            if (item.id_provinsi !== '') {
                                return {
                                    id: item.id_provinsi,
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

        $('#provinsi').on('change', function() {
            $('#kabupaten').removeAttr('disabled');
            $('#kabupaten').val(null).trigger('change');

            let id_provinsi = $('#provinsi').find(':selected').val();

            $('#kabupaten').select2({
                width: '100%',
                placeholder: 'PILIH KABUPATEN / KOTA',
                language: {
                    noResults: function(params) {
                        return "Tidak ada Data yang cocok dengan Keyword.";
                    },
                    searching: function(params) {
                        return "Mencari...";
                    },
                    inputTooShort: function(params) {
                        var x = params.minimum - params.input.length;
                        return "Masukkan " + x + " karakter lagi";
                    }
                },
                minimumInputLength: 1,
                ajax: {
                    url: '<?= BASE_URL ?>pengajuan/cari-kabupatenkota/' + id_provinsi,
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
        });

        $('#kabupaten').on('change', function() {
            $('#nomor-surat').removeAttr('disabled');
            $('#nomor-surat').val(null).trigger('change');

            let id_kabupatenkota = $('#kabupaten').find(':selected').val();

            $('#nomor-surat').select2({
                width: '100%',
                placeholder: 'PILIH NOMOR SURAT PROPOSAL',
                language: {
                    noResults: function(params) {
                        return "Tidak ada Data yang cocok dengan Keyword.";
                    },
                    searching: function(params) {
                        return "Mencari...";
                    },
                    inputTooShort: function(params) {
                        var x = params.minimum - params.input.length;
                        return "Masukkan " + x + " karakter lagi";
                    }
                },
                minimumInputLength: 1,
                ajax: {
                    url: '<?= BASE_URL ?>pengajuan/cari-nomor-surat-bykabupaten/' + id_kabupatenkota,
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
                                if (item.id_proposal !== '') {
                                    return {
                                        id: item.id_proposal,
                                        text: item.nomor_surat
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
        });

        $('#provinsi').on('change', function() {
            if ($('#provinsi').select2('data') != null) $('#error-provinsi').hide();
        });

        $('#kabupaten').on('change', function() {
            if ($('#kabupaten').select2('data') != null) $('#error-kabupaten').hide();
        });

        $('#nomor-surat').on('change', function() {
            if ($('#nomor-surat').select2('data') != null) $('#error-nomor-surat').hide();
        });

        $('#nextToShow').on('click', function() {
            let provinsi = $('#provinsi').select2('data');
            let kabupaten = $('#kabupaten').select2('data');
            let nomorSurat = $('#nomor-surat').select2('data');
            if (provinsi != '' && kabupaten != '' && nomorSurat != '') {
                showDataPengajuan();

                if ($.fn.DataTable.isDataTable('#dataTablePengajuan')) {
                    myTable.clear().destroy();
                }

                let myTable = $('#dataTablePengajuan').DataTable({
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    autoWidth: false,
                    scrollX: true,
                    scrollY: "410px",
                    paging: false,
                    searching: false,
                    info: false,
                    destroy: true,
                    retrieve: true
                });

                $('#detailSection').show(function() {
                    myTable.columns.adjust();
                });
            } else {
                if (provinsi == '') $('#error-provinsi').show();
                if (kabupaten == '') $('#error-kabupaten').show();
                if (nomorSurat == '') $('#error-nomor-surat').show();
            }
        });

        $('#btnSimpan').click(function() {
            let url = $('#formTelaahPengajuan').attr('action');
            let id_pengajuan = $('#id-pengajuan');
            let catatan = $('#catatan');

            if (id_pengajuan.val() != '') {
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: {
                        id_pengajuan: id_pengajuan.val(),
                        catatan: catatan.val()
                    },
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#modal-approval').modal('hide');
                            $('#formTelaahPengajuan')[0].reset();

                            swal("Selamat!", "Status pengajuan berhasil diperbarui!", "success");
                            showDataPengajuan();
                        } else {
                            swal("Internal Server error 500!", "Error!", "error");
                        }
                    },
                    error: function() {
                        swal("Gagal memperbarui status data pengajuan!", "Error!", "error");
                    }
                });
            } else {
                swal("Field tidak boleh kosong!", "Error!", "error");
            }
        });

        //APPROVE PENGAJUAN
        $('#showDataPengajuan').on('click', '.layak', function() {
            var id_pengajuan = $(this).attr('data');
            $('#modal-approval').modal('show');
            $('#modal-approval').find('.modal-title').text('TELAAH PENGAJUAN');
            $('#catatan').val('');
            $('#id-pengajuan').val(id_pengajuan);
        });

        //SHOW DATA PENGAJUAN
        function showDataPengajuan() {
            let id_kabupatenkota = $('#kabupaten').val();
            let id_proposal = $('#nomor-surat').val();
            // let id_kabupatenkota = '1108';
            let base_url = '<?= BASE_URL ?>';
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/list-pengajuan-admin'; ?>',
                data: {
                    id_kabupatenkota: id_kabupatenkota,
                    id_proposal: id_proposal
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        let disabled = '';
                        let btnColor = 'success';
                        let style = 'background-color: #18D26E; color: #fff;';

                        if ((data[i].nama_status).toLowerCase() == 'sudah diverifikasi') {
                            disabled = 'disabled';
                            btnColor = 'light';
                            style = 'color: #fff;';
                        }

                        html += `<tr>
                                    <td scope="col" style="width: 2%;">${ i + 1 }</td>
                                    <td scope="col" style="width: 5%">
                                        <a href="javascript:;" class="btn btn-sm btn-icon btn-${ btnColor } layak ${ disabled }" style="margin-left:0px; ${ style }" data-toggle="tooltip" data-placement="bottom" title="Tandai Sudah Ditelaah" data="${data[i].id_pengajuan}"><i class="ft-check"></i></a>                                        
                                    </td>
                                    <td scope="col" style="width: 24%;">
                                        <ul style="list-style-type: none;">
                                            <li><strong>${ data[i].nama_poktan }</strong></li>
                                            <li>Desa ${ capitalize((data[i].nama_kelurahan).toLowerCase()) }</li>
                                            <li>Kecamatan ${ capitalize((data[i].nama_kecamatan).toLowerCase()) }</li>
                                        </ul>
                                    </td>
                                    <td scope="col" style="width: 5%;" class="text-center">${ data[i].luas_layanan }</td>
                                    <td scope="col" style="width: 10%;" class="text-center">Rp. ${ Number(data[i].perkiraan_biaya).toLocaleString('id') }</td>
                                    <td scope="col" style="width: 27%;">
                                        <ul>
                                            <li>Rumah pompa ${ data[i].rumah_pompa }</li>
                                            <li>Pompa ${ data[i].ukuran_pompa }</li>
                                            <li>Bak penampung ${ data[i].bak_penampung }</li>
                                        </ul>
                                    </td>
                                    <td scope="col" style="width: 22%;">
                                        <ul>
                                            <li>Sumber ${ data[i].rumah_pompa }</li>
                                            <li>Luas layanan ${ data[i].luas_layanan }</li>
                                            <li>Jarak dari sumber ${ data[i].jarak }</li>
                                            <li>Dampak : Peningkatan IP dari ${ data[i].ip }</li>
                                        </ul>
                                    </td>
                                    <td scope="col" style="width: 5%;" class="text-center">
                                        <p style="margin-bottom: 20px;">${ data[i].kelayakan }</p>
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

        function capitalize(words) {
            var separateWord = words.toLowerCase().split(' ');
            for (var i = 0; i < separateWord.length; i++) {
                separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
                    separateWord[i].substring(1);
            }
            return separateWord.join(' ');
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