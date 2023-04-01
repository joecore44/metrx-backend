<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require './config.php';
require './functions.php';

use ICanBoogie\DateTime;
use onesignal\client\api\DefaultApi;
use onesignal\client\Configuration;
use onesignal\client\model\GetNotificationRequestBody;
use onesignal\client\model\Notification;
use onesignal\client\model\StringMap;
use onesignal\client\model\Player;
use onesignal\client\model\UpdatePlayerTagsRequestBody;
use onesignal\client\model\ExportPlayersRequestBody;
use onesignal\client\model\Segment;
use onesignal\client\model\FilterExpressions;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

const APP_ID = 'd1f3c852-8054-4b4a-a2b8-13637ff73360';
const APP_KEY_TOKEN = 'MDUyMTMzNWUtNjU2NC00YjZlLWFlNTEtZDMyOGI3YmQwMTA4';
const USER_KEY_TOKEN = 'NTRhYWQ5MGQtYTNlOS00MzVmLWFmYzktZjJkNDhlMjExMDI0';

$config = Configuration::getDefaultConfiguration()
    ->setAppKeyToken(APP_KEY_TOKEN)
    ->setUserKeyToken(USER_KEY_TOKEN);

$apiInstance = new DefaultApi(
    new GuzzleHttp\Client(),
    $config
);

$notification = 'PHP Test notification';

$result = $apiInstance->createNotification($notification);
print_r($result);

?>