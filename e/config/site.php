<?php

function getGoogleIndexCount($domain) {
    $searchurl = 'https://www.google.com/search?q=site:' . urlencode($domain);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $searchurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    $html = curl_exec($ch);

    // Check for cURL errors
    if ($html === false) {
        // error_log("cURL error for domain $domain: " . curl_error($ch)); // Optional: log error
        curl_close($ch);
        return 0; // Return 0 or handle error as appropriate
    }
    curl_close($ch);

    // Ensure $html is a string before passing to preg_match (PHP 8.1 TypeError if not)
    if (!is_string($html)) {
        // error_log("cURL result for domain $domain was not a string."); // Optional: log error
        return 0;
    }

    // 使用正则表达式匹配收录数
    $pattern = '/About ([0-9,]+) results/';
    // preg_match can also return false on error (though less likely with a fixed pattern here)
    // or 0 if no match is found.
    if (preg_match($pattern, $html, $matches) === 1 && isset($matches[1])) {
        $count = str_replace(',', '', $matches[1]);
        return intval($count);
    }

    return 0;
}

// 要查询的域名列表
$domains = array(
    '0zipai.net',
    '1188nc.com',
    '135048.com',
    '238473.com',
    '35zipai.com',
    '372148.com',
    '3zipai.net',
    '438361.com',
    '4zipai.net',
    '504532.com',
    '50zipai.com',
    '55zipai.com',
    '57zipai.com',
    '5zipai.com',
    '66zipai.com',
    '6zipai.com',
    '7aipai.com',
    '7zipai.net',
    '832871.com',
    '867516.com',
    '88zipai.com',
    '99zipai.com',
    '9zipai.net',
    'alo504.com',
    'dwv314.com',
    'ecams.buzz',
    'euvt.cfd',
    'fnp574.com',
    'fsu768.com',
    'gtk839.com',
    'hailed.cfd',
    'hnf281.com',
    'indeed1.cfd',
    'ite435.com',
    'kgs240.com',
    'kih573.com',
    'lvu673.com',
    'mcy505.com',
    'meipay1.xyz',
    'meipay2.xyz',
    'meipay3.xyz',
    'meipay4.xyz',
    'meipay5.xyz',
    'meipay6.xyz',
    'meipay7.xyz',
    'meipay8.xyz',
    'ned645.com',
    'ngi901.com',
    'ohs209.com',
    'pin502.com',
    'psc757.com',
    'public6.cfd',
    'syv785.com',
    't64398.com',
    't69y.net',
    'tissue5.cfd',
    'wzv828.com',
    '中国银监会43.com',
    'yhd185.com',
    'yik425.com',
    'zmc912.com',
    'www.niupag.probaljaki.hu',
    'www.nizreo.webtelek.hu',
    'www.zipai.nhely.hu',
    'zipai.szakdoga.net',
    'zipai.szakdolgozat.net'
);

// 处理查询请求
if (isset($_POST['domain'])) {
    $domain = $_POST['domain'];
    $indexCount = getGoogleIndexCount($domain);
    echo $indexCount; // This is already an int
    
    // 将结果存储到txt文件
    $file = 'site_results.txt';
    $previousResults = array(); // Initialize as empty array

    if (file_exists($file)) {
        $fileContent = file_get_contents($file);
        // Ensure content was read and is not empty before unserializing
        if ($fileContent !== false && $fileContent !== '') {
            $unserializedData = unserialize($fileContent);
            if (is_array($unserializedData)) {
                $previousResults = $unserializedData;
            } else {
                // error_log("Failed to unserialize data from $file or data is not an array."); // Optional: log error
            }
        } elseif ($fileContent === false) {
            // error_log("Failed to read $file."); // Optional: log error
        }
    }
    
    // Ensure $previousCount is an integer.
    $previousCount = isset($previousResults[$domain]) ? intval($previousResults[$domain]) : 0;

    // $indexCount is already an int from getGoogleIndexCount's return type.
    $currentCount = $indexCount; 
    $previousResults[$domain] = $currentCount;
    
    if (file_put_contents($file, serialize($previousResults)) === false) {
        // error_log("Failed to write to $file."); // Optional: log error
    }

    // 比较与上次查询的结果
    $difference = $currentCount - $previousCount;
    $differenceText = $difference >= 0 ? '+' . $difference : $difference;
    echo '|' . $differenceText;

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Google Index Count</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            border: 1px solid black;
        }
    </style>
    <script>
var domains = <?php echo json_encode($domains); ?>;
var currentIndex = 0;

function queryNextDomain() {
    if (currentIndex < domains.length) {
        var domain = domains[currentIndex];
        var resultContainer = document.getElementById('resultContainer');

        // 发起查询请求
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                var index = response.indexOf('|');
                var count = response.substring(0, index);
                var difference = response.substring(index + 1);

                var countElement = document.getElementById('count_' + currentIndex);
                countElement.innerHTML = count;
                var differenceElement = document.getElementById('difference_' + currentIndex);
                differenceElement.innerHTML = difference;

                currentIndex++;
                setTimeout(queryNextDomain, 5000); // 停顿5秒后查询下一个域名
            }
        };
        xhr.send('domain=' + encodeURIComponent(domain));
    }
}

window.onload = queryNextDomain;
    </script>
</head>
<body>
    <center>
    <h1>Google Index Count</h1>
    <table>
        <tr>
            <th>域名</th>
            <th>Google收录数</th>
            <th>增加/减少</th>
			<th>site</th>
        </tr>
        <?php for ($i = 0; $i < count($domains); $i++) { ?>
            <tr>
                <td> <a href='https://www.<?php echo $domains[$i]; ?>' target='_blank'><?php echo $domains[$i]; ?></a></td>
                <td id="count_<?php echo $i; ?>"></td>
                <td id="difference_<?php echo $i; ?>"></td>
				<td> <a href='https://www.google.com/search?q=site:<?php echo $domains[$i]; ?>' target='_blank'>Google前台</a></td>
            </tr>
        <?php } ?>
    </table>
    </center>
</body>
</html>