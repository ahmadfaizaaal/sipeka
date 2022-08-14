<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> -->
    <link rel="icon" href="<?= BASE_THEME ?>img/sipeka-icon-v2.png" type="image/ico" />
    <title><?= $title ?></title>
    <style>
        p {
            font-size: 10px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        #float-right td>p {
            text-align: right;
        }

        .custom-padding {
            padding-left: 5px;
        }

        .table-bordered {
            border: 1px solid #1A1A1A;
            /* margin-top: 20px; */
            border-collapse: collapse;
        }

        .table-bordered>thead>tr>th {
            border: 1px solid #1A1A1A;
            background-color: #F2C19D;
            text-align: center;
            vertical-align: middle;
        }

        .table-bordered>thead>tr>td {
            border: 1px solid #1A1A1A;
            text-align: center;
            vertical-align: middle;
        }

        .table-bordered>tbody>tr>td {
            border: 1px solid #1A1A1A;
            vertical-align: top;
        }

        h5 {
            font-weight: bold;
            margin-bottom: -20px;
        }

        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 1cm;
            margin-left: .5cm;
            margin-right: .5cm;
            margin-bottom: .7cm;
        }

        .ttd {
            margin-bottom: -15px;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif !important;">
    <h5 class="text-center" style="margin-top: -10px;">REKAP CALON PENERIMA BANTUAN PEMERINTAH KEGIATAN <?= strtoupper($data[0]['url']) ?></h5>
    <h5 class="text-center"><?= $data[0]['nama_kabupaten'] ?> PROVINSI <?= $data[0]['nama_provinsi'] ?></h5>

    <table class="table table-bordered" style="font-size: 10px !important; margin: 40px 0px 0px 0px; width: 1030px; padding-bottom: -10px; page-break-inside: avoid;">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2" style="width: 70px;">NAMA KELOMPOK TANI</th>
                <th colspan="7">URAIAN BANPEM</th>
                <th colspan="4">DATA REKENING PENERIMA</th>
                <th rowspan="2">NOMINAL ANGGARAN (Rp)</th>
                <th rowspan="2">LUAS (Ha)</th>
                <th rowspan="2">KECAMATAN, DESA</th>
            </tr>
            <tr>
                <th>NAMA KETUA</th>
                <th style="width: 5px;">NIK</th>
                <th>NO. HP</th>
                <th>NAMA KOORD UPKK</th>
                <th style="width: 5px;">NIK</th>
                <th>NAMA KEGIATAN</th>
                <th>PENGGUNAAN</th>
                <th>NAMA BANK</th>
                <th>TANGGAL</th>
                <th>NO REKENING</th>
                <th>NAMA REKENING</th>
            </tr>
            <tr style="background-color: white !important; font-style: italic !important; font-size: 0.8em; height: 5px;">
                <td style="padding: 3px 0px">1</td>
                <td style="padding: 3px 0px">2</td>
                <td style="padding: 3px 0px">3</td>
                <td style="padding: 3px 0px">4</td>
                <td style="padding: 3px 0px">5</td>
                <td style="padding: 3px 0px">6</td>
                <td style="padding: 3px 0px">7</td>
                <td style="padding: 3px 0px">8</td>
                <td style="padding: 3px 0px">9</td>
                <td style="padding: 3px 0px">10</td>
                <td style="padding: 3px 0px">11</td>
                <td style="padding: 3px 0px">12</td>
                <td style="padding: 3px 0px">13</td>
                <td style="padding: 3px 0px">14</td>
                <td style="padding: 3px 0px">15</td>
                <td style="padding: 3px 0px">16</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="16" class="custom-padding" style="background-color: yellow; font-weight: bold;"><?= $data[0]['nama_kabupaten'] ?></td>
            </tr>
            <?php
            $totalNominal = 0;
            for ($i = 0; $i < count($data); $i++) {
                $totalNominal += $data[$i]['pengajuan']['perkiraan_biaya'];
            ?>
                <tr>
                    <td class="text-center custom-padding" style="vertical-align: top;"><?= ($i + 1) ?></td>
                    <td class="custom-padding"><?= $data[$i]['poktan']['nama_poktan'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['poktan']['nama_ketua'] ?></td>
                    <td class="text-center custom-padding"><?= $data[$i]['poktan']['nik_ketua'] ?></td>
                    <td class="text-center custom-padding"><?= $data[$i]['poktan']['no_hp_ketua'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['poktan']['koordinator_upkk'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['poktan']['nik_upkk'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['pengajuan']['nama_kegiatan'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['pengajuan']['detail_kegiatan'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['rekening']['nama_bank'] ?></td>
                    <td class="custom-padding"><?= tgl_indo($data[$i]['rekening']['tgl_buat'], true) ?></td>
                    <td class="custom-padding"><?= $data[$i]['rekening']['no_rekening'] ?></td>
                    <td class="custom-padding"><?= $data[$i]['rekening']['nama_rekening'] ?></td>
                    <td class="custom-padding"><?= 'Rp.' . number_format($data[$i]['pengajuan']['perkiraan_biaya'], 0, ',', '.') ?></td>
                    <td class="custom-padding"><?= $data[$i]['pengajuan']['luas_layanan'] ?></td>
                    <td class="custom-padding"><?= 'KEC. ' . $data[$i]['nama_kecamatan'] . ', DESA ' . $data[$i]['nama_kelurahan'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="13" class="text-center" style="font-weight: bold;">JUMLAH</td>
                <td style="font-weight: bold;"><?= 'Rp.' . number_format($totalNominal, 0, ',', '.') ?></td>
                <td></td>
                <td></td>
            </tr>

        <tbody>
    </table>
    <div style="margin-top: 10px; width: 100%;">
        <table style="border: none; margin: 20px 0px 0px 0px; width: 100%; padding-bottom: -10px;">
            <tr>
                <td id="float-right">
                    <div class="text-center" style="width: 350px; vertical-align: top; margin-left: auto; margin-right: 0; padding-right: -50px;">
                        <p class="ttd"><?= strtoupper($data[0]['alamat_dinas']) . ', ' . strtoupper($data[0]['tgl_buat']) ?></p>
                        <p class="ttd">KEPALA DINAS PERTANIAN</p>
                        <p class="ttd"><?= $data[0]['nama_kabupaten'] ?></p>
                        <img style="margin-top: 20px !important; margin-bottom: 5px;" src="assets/pengajuan/temp/signature/<?= $data[0]['tanda_tangan'] ?>" alt="" width="50%" height="50px">
                        <p class="ttd" style="text-decoration: underline;"><strong><?= strtoupper($data[0]['nama_kadin']) ?></strong></p>
                        <p class="ttd"><?= strtoupper($data[0]['jabatan']) ?></p>
                        <p class="ttd">NIP. <?= strtoupper($data[0]['nip']) ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="page-break-after: always;"></div>
    <h5 class="text-center" style="margin-top: -10px;">LAMPIRAN DOKUMEN PENDUKUNG</h5>
    <table class="table table-bordered" style="font-size: 10px !important; margin: 40px 0px 0px 0px; width: 100%; padding-bottom: -10px; page-break-inside: avoid;">
        <thead>
            <tr>
                <th rowspan="2" style="width: 30px;">NO</th>
                <th rowspan="2" style="width: 150px;">NAMA KELOMPOK TANI</th>
                <th colspan="3">DOKUMEN</th>
            </tr>
            <tr>
                <th>SCAN KTP</th>
                <th>SCAN BUKU TABUNGAN</th>
                <th>SCAN SURAT REKENING AKTIF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" class="custom-padding" style="background-color: yellow; font-weight: bold;"><?= $data[0]['nama_kabupaten'] ?></td>
            </tr>
            <?php
            for ($i = 0; $i < count($data); $i++) {
            ?>
                <tr>
                    <td class="text-center custom-padding" style="vertical-align: top;"><?= ($i + 1) ?></td>
                    <td class="custom-padding"><?= $data[$i]['poktan']['nama_poktan'] ?></td>
                    <td style="padding: 10px 10px;">
                        <div style="text-align: center;"><img src="assets/pengajuan/SYARAT/<?= $data[$i]['dokumen']['ktp'] ?>" alt="" width="170px" height="130px"></div>
                    </td>
                    <td style="padding: 10px 10px;">
                        <div style="text-align: center;"><img src="assets/pengajuan/SYARAT/<?= $data[$i]['dokumen']['buku_tabungan'] ?>" alt="" width="170px" height="130px"></div>
                    </td>
                    <td style="padding: 10px 10px;">
                        <div style="text-align: center;"><img src="assets/pengajuan/SYARAT/<?= $data[$i]['dokumen']['surat_rekening_aktif'] ?>" alt="" width="170px" height="130px"></div>
                    </td>
                </tr>
            <?php } ?>
        <tbody>
    </table>
</body>

</html>