<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Oursvib Order Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style type="text/css">
        a[x-apple-data-detectors] {color: inherit !important;}
    </style>

</head>
<body style="margin: 0; padding: 0;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px 0 30px 0;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #e1c274;">
                <tr>
                    <td align="center" bgcolor="#e1c274" style="padding: 40px 0 30px 0;">
                        <img src="{{asset('customerfile/images/logo1.png')}}" width="200" height="43" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif;">
                                    <h1 style="font-size: 24px; margin: 0;">New Booking </h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Listing Title: {{$details[0]->listing->title}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Vendor Name: {{$details[0]->vendor->company_name}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Start Time: {{$details[0]->start_date}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">End Time: {{$details[0]->end_date}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Invoice No: {{$details[0]->booking_ref_no}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Amount paid: RM {{$details[0]->amountpaid/100}}</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#e1c274" style="padding: 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #000; font-family: Arial, sans-serif; font-size: 14px;text-align: center">
                                    <p style="margin: 0;">copyright &copy; oursvib<br/>
                                    </p>
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
