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

        .table-bordered>tbody>tr>td>ul>li {
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
    <h5 class="text-center" style="margin-top: -10px;">TELAAH LAPORAN VERIFIKASI</h5>
    <h5 class="text-center">USULAN KEGIATAN PENGEMBANGAN IRIGASI <?= strtoupper($data[0]['url']) . ' ' . $data[0]['nama_kabupaten'] ?></h5>

    <table class="table table-bordered" style="font-size: 10px !important; width: 100%; margin: 40px 20px 0px 20px; padding-bottom: -10px; page-break-inside: avoid;">
        <thead>
            <tr class="text-center">
                <th>No.</th>
                <th>Lokasi Kegiatan</th>
                <th>Luas Layanan (Ha)</th>
                <th>Perkiraan Biaya (Rp)</th>
                <th>Bentuk Konstruksi</th>
                <th>Hasil Telaah</th>
                <th>Kelayakan / Status</th>
            </tr>
            <tr style="background-color: white !important; font-style: italic !important; font-size: 0.8em; height: 5px;">
                <td style="padding: 3px 0px">1</td>
                <td style="padding: 3px 0px">2</td>
                <td style="padding: 3px 0px">3</td>
                <td style="padding: 3px 0px">4</td>
                <td style="padding: 3px 0px">5</td>
                <td style="padding: 3px 0px">6</td>
                <td style="padding: 3px 0px">7</td>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($data); $i++) { ?>
                <tr>
                    <td style="width: 2%;" class="text-center"><?= $i + 1 ?></td>
                    <td style="width: 24%;">
                        <ul style="list-style-type: none; margin-top: 0;">
                            <li><strong><?= $data[$i]['poktan']['nama_poktan'] ?></strong></li>
                            <li>Desa <?= strtoupper($data[$i]['nama_kelurahan']) ?></li>
                            <li>Kecamatan <?= strtoupper($data[$i]['nama_kecamatan']) ?></li>
                        </ul>
                    </td>
                    <td style="width: 5%;" class="text-center"><?= $data[$i]['pengajuan']['luas_layanan'] ?></td>
                    <td style="width: 10%;" class="text-center"><?= 'Rp.' . number_format($data[$i]['pengajuan']['perkiraan_biaya'], 0, ',', '.') ?></td>
                    <td style="width: 27%;">
                        <ul style="margin-top: 0;">
                            <li>Rumah pompa <?= $data[$i]['pengajuan']['rumah_pompa'] ?></li>
                            <li>Pompa <?= $data[$i]['pengajuan']['ukuran_pompa'] ?></li>
                            <li>Bak penampung <?= $data[$i]['pengajuan']['bak_penampung'] ?></li>
                        </ul>
                    </td>
                    <td style="width: 22%;">
                        <ul style="margin-top: 0;">
                            <li>Sumber <?= $data[$i]['pengajuan']['rumah_pompa'] ?></li>
                            <li>Luas layanan <?= $data[$i]['pengajuan']['luas_layanan'] ?></li>
                            <li>Jarak dari sumber <?= $data[$i]['pengajuan']['jarak'] ?></li>
                            <li>Dampak : Peningkatan IP dari <?= $data[$i]['pengajuan']['ip'] ?></li>
                        </ul>
                    </td>
                    <td style="width: 5%; margin-top: 0;" class="text-center">
                        <p style="margin-bottom: 20px;"><?= $data[$i]['pengajuan']['kelayakan'] ?></p>
                    </td>
                </tr>
            <?php } ?>

        <tbody>
    </table>
</body>

</html>