<?php $domain = 'https://purwodadikab.onrender.com/'; $sitemap_name = 'agen';
$max_links_per_sitemap = 5000;


$keywords = file('mau.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


$sitemap_index = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$sitemap_index .= '<sitemapindex
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

$sitemap_files = [];

foreach ($keywords as $i => $keyword) { $keyword = trim($keyword); if
($keyword === '') continue;

    $sitemap_file_number = ceil(($i + 1) / $max_links_per_sitemap);

    if (!isset($sitemap_files[$sitemap_file_number])) { $sitemap_files
    [$sitemap_file_number] = '<?xml version="1.0" encoding="UTF-8"?>' .
    PHP_EOL; $sitemap_files
    [$sitemap_file_number] .= '<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL; }

    $url = htmlspecialchars($domain . '?service=' . urlencode
    ($keyword), ENT_QUOTES | ENT_XML1, 'UTF-8');

    $sitemap_files[$sitemap_file_number] .= '  <url>' . PHP_EOL;
    $sitemap_files[$sitemap_file_number] .= '    <loc>' . $url . '</loc>' .
    PHP_EOL; $sitemap_files[$sitemap_file_number] .= '  </url>' . PHP_EOL; }


foreach ($sitemap_files as $sitemap_file_number => &$sitemap_file)
{ $sitemap_file .= '</urlset>' . PHP_EOL; $filename
= "$sitemap_name-$sitemap_file_number.xml"; file_put_contents
($filename, $sitemap_file);

    $sitemap_index .= '  <sitemap>' . PHP_EOL; $sitemap_index .= '    <loc>' .
    htmlspecialchars($domain . $filename, ENT_QUOTES |
    ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL; $sitemap_index .= '
    </sitemap>' . PHP_EOL; }

$sitemap_index .= '</sitemapindex>' . PHP_EOL; file_put_contents
($sitemap_name . '.xml', $sitemap_index);

echo "✅ Sitemap berhasil dibuat!!!";
?>
