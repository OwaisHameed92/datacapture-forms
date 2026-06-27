<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New KYC submission</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background-color:#ffffff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="height:6px;background:linear-gradient(to right,#2563eb,#10b981);font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:28px 32px 8px 32px;">
                            <p style="margin:0 0 4px 0;font-size:12px;font-weight:bold;color:#2563eb;letter-spacing:.04em;text-transform:uppercase;">Switch&amp;Save Business Services Ltd</p>
                            <h1 style="margin:0;font-size:20px;color:#0f172a;">New KYC submission received</h1>
                            <p style="margin:8px 0 0 0;font-size:14px;line-height:1.6;color:#64748b;">
                                A customer has just submitted the identity &amp; business verification form. Details are summarised below.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;width:42%;">Name</td>
                                    <td style="padding:8px 0;color:#0f172a;font-weight:bold;">{{ trim($customer->first_name.' '.$customer->last_name) ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;border-top:1px solid #f1f5f9;">Company</td>
                                    <td style="padding:8px 0;color:#0f172a;font-weight:bold;border-top:1px solid #f1f5f9;">{{ $customer->company_name ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;border-top:1px solid #f1f5f9;">Business type</td>
                                    <td style="padding:8px 0;color:#0f172a;border-top:1px solid #f1f5f9;">{{ $customer->business_type ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;border-top:1px solid #f1f5f9;">Documents uploaded</td>
                                    <td style="padding:8px 0;color:#0f172a;border-top:1px solid #f1f5f9;">{{ $documentsCount }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;border-top:1px solid #f1f5f9;">Submitted</td>
                                    <td style="padding:8px 0;color:#0f172a;border-top:1px solid #f1f5f9;">{{ optional($submittedAt)->format('d M Y, H:i') }} UTC</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#64748b;border-top:1px solid #f1f5f9;">Reference</td>
                                    <td style="padding:8px 0;color:#0f172a;border-top:1px solid #f1f5f9;">Customer #{{ $customer->id }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 32px 28px 32px;">
                            <a href="{{ $adminUrl }}" style="display:inline-block;background-color:#2563eb;color:#ffffff;font-size:14px;font-weight:bold;text-decoration:none;padding:11px 22px;border-radius:8px;">View full submission</a>
                            <p style="margin:16px 0 0 0;font-size:12px;line-height:1.6;color:#94a3b8;">
                                For security, personal, bank and document details are not included in this email. Sign in to the secure admin
                                area to review them.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 32px;background-color:#f8fafc;border-top:1px solid #e2e8f0;">
                            <p style="margin:0;font-size:11px;line-height:1.6;color:#94a3b8;">
                                Switch&amp;Save Business Services Ltd · Company No. 15051352 · Authorised and regulated by the FCA, FRN 1052230.
                                This is an automated notification.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
