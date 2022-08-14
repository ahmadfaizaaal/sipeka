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
                <div class="row" id="detailSection">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card ">
                            <div class="card-header bg-hexagons">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 2em;">1794.RBK <span class="text-muted font-medium-1">(EMBUNG/DAMPARIT/POMPA/PIPA/AIR TANAH)</span></h4>
                            </div>
                            <div class="card-content collapse show bg-hexagons">
                                <div class="card-body pt-0 pb-1">
                                    <div class="media d-flex">
                                        <div class="align-self-center width-100">
                                            <div id="statistics-donut-chart" class="height-100 donutShadow"><i class="la la-money text-success font-large-5 float-left"></i></div>
                                        </div>
                                        <div class="media-body text-right mt-2">
                                            <h3 class=" font-large-1 blue-grey font-weight-bold" style="font-family: Calibri !important;" id="total-spent">Rp. 18.812.000.000,-
                                            </h3>
                                            <h6 class="mt-1">
                                                <span class="text-muted font-medium-3" style="font-family: Calibri !important;">telah teralokasi dari total <strong class="text-success">Rp. 33.750.000.000,-</strong></span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card ">
                            <div class="card-header bg-hexagons">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 2em;">1794.AEA <span class="text-muted font-medium-1">(RJIT/NORMALISASI)</span></h4>
                            </div>
                            <div class="card-content collapse show bg-hexagons">
                                <div class="card-body pt-0 pb-1">
                                    <div class="media d-flex">
                                        <div class="align-self-center width-100">
                                            <div id="statistics-donut-chart" class="height-100 donutShadow"><i class="la la-money text-success font-large-5 float-left"></i></div>
                                        </div>
                                        <div class="media-body text-right mt-2">
                                            <h3 class=" font-large-1 blue-grey font-weight-bold" style="font-family: Calibri !important;">Rp. 0,-
                                            </h3>
                                            <h6 class="mt-1">
                                                <span class="text-muted font-medium-3" style="font-family: Calibri !important;">telah teralokasi dari total <strong class="text-success">Rp. 4.179.136.000,-</strong></span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">DAFTAR PENOMORAN</h4>
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

                                    <table class="table table-responsive" id="dataTablePengajuan" style="font-family: Arial !important;" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="width: 1%">Aksi</th>
                                                <th scope="col" style="width: 10%">Provinsi / Kab. / Kota</th>
                                                <!-- <th scope="col" style="width: 25%;">Surat</th> -->
                                                <th scope="col" style="width: 40%;">Nomor Surat</th>
                                                <th scope="col" style="width: 12%;">Tanggal</th>
                                                <th scope="col" style="width: 18%;">Nama Penerima Banpem</th>
                                                <th scope="col" style="width: 10%;">Jumlah Dana Banpem</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showDataPengajuan">
                                            <!-- <tr>
                                                <td scope="col" style="width: 3%;">
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop12" type="button" class="btn btn-sm btn-icon btn-pure font-medium-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ft-more-vertical"></i>
                                                        </button>
                                                        <span aria-labelledby="btnSearchDrop12" class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="javascript:;" class="dropdown-item viewProposal" data="">
                                                                <i class="ft-download"></i> Unduh Dokumen Verifikasi</a>
                                                        </span>
                                                    </span>
                                                </td>
                                                <td scope="col" style="width: 10%;">
                                                    <p class="custom-padding">Kegiatan</p>
                                                    <p class="custom-padding">Provinsi</p>
                                                    <p class="custom-padding">Kabupaten</p>
                                                </td>
                                                <td scope="col" style="width: 23%;">
                                                    <p class="custom-padding">SK TIM TEKNIS</p>
                                                    <p class="custom-padding">SK PENERIMA MANFAAT</p>
                                                    <p class="custom-padding">SPKS</p>
                                                </td>
                                                <td scope="col" style="width: 21%;">
                                                    <p class="custom-padding">14.01.a.III/Kpts/PPK.7/08/2022</p>
                                                    <p class="custom-padding">14.01.b.III/Kpts/PPK.7/08/2022</p>
                                                    <p class="custom-padding">14.01.01.III/PPK.PSP.7/SPK/08/2022</p>
                                                    <p class="custom-padding">14.02.01.III/PPK.PSP.7/SPK/08/2022</p>
                                                </td>
                                                <td scope="col" style="width: 25%;">
                                                    <p class="custom-padding">Rabu, 13 September 2022</p>
                                                </td>
                                                <td scope="col" style="width: 10%;">
                                                    <p class="custom-padding">UPKK Kelompok Tani Manjur</p>
                                                </td>
                                                <td scope="col" style="width: 11%;" class="text-center">
                                                    <p class="custom-padding">Rp. 123.000.000</p>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF HEADER SIDE -->
                <!-- <div class="row float-md-right">
                    <div class="col-md-12" style="font-family: Calibri !important; font-size: 1.3em;"> -->
                <!-- <a href="" id="btn-surat-alokasi" class="btn btn-icon btn-md btn-warning mb-2 font-medium-2 mr-1" style="font-size: 13px;"><i class="la la-file-pdf-o"></i> &nbsp;Surat Alokasi</a>
                        <a href="" id="btn-nota-dinas" class="btn btn-icon btn-md btn-info mb-2 font-medium-2 mr-1" style="font-size: 13px;"><i class="la la-file-pdf-o"></i> &nbsp;Cetak Nota Dinas</a>
                        <a href="" id="btn-export" class="btn btn-icon btn-md btn-info mb-2 font-medium-2" style="font-size: 13px; background-color: #18D26E; color: #fff;"><i class="la la-file-pdf-o"></i> &nbsp;Ekspor Data</a> -->
                <!-- <input type="button" id="cancelSubmission" class="btn btn-danger btn-min-width mb-2" placeholder="" name="cancelSubmission" value="Batalkan Pengajuan"> -->
                <!-- </div>
                </div> -->

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
                        <p class="text-left"><small class="text-muted">Beri tanda (-) apabila tidak ada catatan.</small></p>
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

