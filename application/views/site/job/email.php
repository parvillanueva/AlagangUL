
<html>
<head>
</head>

<body style="background: #092E6E;width:100%;height: 100%;font-family: Arial, sans-serif;">
<table style="width:100%;">
    <tbody>
        <tr>
            <td>
                <center>
                    <img width="330" height="150px" src="http://172.29.70.126/alagang_unilab/uploads/au-alagangunilab.png"
                        style="margin-bottom:15px;">
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <table width="700" align="center" bgcolor="white" style="border:1px solid #dedede;padding:25px; margin-right:auto;margin-left:auto">
                    <tr>
                        <td>
                            <center>
                                <b style="padding-bottom:35px;color: #092e6e;font-weight:700;font-size:18px;">Alagang Unilab Volunteers</b>
                            </center>
                            <p style="font-size:15px;font-weight:300;color: #4b4d4d;line-height: 24px;">
                                    Hello <?= $user_name;?>;<br>
                            </p>

                            <?php foreach ($program_list as $key => $value) {?>
                                <br>
                                <b style="padding-bottom:35px;color: #092e6e;font-weight:700;font-size:15px;"><?= $value['ProgramName'] ;?></b>
                                <br>
                                <table style="font-size:15px;font-weight:300;color: #4b4d4d;line-height: 24px;border-spacing: 0px; border-top: 1px solid #eee; border-left: 1px solid #eee;width: 100%;">
                                    <thead style="color: #092e6e;">
                                        <tr>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">Event</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">Date</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($value['Events'] as $a => $b) { ?>
                                            <tr>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['EventTitle'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width: 245px;"><span><?= $b['EventDate'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width: 70px;"><a href="<?= $b['DownloadLink'];?>" target="_blank">Download</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <br>
                            <p style="font-size:15px;font-weight:300;color: #4b4d4d;line-height: 24px;">
                                    Thank you.<br>
                            </p>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
        <tr>
            <td>
                <table width="500" align="center">
                    <tr>
                        <td>
                            <center style="width:500px;margin-left:auto;margin-right:auto;">
                                <p align="center" style="color: #fff; width: 500px; font-size: 14px; margin: 15px auto 15px;">
                                    If you received this email by mistake, send us a report. Lorem ipsum dolor sit amet conserctetuer adipiscing
                                    nomnumny di dalam hati nay.
                                </p>
                            </center>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</body>

</html>