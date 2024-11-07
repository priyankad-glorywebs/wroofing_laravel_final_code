<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Email</title>
    @php
    // Set default values to avoid undefined variable errors
    $contractorName = ''; // Default contractor name
    $company_Name = '';      // Default company name
    $project_title = '';

    if (isset($quotdata) && isset($quotdata['contractor'])) {
        $contractorName    = ucfirst(strtolower($quotdata['contractor']['name'] ?? ''));
        $companyName       = $quotdata['contractor']['company_name'] ?? '';
        // You can remove the 'dd' for debugging in production code
        // dd($data['quoteData']['project']['title']);
        if(isset($quotdata['quoteData']['project']['title'])){
            $project_title = $quotdata['quoteData']['project']['title'];
        }
    }
    @endphp
</head>

<body style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Arial', sans-serif;">

    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td>
                <table align="center" width="600" border="0" cellpadding="0" cellspacing="0" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;">
                    <!-- Logo -->
                    <tr>
                        <td align="center" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding: 20px;">
                            <img src="{{ asset('emails/logo.png') }}" alt="Company Logo" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';display: block; max-width: 200px; height: auto;">
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
                    <!-- Main content -->
                    <tr>
                        <td align="center" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding: 20px;">
                            <h1 style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size: 24px; color: #333333; margin: 0;">{{$contractorName}} has sent you a quote</h1>
                            @if(isset($companyName) && isset($project_title))
                            <p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size: 16px; color: #555555; line-height: 1.6;">You have received a quote from {{$contractorName}} with {{$companyName}}, for project {{$project_title}}. If you have any questions, contact {{$contractorName}}. by replying to this email.</p>
                            @else
                            <p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size: 16px; color: #555555; line-height: 1.6;">You have received a quote from {{$contractorName}}. If you have any questions, contact {{$contractorName}}. by replying to this email.</p>
                            @endif
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding: 20px;">
                            <a href="{{ $signedUrl }}" style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; background-color: #0070BA; color: white; text-decoration: none; padding: 14px 36px; font-size: 18px; font-weight: bold; border-radius: 8px; display: inline-block; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease; text-align: center;">Pay Now</a>                            
                        </td>
                    </tr>

                    <!-- Expiry note -->
                    <tr>
                        <td align="center" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding: 20px;">
                            <p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size: 14px; color: #777777; line-height: 1.6;">This link will expire after 24 hours.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding: 15px; background-color: #53B746; color: #ffffff; border-radius: 0 0 10px 10px;">
                            <p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size: 14px; margin: 0;">Powered by {{ config('app.name') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
