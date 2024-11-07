<table style="padding: 0;margin: 0 auto;max-width: 600px;" width="600" cellspacing="0" cellpadding="0"
    bgcolor="#ffffff" align="center">
    <tbody>
        <tr>
            <td style="padding: 17px 20px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 15px;font-weight: 400;line-height: 1.5;color: rgb(0,0,0);font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                <img src="{{ asset('emails/logo.png') }}" alt="logo" width="220"
                                    height="47" style="max-width:220px; height: auto;width: auto;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 11px 20px; background-color: #53B746;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#53B746"
                    align="center">
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
            <td style="padding: 25px 20px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"
                    align="center">
                    <tbody>
                        <tr>
                            <td
                                style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding: 5px;">
                                <h2
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;font-weight:bold;margin-top:0;text-align:left">
                                    Contact Details</h2>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    <strong
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">Name:</strong>
                                    {{ $contact->name }}
                                </p>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    <strong
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">Email:</strong>
                                    <a href="mailto:bhagyesh.chavda@gmail.com"
                                        target="_blank">{{ $contact->email }}</a>
                                </p>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    <strong
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">Phone
                                        Number:</strong> {{ $contact->phoneno }}
                                </p>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    <strong
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">Address:</strong>
                                    {{ $contact->address }}
                                </p>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    <strong
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">Your
                                        Comments:</strong> {{ $contact->yourcomments }}
                                </p>
                                <p
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                    Thanks,<br>{{ env('app.name') }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 11px 20px; background-color: #53B746">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#53B746"
                    align="center">
                    <tbody>
                        <tr>
                            <td
                                style="font-size: 14px;font-weight: 400;line-height: 1.25;color: #fff;font-family: 'Open Sans', sans-serif;padding: 0;margin: 0;text-align: center;">
                                Powered by {{ config('app.name') }} Team
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>