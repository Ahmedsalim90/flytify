/**
 * HINT FILE — Flytify Brochure Generator
 *
 * This file does NOT run. It's a collection of hints and code
 * snippets for when you're ready to build generate.php.
 *
 * HOW TO USE:
 *   1. Create a file called generate.php in this folder
 *   2. Copy the snippets below into it
 *   3. Fill in the [...blank...] parts
 *   4. Connect it to test.html by wrapping the form fields
 *      in <form action="generate.php" method="POST" enctype="multipart/form-data">
 *
 * NEED HELP? Check the README.md for the full tutorial.
 */

// ─────────────────────────────────────────────
// 1. CHECK IF FORM WAS SUBMITTED
// ─────────────────────────────────────────────
// HTML forms using method="POST" send data that
// PHP reads from $_POST and $_FILES.

/*
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: test.html');
    exit;
}
*/

// ─────────────────────────────────────────────
// 2. READ FORM DATA
// ─────────────────────────────────────────────
// Each input in test.html with a name="..." attribute
// becomes available as $_POST['...'].

/*
$fullName    = $_POST['full_name'] ?? '';
$companyName = $_POST['company_name'] ?? '';
$tagline     = $_POST['tagline'] ?? '';
$email       = $_POST['email'] ?? '';
$phone       = $_POST['phone'] ?? '';
$model       = $_POST['model'] ?? 'model1';
$primaryColor   = $_POST['primary_color'] ?? '#3B82F6';
$secondaryColor = $_POST['secondary_color'] ?? '#1E3A5F';
*/

// TODO: Add the extra fields you created in test.html

// ─────────────────────────────────────────────
// 3. CONNECT TO THE DATABASE
// ─────────────────────────────────────────────
// See config/schema.sql first to understand the database.
// Then use PDO to connect. Ask your mentor about
// "prepared statements" — they prevent SQL injection.

/*
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME');
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
*/

// ─────────────────────────────────────────────
// 4. SAVE TO DATABASE
// ─────────────────────────────────────────────
// Use a prepared statement with ? placeholders.
// This is the SAFE way to insert user data.

/*
$sql = "INSERT INTO submissions (full_name, company_name, tagline, ...)
        VALUES (?, ?, ?, ...)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$fullName, $companyName, $tagline, ...]);
*/

// ─────────────────────────────────────────────
// 5. HANDLE FILE UPLOAD
// ─────────────────────────────────────────────
// Files arrive in $_FILES['logo']. Move them to
// the uploads/ folder with a unique name.

/*
if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
    $ext  = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $name = 'logo_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/' . $name);
}
*/

// ─────────────────────────────────────────────
// 6. RENDER THE BROCHURE
// ─────────────────────────────────────────────
// Load the selected template from models/ and
// replace {{PLACEHOLDERS}} with the user's data.

/*
$template = file_get_contents('models/' . $model . '.html');

$replacements = [
    '{{FULL_NAME}}'       => $fullName,
    '{{COMPANY_NAME}}'    => $companyName,
    '{{TAGLINE}}'         => $tagline,
    '{{EMAIL}}'           => $email,
    '{{PHONE}}'           => $phone,
    '{{PRIMARY_COLOR}}'   => $primaryColor,
    '{{SECONDARY_COLOR}}' => $secondaryColor,
];

$output = str_replace(
    array_keys($replacements),
    array_values($replacements),
    $template
);

echo $output;
*/
