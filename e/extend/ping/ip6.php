<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

class GooglePing {
    private string $currentDomain;
    private string $userAgent;
    private Memcached $cache;
    private string $userIP;
    private string $cacheKey;
    private int $cacheTTL = 86400;
 
    public function __construct() {
        $this->currentDomain = $_SERVER['HTTP_HOST'];
        $this->userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';
        $this->cache = new Memcached();
        $this->cache->addServer('localhost', 11211);
        $this->userIP = $_SERVER['REMOTE_ADDR'];
        $this->cacheKey = 'google_ping_' . $this->currentDomain . '_' . $this->userIP;
    }
 
    public function run() {
        if (!$this->cache->get($this->cacheKey)) {
            $googleRequest = curl_init();
            curl_setopt($googleRequest, CURLOPT_URL, 'https://www.google.com/ping?sitemap=https://' . $this->currentDomain . '/sitemap/index.xml');
            curl_setopt($googleRequest, CURLOPT_USERAGENT, $this->userAgent);
            curl_setopt($googleRequest, CURLOPT_RETURNTRANSFER, true);
            curl_exec($googleRequest);
            curl_close($googleRequest);
 
            $webmastersRequest = curl_init();
            curl_setopt($webmastersRequest, CURLOPT_URL, 'https://www.google.com/webmasters/tools/ping?sitemap=https://' . $this->currentDomain . '/sitemap/index.xml');
            curl_setopt($webmastersRequest, CURLOPT_USERAGENT, $this->userAgent);
            curl_setopt($webmastersRequest, CURLOPT_RETURNTRANSFER, true);
            curl_exec($webmastersRequest);
            curl_close($webmastersRequest);
 
            $this->cache->set($this->cacheKey, true, $this->cacheTTL);
        }
    }
    public function getUserIP() {
        return $this->userIP;
    }
}
 
$googlePing = new GooglePing();
$googlePing->run();
echo "访问者IP地址：" . $googlePing->getUserIP();
?>