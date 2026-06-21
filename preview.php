<?php
require 'config/database.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM submissions WHERE id = ?");
$stmt->execute([$id]);
$b = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$b) {
    die('Brochure not found');
}

$template = file_get_contents('models/' . $b['model'] . '.html');

$replacements = [
    '{{FULL_NAME}}'       => $b['full_name'] ?? '',
    '{{COMPANY_NAME}}'    => $b['company_name'] ?? '',
    '{{TAGLINE}}'         => $b['tagline'] ?? '',
    '{{EMAIL}}'           => $b['email'] ?? '',
    '{{PHONE}}'           => $b['phone'] ?? '',
    '{{ADDRESS}}'         => $b['address'] ?? '',
    '{{ABOUT}}'           => $b['about'] ?? '',
    '{{SERVICES}}'        => $b['services'] ?? '',
    '{{PRIMARY_COLOR}}'   => $b['primary_color'] ?? '#10B981',
    '{{SECONDARY_COLOR}}' => $b['secondary_color'] ?? '#064E3B',
    '{{LOGO_PATH}}'       => $b['logo_path'] ?? '',
    '{{SERVICE_1}}'       => $b['service_1'] ?? '',
    '{{SERVICE_2}}'       => $b['service_2'] ?? '',
    '{{SERVICE_3}}'       => $b['service_3'] ?? '',
    '{{WHY_CHOOSE_US}}'   => $b['why_choose_us'] ?? '',
    '{{WHY_CHOOSE_US_1}}' => $b['why_choose_us_1'] ?? '',
    '{{WHY_CHOOSE_US_2}}' => $b['why_choose_us_2'] ?? '',
    '{{WHY_CHOOSE_US_3}}' => $b['why_choose_us_3'] ?? '',
];

echo str_replace(array_keys($replacements), array_values($replacements), $template);