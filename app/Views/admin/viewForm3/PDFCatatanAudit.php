<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Table</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th,
        td {
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .UMRAH {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 11px;
            text-align: center;
            vertical-align: middle;
            height: 40px;
        }

        .No-002-KKA-02A {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            text-align: center;
            vertical-align: middle;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .BORANG-AUDIT-MUTU-INTERNAL {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }

        .table-container {
            padding: 0;
            margin: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <table>
            <tr>
                <th rowspan="2" style="width: 10%;">

                    <img src="<?= $image_path ?>" alt="Logo" width="50" height="50">

                </th>
                <th style="width: 60%;" class="UMRAH">
                    UNIVERSITAS MARITIM RAJA ALI HAJI
                </th>
                <th rowspan="2" style="width: 30%;" class="No-002-KKA-02A">
                    <div></div>
                    No: 001-KKA-01A
                    <div></div>
                </th>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" class="BORANG-AUDIT-MUTU-INTERNAL">
                    BORANG AUDIT MUTU INTERNAL
                    <br>
                    Catatan Audit
                </td>
            </tr>
        </table>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <td style="font-weight: bold;">
                    Auditi
                    <div></div>
                </td>
                <td colspan="2" style="font-weight: bold; text-align: start;">
                    Standar BAN-PT
                    <div></div>
                </td>
            </tr>
            <tr>
                <td>
                    <?= $lokasi ?>
                    <div></div>
                </td>
                <td colspan="2">
                    Kriteria BAN-PT PENDIDIKAN, PENELITIAN, DAN PENGABDIAN
                    <div></div>
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Tanggal<div></div>
                </td>
                <td style="font-weight: bold;">Lokasi <div></div>
                </td>
                <td style="font-weight: bold;">Auditor <div></div>
                </td>
            </tr>

            <tr>
                <td><?= $tanggal_audit ?><div></div>
                </td>
                <td>UNIVERSITAS MARITIM RAJA ALI HAJI <div></div>
                </td>
                <td>
                    <ol>
                        <?php foreach ($auditor as  $auditorList) : ?>
                            <li><?= $auditorList ?></li>
                        <?php endforeach; ?>
                    </ol>
                    <div></div>
                </td>
            </tr>


        </table>

    </div>
    <div class="table-container">
        <table>
            <tr>
                <td style="font-weight: bold; width: 60%;">Catatan </td>
                <td style="font-weight: bold; width: 20%;">Dokumen</td>
                <td style="font-weight: bold; width: 20%;">Tanggal /Rev </td>
            </tr>
            <tr>
                <td style="text-align: start;">
                    <?php if (!empty($catatan_positif)) : ?>
                        <div>
                            <span style="font-weight: bold;">Positif :</span>
                            <?php foreach ($catatan_positif as $catatan) : ?>
                                <div>
                                    <span><?= $catatan['catatan_audit'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <br>

                    <?php if (!empty($catatan_negatif)) : ?>
                        <div>
                            <span style="font-weight: bold;">Negatif :</span>
                            <?php foreach ($catatan_negatif as $catatan) : ?>
                                <div>
                                    <span><?= $catatan['catatan_audit'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <div></div>
                </td>
                <td>
                    <div></div>
                </td>
            </tr>

        </table>

    </div>


</body>

</html>