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
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: .7cm;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif !important;">
    <h5 class="text-center" style="margin-top: -10px;">HASIL VERIFIKASI USULAN BANTUAN PEMERINTAH</h5>
    <h5 class="text-center">PENGEMBANGAN PADAT KARYA PRODUKTIF INFRASTRUKTUR PSP ASPEK IRIGASI PERTANIAN <?= $data['nama_kabupaten'] ?></h5>
    <h5 class="text-center">KEGIATAN IRIGASI <?= strtoupper($data['url']) ?></h5>
    <!-- <div style="display: flex; justify-content: space-between; margin: 20px 50px -20px 50px;"> -->
    <table style="border: none; margin: 20px 20px 0px 20px; width: 100%; padding-bottom: -10px;">
        <tr>
            <td>
                <p>Verifikator Lapang : <?= $data['nama_user'] ?></p>
            </td>
            <td id="float-right">
                <p style="text-align: right;">Waktu Survei : <?= strtoupper($data['tgl_buat']) ?></p>
            </td>
        </tr>
    </table>
    <!-- <div style="margin-top: 20px;">
        <p>Verifikator Lapang : <?= $data['nama_user'] ?></p>
        <p>Waktu Survei : <?= strtoupper($data['tgl_buat']) ?></p>
    </div> -->

    <table class="table table-bordered" style="font-size: 10px !important; width: 100%; page-break-inside: avoid;">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2" style="width: 100px;">Lokasi Kegiatan</th>
                <th colspan="2">Gapoktan / Poktan</th>
                <th rowspan="2">Luas Layanan (Ha)</th>
                <th rowspan="2">Unit</th>
                <th rowspan="2">Perkiraan Biaya (Rp)</th>
                <th colspan="4">Kebutuhan Pipa / Perpompaan</th>
                <th colspan="2">Pertanaman</th>
                <th rowspan="2" style="width: 180px;">Keterangan</th>
                <th rowspan="2" style="width: 50px;">Status</th>
            </tr>
            <tr>
                <th style="width: 70px;">Nama Poktan</th>
                <th style="width: 70px;">Nama Ketua</th>
                <th style="width: 50px;">Panjang / Jarak dari Sumber (m)</th>
                <th>Ukuran Pompa (inchi) / Pipa (m)</th>
                <th style="width: 100px;">Bak Penampung</th>
                <th style="width: 100px;">Rumah Pompa</th>
                <th>Provitas</th>
                <th>IP</th>
            </tr>
            <tr style="background-color: white !important; font-style: italic !important; font-size: 0.8em; height: 5px;">
                <?php
                for ($i = 1; $i < 16; $i++) {
                    echo '<td style="padding: 3px 0px">' . $i . '</td>';
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="15" style="background-color: yellow; font-weight: bold;"><?= $data['nama_kabupaten'] ?></td>
            </tr>
            <tr>
                <td rowspan="9" class="text-center custom-padding" style="vertical-align: top;">1</td>
                <td class="custom-padding"><?= 'DESA ' . $data['nama_kelurahan'] ?></td>
                <td class="custom-padding" rowspan="6"><?= $data['poktan']['nama_poktan'] ?></td>
                <td class="custom-padding" rowspan="6"><?= $data['poktan']['nama_ketua'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['luas_layanan'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['unit'] ?></td>
                <td rowspan="6" class="text-center"><?= 'Rp.' . number_format($data['pengajuan']['perkiraan_biaya'], 0, ',', '.') ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['jarak'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['ukuran_pompa'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['bak_penampung'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['rumah_pompa'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['provitas'] ?></td>
                <td rowspan="6" class="text-center"><?= $data['pengajuan']['ip'] ?></td>
                <td class="custom-padding"><?= 'Lahan sawah merupakan ' . $data['pengajuan']['lahan_sawah'] ?></td>
                <td rowspan="9" class="text-center" style="vertical-align: middle;"><?= $data['pengajuan']['kelayakan'] ?></td>
            </tr>
            <tr>
                <td class="custom-padding"><?= 'KECAMATAN ' . $data['nama_kecamatan'] ?></td>
                <td class="custom-padding"><?= 'Sumber air yang digunakan berasal dari ' . $data['pengajuan']['sumber_air'] ?></td>
            </tr>
            <tr>
                <td class="custom-padding" style="font-weight: bold;">Koordinat :</td>
                <td class="custom-padding"><?= 'Komoditas yang ditanam adalah ' . $data['pengajuan']['komoditas'] ?></td>
            </tr>
            <tr>
                <td class="custom-padding"><?= $data['lokasi']['koordinat_a'] ?></td>
                <td class="custom-padding"><?= 'Permasalahan yang dialami adalah ' . $data['pengajuan']['permasalahan'] ?></td>
            </tr>
            <tr>
                <td class="custom-padding"><?= $data['lokasi']['koordinat_b'] ?></td>
                <td class="custom-padding"><?= 'Rencana solusi yaitu ' . $data['pengajuan']['rencana_solusi'] ?></td>
            </tr>
            <?php if ($data['url'] == 'perpipaan') { ?>
                <tr>
                    <td></td>
                    <td class="custom-padding"><?= 'Beda elevasi sebesar ' . $data['pengajuan']['beda_elevasi'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="13" class="text-center" style="font-weight: bold; font-size: 12px; background-color: #E7E9EB;">DOKUMENTASI (SUMBER AIR, LOKASI LAHAN / SAWAH DAN CATCHMENT AREA) OPEN CAMERA</td>
            </tr>
            <tr class="text-center" style="font-weight: bold; background-color: #E7E9EB;">
                <td colspan="5">PLOTTING AREA</td>
                <td colspan="5">SUMBER AIR</td>
                <td colspan="3">LAHAN SAWAH</td>
            </tr>
            <tr class="text-center" style="font-weight: bold;">
                <td colspan="5" style="padding: 10px 10px;">
                    <div style="text-align: center;"><img src="assets/pengajuan/LAHAN SAWAH/28072022/5_LAHAN_SAWAH_28072022.png" alt="" width="150px" height="auto"></div>
                </td>
                <td colspan="5" style="padding: 10px 10px;">
                    <div style="text-align: center;"><img src="assets/pengajuan/LAHAN SAWAH/28072022/5_LAHAN_SAWAH_28072022.png" alt="" width="150px" height="auto"></div>
                </td>
                <td colspan="3" style="padding: 10px 10px;">
                    <div style="text-align: center;"><img src="assets/pengajuan/LAHAN SAWAH/28072022/5_LAHAN_SAWAH_28072022.png" alt="" width="150px" height="auto"></div>
                </td>
            </tr>

        <tbody>
    </table>
</body>

</html>