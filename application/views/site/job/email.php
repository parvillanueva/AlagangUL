<html>
<head>
</head>

<body style="background: #efefef;width:100%;height: 100%;font-family: Arial, sans-serif;">
<table align="center" width="850" bgcolor="white" style="display:block;border:1px solid #dedede;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;border-radius: 10px;padding:10px;">
    <tbody>
        <tr>
            <td style="background-color: #092E6E;padding:10px 0px;border-radius: 8px 8px 0px 0px;">
                <img width="220" src="http://172.29.70.126/alagang_unilab/uploads/au-alagangunilab.png">
            </td>
        </tr>
        <tr>
            <td>
                <table style="padding:20px;">
                    <tr>
                        <td>
                            
                            <center>
                                <b style="padding-bottom:35px;color: #092e6e;font-weight:700;font-size:18px;">Alagang Unilab Volunteers</b>
                            </center>
                            <p style="font-size:14px;font-weight:300;color: #000;line-height: 24px;">
                                <b style="font-size:15px;">Hello <?= $user_name;?>;</b></p>
                            
                                <table style="font-size:15px;font-weight:300;color: #4b4d4d;line-height: 24px;border-spacing: 0px; border-top: 1px solid #eee; border-left: 1px solid #eee;width: 100%;">
                                    <thead style="color: #092e6e;">
                                        <tr>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:133px;">Program</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:133px;">Event</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:133px;">Badge</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:193px;">Task</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:103px;">Required</th>
                                            <th style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee; width:103px;">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listing as $a => $b) { ?>
                                            <tr>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['program_name'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['event_name'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['badges'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['task'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['required_volunteers'];?></span></td>
                                                <td style="padding: 5px; border-right: 1px solid #eee; border-bottom: 1px solid #eee;"><span><?= $b['joined_volunteers'];?></span></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                </table>
                                <br>
                                <a href="<?= $download;?>">Download / Export</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color: #092E6E;padding:15px;border-radius:0px 0px 8px 8px ;">
                <table width="100%">
                    <tr>
                        <td>
                            <p style="color:#fff;font-size:14px;">Alagang Unilab</p>
                        </td>
                        <td style="text-align:right">
                            <p style="color:#fff;font-size:14px;">Website: <a href="<?= base_url(); ?>" style="color:#0e5bdf;text-decoration: none;">www.alagangunilab.unilab.com.ph</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</body>

</html>