<!-- MODAL PREVIEW -->
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
                <!-- <input type="text"> -->
                <iframe src="" style="width:100%; height:600px;" frameborder="0" id="doc-frame"></iframe>
                <div class="form-group row mt-3 mr-3 ml-3">
                    <label for="pic" class="label-control col-md-3">Nama PIC Verifikator</label>
                    <div class="col-md-9">
                        <input type="hidden" id="id-proposal" name="id-proposal">
                        <input type="text" class="form-control" id="pic" name="pic" value="" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btnVerif" class="btn btn-success" style="background-color: #18D26E; color: #fff;">Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const base_theme = '<?= BASE_THEME; ?>';
        const base_url = '<?= BASE_URL; ?>';
        showDataPenomoran();

        $('#dataTablePengajuan').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            autoWidth: false,
            scrollX: true,
            // scrollY: "410px",
            // paging: false,
            // searching: false,
            // info: false,
            // destroy: true,
            // retrieve: true
        });


        $('#btnVerif').click(function() {
            let id_proposal = $('#id-proposal').val();
            let pic = $('#pic').val();

            if (id_proposal != '') {
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: '<?= BASE_URL . 'pengajuan/verifikasi-penomoran'; ?>',
                    data: {
                        id_proposal: id_proposal,
                        pic: pic
                    },
                    async: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#modal-preview-document').modal('hide');

                            swal("Selamat!", "Verifikasi berhasil!", "success");
                            showDataPenomoran();
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

        //EXPORT TELAAH PENGAJUAN
        $('#showDataPengajuan').on('click', '.btn-export', function() {
            let id_kabupatenkota = $('#kabupaten').val();
            let id_proposal = $('#nomor-surat').val();
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU DOKUMEN TELAAH');
            $('#btnVerif').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/export-telaah'; ?>',
                data: {
                    id_kabupatenkota: id_kabupatenkota,
                    id_proposal: id_proposal,
                    url: kegiatan
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#doc-frame').attr('src', base_theme + response + '#zoom=100%');
                },
                error: function(e) {
                    console.log(e.responseText);
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        //PRATINJAU DOKUMEN VERIFIKASI
        $('#showDataPengajuan').on('click', '.pratinjau', function() {
            let id_pengajuan = $(this).attr('data');
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU DOKUMEN VERIFIKASI');
            $('#btnVerif').hide();
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

        //CETAK DOKUMEN VERIFIKASI
        $('#showDataPengajuan').on('click', '.cetak-dokumen-verifikasi', function() {
            let id_proposal = $('#nomor-surat').val();
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU DOKUMEN VERIFIKASI');
            $('#btnVerif').hide();
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

        //GENERATE NOTA DINAS
        $('#showDataPengajuan').on('click', '.btn-nota-dinas', function() {
            let id_kabupatenkota = $('#kabupaten').val();
            let id_proposal = $('#nomor-surat').val();
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU NOTA DINAS');
            $('#btnVerif').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/generate-nota-dinas'; ?>',
                data: {
                    id_kabupatenkota: id_kabupatenkota,
                    id_proposal: id_proposal,
                    url: kegiatan
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#doc-frame').attr('src', base_theme + response + '#zoom=100%');
                },
                error: function(e) {
                    console.log(e.responseText);
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        //GENERATE SURAT PENERBITAN
        $('#showDataPengajuan').on('click', '.btn-surat-penerbitan', function() {
            let id_kabupatenkota = $('#kabupaten').val();
            let id_proposal = $('#nomor-surat').val();
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU SURAT PENERBITAN');
            $('#btnVerif').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/generate-surat-penerbitan'; ?>',
                data: {
                    id_kabupatenkota: id_kabupatenkota,
                    id_proposal: id_proposal,
                    url: kegiatan
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#doc-frame').attr('src', base_theme + response + '#zoom=100%');
                },
                error: function(e) {
                    console.log(e.responseText);
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        // CLEAR TEMP FILES
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

        //CETAK DOKUMEN VERIFIKASI
        $('#showDataPengajuan').on('click', '.pratinjau-syarat', function() {
            let id_proposal = $(this).attr('data');
            $('#modal-preview-document').modal('show');
            $('#modal-preview-document').find('.modal-title').text('PRATINJAU SYARAT PENOMORAN');
            // $('#btnVerif').hide();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/lihat-syarat-penomoran'; ?>',
                data: {
                    id_proposal: id_proposal
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#id-proposal').val(id_proposal);
                    $('#doc-frame').attr('src', base_theme + response);
                },
                error: function() {
                    swal("Internal Server error 500!", "Error!", "error");
                }
            });
        });

        //SHOW DATA PENGAJUAN
        function showDataPenomoran() {
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?= BASE_URL . 'pengajuan/list-data-penomoran'; ?>',
                // data: {
                //     id_kabupatenkota: id_kabupatenkota,
                //     id_proposal: id_proposal
                // },
                async: false,
                dataType: 'json',
                success: function(data) {
                    let html = '';
                    let totalSpent = 0;
                    // let i;
                    // let jmlTerverif = 0;
                    // let generated = false;

                    // for (i = 0; i < data.length; i++) {
                    //     if ((data[i].kode).toLowerCase() == 'dvr' || (data[i].kode).toLowerCase() == 'ppnmr') {
                    //         jmlTerverif++;
                    //     }
                    // }
                    // console.log(jmlTerverif)
                    // for (i = 0; i < data.length; i++) {
                    // let disabled = ['', 'disabled'];
                    // let btnColor = ['light', 'info', 'success', 'warning'];
                    // let classId = ['layak', 'btn-export', 'btn-nota-dinas', 'btn-surat-penerbitan']
                    // let title = ['Tandai sudah ditelaah', 'Ekspor Data Telaah', 'Cetak Nota Dinas', 'Cetak Surat Penerbitan', 'Cetak Dokumen Verifikasi']
                    // let style = 'color: #fff;';
                    // let actionTd = '';

                    // if (data.length == jmlTerverif) {
                    //     if (!generated) {
                    //         styleTd = 'vertical-align: top;';
                    //         icon = 'ft-printer';
                    //         rowspan = `rowspan="${ jmlTerverif }"`;
                    //         actionTd = `<td scope="col" ${ rowspan } style="width: 5%; ${ styleTd }">
                    //                 <a href="javascript:;" class="btn btn-md btn-icon btn-danger cetak-dokumen-verifikasi ${ disabled[0] }" style="margin-left:0px; margin-bottom: 10px; ${ style }" data-toggle="tooltip" data-placement="right" title="${ title[4] }" data="${data[i].id_pengajuan}"><i class="${ icon }"></i></a>
                    //                 <a href="javascript:;" class="btn btn-md btn-icon btn-${ btnColor[1] } ${ classId[1] } ${ disabled[0] }" style="margin-left:0px; margin-bottom: 10px; ${ style }" data-toggle="tooltip" data-placement="right" title="${ title[1] }" data="${data[i].id_pengajuan}"><i class="${ icon }"></i></a>
                    //                 <a href="javascript:;" class="btn btn-md btn-icon btn-${ btnColor[2] } ${ classId[2] } ${ disabled[0] }" style="margin-left:0px; margin-bottom: 10px; ${ style }" data-toggle="tooltip" data-placement="right" title="${ title[2] }" data="${data[i].id_pengajuan}"><i class="${ icon }"></i></a>
                    //                 <a href="javascript:;" class="btn btn-md btn-icon btn-${ btnColor[3] } ${ classId[3] } ${ disabled[0] }" style="margin-left:0px; margin-bottom: 10px; ${ style }" data-toggle="tooltip" data-placement="right" title="${ title[3] }" data="${data[i].id_pengajuan}"><i class="${ icon }"></i></a>
                    //             </td>`;
                    //         generated = true;
                    //     }
                    // } else {
                    //     styleTd = '';
                    //     rowspan = '';
                    //     icon = 'ft-check';

                    //     actionTd = `<td scope="col" ${ rowspan } style="width: 5%; ${ styleTd }">
                    //         <a href="javascript:;" class="btn btn-md btn-icon btn-info pratinjau" style="margin-left:0px; margin-bottom: 10px;" data-toggle="tooltip" data-placement="right" title="Pratinjau Dokumen Verifikasi" data="${data[i].id_pengajuan}"><i class="ft-search"></i></a>
                    //         <a href="javascript:;" class="btn btn-md btn-icon btn-${ (data[i].nama_status).toLowerCase() == 'sudah diverifikasi' ? btnColor[0] : btnColor[2] } ${ classId[0] } ${ (data[i].nama_status).toLowerCase() == 'sudah diverifikasi' ? disabled[1] : disabled[0] }" style="margin-left:0px; ${ (data[i].nama_status).toLowerCase() != 'sudah diverifikasi' ? 'background-color: #18D26E; color: #fff;' : style }" data-toggle="tooltip" data-placement="right" title="${ title[0] }" data="${data[i].id_pengajuan}"><i class="${ icon }"></i></a>                                        
                    //         </td>`;
                    // }
                    for (i = 0; i < data.length; i++) {
                        let namaPoktan = '';
                        let namaPoktanKwitansi = '';
                        let spks = '';
                        let space = '';
                        let nominal = '';
                        let nominalDiterima = '';
                        let kwitansi = '';
                        let dataSPKS = data[i].spks;
                        let dataKwitansi = data[i].kwitansi;
                        let countNominal = 0;

                        for (j = 0, idj = 1; j < dataSPKS.length; j++, idj + 2) {
                            spks += `<p class="custom-padding">SPKS ( <strong class="text-success">${ dataSPKS[j].nomor_sk }</strong> )</p>`;
                            namaPoktan += `<p class="custom-padding">UPKK ${ dataSPKS[j].nama_poktan }</p>`;
                            namaPoktanKwitansi += `<p class="custom-padding">UPKK ${ dataSPKS[j].nama_poktan }</p>`;
                            nominal += `<p class="custom-padding">Rp. ${ Number(dataSPKS[j].nominal).toLocaleString('id') },-</p>`;
                            countNominal += Number(dataSPKS[j].nominal);
                            if (dataSPKS.length > 1) {
                                namaPoktanKwitansi += `<p class="custom-padding text-white">.</p><p class="custom-padding text-white">.</p>`;
                            }
                            space += `<p class="custom-padding text-white">.</p>`;
                        }

                        for (k = 0, idk = 1; k < dataKwitansi.length; k++, idk + 2) {
                            kwitansi += `<p class="custom-padding">${ dataKwitansi[k].tahap } ( <strong class="text-success">${ dataKwitansi[k].nomor_kwitansi }</strong> )</p>`;
                            nominalDiterima += `<p class="custom-padding">Rp. ${ Number(dataKwitansi[k].nominal_diterima).toLocaleString('id') },-</p>`;
                            if (dataKwitansi.length > 2 && k == idk) {
                                kwitansi += `<p class="custom-padding text-white">.</p>`;
                                nominalDiterima += `<p class="custom-padding text-white">.</p>`;
                            }
                        }

                        totalSpent += countNominal;
                        let formatted = `Rp. ${ totalSpent.toLocaleString('id') },-`;
                        $('#total-spent').text(formatted);

                        let setClass = data[i].status == 'TNMR' ? 'disabled' : 'pratinjau-syarat';

                        html += `<tr>
                                    <td scope="col" style="width: 1%;">
                                        <span class="dropdown">
                                            <button id="btnSearchDrop12" type="button" class="btn btn-sm btn-icon btn-pure font-medium-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ft-more-vertical"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop12" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="javascript:;" class="dropdown-item ${ setClass }" data="${ data[i].id_proposal }">
                                                    <i class="ft-check"></i> Verifikasi Penomoran
                                                </a>
                                            </span>
                                        </span>
                                    </td>
                                    <td scope="col" style="width: 10%;">
                                        <p class="custom-padding"><strong>${ (data[i].kegiatan).toUpperCase() }</strong></p>
                                        <p class="custom-padding">Prov. ${ capitalize(data[i].nama_provinsi) }</p>
                                        <p class="custom-padding">${ capitalize(data[i].nama_kabupaten) }</p>
                                    </td>
                                    <td scope="col" style="width: 40%;">
                                        <p class="custom-padding">SK TIM TEKNIS ( <strong class="text-success"> ${ data[i].sk_tim_teknis } </strong> )</p>
                                        <p class="custom-padding">SK PENERIMA MANFAAT ( <strong class="text-success"> ${ data[i].sk_penerima } </strong> )</p>
                                        ${ spks }
                                        <p class="custom-padding text-center text-white" style="border-top: 1px solid #CDCDCD;"><strong class="text-black">.</strong></p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ kwitansi }
                                    </td>
                                    <td scope="col" style="width: 12%;">
                                        <p class="custom-padding">${ data[i].tgl_ppk }</p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ space }
                                        <p class="custom-padding text-center text-white" style="border-top: 1px solid #CDCDCD;"><strong class="text-black">.</strong></p>
                                    </td>
                                    <td scope="col" style="width: 18%;">
                                        <p class="custom-padding text-white">.</p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ namaPoktan }
                                        <p class="custom-padding text-center" style="border-top: 1px solid #CDCDCD;"><strong class="text-black">JUMLAH</strong></p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ namaPoktanKwitansi }
                                    </td>
                                    <td scope="col" style="width: 10%;" class="text-right">
                                        <p class="custom-padding text-white">.</p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ nominal }
                                        <p class="custom-padding text-right text-success" style="border-top: 1px solid #CDCDCD;"><strong class="text-black">Rp. ${ countNominal.toLocaleString('id') },-</strong></p>
                                        <p class="custom-padding text-white">.</p>
                                        ${ nominalDiterima }
                                    </td>
                                </tr>`;
                    }
                    $('#showDataPengajuan').html(html);
                    $('[data-toggle="tooltip"]').tooltip();

                    // if ($.fn.DataTable.isDataTable('#dataTablePengajuan')) {
                    //     myTable.clear().destroy();
                    // }

                    // let myTable = $('#dataTablePengajuan').DataTable({
                    //     "lengthMenu": [
                    //         [5, 10, 25, 50, -1],
                    //         [5, 10, 25, 50, "All"]
                    //     ],
                    //     autoWidth: false,
                    //     scrollX: true,
                    //     // scrollY: "410px",
                    //     paging: false,
                    //     searching: false,
                    //     info: false,
                    //     destroy: true,
                    //     retrieve: true
                    // });

                    // $('#detailSection').show(function() {
                    //     myTable.columns.adjust();
                    // });
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