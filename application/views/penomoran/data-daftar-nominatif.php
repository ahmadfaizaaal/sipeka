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
    <h5 class="text-center" style="margin-top: -10px;">KEMENTERIAN PERTANIAN</h5>
    <h5 class="text-center">DIREKTORAT JENDERAL PRASARANA DAN SARANA PERTANIAN</h5>
    <h5 class="text-center">DAFTAR NOMINATIF PENERIMA MANFAAT <?= $data[0]['nama_kabupaten'] ?></h5>

    <table class="table table-bordered" style="font-size: 11px !important; width: 100%; margin: 40px 20px 0px 20px; padding-bottom: -10px; page-break-inside: avoid;">
        <thead>
            <tr class="text-center">
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Bank</th>
                <th>No. Rekening</th>
                <th>No. SK</th>
                <th>Jumlah</th>
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
            <?php
            $total = 0;
            for ($i = 0; $i < count($data); $i++) {
                $total += $data[$i]['nominal'];
            ?>
                <tr>
                    <td style="width: 2%;" class="text-center custom-padding"><?= $i + 1 ?></td>
                    <td style="width: 15%;">
                        <?= 'UPKK ' . strtoupper($data[$i]['nama_poktan']) ?>
                    </td>
                    <td style="width: 18%;" class="text-center custom-padding">
                        <?=
                        'DESA ' . strtoupper($data[$i]['nama_kelurahan']) . ',' .
                            'KEC. ' . strtoupper($data[$i]['nama_kecamatan']) . ',' .
                            strtoupper($data[$i]['nama_kabupaten']);
                        ?>
                    </td>
                    <td style="width: 15%;" class="text-center custom-padding">
                        <?= $data[$i]['nama_bank']; ?>
                    </td>
                    <td style="width: 10%;" class="text-center custom-padding">
                        <?= $data[$i]['no_rekening']; ?>
                    </td>
                    <td style="width: 30%;" class="text-center custom-padding">
                        <?= $data[$i]['sk_penerima']; ?>
                    </td>
                    <td style="width: 10%;" class="text-center custom-padding">
                        <?= 'Rp. ' . number_format($data[$i]['nominal'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" class="text-center">MAK 1794.RBK.003.051.A.526321</td>
                <td colspan="3" class="text-center"><strong>JUMLAH</strong></td>
                <td class="text-center"><strong><?= 'Rp. ' . number_format($total, 0, ',', '.') ?></strong></td>
            </tr>

        <tbody>
    </table>
</body>

</html>