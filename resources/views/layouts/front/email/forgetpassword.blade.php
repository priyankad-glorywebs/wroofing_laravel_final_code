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
                                        src="{{ asset('emails/phone-icon.png') }}" alt="logo" width="10" height="10"
                                        style="margin-right: 5px;"> 777-123-1234</a>
                            </td>
                            <td
                                style="font-size: 13px;font-weight: 400;line-height: 1.25;color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                <a href="mailto:abcd@tester.com"
                                    style="white-space: nowrap; color:rgb(255,255,255); text-decoration:none;"><img
                                        src="{{ asset('emails/mail-icon.png') }}" alt="logo" width="10" height="10"
                                        style="margin-right: 5px;"> abcd@tester.com</a>
                            </td>
                            <td
                                style="font-size: 13px;font-weight: 400;line-height: 1.25;color: rgb(255,255,255);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: right;">
                                <a href="www.abcdefgh.com"
                                    style="white-space: nowrap; color:rgb(255,255,255); text-decoration:none;"><img
                                        src="{{ asset('emails/web-icon.png') }}" alt="logo" width="11" height="10"
                                        style="margin-right: 5px;"> www.abcdefgh.com</a>
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
                                <div class="header">
                                    <h1>Forget Password</h1>
                                </div>
                                <div class="content" style="text-align: justify;">
                                    <p style="text-align: justify;">Dear User,</p>
                                    <p style="text-align: justify;">We noticed that you requested to reset your
                                        password. Please click the button below to reset your password.</p>
                                    <a style="display: inline-block; padding: 10px 20px; background-color: #2d3748; color: #fff; text-decoration: none; border-radius: 4px;"
                                        href="{{ $resetLink }}" class="button">Reset Password</a>
                                    <p>If you didn't request this, you can safely ignore this email. Your password will
                                        not be changed until you confirm the reset.</p>
                                </div>
                                <div class="footer">
                                    <p style="text-align: justify;">Best regards,<br>{{ config('app.name') }} Team</p>
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