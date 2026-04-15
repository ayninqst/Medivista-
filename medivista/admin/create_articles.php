<?php
// ============================================================
//  MHIP – Manage Health Warning & Announcement
//  File: create.php  (Admin – Create New Warning)
//  Requires: db.php in the same folder
// ============================================================
require 'db.php';

$errors = [];
$old    = []; // keeps form values if validation fails

// ── PROCESS FORM SUBMISSION ──────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitise & collect inputs
    $old['title']       = trim($_POST['title']       ?? '');
    $old['category']    = trim($_POST['category']    ?? '');
    $old['severity']    = trim($_POST['severity']    ?? '');
    $old['location']    = trim($_POST['location']    ?? '');
    $old['description'] = trim($_POST['description'] ?? '');
    $old['status']      = trim($_POST['status']      ?? 'Active');
    $old['expires_at']  = trim($_POST['expires_at']  ?? '');

    // ── Validation ───────────────────────────────────────────
    if ($old['title'] === '')
        $errors['title'] = 'Warning title is required.';
    elseif (strlen($old['title']) > 255)
        $errors['title'] = 'Title must be 255 characters or fewer.';

    $valid_cats = ['Infectious Disease','Environmental Health','Vaccination',
                   'Food Safety','Mental Health','Chronic Disease','Emergency','Other'];
    if (!in_array($old['category'], $valid_cats))
        $errors['category'] = 'Please select a valid category.';

    $valid_sevs = ['Critical','High','Medium','Low','Informational'];
    if (!in_array($old['severity'], $valid_sevs))
        $errors['severity'] = 'Please select a valid severity level.';

    if ($old['location'] === '')
        $errors['location'] = 'Affected location is required.';

    if ($old['description'] === '')
        $errors['description'] = 'Description is required.';
    elseif (strlen($old['description']) < 20)
        $errors['description'] = 'Description must be at least 20 characters.';

    $valid_statuses = ['Active','Draft','Expired'];
    if (!in_array($old['status'], $valid_statuses))
        $errors['status'] = 'Please select a valid status.';

    if ($old['expires_at'] !== '' && !strtotime($old['expires_at']))
        $errors['expires_at'] = 'Please enter a valid date.';

    // ── Insert if no errors ──────────────────────────────────
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO health_warnings
                (title, category, severity, location, description, status, expires_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $old['title'],
            $old['category'],
            $old['severity'],
            $old['location'],
            $old['description'],
            $old['status'],
            $old['expires_at'] !== '' ? $old['expires_at'] : null,
        ]);

        // Redirect back to list with success message
        header('Location: index.php?created=1');
        exit();
    }
}

