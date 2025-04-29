<?php
// api/newsletter_subscribe.php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/send_email.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

// --- Send Thank You Email (HTML) ---
$subject1 = "Thank you for subscribing to Woolify's Newsletter!";
$message1_html = '<div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;">
  <h2 style="color:#5F975F;">Thank you for subscribing!</h2>
  <p><strong>Hello! This is Ankit from Woolify,</strong></p>
  <p>Thank you for subscribing to <b>Woolify\'s newsletter</b>. We\'re excited to have you join our community of sustainable wool producers and enthusiasts.</p>
  <p>You\'ll receive <b>updates, tips, and the latest news</b> from the world of wool.</p>
  <hr style="border:none;border-top:1px solid #eee;">
  <p style="color:#888;font-size:13px;">Best regards,<br><b>The Woolify Team</b></p>
</div>';
$message1_text = "Hello! This is Ankit from Woolify,\n\nThank you for subscribing to Woolify's newsletter. We're excited to have you join our community of sustainable wool producers and enthusiasts.\n\nYou'll receive updates, tips, and the latest news from the world of wool.\n\nBest regards,\nThe Woolify Team";

// --- Send News Email (HTML) ---
$subject2 = "Woolify News: Sustainable Wool Trends & Tips";
$message2_html = '<div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;">
  <h2 style="color:#5F975F;">Woolify News</h2>
  <p>Hi there!</p>
  <ul style="padding-left:18px;">
    <li><b>Indian wool prices</b> are stable this month.</li>
    <li>New <b>sustainable farming techniques</b> are being adopted by top producers.</li>
    <li><b>Woolify platform</b> now supports batch tracking for all users!</li>
  </ul>
  <p>Stay tuned for more updates.</p>
  <hr style="border:none;border-top:1px solid #eee;">
  <p style="color:#888;font-size:13px;">Warm regards,<br><b>The Woolify Team</b></p>
</div>';
$message2_text = "Hi there!\n\nHere's some fresh news from Woolify:\n- Indian wool prices are stable this month.\n- New sustainable farming techniques are being adopted by top producers.\n- Woolify platform now supports batch tracking for all users!\n\nStay tuned for more updates.\n\nWarm regards,\nThe Woolify Team";

$ok1 = send_email_gmail($email, $subject1, $message1_html, $message1_text);
$ok2 = send_email_gmail($email, $subject2, $message2_html, $message2_text);

if ($ok1) {
    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing! Please check your email.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
} 