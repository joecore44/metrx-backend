CREATE TABLE `bodyparts` (
  `bodypart_id` int(11) NOT NULL,
  `bodypart_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bodypart_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `bodypart_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` text COLLATE utf8_unicode_ci NOT NULL,
  `category_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `emailtemplates` (
  `email_id` int(11) NOT NULL,
  `email_title` varchar(50) NOT NULL,
  `email_fromname` varchar(50) NOT NULL,
  `email_plaintext` varchar(5) NOT NULL DEFAULT 'false',
  `email_disabled` tinyint(4) NOT NULL DEFAULT 0,
  `email_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

INSERT INTO `emailtemplates` (`email_id`, `email_title`, `email_fromname`, `email_plaintext`, `email_disabled`, `email_content`) VALUES
(1, 'New User Registered (Welcome Email)', 'Your Site Name', 'false', 0, '[{\"message\":\"<!doctype html>\\r\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\" xmlns:v=\\\"urn:schemas-microsoft-com:vml\\\" xmlns:o=\\\"urn:schemas-microsoft-com:office:office\\\">\\r\\n\\r\\n<head>\\r\\n<title>\\r\\n\\r\\n<\\/title>\\r\\n<!--[if !mso]> -->\\r\\n<meta http-equiv=\\\"X-UA-Compatible\\\" content=\\\"IE=edge\\\">\\r\\n<!--<![endif]-->\\r\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=UTF-8\\\">\\r\\n<meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1\\\">\\r\\n<style type=\\\"text\\/css\\\">\\r\\n#outlook a {\\r\\npadding: 0;\\r\\n}\\r\\n\\r\\n.ReadMsgBody {\\r\\nwidth: 100%;\\r\\n}\\r\\n\\r\\n.ExternalClass {\\r\\nwidth: 100%;\\r\\n}\\r\\n\\r\\n.ExternalClass * {\\r\\nline-height: 100%;\\r\\n}\\r\\n\\r\\nbody {\\r\\nmargin: 0;\\r\\npadding: 0;\\r\\n-webkit-text-size-adjust: 100%;\\r\\n-ms-text-size-adjust: 100%;\\r\\n}\\r\\n\\r\\ntable,\\r\\ntd {\\r\\nborder-collapse: collapse;\\r\\nmso-table-lspace: 0pt;\\r\\nmso-table-rspace: 0pt;\\r\\n}\\r\\n\\r\\nimg {\\r\\nborder: 0;\\r\\nheight: auto;\\r\\nline-height: 100%;\\r\\noutline: none;\\r\\ntext-decoration: none;\\r\\n-ms-interpolation-mode: bicubic;\\r\\n}\\r\\n\\r\\np {\\r\\ndisplay: block;\\r\\nmargin: 13px 0;\\r\\n}\\r\\n<\\/style>\\r\\n<!--[if !mso]><!-->\\r\\n<style type=\\\"text\\/css\\\">\\r\\n@media only screen and (max-width:480px) {\\r\\n@-ms-viewport {\\r\\nwidth: 320px;\\r\\n}\\r\\n@viewport {\\r\\nwidth: 320px;\\r\\n}\\r\\n}\\r\\n<\\/style>\\r\\n<!--<![endif]-->\\r\\n<!--[if mso]>\\r\\n<xml>\\r\\n<o:OfficeDocumentSettings>\\r\\n<o:AllowPNG\\/>\\r\\n<o:PixelsPerInch>96<\\/o:PixelsPerInch>\\r\\n<\\/o:OfficeDocumentSettings>\\r\\n<\\/xml>\\r\\n<![endif]-->\\r\\n<!--[if lte mso 11]>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n.outlook-group-fix { width:100% !important; }\\r\\n<\\/style>\\r\\n<![endif]-->\\r\\n\\r\\n\\r\\n<style type=\\\"text\\/css\\\">\\r\\n@media only screen and (min-width:480px) {\\r\\n.mj-column-per-100 {\\r\\nwidth: 100% !important;\\r\\n}\\r\\n}\\r\\n<\\/style>\\r\\n\\r\\n\\r\\n<style type=\\\"text\\/css\\\">\\r\\n<\\/style>\\r\\n\\r\\n<\\/head>\\r\\n\\r\\n<body style=\\\"background-color:#f9f9f9;\\\">\\r\\n<p><!-- [if !mso]> --> <!--<![endif]--> <!-- [if !mso]><!--><!--<![endif]--> <!-- [if mso]>\\r\\n<xml>\\r\\n<o:OfficeDocumentSettings>\\r\\n<o:AllowPNG\\/>\\r\\n<o:PixelsPerInch>96<\\/o:PixelsPerInch>\\r\\n<\\/o:OfficeDocumentSettings>\\r\\n<\\/xml>\\r\\n<![endif]--> <!-- [if lte mso 11]>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n.outlook-group-fix { width:100% !important; }\\r\\n<\\/style>\\r\\n<![endif]--><\\/p>\\r\\n<div style=\\\"background-color: #f9f9f9;\\\"><!-- [if mso | IE]>\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"background: #f9f9f9; background-color: #f9f9f9; margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"background: #f9f9f9; background-color: #f9f9f9; width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"border-bottom: #333957 solid 5px; direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"background: #fff; background-color: #fff; margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"background: #fff; background-color: #fff; width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"border: #dddddd solid 1px; border-top: 0px; direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<td\\r\\nstyle=\\\"vertical-align:bottom;width:600px;\\\"\\r\\n>\\r\\n<![endif]-->\\r\\n<div class=\\\"mj-column-per-100 outlook-group-fix\\\" style=\\\"font-size: 13px; text-align: left; direction: ltr; display: inline-block; vertical-align: bottom; width: 100%;\\\">\\r\\n<table style=\\\"vertical-align: bottom;\\\" role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<table style=\\\"border-collapse: collapse; border-spacing: 0px;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"width: 130px;\\\"><img style=\\\"border: 0; display: block; outline: none; text-decoration: none; width: 100%;\\\" src=\\\"{LOGO_URL}\\\" width=\\\"130\\\" height=\\\"auto\\\" \\/><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; padding-bottom: 40px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 24px; font-weight: bold; line-height: 1; text-align: center; color: #555;\\\">Welcome!<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\">Hello {USER_NAME}!<\\/div>\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\"><br \\/>Thank you for signing up. We\'re really happy to have you! Click the link below to login to your account:<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; padding-top: 30px; padding-bottom: 50px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<table style=\\\"border-collapse: separate; line-height: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"border: none; border-radius: 3px; color: #ffffff; cursor: auto; padding: 15px 25px;\\\" role=\\\"presentation\\\" align=\\\"center\\\" valign=\\\"middle\\\" bgcolor=\\\"#333333\\\"><a style=\\\"background: #333333; color: #ffffff; font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 15px; font-weight: normal; line-height: 120%; margin: 0; text-decoration: none; text-transform: none;\\\" href=\\\"{SIGNIN_URL}\\\"> Login to Your Account <\\/a><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #525252;\\\">Cheers,<br \\/><a style=\\\"color: #2f67f6;\\\" href=\\\"{SITE_DOMAIN}\\\">{SITE_NAME}<\\/a><\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<td\\r\\nstyle=\\\"vertical-align:bottom;width:600px;\\\"\\r\\n>\\r\\n<![endif]-->\\r\\n<div class=\\\"mj-column-per-100 outlook-group-fix\\\" style=\\\"font-size: 13px; text-align: left; direction: ltr; display: inline-block; vertical-align: bottom; width: 100%;\\\">\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"vertical-align: bottom; padding: 0;\\\">\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 0; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 12px; font-weight: 300; line-height: 1; text-align: center; color: #575757;\\\">{SITE_NAME}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<![endif]--><\\/div>\\r\\n<\\/body>\\r\\n\\r\\n<\\/html>\",\"subject\":\"Welcome to {SITE_NAME}\"}]'),
(11, 'Contact Form Notification', 'Your Site Name', 'false', 0, '[{\"message\":\"<!DOCTYPE html>\\r\\n<html>\\r\\n<head>\\r\\n<\\/head>\\r\\n<body>\\r\\n<p><!-- [if !mso]> --> <!--<![endif]--> <!-- [if !mso]><!--><!--<![endif]--> <!-- [if mso]>\\r\\n<xml>\\r\\n<o:OfficeDocumentSettings>\\r\\n<o:AllowPNG\\/>\\r\\n<o:PixelsPerInch>96<\\/o:PixelsPerInch>\\r\\n<\\/o:OfficeDocumentSettings>\\r\\n<\\/xml>\\r\\n<![endif]--> <!-- [if lte mso 11]>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n.outlook-group-fix { width:100% !important; }\\r\\n<\\/style>\\r\\n<![endif]--><\\/p>\\r\\n<div style=\\\"background-color: #f9f9f9;\\\"><!-- [if mso | IE]>\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"background: #f9f9f9; background-color: #f9f9f9; margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"background: #f9f9f9; background-color: #f9f9f9; width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"border-bottom: #F44336 solid 5px; direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"background: #fff; background-color: #fff; margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"background: #fff; background-color: #fff; width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"border: #dddddd solid 1px; border-top: 0px; direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<td\\r\\nstyle=\\\"vertical-align:bottom;width:600px;\\\"\\r\\n>\\r\\n<![endif]-->\\r\\n<div class=\\\"mj-column-per-100 outlook-group-fix\\\" style=\\\"font-size: 13px; text-align: left; direction: ltr; display: inline-block; vertical-align: bottom; width: 100%;\\\">\\r\\n<table style=\\\"vertical-align: bottom;\\\" role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<table style=\\\"border-collapse: collapse; border-spacing: 0px;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"width: 160px;\\\"><img style=\\\"border: 0; display: block; outline: none; text-decoration: none; width: 100%;\\\" src=\\\"{LOGO_URL}\\\" width=\\\"160\\\" height=\\\"auto\\\" \\/><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; padding-bottom: 40px; word-break: break-word;\\\" align=\\\"center\\\">&nbsp;<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 24px; font-weight: bold; line-height: 1; text-align: center; color: #555;\\\">Contact Form Notification<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; padding-bottom: 30px; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: center; color: #555;\\\">You have just receive a new message<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\"><strong>Name:<\\/strong> {USER_NAME}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\"><strong>Email:<\\/strong> {USER_EMAIL}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\"><strong>Phone:<\\/strong> {USER_PHONE}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 10px 25px; padding-bottom: 30px; word-break: break-word;\\\" align=\\\"left\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 16px; line-height: 22px; text-align: left; color: #555;\\\"><strong>Message:<\\/strong><br \\/><br \\/>{USER_MESSAGE}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n\\r\\n<table\\r\\nalign=\\\"center\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\" style=\\\"width:600px;\\\" width=\\\"600\\\"\\r\\n>\\r\\n<tr>\\r\\n<td style=\\\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\\\">\\r\\n<![endif]-->\\r\\n<div style=\\\"margin: 0px auto; max-width: 600px;\\\">\\r\\n<table style=\\\"width: 100%;\\\" role=\\\"presentation\\\" border=\\\"0\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" align=\\\"center\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;\\\"><!-- [if mso | IE]>\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" cellpadding=\\\"0\\\" cellspacing=\\\"0\\\">\\r\\n\\r\\n<tr>\\r\\n\\r\\n<td\\r\\nstyle=\\\"vertical-align:bottom;width:600px;\\\"\\r\\n>\\r\\n<![endif]-->\\r\\n<div class=\\\"mj-column-per-100 outlook-group-fix\\\" style=\\\"font-size: 13px; text-align: left; direction: ltr; display: inline-block; vertical-align: bottom; width: 100%;\\\">\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"vertical-align: bottom; padding: 0;\\\">\\r\\n<table role=\\\"presentation\\\" border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">\\r\\n<tbody>\\r\\n<tr>\\r\\n<td style=\\\"font-size: 0px; padding: 0; word-break: break-word;\\\" align=\\\"center\\\">\\r\\n<div style=\\\"font-family: \'Helvetica Neue\',Arial,sans-serif; font-size: 12px; font-weight: 300; line-height: 1; text-align: center; color: #575757;\\\">{SITE_NAME}<\\/div>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n\\r\\n<\\/tr>\\r\\n\\r\\n<\\/table>\\r\\n<![endif]--><\\/td>\\r\\n<\\/tr>\\r\\n<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/div>\\r\\n<!-- [if mso | IE]>\\r\\n<\\/td>\\r\\n<\\/tr>\\r\\n<\\/table>\\r\\n<![endif]--><\\/div>\\r\\n<\\/body>\\r\\n<\\/html>\",\"subject\":\"Notification\"}]');

-- SEPARATOR --

CREATE TABLE `equipments` (
  `equipment_id` int(11) NOT NULL,
  `equipment_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `equipment_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `equipment_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `exercise_reps` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `exercise_sets` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `exercise_rest` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5',
  `exercise_time` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '30',
  `exercise_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'repsbased',
  `exercise_equipments` text COLLATE utf8_unicode_ci NOT NULL,
  `exercise_description` text COLLATE utf8_unicode_ci NOT NULL,
  `exercise_bodyparts` text COLLATE utf8_unicode_ci NOT NULL,
  `exercise_levels` text COLLATE utf8_unicode_ci NOT NULL,
  `exercise_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `exercise_video` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `exercise_author` int(11) NOT NULL,
  `exercise_status` int(11) NOT NULL DEFAULT 1,
  `exercise_availability` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `exercise_instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `exercise_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exercise_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `goal_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `goal_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `goal_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `levels` (
  `level_id` int(11) NOT NULL,
  `level_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level_rate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `level_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meal_days` text COLLATE utf8_unicode_ci NOT NULL,
  `meal_categories` text COLLATE utf8_unicode_ci NOT NULL,
  `meal_featured` int(11) NOT NULL DEFAULT 0,
  `meal_author` int(11) NOT NULL,
  `meal_trainer` int(11) NOT NULL,
  `meal_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meal_availability` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `meal_calories` int(11) NOT NULL,
  `meal_status` int(11) NOT NULL DEFAULT 1,
  `meal_created` datetime NOT NULL DEFAULT current_timestamp(),
  `meal_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- SEPARATOR --

CREATE TABLE `meals_users` (
  `id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `member_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_status` tinyint(1) NOT NULL DEFAULT 1,
  `member_role` int(11) NOT NULL,
  `member_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `member_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

INSERT INTO `members` (`member_id`, `member_name`, `member_email`, `member_password`, `member_status`, `member_role`, `member_updated`, `member_created`) VALUES
(1, 'Wicombit', 'admin@admin.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 1, 1, '2023-01-09 10:51:50', '2023-01-09 10:51:50'),
(2, 'User', 'user@user.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 1, 5, '2023-01-09 12:18:02', '2023-01-09 12:18:02');

-- SEPARATOR --

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `post_description` text COLLATE utf8_unicode_ci NOT NULL,
  `post_tags` text COLLATE utf8_unicode_ci NOT NULL,
  `post_featured` int(11) NOT NULL DEFAULT 0,
  `post_author` int(11) NOT NULL,
  `post_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `post_availability` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `post_status` int(11) NOT NULL DEFAULT 1,
  `post_created` datetime NOT NULL DEFAULT current_timestamp(),
  `post_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- SEPARATOR --

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_tags` text COLLATE utf8_unicode_ci NOT NULL,
  `product_featured` int(11) NOT NULL DEFAULT 0,
  `product_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_old_price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `product_author` int(11) NOT NULL,
  `product_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `product_availability` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `product_created` datetime NOT NULL DEFAULT current_timestamp(),
  `product_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- SEPARATOR --

CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `file` text NOT NULL,
  `type` varchar(40) NOT NULL,
  `size` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `is_main` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- SEPARATOR --

CREATE TABLE `product_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tag_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- SEPARATOR --

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `recipe_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `recipe_description` text COLLATE utf8_unicode_ci NOT NULL,
  `recipe_ingredients` text COLLATE utf8_unicode_ci NOT NULL,
  `recipe_steps` text COLLATE utf8_unicode_ci NOT NULL,
  `recipe_categories` text COLLATE utf8_unicode_ci NOT NULL,
  `recipe_author` int(11) NOT NULL,
  `recipe_status` int(11) NOT NULL DEFAULT 1,
  `recipe_featured` int(11) NOT NULL DEFAULT 0,
  `recipe_availability` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `recipe_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `recipe_created` datetime NOT NULL DEFAULT current_timestamp(),
  `recipe_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(50) NOT NULL,
  `role_permissions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

INSERT INTO `roles` (`role_id`, `role_title`, `role_permissions`) VALUES
(1, 'Administrator', '[\"view_exercises\",\"edit_exercises\",\"delete_exercises\",\"create_exercises\",\"view_categories\",\"edit_categories\",\"delete_categories\",\"create_categories\",\"view_workouts\",\"edit_workouts\",\"delete_workouts\",\"create_workouts\",\"view_bodyparts\",\"edit_bodyparts\",\"delete_bodyparts\",\"create_bodyparts\",\"view_equipments\",\"edit_equipments\",\"delete_equipments\",\"create_equipments\",\"view_levels\",\"edit_levels\",\"delete_levels\",\"create_levels\",\"view_goals\",\"edit_goals\",\"delete_goals\",\"create_goals\",\"view_users\",\"edit_users\",\"delete_users\",\"create_users\",\"view_recipes\",\"edit_recipes\",\"delete_recipes\",\"create_recipes\",\"view_posts\",\"edit_posts\",\"delete_posts\",\"create_posts\",\"view_etemplates\",\"edit_etemplates\",\"delete_etemplates\",\"create_etemplates\",\"view_settings\",\"edit_settings\",\"view_trainers\",\"edit_trainers\",\"delete_trainers\",\"create_trainers\",\"view_products\",\"edit_products\",\"delete_products\",\"create_products\",\"view_tags\",\"edit_tags\",\"delete_tags\",\"create_tags\",\"view_product_tags\",\"edit_product_tags\",\"delete_product_tags\",\"create_product_tags\",\"view_members\",\"edit_members\",\"delete_members\",\"create_members\",\"view_meals\",\"edit_meals\",\"delete_meals\",\"create_meals\",\"view_roles\",\"edit_roles\",\"create_roles\"]'),
(5, 'Trainer', '[\"view_exercises\",\"edit_exercises\",\"delete_exercises\",\"create_exercises\",\"view_workouts\",\"edit_workouts\",\"delete_workouts\",\"create_workouts\",\"view_bodyparts\",\"edit_bodyparts\",\"delete_bodyparts\",\"create_bodyparts\",\"view_equipments\",\"edit_equipments\",\"create_equipments\",\"view_levels\",\"edit_levels\",\"create_levels\",\"view_goals\",\"edit_goals\",\"create_goals\"]');

-- SEPARATOR --

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `st_dateformat` varchar(50) NOT NULL DEFAULT 'd/m/Y',
  `st_timezone` varchar(100) NOT NULL DEFAULT 'UTC',
  `st_timeformat` varchar(50) NOT NULL DEFAULT '24hour',
  `st_recipientemail` varchar(100) NOT NULL,
  `st_smtphost` varchar(50) NOT NULL,
  `st_smtpemail` varchar(100) NOT NULL,
  `st_smtppassword` varchar(50) NOT NULL,
  `st_smtpencrypt` varchar(50) NOT NULL,
  `st_smtpport` varchar(50) NOT NULL,
  `st_aboutus` text NOT NULL,
  `st_privacypolicy` text NOT NULL,
  `st_termsofservice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

INSERT INTO `settings` (`id`, `st_dateformat`, `st_timezone`, `st_timeformat`, `st_recipientemail`, `st_smtphost`, `st_smtpemail`, `st_smtppassword`, `st_smtpencrypt`, `st_smtpport`, `st_aboutus`, `st_privacypolicy`, `st_termsofservice`) VALUES
(1, 'd/m/Y', 'Europe/London', '24hour', 'support@wicombit.com', 'HOST', 'EMAIL', 'PASSWORD', 'ENCRYPT', 'PORT', '', '', '');

-- SEPARATOR --

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `tag_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- SEPARATOR --

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `trainer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trainer_member` int(11) NOT NULL,
  `trainer_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trainer_avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trainer_status` tinyint(1) NOT NULL DEFAULT 1,
  `trainer_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trainer_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

CREATE TABLE `trainers_users` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

CREATE TABLE `workouts` (
  `workout_id` int(11) NOT NULL,
  `workout_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `workout_description` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_goals` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_levels` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_bodyparts` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_trainer` int(11) NOT NULL,
  `workout_author` int(11) NOT NULL DEFAULT 0,
  `workout_equipments` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_exercises` text COLLATE utf8_unicode_ci NOT NULL,
  `workout_status` int(11) NOT NULL DEFAULT 1,
  `workout_availability` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `workout_rate` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `workout_type` enum('single','weekly') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'single',
  `workout_image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `workout_created` datetime NOT NULL DEFAULT current_timestamp(),
  `workout_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SEPARATOR --

CREATE TABLE `workouts_users` (
  `id` int(11) NOT NULL,
  `workout_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- SEPARATOR --

ALTER TABLE `bodyparts`
  ADD PRIMARY KEY (`bodypart_id`);

-- SEPARATOR --

ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

-- SEPARATOR --

ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`email_id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `equipments`
  ADD PRIMARY KEY (`equipment_id`);

-- SEPARATOR --

ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

-- SEPARATOR --

ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`);

-- SEPARATOR --

ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

-- SEPARATOR --

ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `meals_users`
  ADD PRIMARY KEY (`id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`) USING BTREE,
  ADD UNIQUE KEY `user_email` (`member_email`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

-- SEPARATOR --

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

-- SEPARATOR --

ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

-- SEPARATOR --

ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`tag_id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

-- SEPARATOR --

ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

-- SEPARATOR --

ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`) USING BTREE,
  ADD UNIQUE KEY `trainer_user` (`trainer_member`) USING BTREE;

-- SEPARATOR --

ALTER TABLE `trainers_users`
  ADD PRIMARY KEY (`id`);

-- SEPARATOR --

ALTER TABLE `workouts`
  ADD PRIMARY KEY (`workout_id`);

-- SEPARATOR --

ALTER TABLE `workouts_users`
  ADD PRIMARY KEY (`id`);

-- SEPARATOR --

ALTER TABLE `bodyparts`
  MODIFY `bodypart_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `emailtemplates`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

-- SEPARATOR --

ALTER TABLE `equipments`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `meals_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

-- SEPARATOR --

ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- SEPARATOR --

ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `product_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- SEPARATOR --

ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- SEPARATOR --

ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `trainers_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `workouts`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT;

-- SEPARATOR --

ALTER TABLE `workouts_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
