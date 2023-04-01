<?php
define('ROOT', realpath(__DIR__ . '/..') . '/');

if(file_exists(ROOT . 'install/installed')) {
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <title>FitPro Installation</title>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="d-flex">
            <div class="mr-3">
                <img src="./assets/images/logo.png" class="img-fluid logo" />
            </div>

            <div class="d-flex flex-column justify-content-center">
                <h1>Installation</h1>
                <p class="subheader d-flex flex-row">
                        <span class="text-light" style="opacity:0.7">
                            <a href="https://wicombit.com" target="_blank" class="text-gray-500">FitPro</a> by <a href="https://wicombit.com" target="_blank" class="text-gray-500">Wicombit</a>
                        </span>
                </p>
            </div>
        </div>
    </div>
</header>

<main class="main">
    <div class="container">
        <div class="row">

            <div class="col col-md-3 d-none d-md-block">
                <nav class="nav sidebar-nav">
                    <ul class="sidebar" id="sidebar-ul">
                        <li class="nav-item">
                            <a href="#welcome" class="navigator nav-link">Welcome</a>
                        </li>

                        <li class="nav-item">
                            <a href="#requirements" class="navigator nav-link" style="display: none">Requirements</a>
                        </li>

                        <li class="nav-item">
                            <a href="#setup" class="navigator nav-link" style="display: none">Setup</a>
                        </li>

                        <li class="nav-item">
                            <a href="#finish" class="navigator nav-link" style="display: none">Finish</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col" id="content">

                <section id="welcome" style="display: none">
                    <h2>Welcome</h2>

                    <p>By continuing with the installation process, you are agreeing to the privacy policy and terms of service of Wicombit, which are mentioned in their respective pages on <a href="https://wicombit.com" target="_blank">https://wicombit.com</a>.</p>
                    <a href="#requirements" id="welcome_start" class="navigator btn btn-block btn-primary">Start the installation</a>
                    
                </section>

                <section id="requirements" style="display: none">
                    <?php $requirements = true ?>
                    <h2>Requirements</h2>

                    <table class="table mt-3">
                        <thead>
                        <th class="bg-gray-200"></th>
                        <th class="bg-gray-200">Required</th>
                        <th class="bg-gray-200">Current</th>
                        <th class="bg-gray-200"></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>PHP Version</td>
                            <td>8.0</td>
                            <td><?= PHP_VERSION ?></td>
                            <td>
                                <?php if(version_compare(PHP_VERSION, '8.0.0') >= 0): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>cURL</td>
                            <td>Enabled</td>
                            <td><?= function_exists('curl_version') ? 'Enabled' : 'Not Enabled' ?></td>
                            <td>
                                <?php if(function_exists('curl_version')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>OpenSSL</td>
                            <td>Enabled</td>
                            <td><?= extension_loaded('openssl') ? 'Enabled' : 'Not Enabled' ?></td>
                            <td>
                                <?php if(extension_loaded('openssl')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>mbstring</td>
                            <td>Enabled</td>
                            <td><?= extension_loaded('mbstring') && function_exists('mb_get_info') ? 'Enabled' : 'Not Enabled' ?></td>
                            <td>
                                <?php if(extension_loaded('mbstring') && function_exists('mb_get_info')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>MySQLi</td>
                            <td>Enabled</td>
                            <td><?= function_exists('mysqli_connect') ? 'Enabled' : 'Not Enabled' ?></td>
                            <td>
                                <?php if(function_exists('mysqli_connect')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>PDO</td>
                            <td>Enabled</td>
                            <td><?= extension_loaded('pdo') ? 'Enabled' : 'Not Enabled' ?></td>
                            <td>
                                <?php if(extension_loaded('pdo')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <table class="table mt-5">
                        <thead>
                        <th class="bg-gray-200">Path / File</th>
                        <th class="bg-gray-200">Status</th>
                        <th class="bg-gray-200"></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>/images/</td>
                            <td><?= is_writable(ROOT . 'images/') ? 'Writable' : 'Not Writable' ?></td>
                            <td>
                                <?php if(is_writable(ROOT . 'images/')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>/config.php</td>
                            <td><?= is_writable(ROOT . 'config.php') ? 'Writable' : 'Not Writable' ?></td>
                            <td>
                                <?php if(is_writable(ROOT . 'config.php')): ?>
                                    <img src="assets/svg/check-circle-solid.svg" class="img-fluid img-icon text-success" />
                                <?php else: ?>
                                    <img src="assets/svg/times-circle-solid.svg" class="img-fluid img-icon text-danger" />
                                    <?php $requirements = false; ?>
                                <?php endif ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <?php if($requirements): ?>
                            <a href="#setup" class="navigator btn btn-block btn-primary">Next</a>
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">
                                Please make sure all the requirements listed on the documentation and on this page are met before continuing!
                            </div>
                            <p class="text-danger"></p>
                        <?php endif ?>
                    </div>
                </section>

                <section id="setup" style="display: none">
                    <?php
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $installation_url = preg_replace('/install\/$/', '', $actual_link);
                    $final_url = preg_replace('/\/$/', '', $installation_url);
                    ?>
                    <h2>Setup</h2>

                    <form id="setup_form" method="post" action="" role="form">

                    <div class="form-group">
                            <label for="license_key">License key/email</label>
                            <input type="text" class="form-control" id="license_key" name="license_key" required="required">
                            <small class="form-text text-muted">The unique license key that you got after purchasing or your purchase email</small>
                        </div>

                        <div class="form-group">
                            <label for="installation_url">Website URL</label>
                            <input type="text" class="form-control" id="installation_url" name="installation_url" value="<?= $final_url ?>" placeholder="https://example.com/" required="required">
                            <small class="form-text text-muted">Make sure to specify the full url of the installation path of the product.<br /> Subdomain example: <code>https://subdomain.domain.com/</code> <br />Subfolder example: <code>https://domain.com/product/</code></small>
                        </div>

                        <h3 class="mt-5">Database Details</h3>
                        <p>Fill in the database details that you will use for the installation of this product.</p>

                        <div class="form-group">
                            <label for="database_host">Host</label>
                            <input type="text" class="form-control" id="database_host" name="database_host" value="localhost" required="required">
                        </div>

                        <div class="form-group">
                            <label for="database_name">Name</label>
                            <input type="text" class="form-control" id="database_name" name="database_name" required="required">
                        </div>

                        <div class="form-group">
                            <label for="database_username">Username</label>
                            <input type="text" class="form-control" id="database_username" name="database_username" required="required">
                        </div>

                        <div class="form-group">
                            <label for="database_password">Password</label>
                            <input type="password" class="form-control" id="database_password" name="database_password">
                        </div>

                        <h3 class="mt-5">Firebase</h3>
                        <p>Fill in the firebase database url that you will use to get users progress.</p>

                        <div class="form-group">
                            <label for="firebase_url">Database Url</label>
                            <input type="text" class="form-control" id="firebase_url" name="firebase_url" required="required">
                        </div>

                        <button type="submit" name="submit" class="btn btn-block btn-primary mt-5">Finish installation</button>
                    </form>
                </section>

                <section id="finish" style="display: none">
                    <h2>Installation Completed</h2>
                    <p class="text-success">Congratulations! You have successfully installed FitPro</p>

                    <p>You can now login with the following information:</p>

                    <table class="table">
                        <tbody>
                        <tr>
                            <th>URL</th>
                            <td><a href="" id="final_url"></a></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>admin@admin.com</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>123456</td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </div>

        </div>
    </div>
</main>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
