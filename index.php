<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['domains'])) {
    $domains = explode("\n", trim($_POST['domains']));
    $domains = array_map('trim', $domains);
    $results = '';

    foreach ($domains as $domain) {
        if (!empty($domain)) {
            $url = 'http://' . $domain;
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($http_code === 200 && $response) {
                $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', $domain) . '.txt';
                file_put_contents($file_name, $response);
            }

            $results .= "$domain [$http_code]\n";

            curl_close($curl);
        }
    }

    echo nl2br($results);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Status Checker</title>
</head>
<body>

<h2>Website Status Checker</h2>
<form id="domainForm">
    <label for="domains">Enter website domains (one per line):</label><br><br>
    <textarea id="domains" name="domains" rows="10" cols="50" placeholder="example.com"></textarea><br><br>
    <button type="submit">Check</button>
</form>

<h3>Results</h3>
<textarea id="results" rows="10" cols="50" readonly></textarea>

<script>
document.getElementById('domainForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let domains = document.getElementById('domains').value.trim();
    if (domains === "") {
        alert("Please enter some domains!");
        return;
    }

    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'domains=' + encodeURIComponent(domains)
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('results').value = data.replace(/<br\s*\/?>/gi, '\n');
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

</body>
</html>
