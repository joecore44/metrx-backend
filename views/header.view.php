<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Dashboard</title>
    <link href="../assets/images/favicon.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/customScroll/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../assets/icons/dripicons/dripicons.css">
    <link rel="stylesheet" href="../assets/icons/tabler/tabler-icons.min.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sweetalert.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
    <link rel="stylesheet" href="../assets/css/fileuploader.css">
    <link rel="stylesheet" href="../assets/css/fileuploader-theme-gallery.css">
    <link rel="stylesheet" href="../assets/css/checkbox.css">
    <link rel="stylesheet" href="../assets/css/flag-icons.min.css">
    <link rel="stylesheet" href="../assets/css/select2.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="../assets/plugins/date-range/daterangepicker.css">

    <script type="text/javascript">
    /* Global js vars */
    var TINYMCELANG = "en";
    var TIMEIN24H = true;
    var IMAGES_FOLDER = "<?= $target_dir; ?>";
    var ST_SAVECHANGES = "<?= _SAVECHANGES; ?>";
    var ST_CHANGESSAVED = "<?= _CHANGESSAVED; ?>";
    var ST_PROCESSING = "<?= _PROCESSING; ?>";
    var ST_SENDBUTTON = "<?= _EMAILSENDBUTTON; ?>";
    var ST_AREYOUSURE = "<?= _AREYOUSURE; ?>";
    var ST_AREYOUSUREDELETE = "<?= _AREYOUSUREDELETE; ?>";
    var ST_YOUWILLNOT = "<?= _YOUWILLNOT; ?>";
    var ST_YESDELETEIT = "<?= _YESDELETEIT; ?>";
    var ST_CANCELBUTTONALERT = "<?= _CANCELBUTTONALERT; ?>";
    var ST_DUPLICATETITLE = "<?= _DUPLICATETITLE; ?>";
    var ST_DUPLICATETEXT = "<?= _DUPLICATETEXT; ?>";
    var ST_DUPLICATEDONE = "<?= _DUPLICATEDONE; ?>";
    var ST_DUPLICATECOMPLETED = "<?= _DUPLICATECOMPLETED; ?>";
    var ST_FILEUPLOADERCHOOSE = "<?= _FILEUPLOADERCHOOSE; ?>";
    var ST_FILEUPLOADERSELECT = "<?= _FILEUPLOADERSELECT; ?>";
    var ST_FILEUPLOADERYOUHAVE = "<?= _FILEUPLOADERYOUHAVE; ?>";
    var ST_FILEUPLOADERFILE = "<?= _FILEUPLOADERFILE; ?>";
    var ST_FILEUPLOADERFILES = "<?= _FILEUPLOADERFILES; ?>";
    var ST_FILEUPLOADERDELETEALERT = "<?= _FILEUPLOADERDELETEALERT; ?>";
    var ST_BYDELETINGTHEUSER = "<?= _BYDELETINGTHEUSER; ?>";
    var DETAILSITEM = "<?= _DETAILSITEM; ?>";
    var DISABLEITEM = "<?= _DISABLEITEM; ?>";
    var ENABLEITEM = "<?= _ENABLEITEM; ?>";
    var EDITITEM = "<?= _EDITITEM; ?>";
    var VIEWITEM = "<?= _VIEWITEM; ?>";
    var DELETEITEM = "<?= _DELETEITEM; ?>";
    var APPROVEITEM = "<?= _APPROVEITEM; ?>";
    var VERIFYITEM = "<?= _VERIFYITEM; ?>";
    var REMOVEITEM = "<?= _REMOVEITEM; ?>";
    var ENTERVALUE = "<?= _ENTERVALUE; ?>";
    var DELETEWEEK = "<?= _DELETEWEEK; ?>";
    var DELETEDAY = "<?= _DELETEDAY; ?>";
    var ALLOWEDFILEEXT = <?= json_encode(allowedFileExt()); ?>;
    var ALLOWEDFILESIZE = "<?= (allowedFileSize()/1024/1024); ?>";
    var FIELDTITLE = "<?= _TABLEFIELDTITLE; ?>";
    var FIELDDESCRIPTION = "<?= _TABLEFIELDDESCRIPTION; ?>";
    var FIELDCATEGORY = "<?= _TABLEFIELDCATEGORY; ?>";
    var FIELDVALUE = "<?= _TABLEFIELDVALUE; ?>";
    var WEEKTEXT = "<?= _WEEKTEXT; ?>";
    var DAYTEXT = "<?= _DAYTEXT; ?>";
    var MEALTEXT = "<?= _MEALTEXT; ?>";

    </script>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/sweetalert.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/jquery.fileuploader.min.js"></script>
    <script src="../assets/js/jquery.uploadPreview.js"></script>
    <script src="../assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="../assets/js/jquery.mswitch.js"></script>
    <script src="../assets/js/bootstrap-colorpicker.js"></script>
    <script src="../assets/js/header.js"></script>

</head>
<body>