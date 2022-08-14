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
    <h5 class="text-center" style="margin-top: -10px;">HASIL PENOMORAN</h5>
    <h5 class="text-center"> </h5>

    <table class="table table-responsive" id="dataTablePengajuan" style="font-family: Arial !important;" width="100%">
        <thead>
            <tr class="text-center">
                <th scope="col" style="width: 10%">Provinsi / Kab. / Kota</th>
                <!-- <th scope="col" style="width: 25%;">Surat</th> -->
                <th scope="col" style="width: 40%;">Nomor Surat</th>
                <th scope="col" style="width: 12%;">Tanggal</th>
                <th scope="col" style="width: 18%;">Nama Penerima Banpem</th>
                <th scope="col" style="width: 10%;">Jumlah Dana Banpem</th>
            </tr>
        </thead>
        <tbody id="showDataPengajuan">

        </tbody>
    </table>
</body>

</html>