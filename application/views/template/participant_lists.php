<page>
    <style>
        *,
        p,
        td,
        th {
            font-size: 12px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            font-size: 12px;
            border: 1px solid;
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 3px;
            padding-right: 3px;
        }

        table th {
            text-align: center;
        }
    </style>
    <img src="<?php echo FCPATH . 'assets/images/logos/FHI_360.png' ?>" style='width:120px;position:absolute;left:0px'>

    <br>
    <p style="font-weight: bold; font-size: 18px">Participants List</p>
    <p style="font-size: 14px">Activity: <?= $detail['activity'] ?></p>
    <br>
    <table class="table" style="width: 100%; margin-left: -5px">
        <tr>
            <th style="width: 20px">No</th>
            <th style="width: 150px">Name</th>
            <th style="width: 140px">Organization</th>
            <th style="width: 130px">Email</th>
            <th style="width: 130px">Payment Method</th>
            <th style="width: 90px">Reimburesment</th>
        </tr>
        <?php $no = 1; foreach($participants as $par): ?>
        <tr style="background: #e8e8e8">
            <td style="text-align: center"><?= $no++ ?></td>
            <td><?= $par->nama_peserta ?></td>
            <td>
                <p style="margin: 0; margin-bottom: 3px;">
                    <?= $par->asal_layanan ?>
                </p>
                <p style="margin: 0;">
                    <?= $par->nama_lembaga ?>
                </p>
            </td>
            <td><?= $par->email_peserta ?></td>
            <td>
                <?php
                        // $payment = '';
                        // if (!empty($par->ovo_number)) {
                        //     $payment .= '<p style="margin: 0px">OVO - '.$par->ovo_number.'</p>';
                        // }
                        // if (!empty($par->gopay_number)) {
                        //     $payment .= '<p style="margin: 0px">GOPAY - '.$par->gopay_number.'</p>';
                        // }
                        // if (!empty($par->bank_number)) {
                        //     $payment .= '<p style="margin: 0px">'.$par->bank_name.' - '.$par->bank_number.'</p>';
                        // }
                        echo $par->payment_method;
                    ?>
            </td>
            <td style="text-align: right"><?= $par->total ?></td>
        </tr>
        <tr>
            <td colspan="6">
                <table class="table" style="width: 100%; margin-left: 0px; margin-top: -5px; margin-bottom: -5px">
                    <tr>
                        <td
                            style="width: 50%; vertical-align: top; border-top: none; border-bottom: none; border-left: none; text-align: center">
                            <p>Consumption Receipt</p>
                            
                        </td>
                        <td
                            style="width: 50%; vertical-align: top; border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center">
                            <p>Transfer Receipt</p>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br><br><br><br><br>

    <div style="text-align: center">
        <p style="margin: 0px; font-size: 14px; margin-top: 3px"><?= $detail['pa_purpose'] ?></p>
        <br>
        <p style="margin: 0px; font-size: 16px; font-weight: bold; text-decoration: underline"><?= $detail['pa_name'] ?></p>
    </div>
</page>