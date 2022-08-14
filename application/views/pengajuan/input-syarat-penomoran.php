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
            <section id="drag-area">
                <?= $this->session->flashdata('message'); ?>
                <!-- HEADER SIDE OF REGISTRASI Rujuk -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">SURAT PROPOSAL</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show" style="font-family: Calibri !important; font-size: 1.3em;">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nomor-surat">Nomor Surat <span class="danger">*</span></label>
                                        <div class="col-md-9">
                                            <select id="nomor-surat" class="select2 job form-control required" placeholder="" name="nomor-surat"></select>
                                            <p class="text-left text-danger" style="margin-top: 5px;" id="error-nomor-surat">This field is required!</p>
                                        </div>
                                    </div>

                                    <div class="form-group row float-md-right">
                                        <div class="col-md-12">
                                            <input type="button" id="nextToDetail" class="btn btn-md btn-min-width mb-1" style="background-color: #18D26E; color: #fff;" placeholder="" name="nextToDetail" value="Selanjutnya">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF HEADER SIDE -->

                <!-- MAIN SIDE OF REGISTRASI NIKAH -->
                <div class="row" id="detailSection">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">FORM SYARAT PENOMORAN</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show" style="font-family: Calibri !important; font-size: 1.3em;">
                                <div class="card-body">
                                    <?= form_open_multipart('pengajuan/submit-syarat-penomoran/' . $data['pengajuan']['id_pengajuan'], 'class="steps-validation" id="form"'); ?>
                                    <!-- <input type="hidden" id="regID" name="regID"> -->
                                    <input type="hidden" id="url" name="url" value="<?= $kegiatan; ?>">
                                    <input type="hidden" id="id-poktan" name="id-poktan" value="<?= $data['poktan']['id_poktan'] ?>">
                                    <input type="hidden" id="nama-kabupaten" name="nama-kabupaten" value="">
                                    <input type="hidden" id="nama-kecamatan" name="nama-kecamatan" value="">
                                    <input type="hidden" id="nama-kelurahan" name="nama-kelurahan" value="<?= $data['nama_kelurahan'] ?>">
                                    <input type="hidden" id="id-proposal" name="id-proposal" value="<?= $data['id_proposal'] ?>">


                                    <!-- LOKASI KEGIATAN -->
                                    <h6><i class="step-icon ft-activity"></i> DETAIL KEGIATAN</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <input type="hidden" name="id-lokasi" id="id-lokasi" value="<?= $data['lokasi']['id_lokasi'] ?>">
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
                                            <label class="col-md-3 label-control" for="nama-kegiatan">Nama Kegiatan <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-kegiatan" class="form-control required" placeholder="" name="nama-kegiatan" value="<?= strtoupper(str_replace('-', ' ', $kegiatan)) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="luas-layanan">Luas (Ha) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" id="luas-layanan" class="form-control required" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" placeholder="" name="luas-layanan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="perkiraan-biaya">Nominal Anggaran (Rp) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="hidden" name="nominal" id="nominal" value="<?= $data['pengajuan']['perkiraan_biaya'] ?>">
                                                <input type="text" id="perkiraan-biaya" class="form-control required price " placeholder="" name="perkiraan-biaya" value="<?= 'Rp. ' . number_format($data['pengajuan']['perkiraan_biaya'], 0, ',', '.') ?>">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- URAIAN BANPEM -->
                                    <h6><i class="step-icon ft-package"></i>URAIAN BANPEM</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <input type="hidden" name="id-poktan" id="id-poktan" value="<?= $data['poktan']['id_poktan'] ?>">
                                            <label class="col-md-3 label-control" for="nama-poktan">Nama Kelompok Tani <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-poktan" class="form-control required" placeholder="" name="nama-poktan" value="<?= strtoupper($data['poktan']['nama_poktan']) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-ketua">Nama Ketua <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-ketua" class="form-control required" placeholder="" name="nama-ketua" value="<?= strtoupper($data['poktan']['nama_ketua']) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nik-ketua">NIK Ketua <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nik-ketua" class="form-control required nik" placeholder="" name="nik-ketua" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="no-hp-ketua">No. HP Ketua <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="no-hp-ketua" class="form-control required mobile-phone" placeholder="" name="no-hp-ketua" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-koord-upkk">Nama Koordinator UPKK <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-koord-upkk" class="form-control required" placeholder="" name="nama-koord-upkk" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nik-koord-upkk">NIK Koordinator UPKK <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nik-koord-upkk" class="form-control required nik" placeholder="" name="nik-koord-upkk" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="penggunaan">Penggunaan <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="penggunaan" class="form-control required" placeholder="" name="penggunaan" value="">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- DATA REKENING PENERIMA -->
                                    <h6><i class="step-icon la la-money"></i>DATA REKENING PENERIMA</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-bank">Nama Bank <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-bank" class="form-control required" placeholder="" name="nama-bank" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="no-rekening">No. Rekening <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="no-rekening" class="form-control required" placeholder="" name="no-rekening" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-rekening">Nama Pemilik Rekening <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-rekening" class="form-control required" placeholder="" name="nama-rekening" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="tgl-rekening">Tanggal Pembukaan Rekening <span class="danger">*</span></label>
                                            <div class="col-md-9 position-relative datepicker">
                                                <input type="text" id="tgl-rekening" class="form-control" name="tgl-rekening">
                                                <!-- <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div> -->
                                            </div>
                                            <!-- <div class="col-md-9">
                                                <input type="text" id="tgl-rekening" class="form-control required" placeholder="" name="tgl-rekening" value="">
                                            </div> -->
                                        </div>
                                    </fieldset>

                                    <!-- KETERANGAN -->
                                    <h6><i class="step-icon ft-image"></i>UNGGAH BERKAS</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                                    <div class="card-content collapse show">
                                                        <div class="card-body">
                                                            <p class="card-text" style="font-family: Calibri !important; font-size: 1em;"><i class="ft-alert-triangle"></i>&nbsp; Jenis dokumen berupa file foto yang bertipe <strong>.JPG / .PNG / .JPEG</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="doc-scan-ktp">Scan KTP <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-scan-ktp" id="doc-scan-ktp" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-scan-ktp', 'label-scan-ktp')">
                                                    <label for="doc-scan-ktp" class="custom-file-label" id="label-scan-ktp"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="doc-scan-buktab">Scan Buku Tabungan <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-scan-buktab" id="doc-scan-buktab" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-scan-buktab', 'label-scan-buktab')">
                                                    <label for="doc-scan-buktab" class="custom-file-label" id="label-scan-buktab"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label class="col-md-3 label-control" for="doc-scan-rekaktif">Surat Rekening Aktif <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-scan-rekaktif" id="doc-scan-rekaktif" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-scan-rekaktif', 'label-scan-rekaktif')">
                                                    <label for="doc-scan-rekaktif" class="custom-file-label" id="label-scan-rekaktif"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF MAIN SIDE -->
                <div class="row float-md-right">
                    <div class="col-md-12" style="font-family: Calibri !important; font-size: 1.5em;">
                        <input type="button" id="cancelSubmission" class="btn btn-danger btn-min-width mb-2" placeholder="" name="cancelSubmission" value="Batalkan Pengajuan">
                    </div>
                </div>
            </section>
        </div>
    </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="<?= BASE_THEME; ?>v4/vendor/jquery/jquery.min.js"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/forms/validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/extensions/sweetalert2.all.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/id.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>datetime/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?= BASE_THEME ?>adm/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/core/app.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/forms/wizard-steps.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script>
        $(function() {

            // $('#nama-rekening').on('change', function() {
            //     alert($('#tgl-rekening').val())
            // })

            $('#tgl-rekening').datetimepicker({
                locale: 'id',
                format: 'DD-MM-YYYY HH:mm:ss',
                maxDate: moment().add(0, 'days')
            });

            const kegiatan = '<?= $kegiatan ?>';
            let numberLength = 0;
            let value_luas_layanan = '<?= $data['pengajuan']['luas_layanan'] ?>';
            $('#luas-layanan').val(parseFloat(value_luas_layanan.split(' ')[0].replace(',', '.')).toFixed(2));

            validateNumber('price');
            validateNumber('number');
            validateNumber('nik');
            validateMobilePhone();

            $('#error-nomor-surat').hide();
            $('#cancelSubmission').hide();

            let selected_id = '<?= $data['id_proposal'] ?>';
            let selected_text = '<?= $data['nomor_surat'] ?>';
            $('#nomor-surat').select2({
                allowClear: true,
                width: '100%',
                data: [{
                    id: selected_id,
                    text: selected_text
                }],
                placeholder: 'PILIH NOMOR SURAT',
                ajax: {
                    url: '<?= BASE_URL ?>pengajuan/cari-nomor-surat',
                    dataType: 'json',
                    delay: 750,
                    data: function(params) {
                        return {
                            q: params.term, // search term                            
                        };
                    },
                    processResults: function(data) {
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
                },
                tags: true,
            });

            $('#nomor-surat').on('change', function() {
                $('#error-nomor-surat').hide();
            });

            // $('#nextToDetail').on('click', function() {
            let surat = $('#nomor-surat').select2('data');
            if (surat != '') {
                // $('#id-proposal').val(surat[0].text);
                $('#detailSection').show();
                $('#nextToDetail').attr('disabled', true);
                $('#nomor-surat').attr('disabled', true);
                // }

                const p_bak_penampung = $('#p-bak-penampung').val();
                const l_bak_penampung = $('#l-bak-penampung').val();
                const t_bak_penampung = $('#t-bak-penampung').val();

                const p_rumah_pompa = $('#p-rumah-pompa').val();
                const l_rumah_pompa = $('#l-rumah-pompa').val();
                const t_rumah_pompa = $('#t-rumah-pompa').val();

                if (p_bak_penampung != '' && l_bak_penampung != '' && t_bak_penampung != '') {
                    const bak_penampung = `${parseFloat(p_bak_penampung).toFixed(1).replace('.', ',')} m x ${parseFloat(l_bak_penampung).toFixed(1).replace('.', ',')} m x ${parseFloat(t_bak_penampung).toFixed(1).replace('.', ',')} m`;
                    $('#bak-penampung').val(bak_penampung);
                }

                if (p_rumah_pompa != '' && l_rumah_pompa != '' && t_rumah_pompa != '') {
                    const rumah_pompa = `${parseFloat(p_rumah_pompa).toFixed(1).replace('.', ',')} m x ${parseFloat(l_rumah_pompa).toFixed(1).replace('.', ',')} m x ${parseFloat(t_rumah_pompa).toFixed(1).replace('.', ',')} m`;
                    $('#rumah-pompa').val(rumah_pompa);
                }

                // let kelurahan = $('#desa').select2('data');
                // $('#nama-kelurahan').val(kelurahan[0].text);
            } else {
                $('#error-nomor-surat').show();
            }
            // });


            $('#kabupaten').prop('disabled', true);
            $('#kecamatan').prop('disabled', true);
            $('#desa').attr('disabled', true);
            $('#nama-kegiatan').attr('readonly', true);
            $('#luas-layanan').attr('readonly', true);
            $('#perkiraan-biaya').attr('readonly', true);

            $('#nama-poktan').attr('readonly', true);
            $('#nama-ketua').attr('readonly', true);

            $("#kecamatan").select2({
                placeholder: "PILIH KECAMATAN",
            });

            let selected_kelurahan_id = '<?= $data['id_kelurahan'] ?>';
            let selected_kelurahan_text = '<?= $data['nama_kelurahan'] ?>';
            $("#desa").select2({
                placeholder: "PILIH DESA",
                data: [{
                    id: selected_kelurahan_id,
                    text: selected_kelurahan_text
                }],
            });

            const lahan_sawah = '<?= $data['pengajuan']['lahan_sawah'] ?>';
            $("#lahan-sawah").val(lahan_sawah).trigger('change');
            $("#lahan-sawah").select2({
                width: '100%',
            });

            // INISIALISASI RUMAH POMPA DAN BAK PENAMPUNG
            $('#t-rumah-pompa').on('change', function() {
                const p_bak_penampung = $('#p-bak-penampung').val();
                const l_bak_penampung = $('#l-bak-penampung').val();
                const t_bak_penampung = $('#t-bak-penampung').val();

                const p_rumah_pompa = $('#p-rumah-pompa').val();
                const l_rumah_pompa = $('#l-rumah-pompa').val();
                const t_rumah_pompa = $('#t-rumah-pompa').val();

                if (p_bak_penampung != '' && l_bak_penampung != '' && t_bak_penampung != '') {
                    const bak_penampung = `${parseFloat(p_bak_penampung).toFixed(1).replace('.', ',')} m x ${parseFloat(l_bak_penampung).toFixed(1).replace('.', ',')} m x ${parseFloat(t_bak_penampung).toFixed(1).replace('.', ',')} m`;
                    $('#bak-penampung').val(bak_penampung);
                }

                if (p_rumah_pompa != '' && l_rumah_pompa != '' && t_rumah_pompa != '') {
                    const rumah_pompa = `${parseFloat(p_rumah_pompa).toFixed(1).replace('.', ',')} m x ${parseFloat(l_rumah_pompa).toFixed(1).replace('.', ',')} m x ${parseFloat(t_rumah_pompa).toFixed(1).replace('.', ',')} m`;
                    $('#rumah-pompa').val(rumah_pompa);
                }

                // let kelurahan = $('#desa').select2('data');
                // $('#nama-kelurahan').val(kelurahan[0].text);

            })

            id_kota = '<?= $data['id_kabupatenkota'] ?>';
            let dataKota = []
            $('#id-kabupaten').val(id_kota);
            $.ajax({
                type: 'ajax',
                url: '<?= BASE_URL ?>pengajuan/cari-kota',
                async: false,
                dataType: 'json',
                success: function(response) {
                    for (var i = 0; i < response.length; i++) {
                        if (response[i].id_kabupatenkota == id_kota) {
                            var obj = {
                                id: response[i].id_kabupatenkota,
                                text: response[i].nama
                            };
                            $('#nama-kabupaten').val(response[i].nama);
                            dataKota.push(obj);
                        }
                    }
                },
            });

            $('#kabupaten').select2({
                width: '100%',
                placeholder: 'PILIH KABUPATEN / KOTA',
                data: dataKota,
            });

            let selected_kecamatan_id = '<?= $data['id_kecamatan'] ?>';
            let selected_kecamatan_text = '<?= $data['nama_kecamatan'] ?>';
            $('#nama-kecamatan').val(selected_kecamatan_text);
            $('#kecamatan').select2({
                width: '100%',
                placeholder: 'PILIH KECAMATAN',
                data: [{
                    id: selected_kecamatan_id,
                    text: selected_kecamatan_text
                }],
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
                    url: '<?= BASE_URL ?>pengajuan/cari-kecamatan/' + id_kota,
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
                                if (item.id_kecamatan !== '') {
                                    return {
                                        id: item.id_kecamatan,
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

            $('#kecamatan').on('change', function() {
                $('#desa').removeAttr('disabled');
                $('#desa').val(null).trigger('change');

                id_kecamatan = $('#kecamatan').find(':selected').val();

                let kecamatan = $('#kecamatan').select2('data');
                $('#nama-kecamatan').val(kecamatan[0].text);

                let kelurahan = $('#desa').select2('data');
                $('#nama-kelurahan').val(kelurahan[0].text);
                let selected_kelurahan_id = '<?= $data['id_kelurahan'] ?>';
                let selected_kelurahan_text = '<?= $data['nama_kelurahan'] ?>';

                $('#desa').select2({
                    width: '100%',
                    placeholder: 'PILIH DESA',
                    data: [{
                        id: selected_kelurahan_id,
                        text: selected_kelurahan_text
                    }],
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
                        url: '<?= BASE_URL ?>pengajuan/cari-desa/' + id_kecamatan,
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
                                    if (item.id_kelurahan !== '') {
                                        return {
                                            id: item.id_kelurahan,
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
        });

        function validateMobilePhone() {
            $('.mobile-phone').on('keyup', function(e) {
                numberLength = $('.mobile-phone').val().length;
            });

            $('.mobile-phone').on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                var currentNum = 48;
                // for 13 digit number only
                if ($this.val().length > 12) {
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

        function validateNumber(component) {
            $('.' + component).on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                // var regex = new RegExp("^[0-9]+(?:\,[0-9]{1,2})?$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

                if (component == 'nik') {
                    if ($this.val().length > 15) {
                        e.preventDefault();
                        return false;
                    }
                }

                if (regex.test(str)) {
                    if (component == 'price') {
                        maskNumber(this);
                    }
                    return true;
                }

                e.preventDefault();
                return false;
            });
        }

        function maskNumber(component) {
            $(component).on('keyup', function(event) {
                // When user select text in the document, also abort.
                var selection = window.getSelection().toString();
                if (selection !== '') {
                    return;
                }
                // When the arrow keys are pressed, abort.
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                    return;
                }
                var $this = $(this);
                // Get the value.
                var input = $this.val();
                if (input.indexOf('-') > -1) {
                    if (hasNumbers(input)) {
                        input = input ? "-" + parseFloat(input.replace(/[\D\s\._\-]+/g, ""), 10).toLocaleString("id-ID") : "-";
                    } else {
                        input = "-";
                    }
                } else {
                    input = input ? parseInt(input.replace(/[\D\s\._\-]+/g, ""), 10).toLocaleString("id-ID") : 0;
                }
                // var input = input.replace(/[\D\s\._\-]+/g, "");
                $this.val(function() {
                    // return ( input === 0 ) ? "" : input.toLocaleString( "id-ID" );
                    return input;
                });
            });
        }

        function getFileNameOfImage(inputId, id) {
            let fileName = $('#' + inputId).val().split('\\').pop();
            $('#' + id).addClass('selected').html(fileName);
        }
    </script>
    </body>

    </html>