<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">

    <!-- Main wrapper table -->
    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0"
        style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td>

                <!-- Email container -->
                <table align="center" width="600" border="0" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px;">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img src="{{ asset('emails/logo.png') }}" alt="Company Logo"
                                style="display: block; max-width: 200px; height: auto;">
                        </td>
                    </tr>

                    <!-- Contact Info -->
                    <tr>
                        <td style="padding: 11px 20px; background-color: #53B746;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#53B746"
                                align="center">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 13px; font-weight: 400; color: rgb(255,255,255);">
                                            <a href="tel:7771231234"
                                                style="color: rgb(255,255,255); text-decoration:none;">
                                                <img src="{{ asset('emails/phone-icon.png') }}" alt="Phone"
                                                    width="10" height="10" style="margin-right: 5px;">
                                                777-123-1234
                                            </a>
                                        </td>
                                        <td
                                            style="font-size: 13px; font-weight: 400; color: rgb(255,255,255); text-align: center;">
                                            <a href="mailto:abcd@tester.com"
                                                style="color: rgb(255,255,255); text-decoration:none;">
                                                <img src="{{ asset('emails/mail-icon.png') }}" alt="Email"
                                                    width="10" height="10" style="margin-right: 5px;">
                                                abcd@tester.com
                                            </a>
                                        </td>
                                        <td
                                            style="font-size: 13px; font-weight: 400; color: rgb(255,255,255); text-align: right;">
                                            <a href="www.abcdefgh.com"
                                                style="color: rgb(255,255,255); text-decoration:none;">
                                                <img src="{{ asset('emails/web-icon.png') }}" alt="Website"
                                                    width="11" height="10" style="margin-right: 5px;">
                                                www.abcdefgh.com
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Receipt Content -->
                    <tr>
                        <td style="padding: 20px;">
                            <h2 style="font-size: 24px; margin: 0; color: #333;">Payment Details</h2>
                            <p style="font-size: 16px; color: #555;">Hi {{ ucfirst($paymentData['contractor_name']) }},</p>

                            <p style="font-size: 16px; color: #555;">The customer {{ ucfirst($paymentData['customer_name']) }} has made a payment for the roofing project "{{ $paymentData['project_name'] }}".</p>

                            <table width="100%" border="1" cellspacing="0" cellpadding="10"
                                style="border-collapse: collapse; margin-top: 20px; border-color: #ccc;">
                                <tr>
                                    <td>Customer Name</td>
                                    <td>{{ $paymentData['customer_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Project Name</td>
                                    <td>{{ $paymentData['project_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Amount</td>
                                    <td>${{ number_format($paymentData['amount'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Discount Applied</td>
                                    <td>${{ number_format($paymentData['discount'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Amount Paid</td>
                                    <td>${{ number_format($paymentData['total'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>{{ $paymentData['payment_method'] }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Date</td>
                                    <td>{{ $paymentData['transaction_date'] }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction ID</td>
                                    <td>#{{ $paymentData['transaction_id'] }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 16px; color: #555; margin-top: 20px;">You can now proceed with the next steps of the project.</p>
                            
                                <p style="font-size: 16px; color: #555; margin-top: 20px;">If you have any questions
                                regarding this receipt or need further assistance, feel free to contact us at [{{ $paymentData['customer_email'] }}].</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding: 15px; background-color: #53B746; color: #ffffff; border-radius: 0 0 10px 10px;">
                            <p style="font-size: 14px; margin: 0;">Powered by {{ config('app.name') }}</p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
