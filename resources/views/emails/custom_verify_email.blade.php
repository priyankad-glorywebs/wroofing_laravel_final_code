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
                                <h1
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#AEAEB2;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                    Hello!</h1>
                            </td>
                        </tr>
 
						<tr>
                            <td
                                style="font-size: 32px;font-weight: 700;line-height: 1.25;color: #2C2C2E;font-family: 'Open Sans', sans-serif;padding: 15px 0 20px;margin: 0;text-align:center;">
                                <p
                                    style="color:#AEAEB2;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Please click the button below to complete the verification process:</p>
                            </td>
                        </tr>
						<tr>
                            <td
                                style="font-size: 16px;font-weight: 600;line-height: 1.5;color: #AEAEB2;font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align:center;">
                                <a href="{{$verificationUrl}}"
                                    class="m_-858663772823252819button" rel="noopener"
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748">Verify
                                    Email</a>
                            </td>
                        </tr>
						<tr>
                            <td
                                style="font-size: 32px;font-weight: 700;line-height: 1.25;color: #2C2C2E;font-family: 'Open Sans', sans-serif;padding: 15px 0 20px;margin: 0;text-align:center;">
                                <p
                                    style="color:#AEAEB2;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Thank you for choosing {{ config('app.name') }}. If you have any questions or concerns, feel free to reach out to our support team at jon.doe4@gmail.com.</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <td
                                style="font-size: 16px;font-weight: 600;line-height: 1.5;color: #AEAEB2;font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align:center;">
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Regards,<br>{{ config('app.name') }} Team</p>
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