// ── HELPERS ───────────────────────────────────────────────────
function esc($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
function old($key, $default = '') {
    global $old;
    return esc($old[$key] ?? $default);
}
function err($key) {
    global $errors;
    if (isset($errors[$key])) {
        echo '<p class="field-error"><svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM7 4h2v4H7V4zm0 5h2v2H7V9z"/></svg> '
             . esc($errors[$key]) . '</p>';
    }
}
function has_err($key) {
    global $errors;
    return isset($errors[$key]) ? 'has-error' : '';
}
function sel($key, $val) {
    global $old;
    return ($old[$key] ?? '') === $val ? 'selected' : '';
}

$categories = [
    'Infectious Disease', 'Environmental Health', 'Vaccination',
    'Food Safety', 'Mental Health', 'Chronic Disease', 'Emergency', 'Other',
];
$severities  = ['Critical', 'High', 'Medium', 'Low', 'Informational'];
$statuses    = ['Active', 'Draft', 'Expired'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MHIP Admin – Post New Warning</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="layout">

  <!-- ══ SIDEBAR ══════════════════════════════ -->
  <aside class="sidebar">
    <div class="sb-logo">
      <div class="sb-icon">🏥</div>
      <div>
        <div class="sb-brand">MHIP</div>
        <div class="sb-sub">Admin Panel</div>
      </div>
    </div>
    <nav class="sb-nav">
      <div class="sb-label">Main Menu</div>
      <a href="#" class="sb-item">
        <svg viewBox="0 0 16 16" fill="currentColor"><path d="M2 2h5v5H2V2zm0 7h5v5H2V9zm7-7h5v5H9V2zm0 7h5v5H9V9z"/></svg>
        Dashboard
      </a>
      <a href="index.php" class="sb-item active">
        <svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 1L1 14h14L8 1zm0 3.5L12.1 13H3.9L8 4.5z"/></svg>
        Health Warnings
      </a>
      <a href="#" class="sb-item">
        <svg viewBox="0 0 16 16" fill="currentColor"><path d="M2 3h12v2H2V3zm0 4h12v2H2V7zm0 4h8v2H2v-2z"/></svg>
        Medical Articles
      </a>
      <a href="#" class="sb-item">
        <svg viewBox="0 0 16 16" fill="currentColor"><path d="M2 2h12v10H9l-3 3v-3H2V2zm4 3h4v2H6V5zm0 3h3v2H6V8z"/></svg>
        Q&amp;A
      </a>
      <div class="sb-label" style="margin-top:16px">Account</div>
      <a href="#" class="sb-item">
        <svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 1a3 3 0 110 6A3 3 0 018 1zM2 13a6 6 0 0112 0H2z"/></svg>
        Users
      </a>
    </nav>
    <div class="sb-footer">
      <div class="sb-user">
        <div class="sb-avatar">FA</div>
        <div>
          <div class="sb-uname">Fatin Afifah</div>
          <div class="sb-urole">Administrator</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- ══ MAIN ═════════════════════════════════ -->
  <div class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div>
        <div class="tb-title">Post New Health Warning</div>
        <div class="tb-crumb">MHIP &rsaquo; Health Warnings &rsaquo; Create</div>
      </div>
      <div class="tb-right">
        <a href="index.php" class="btn btn-ghost">
          <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M10 3L5 8l5 5"/></svg>
          Back to List
        </a>
      </div>
    </div>

    <!-- Content -->
    <div class="content">

      <!-- Page header -->
      <div class="page-header">
        <div>
          <h1>Post New Warning</h1>
          <p>Create a new health warning or public health announcement for the MHIP portal.</p>
        </div>
      </div>

      <!-- ── Validation error banner ── -->
      <?php if (!empty($errors)): ?>
      <div class="error-banner" style="max-width:820px; margin-bottom:20px;">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M8 1a7 7 0 100 14A7 7 0 008 1zM7 4h2v5H7V4zm0 6h2v2H7v-2z"/>
        </svg>
        <div>
          <strong>Please fix the following errors:</strong>
          <ul>
            <?php foreach ($errors as $e): ?>
            <li><?= esc($e) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>

      <!-- ══ FORM ══════════════════════════════ -->
      <form method="POST" action="create.php" id="createForm" novalidate>

        <div class="form-card">

          <!-- Card header -->
          <div class="form-card-head">
            <div class="form-card-icon">⚠️</div>
            <div>
              <h2>Warning Details</h2>
              <p>Fill in all required fields marked with <span style="color:var(--red)">*</span></p>
            </div>
          </div>

          <div class="form-body">

            <!-- ── SECTION 1: Basic Info ── -->
            <div class="form-section">
              <div class="section-title">Basic Information</div>
              <div class="form-grid">

                <!-- Title (full width) -->
                <div class="form-group form-full <?= has_err('title') ?>">
                  <label>
                    Warning Title
                    <span class="required-star">*</span>
                  </label>
                  <input
                    type="text"
                    name="title"
                    id="titleInput"
                    maxlength="255"
                    placeholder="e.g. Dengue Fever Outbreak Alert in Kuantan"
                    value="<?= old('title') ?>"
                    autocomplete="off">
                  <?php err('title') ?>
                  <span class="field-hint">Be specific and clear — this is the headline users will read first.</span>
                </div>

                <!-- Category -->
                <div class="form-group <?= has_err('category') ?>">
                  <label>
                    Category
                    <span class="required-star">*</span>
                  </label>
                  <select name="category" id="categorySelect">
                    <option value="" disabled <?= old('category') === '' ? 'selected' : '' ?>>
                      — Select a category —
                    </option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= sel('category', $cat) ?>>
                      <?= esc($cat) ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                  <?php err('category') ?>
                </div>

                <!-- Location -->
                <div class="form-group <?= has_err('location') ?>">
                  <label>
                    Affected Location
                    <span class="required-star">*</span>
                  </label>
                  <input
                    type="text"
                    name="location"
                    placeholder="e.g. Kuantan, Pahang"
                    value="<?= old('location') ?>">
                  <?php err('location') ?>
                  <span class="field-hint">District, state, or "All Areas" for nationwide alerts.</span>
                </div>

              </div>
            </div><!-- /section 1 -->

            <!-- ── SECTION 2: Severity ── -->
            <div class="form-section">
              <div class="section-title">Severity Level</div>

              <div class="form-group <?= has_err('severity') ?>">
                <label>
                  Severity
                  <span class="required-star">*</span>
                </label>

                <!-- Visual severity chips (clicking sets the hidden select) -->
                <div class="sev-preview" id="sevChips">
                  <span class="sev-chip c <?= old('severity') === 'Critical'      ? 'active' : '' ?>" onclick="setSeverity('Critical')">
                    <span class="sev-dot"></span> Critical
                  </span>
                  <span class="sev-chip h <?= old('severity') === 'High'          ? 'active' : '' ?>" onclick="setSeverity('High')">
                    <span class="sev-dot"></span> High
                  </span>
                  <span class="sev-chip m <?= old('severity') === 'Medium'        ? 'active' : '' ?>" onclick="setSeverity('Medium')">
                    <span class="sev-dot"></span> Medium
                  </span>
                  <span class="sev-chip l <?= old('severity') === 'Low'           ? 'active' : '' ?>" onclick="setSeverity('Low')">
                    <span class="sev-dot"></span> Low
                  </span>
                  <span class="sev-chip i <?= old('severity') === 'Informational' ? 'active' : '' ?>" onclick="setSeverity('Informational')">
                    <span class="sev-dot"></span> Informational
                  </span>
                </div>

                <!-- Hidden select (submitted with form) -->
                <select name="severity" id="severitySelect" style="display:none">
                  <option value="">— Select —</option>
                  <?php foreach ($severities as $sv): ?>
                  <option value="<?= $sv ?>" <?= sel('severity', $sv) ?>><?= $sv ?></option>
                  <?php endforeach; ?>
                </select>
                <?php err('severity') ?>

                <span class="field-hint" id="sevHint" style="margin-top:8px">
                  <?php
                  $hints = [
                      'Critical'      => '🔴 Critical — immediate public danger, requires urgent action.',
                      'High'          => '🟠 High — serious risk, strong advisory issued.',
                      'Medium'        => '🟡 Medium — moderate risk, precautions recommended.',
                      'Low'           => '🟢 Low — minor risk, general awareness only.',
                      'Informational' => '🔵 Informational — no immediate risk, public notice only.',
                  ];
                  echo $hints[old('severity')] ?? 'Select a level to see its description.';
                  ?>
                </span>
              </div>
            </div><!-- /section 2 -->

            <!-- ── SECTION 3: Description ── -->
            <div class="form-section">
              <div class="section-title">Announcement Content</div>

              <div class="form-group form-full <?= has_err('description') ?>">
                <label>
                  Description / Announcement
                  <span class="required-star">*</span>
                </label>
                <div class="char-wrap">
                  <textarea
                    name="description"
                    id="descTextarea"
                    maxlength="3000"
                    placeholder="Provide full details of the health warning — symptoms to watch for, areas affected, prevention measures, and any public advisory steps residents should take…"><?= old('description') ?></textarea>
                  <span class="char-count" id="charCount">0 / 3000</span>
                </div>
                <?php err('description') ?>
                <span class="field-hint">Minimum 20 characters. Include symptoms, prevention steps, and who to contact.</span>
              </div>
            </div><!-- /section 3 -->

            <!-- ── SECTION 4: Publishing ── -->
            <div class="form-section">
              <div class="section-title">Publishing Options</div>
              <div class="form-grid">

                <!-- Status -->
                <div class="form-group <?= has_err('status') ?>">
                  <label>
                    Publication Status
                    <span class="required-star">*</span>
                  </label>
                  <div class="status-group">
                    <input type="radio" name="status" id="st_active"  class="status-opt" value="Active"  <?= (old('status','Active') === 'Active'  ? 'checked' : '') ?>>
                    <label for="st_active">
                      <span class="status-dot" style="background:var(--green)"></span> Active
                    </label>

                    <input type="radio" name="status" id="st_draft"   class="status-opt" value="Draft"   <?= (old('status','Active') === 'Draft'   ? 'checked' : '') ?>>
                    <label for="st_draft">
                      <span class="status-dot" style="background:var(--purple)"></span> Draft
                    </label>

                    <input type="radio" name="status" id="st_expired" class="status-opt" value="Expired" <?= (old('status','Active') === 'Expired' ? 'checked' : '') ?>>
                    <label for="st_expired">
                      <span class="status-dot" style="background:var(--faint)"></span> Expired
                    </label>
                  </div>
                  <?php err('status') ?>
                  <span class="field-hint">Active = visible to public. Draft = saved but hidden.</span>
                </div>

                <!-- Expiry date -->
                <div class="form-group <?= has_err('expires_at') ?>">
                  <label>Expiry Date <span style="color:var(--faint);font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
                  <input
                    type="date"
                    name="expires_at"
                    id="expiryDate"
                    value="<?= old('expires_at') ?>"
                    min="<?= date('Y-m-d') ?>">
                  <?php err('expires_at') ?>
                  <span class="field-hint">Leave blank if there is no fixed expiry date.</span>
                </div>

              </div>
            </div><!-- /section 4 -->

          </div><!-- /form-body -->

          <!-- Form footer with submit buttons -->
          <div class="form-footer">
            <span class="form-footer-hint">
              <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor" style="color:var(--faint)"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM7 4h2v5H7V4zm0 6h2v2H7v-2z"/></svg>
              Fields marked <span style="color:var(--red)">*</span> are required.
            </span>
            <div class="form-footer-actions">
              <a href="index.php" class="btn btn-ghost">Cancel</a>
              <button type="submit" name="submit" class="btn btn-primary btn-lg" id="submitBtn">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="currentColor"><path d="M2 8l4 4 8-8"/></svg>
                Post Warning
              </button>
            </div>
          </div>

        </div><!-- /form-card -->
      </form>

      <!-- Tips panel -->
      <div class="tips-card">
        <div class="tips-title">
          <svg width="13" height="13" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zM7 4h2v5H7V4zm0 6h2v2H7v-2z"/></svg>
          Tips for writing effective health warnings
        </div>
        <ul class="tips-list">
          <li>Use plain language — avoid medical jargon so all residents can understand the risk.</li>
          <li>State the specific area affected and who is most at risk (e.g. children, elderly, pregnant women).</li>
          <li>Always include clear prevention steps and what action residents should take.</li>
          <li>Set an expiry date for time-limited alerts so they are not shown after the threat has passed.</li>
          <li>Use <strong>Critical</strong> only for immediate life-threatening situations requiring urgent public action.</li>
        </ul>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /layout -->

<script>
// ── Severity chip selector ────────────────────
const sevHints = {
    'Critical':      '🔴 Critical — immediate public danger, requires urgent action.',
    'High':          '🟠 High — serious risk, strong advisory issued.',
    'Medium':        '🟡 Medium — moderate risk, precautions recommended.',
    'Low':           '🟢 Low — minor risk, general awareness only.',
    'Informational': '🔵 Informational — no immediate risk, public notice only.',
};

function setSeverity(val) {
    document.getElementById('severitySelect').value = val;
    document.querySelectorAll('.sev-chip').forEach(c => c.classList.remove('active'));
    event.currentTarget.classList.add('active');
    document.getElementById('sevHint').textContent = sevHints[val] || '';
}

// Keep chips in sync if select is ever used directly
document.getElementById('severitySelect').addEventListener('change', function() {
    const val = this.value;
    document.querySelectorAll('.sev-chip').forEach(c => {
        c.classList.toggle('active', c.textContent.trim() === val);
    });
    document.getElementById('sevHint').textContent = sevHints[val] || '';
});

// ── Character counter for description ─────────
const descTA    = document.getElementById('descTextarea');
const charCount = document.getElementById('charCount');

function updateCount() {
    const len = descTA.value.length;
    const max = 3000;
    charCount.textContent = len + ' / ' + max;
    charCount.className = 'char-count' + (len > max * 0.9 ? (len >= max ? ' over' : ' near') : '');
}
descTA.addEventListener('input', updateCount);
updateCount(); // run on load (catches PHP repopulation)

// ── Prevent double-submit ──────────────────────
document.getElementById('createForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 16 16" fill="currentColor" style="animation:spin .8s linear infinite"><path d="M8 1v3a4 4 0 010 8v3a7 7 0 000-14z"/></svg> Posting…';
});

// ── Auto-set min expiry date to today ─────────
document.getElementById('expiryDate').min = new Date().toISOString().split('T')[0];
</script>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>

</body>
</html>