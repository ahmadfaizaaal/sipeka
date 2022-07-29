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
                                <h4 class="card-title" style="font-family: Calibri !important; font-size: 1.5em;">FORM PENGAJUAN BARU</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show" style="font-family: Calibri !important; font-size: 1.3em;">
                                <div class="card-body">
                                    <?= form_open_multipart('pengajuan/submitForm', 'class="steps-validation" id="form"'); ?>
                                    <!-- <input type="hidden" id="regID" name="regID"> -->
                                    <input type="hidden" id="id-jenis" name="id-jenis" value="<?= $id_jenis; ?>">
                                    <input type="hidden" id="url" name="url" value="<?= $kegiatan; ?>">
                                    <input type="hidden" name="id-proposal" id="id-proposal">
                                    <input type="hidden" id="nama-kabupaten" name="nama-kabupaten" value="">
                                    <input type="hidden" id="nama-kecamatan" name="nama-kecamatan" value="">
                                    <input type="hidden" id="nama-kelurahan" name="nama-kelurahan" value="">


                                    <!-- LOKASI KEGIATAN -->
                                    <h6><i class="step-icon ft-map-pin"></i> Lokasi Kegiatan</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
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
                                                <input type="text" id="a-koordinat" class="form-control required" placeholder="" name="a-koordinat">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="b-koordinat" class="form-control required" placeholder="" name="b-koordinat">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- GAPOKTAN / POKTAN -->
                                    <h6><i class="step-icon ft-users"></i>Gapoktan / Poktan</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-poktan">Nama Kelompok Tani <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-poktan" class="form-control required" placeholder="" name="nama-poktan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="nama-ketua">Nama Ketua <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="nama-ketua" class="form-control required" placeholder="" name="nama-ketua">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- DETAIL KEGIATAN -->
                                    <h6><i class="step-icon ft-edit"></i>Detail Kegiatan</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="luas-layanan">Luas Layanan (Ha) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" name="luas-layanan" class="form-control required" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" placeholder="" name="luas-layanan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="unit">Unit <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="unit" class="form-control required number " placeholder="" name="unit">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="perkiraan-biaya">Perkiraan Biaya (Rp) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="perkiraan-biaya" class="form-control required price " placeholder="" name="perkiraan-biaya">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="panjang-jarak">Panjang/Jarak dari Sumber (m) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" id="panjang-jarak" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="panjang-jarak">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="ukuran-pompa">Ukuran Pompa (inch) / Pipa (m) <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" id="ukuran-pompa" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="ukuran-pompa">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <input type="hidden" name="bak-penampung" id="bak-penampung">
                                            <label class="col-md-3 label-control" for="p-bak-penampung">Bak Penampung <span class="danger">*</span></label>
                                            <div class="col-md-3">
                                                <input type="number" id="p-bak-penampung" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="p-bak-penampung">
                                                <p class="text-left"><small class="text-muted">Panjang (m)</small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" id="l-bak-penampung" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="l-bak-penampung">
                                                <p class="text-left"><small class="text-muted">Lebar (m)</small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" id="t-bak-penampung" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="t-bak-penampung">
                                                <p class="text-left"><small class="text-muted">Tinggi (m)</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top: -20px;">
                                            <input type="hidden" name="rumah-pompa" id="rumah-pompa">
                                            <label class="col-md-3 label-control" for="p-rumah-pompa">Rumah Pompa <span class="danger">*</span></label>
                                            <div class="col-md-3">
                                                <input type="number" id="p-rumah-pompa" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="p-rumah-pompa">
                                                <p class="text-left"><small class="text-muted">Panjang (m)</small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" id="l-rumah-pompa" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="l-rumah-pompa">
                                                <p class="text-left"><small class="text-muted">Lebar (m)</small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" id="t-rumah-pompa" class="form-control required " placeholder="" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" name="t-rumah-pompa">
                                                <p class="text-left"><small class="text-muted">Tinggi (m)</small></p>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top: -20px;">
                                            <label class="col-md-3 label-control" for="provitas">Provitas <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" name="provitas" class="form-control required" pattern="^[0-9]+(?:\,[0-9]{1,2})?$" step="0.01" placeholder="" name="provitas">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="ip">IP <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="ip" class="form-control required number " placeholder="" name="ip">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- KETERANGAN -->
                                    <h6><i class="step-icon ft-list"></i>Keterangan</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="lahan-sawah">Lahan sawah merupakan</label>
                                            <div class="col-md-9">
                                                <!-- <input type="hidden" name="lahan" id="lahan"> -->
                                                <select id="lahan-sawah" name="lahan-sawah" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="sumber-air">Sumber air yang digunakan berasal dari</label>
                                            <div class="col-md-9">
                                                <input type="text" id="sumber-air" class="form-control " placeholder="" name="sumber-air">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="komoditas">Komoditas yang ditanam </label>
                                            <div class="col-md-9">
                                                <input type="text" id="komoditas" class="form-control " placeholder="" name="komoditas">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="permasalahan">Permasalahan yang dialami </label>
                                            <div class="col-md-9">
                                                <input type="text" id="permasalahan" class="form-control " placeholder="" name="permasalahan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="rencana-solusi">Rencana solusi </label>
                                            <div class="col-md-9">
                                                <input type="text" id="rencana-solusi" class="form-control " placeholder="" name="rencana-solusi">
                                            </div>
                                        </div>
                                        <div class="form-group row" id="elevasi">
                                            <label class="col-md-3 label-control" for="beda-elevasi">Beda elevasi </label>
                                            <div class="col-md-9">
                                                <input type="text" id="beda-elevasi" class="form-control " placeholder="" name="beda-elevasi">
                                            </div>
                                        </div>

                                        <strong>
                                            <h4 class="card-title mt-3 mb-3" style="font-family: Calibri !important; font-size: 1.1em;">DOKUMENTASI (SUMBER AIR, LOKASI LAHAN / SAWAH DAN CATCHMENT AREA) OPEN CAMERA</h4>
                                        </strong>

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
                                            <label class="col-md-3 label-control" for="doc-plotting-area">Plotting Area <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-plotting-area" id="doc-plotting-area" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-plotting-area', 'label-plotting-area')">
                                                    <label for="doc-plotting-area" class="custom-file-label" id="label-plotting-area"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="doc-sumber-air">Sumber Air <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-sumber-air" id="doc-sumber-air" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-sumber-air', 'label-sumber-air')">
                                                    <label for="doc-sumber-air" class="custom-file-label" id="label-sumber-air"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="doc-lahan-sawah">Lahan Sawah <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc-lahan-sawah" id="doc-lahan-sawah" accept="image/jpg, image/jpeg, image/png" required onchange="getFileNameOfImage('doc-lahan-sawah', 'label-lahan-sawah')">
                                                    <label for="doc-lahan-sawah" class="custom-file-label" id="label-lahan-sawah"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>

                                    <!-- STATUS KELAYAKAN -->
                                    <h6><i class="step-icon ft-check-circle"></i> Status Kelayakan</h6>
                                    <fieldset class="mt-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="status_kelayakan">Status Kelayakan <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <!-- <input type="hidden" name="status-kelayakan" id="status-kelayakan"> -->
                                                <select id="status-kelayakan" name="status-kelayakan" class="form-control required">
                                                    <!-- <option value="none" selected="" disabled="">Pilih salah satu</option> -->
                                                    <option value="LAYAK" selected="">LAYAK</option>
                                                    <option value=" TIDAK LAYAK">TIDAK LAYAK</option>
                                                </select>
                                                <p class="text-left text-danger" style="margin-top: 5px;" id="error-status-kelayakan">This field is required!</p>
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
    <script src="<?= BASE_THEME ?>datetime/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?= BASE_THEME ?>adm/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/core/app.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/forms/wizard-steps.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
    <script src="<?= BASE_THEME ?>adm/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/id.js" type="text/javascript"></script>

    <script>
        $(function() {
            let numberLength = 0;
            validateNumber('price');
            validateNumber('number');
            validateNumber('nik');

            $('#error-nomor-surat').hide();
            $('#error-status-kelayakan').hide();
            $('#detailSection').hide();
            $('#cancelSubmission').hide();
            $('#elevasi').hide();

            const kegiatan = '<?= $kegiatan ?>';

            if (kegiatan == 'perpipaan') {
                $('#elevasi').show();
            } else {
                $('#elevasi').hide();
            }

            $('#status-kelayakan').select2({
                width: '100%',
                placeholder: 'PILIH NOMOR SURAT'
            });

            $('#nomor-surat').select2({
                allowClear: true,
                width: '100%',
                placeholder: 'PILIH NOMOR SURAT',
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
                createTag: function(params) {
                    return {
                        id: 0,
                        text: params.term,
                        newOption: true
                    }
                },
                templateResult: function(data) {
                    var $result = $("<span></span>");

                    $result.text(data.text);

                    if (data.newOption) {
                        $result.append(" <em>(BARU)</em>");
                    }

                    return $result;
                }
            });

            $('#nomor-surat').on('change', function() {
                $('#error-nomor-surat').hide();
            });

            $('#nextToDetail').on('click', function() {
                let surat = $('#nomor-surat').select2('data');
                if (surat != '') {
                    if (surat[0].id == 0) {
                        $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: '<?= BASE_URL . 'pengajuan/insert-nomor-surat'; ?>',
                            data: {
                                nomorSurat: surat[0].text
                            },
                            async: false,
                            dataType: 'json',
                            success: function(data) {
                                if (data != '') {
                                    $('#id-proposal').val(data);
                                    $('#detailSection').show();
                                    $('#cancelRegistration').show();
                                    $('#nextToDetail').attr('disabled', true);
                                } else {
                                    swal("Error!", "Gagal simpan nomor surat!", "error");
                                }
                            },
                            error: function() {
                                swal("Error!", "Internal Server error 500!", "error");
                            }
                        });
                    } else {
                        $('#id-proposal').val(surat[0].id);
                        $('#detailSection').show();
                        $('#cancelSubmission').show();
                        $('#nextToDetail').attr('disabled', true);
                        $('#nomor-surat').attr('disabled', true);
                    }
                } else {
                    $('#error-nomor-surat').show();
                }
            });

            $('#kabupaten').prop('disabled', true);
            $('#desa').attr('disabled', true);

            $("#kecamatan").select2({
                placeholder: "PILIH KECAMATAN",
            });

            $("#desa").select2({
                placeholder: "PILIH DESA",
            });

            $("#lahan-sawah").select2({
                width: '100%',
                data: ['Sawah tadah hujan', 'Irigasi Teknis', 'Lahan Kering'],
                placeholder: "PILIH SALAH SATU",
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

                let kelurahan = $('#desa').select2('data');
                $('#nama-kelurahan').val(kelurahan[0].text);

            })

            id_kota = '<?= $this->session->userdata('kabupatenkota'); ?>';
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

            $('#kecamatan').select2({
                width: '100%',
                placeholder: 'PILIH KECAMATAN',
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

            // $('#kabupaten').on('change', function() {
            //     $('#kecamatan').removeAttr('disabled');
            //     $('#kecamatan').val(null).trigger('change');

            //     id_kota = $('#kabupaten').find(':selected').val();

            //     $('#kecamatan').select2({
            //         width: '100%',
            //         placeholder: 'PILIH KECAMATAN',
            //         language: {
            //             noResults: function(params) {
            //                 return "Tidak ada Data yang cocok dengan Keyword.";
            //             },
            //             searching: function(params) {
            //                 return "Mencari...";
            //             },
            //             inputTooShort: function(params) {
            //                 var x = params.minimum - params.input.length;
            //                 return "Masukkan " + x + " karakter lagi";
            //             }
            //         },
            //         minimumInputLength: 1,
            //         ajax: {
            //             url: '<?= BASE_URL ?>pengajuan/cari-kecamatan/' + id_kota,
            //             dataType: 'json',
            //             delay: 750,
            //             data: function(params) {
            //                 return {
            //                     q: params.term, // search term
            //                 };
            //             },
            //             processResults: function(data) {
            //                 console.log(data)
            //                 return {
            //                     results: $.map(data, function(item) {
            //                         if (item.id_kecamatan !== '') {
            //                             return {
            //                                 id: item.id_kecamatan,
            //                                 text: item.nama
            //                             };
            //                         } else {
            //                             return false;
            //                         }
            //                     })
            //                 };
            //             },
            //             cache: true
            //         }
            //     });
            // });

            $('#kecamatan').on('change', function() {
                $('#desa').removeAttr('disabled');
                $('#desa').val(null).trigger('change');

                id_kecamatan = $('#kecamatan').find(':selected').val();

                let kecamatan = $('#kecamatan').select2('data');
                $('#nama-kecamatan').val(kecamatan[0].text);

                $('#desa').select2({
                    width: '100%',
                    placeholder: 'PILIH DESA',
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

        function validateMobilePhone(component) {
            $('#' + component).on('keyup', function(e) {
                numberLength = $('#' + component).val().length;
            });

            $('#' + component).on('keypress', function(e) {
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