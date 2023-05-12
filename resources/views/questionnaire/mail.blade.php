<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//PL" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl-PL">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Poznański Panel Obywatelski</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center" style="padding: 25px 0 10px 0;">
                        <img src="<?php echo $message->embed(public_path() . '/images/index/banner.png'); ?>" alt="Poznański Panel Obywatelski" width="150" height="120" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 20px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #000000; font-family: Arial, sans-serif; padding: 0 0 10px 0; text-align: center">
                                    <h1 style="font-size: 24px; margin: 0; text-align: center">Potwierdzenie rejestracji</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #000000; font-family: Arial, sans-serif; font-size: 14px; padding: 20px 0 10px 0; text-align: justify">
                                    <p style="margin: 0; text-align: justify">Dziękujemy za zgłoszenie się do udziału! Zapraszamy do oglądania ostatecznego losowania, które odbędzie się 11 lutego o godz. 14:00.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #000000; font-family: Arial, sans-serif; font-size: 14px; padding: 10px 0 10px 0; text-align: center">
                                    <p style="margin: 0; text-align: center">Twój identyfikator do ostatecznego losowania to:</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #000000; font-family: Arial, sans-serif; padding: 0 0 10px 0; text-align: center">
                                    <h1 style="font-size: 24px; margin: 0; text-align: center">{{$applicant->identity_string}}</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
