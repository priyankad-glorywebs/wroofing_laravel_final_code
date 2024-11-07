<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Created</title>
</head>
<body>
    <table style="padding: 0;margin: 0 auto;max-width: 600px;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
    align="center">
    <tbody>
        <tr>
            <td style="padding: 17px 20px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 15px;font-weight: 400;line-height: 1.5;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                <img src="{{ asset('emails/logo.png') }}" alt="logo" width="220" height="47"
                                    style="max-width:220px; height: auto;width: auto;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 11px 20px; background-color: #53B746;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#53B746" align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 13px;font-weight: 400;line-height: 1.25;color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: left;">
                                <a href="tel:7771231234"
                                    style="white-space: nowrap; color:rgb(255,255,255); text-decoration:none;"><img
                                        src="{{ asset('emails/phone-icon.png') }}" alt="logo" width="10"
                                        height="10" style="margin-right: 5px;"> 777-123-1234</a>
                            </td>
                            <td
                                style="font-size: 13px;font-weight: 400;line-height: 1.25;color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                <a href="mailto:abcd@tester.com"
                                    style="white-space: nowrap; color:rgb(255,255,255); text-decoration:none;"><img
                                        src="{{ asset('emails/mail-icon.png') }}" alt="logo" width="10"
                                        height="10" style="margin-right: 5px;"> abcd@tester.com</a>
                            </td>
                            <td
                                style="font-size: 13px;font-weight: 400;line-height: 1.25;color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: right;">
                                <a href="www.abcdefgh.com"
                                    style="white-space: nowrap; color:rgb(255,255,255); text-decoration:none;"><img
                                        src="{{ asset('emails/web-icon.png') }}" alt="logo" width="11"
                                        height="10" style="margin-right: 5px;"> www.abcdefgh.com</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 50px 20px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 16px;font-weight: 600;line-height: 1.5;color: #7B7B7B;font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align:center;">

                                <div class="content" style="text-align: justify;">
                                    <p style="text-align: justify;">Dear {{ $user->name }},</p>
                                </div>
                                <div class="content" style="text-align: justify;">
                                    <p style="text-align: justify;">   Your account has been successfully created. Here are your login details:
                                </p>
                                </div>
                                <div class="content" style="text-align: justify;">
                                    <p class="text-align: justify;"><strong>Username:</strong> {{ $user->email }}</p>
                                    <p class="text-align: justify;"><strong>Password:</strong> {{ $password }}</p>
                                </div>

                                <div class="content" style="text-align: justify;">
                                    <p style="text-align: justify;">  Please login and change your password as soon as possible for security reasons.
                                    </p><br/>
                                    <p style="text-align: justify;">Thank you for registering with us!</p>
                                </div>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 11px 20px; background-color: #53B746">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#53B746" align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 14px;font-weight: 400;line-height: 1.25;color: #fff;font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                Powered by {{ config('app.name') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

</body>
</html>










