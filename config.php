<?php
require __DIR__ . '/vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;

// Initialize the AWS SSM client
$ssm = new SsmClient([
    'version' => 'latest',
    'region'  => 'ap-southeast-1'  // update to your actual region if different
]);

function getParam($name, $secure = false) {
    global $ssm;
    try {
        $result = $ssm->getParameter([
            'Name' => $name,
            'WithDecryption' => $secure
        ]);
        return $result['Parameter']['Value'];
    } catch (AwsException $e) {
        die("Error retrieving parameter '$name': " . $e->getAwsErrorMessage());
    }
}

// Fetch DB credentials securely from SSM Parameter Store
$host = getParam('/php-app/DB_HOST');
$db   = getParam('/php-app/DB_NAME');
$user = getParam('/php-app/DB_USER');
$pass = getParam('/php-app/DB_PASS', true);

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

session_start();
?>