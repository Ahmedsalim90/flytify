<?php

// Load .env file
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// 1. Check form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: test.html');
    exit;
}

// 2. Read form data
$fullName       = $_POST['full_name'] ?? '';
$companyName    = $_POST['company_name'] ?? '';
$tagline        = $_POST['tagline'] ?? '';
$email          = $_POST['email'] ?? '';
$phone          = $_POST['phone'] ?? '';
$address        = $_POST['address'] ?? '';
$about          = $_POST['about'] ?? '';
$services       = $_POST['services'] ?? '';
$model          = $_POST['model'] ?? 'model1';
$primaryColor   = $_POST['primary_color'] ?? '#10B981';
$secondaryColor = $_POST['secondary_color'] ?? '#064E3B';
$service1 = $_POST['service_1'] ?? '';
$service2 = $_POST['service_2'] ?? '';
$service3 = $_POST['service_3'] ?? '';
$whyChooseUs = $_POST['why_choose_us'] ?? '';
$whyChooseUs1 = $_POST['why_choose_us_1'] ?? '';
$whyChooseUs2 = $_POST['why_choose_us_2'] ?? '';
$whyChooseUs3 = $_POST['why_choose_us_3'] ?? '';

// 3. Connect to database
require 'config/database.php';

// 4. Handle logo upload
$logoPath = '';
if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
    $ext      = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $filename = 'logo_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/' . $filename);
    $logoPath = 'uploads/' . $filename;
}

// 5. Save to database
$sql = "INSERT INTO submissions 
        (full_name, company_name, tagline, email, phone, address, about, services, primary_color, secondary_color, model, logo_path, service_1, service_2, service_3, why_choose_us, why_choose_us_1, why_choose_us_2, why_choose_us_3)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$fullName, $companyName, $tagline, $email, $phone, $address, $about, $services, $primaryColor, $secondaryColor, $model, $logoPath, $service1, $service2, $service3, $whyChooseUs, $whyChooseUs1, $whyChooseUs2, $whyChooseUs3]);

// 6. Load and render template
$template = file_get_contents('models/' . $model . '.html');

$replacements = [
    '{{FULL_NAME}}'       => $fullName,
    '{{COMPANY_NAME}}'    => $companyName,
    '{{TAGLINE}}'         => $tagline,
    '{{EMAIL}}'           => $email,
    '{{PHONE}}'           => $phone,
    '{{ADDRESS}}'         => $address,
    '{{ABOUT}}'           => $about,
    '{{SERVICES}}'        => $services,
    '{{PRIMARY_COLOR}}'   => $primaryColor,
    '{{SECONDARY_COLOR}}' => $secondaryColor,
    '{{LOGO_PATH}}'       => $logoPath,
    '{{SERVICE_1}}' => $service1,
    '{{SERVICE_2}}' => $service2,
    '{{SERVICE_3}}' => $service3,
    '{{WHY_CHOOSE_US}}' => $whyChooseUs,
    '{{WHY_CHOOSE_US_1}}' => $whyChooseUs1,
    '{{WHY_CHOOSE_US_2}}' => $whyChooseUs2,
    '{{WHY_CHOOSE_US_3}}' => $whyChooseUs3,
];

$output = str_replace(
    array_keys($replacements),
    array_values($replacements),
    $template
);

// Add download button before the brochure
$downloadBtn = '
<div style="text-align:center; padding: 20px; background:#f8f8f8; border-bottom: 2px solid #10B981;">
    <button onclick="downloadPDF()" style="background:#10B981; color:white; padding:12px 30px; border:none; border-radius:6px; font-size:16px; cursor:pointer; margin-right:10px;">
        💾 Save as PDF
    </button>
    <a href="test.html" style="background:#064E3B; color:white; padding:12px 30px; border-radius:6px; font-size:16px; text-decoration:none;">
        ← Create Another
    </a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.querySelector(".brochure, .banner");
    const opt = {
        margin: 0,
        filename: "brochure.pdf",
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
    };
    html2pdf().set(opt).from(element).save();
}
</script>
';

echo $downloadBtn . $output;