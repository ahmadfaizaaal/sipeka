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

    <table style="border: none; font-size: 14px !important; width: 100%; margin: 0px 80px 0px 50px; padding-bottom: -10px;">
        <tr>
            <td class="align-top">Nomor</td>
            <td class="align-top"> : </td>
            <td class="align-top" style="text-align: right;">
                <?php
                $split = explode(' ', tgl_indo(date('d-m-Y'), false));
                echo $split[1] . ' ' . $split[2];
                ?>
            </td>
        </tr>
        <tr>
            <td class="align-top">Sifat</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right"><strong>Segera</strong></td>
        </tr>
        <tr>
            <td class="align-top">Hal</td>
            <td class="align-top"> : </td>
            <td class="align-top" id="float-right">Pelaksanaan Pembangunan Bangunan Konservasi Air dan Antisipasi Anomali Iklim T.A. 2022</td>
        </tr>
    </table>

    <table style="border: none; font-size: 14px !important; width: 100%; margin: 10px 50px 0px 50px; padding-bottom: -10px;">
        <tr>
            <td colspan="3" class="align-top">
                Yth.
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top">
                Kepala <?= ucfirst($data[0]['nama_instansi']) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top">
                di-
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top">
                <?= ucfirst(strtolower($data[0]['alamat_instansi'])) ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top" style="line-height: 1.7; text-align: justify; text-justify: inter-word;">Menindaklanjuti Surat Saudara Nomor <?= $data[0]['nomor_surat'] ?> tanggal <?= $data[0]['tgl_buat'] ?> perihal Pernyataan Kesanggupan dan Tanggung Jawab untuk melaksanakan Kegiatan Pengembangan Pembangunan Bangunan Konservasi Air dan Antisipasi Anomali Iklim T.A. 2022 berupa <?= ucfirst($data[0]['url']) ?> melalui dana Bantuan Pemerintah Pusat, disampaikan hal sebagai berikut :</td>
        </tr>
        <tr style="vertical-align: top;">
            <td colspan="3" class="align-top" style="margin-top: 0; margin-bottom: -10px; vertical-align: top;">
                <ol style="line-height: 1.7; text-align: justify; text-justify: inter-word; margin-top: 0; vertical-align: top;">
                    <li>Setelah dilakukan review dokumen oleh Tim Teknis Pusat berdasarkan persyaratan yang telah ditetapkan dalam petunjuk teknis dan pertimbangan ketersediaan anggaran, maka alokasi kegiatan yang dapat diproses pemberkasan pembangunan <?= ucfirst($data[0]['url']) ?> sebanyak <strong><?= $data[0]['jumlah_alokasi'] ?> unit</strong>.</li>
                    <li>Dokumen pemberkasan dan pola pelaksanaan kegiatan mengacu pada Petunjuk Teknis Bantuan Pemerintah Lingkup Direktorat Jenderal Prasarana dan Sarana Pertanian T.A. 2022.</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="align-top" style="line-height: 1.7; text-align: justify; text-justify: inter-word;">Dimohon Saudara segera menyampaikan dokumen dimaksud untuk diproses lebih lanjut.</td>
        </tr>
        <tr>
            <td colspan="3" class="align-top" style="line-height: 1.7; text-align: justify; text-justify: inter-word;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</td>
        </tr>
    </table>
    <div style="margin-top: 40px; width: 100%;">
        <table style="border: none; margin: 20px 20px 0px 20px; width: 100%; padding-bottom: -10px;">
            <tr>
                <td id="float-right">
                    <div class="text-center" style="width: 350px; vertical-align: top; margin-left: auto; margin-right: 0; padding-right: -50px; font-size: 14px !important;">
                        <p class="ttd">Direktur Irigasi Pertanian</p>
                        <!-- <img style="margin-top: 5px !important; margin-bottom: 5px;" src="assets/pengajuan/temp/signature/" alt="" width="50%" height="50px"> -->
                        <p class="ttd" style="text-decoration: underline; margin-top: 80px;"><strong>Rahmanto</strong></p>
                        <p class="ttd" style="margin-top: -10px;">NIP. 196811051994031001</p>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>