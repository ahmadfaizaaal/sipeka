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

        .align-top {
            vertical-align: top;
            line-height: 1.5;
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
    <img style="margin-top: -15px !important; margin-bottom: 5px;" src="assets/pengajuan/temp/surat/kop-surat.png" alt="" width="100%" height="auto">
    <h5 class="text-center" style="margin-bottom: 5px; font-weight: bold; font-size: 16px;">NOTA DINAS</h5>

    <table style="border: none; font-size: 14px !important; width: 100%; margin: 20px 80px 0px 50px; padding-bottom: -10px;">
        <tr>
            <td class="align-top">Yth.</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right">PPK Pengembangan Kegiatan Irigasi Pertanian dan Pembangunan Bangunan Konservasi Air dan Antisipasi Anomali Iklim</td>
        </tr>
        <tr>
            <td class="align-top">Dari</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right">Sub Koordinator Air Tanah</td>
        </tr>
        <tr>
            <td class="align-top">Hal</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right">Telaah Laporan Verifikasi Lapang Kegiatan Pengembangan Irigasi <?= ucfirst($data[0]['url']) ?> Besar <?= ucwords(strtolower($data[0]['nama_kabupaten'])) ?></td>
        </tr>
        <tr>
            <td class="align-top">Tanggal</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right"><?= $data[0]['tgl_buat'] ?></td>
        </tr>
    </table>

    <table style="border: none; font-size: 14px !important; width: 100%; margin: 10px 50px 0px 50px; padding-bottom: -10px;">
        <tr>
            <td colspan="3" class="align-top">
                <hr style="border: 1px solid black;" width="100%">
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top" style="line-height: 1.7; text-align: justify; text-justify: inter-word;">Berdasarkan hasil verifikasi lapangan calon lokasi kegiatan Pengembangan Irigasi <?= ucfirst($data[0]['url']) ?> Besar yang dilaksanakan oleh <?= ucfirst($data[0]['nama_instansi']) ?>, bersama ini disampaikan hasil telaah teknis terhadap laporan verifikasi lapang:</td>
        </tr>
        <tr style="vertical-align: top;">
            <td colspan="3" class="align-top" style="margin-top: 0; margin-bottom: -10px; vertical-align: top;">
                <ol style="line-height: 1.7; text-align: justify; text-justify: inter-word; margin-top: 0; vertical-align: top;">
                    <li>Laporan hasil verifikasi lapang dari <?= ucwords(strtolower($data[0]['nama_kabupaten'])) ?> mengusulkan kegiatan pengembangan irigasi perpompaan besar sebanyak <strong><?= $data[0]['jumlah_alokasi'] ?> unit</strong>.</li>
                    <li>Berdasarkan sumber air, indeks pertanaman, luas layanan dan rencana konstruksi sesuai dengan kriteria teknis pengembangan irigasi perpompaan besar Tahun Anggaran 2022, layak untuk menerima kegiatan dimaksud</li>
                    <li>Telaah per kelompok tani sebagaimana terlampir</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top" style="line-height: 1.7; text-align: justify; text-justify: inter-word;">Demikian disampaikan atas perkenan Bapak diucapkan terima kasih.</td>
        </tr>
    </table>
    <div style="margin-top: 40px; width: 100%;">
        <table style="border: none; margin: 20px 20px 0px 20px; width: 100%; padding-bottom: -10px;">
            <tr>
                <td id="float-right">
                    <div class="text-center" style="width: 350px; vertical-align: top; margin-left: auto; margin-right: 0; padding-right: -50px; font-size: 14px !important;">
                        <p class="ttd">Sub Koordinator Air Tanah</p>
                        <p class="ttd" style="margin-top: 80px;">Nurul Chair</p>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>