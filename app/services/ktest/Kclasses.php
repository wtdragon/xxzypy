<?php

namespace App\Services\Ktest;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class Kclasses {
var $handshakeUrl;
var $loginUrl;
var $createUserUrl;
var $updateUserUrl;
var $deleteUserUrl;
var $listUserUrl;
var $listDWYAResultsUrl;
var $listResultsUrl;
public function __construct($environment)
{
if($environment === 'singapore'){
$apiRootUrl = 'https://api.keystosucceed.cn/';
$extRootUrl = 'https://api.keystosucceed.cn/ext_singapore.php/';
}
if(!isset($apiRootUrl)) {
echo 'HesClient __construct received an invalid environment:' . $environment;
exit();
}
$this->handshakeUrl = $apiRootUrl.'login';
$this->loginUrl = $extRootUrl;
$this->createUserUrl = $apiRootUrl.'sfGuardUserAPI.json';
$this->updateUserUrl = $apiRootUrl.'sfGuardUserAPI/';
$this->deleteUserUrl = $apiRootUrl.'sfGuardUserAPI/';
$this->listUserUrl = $apiRootUrl.'sfGuardUserAPI.json';
$this->listDWYAResultsUrl = $apiRootUrl.'asPortDWYAResultAPI.json';
$this->listResultsUrl = $apiRootUrl.'asPortResultAPI.json';
$this->deleteResultUrl = $apiRootUrl.'asPortResultAPI/';
}
public function getLoginUrl($accountId, $configId, $userId, $nonce, $prodId = null, $accountEncryptedHesStudentId = null)
{
$url = $this->loginUrl.'?accountId='.$accountId.'&userId='.$userId.'&nonce='.$nonce;
if(isset($prodId)){
$url.= '&prodId='.$prodId;
}
if(isset($configId)){
$url.= '&configId='.$configId;
}
if($accountEncryptedHesStudentId !== null){
$url.= '&ssoStudentId='.$accountEncryptedHesStudentId;
}
return $url;
}
public function powerOnSelfTest($stringToEncode, $accountKey)
{
try{
$this->log("Power on self test\n");
$this->log("text to encode: '".$stringToEncode."' length: ".strlen($stringToEncode));
//encrypt and encode
$outStringEncoded = Cryptographer::encrypt($stringToEncode, $accountKey, true);
//decode and decrypt
$clearText = Cryptographer::decrypt($outStringEncoded, $accountKey, true);
$this->log("un-encoded: '".$clearText."' length: ".strlen($clearText));
if($stringToEncode !== $clearText){
throw new Exception("Fail: Decryption not exact match");
}
else {
$this->log("Success: Decryption exact match");
}
$this->log("/////////////////////////////////////");
}
catch (Exception $e){
$this->log("Error: ".$e.getMessage());
$this->log("/////////////////////////////////////");
}
}
public function handshake($accountId, $password, $keyString)
{
try{
//$this->log("handshake test");
$encryptedEncodedString = Cryptographer::encrypt($password, $keyString, true);
$parameters = "accountId=".$accountId."&accountSsoPassword=".$encryptedEncodedString;
$postResponse = $this->sendPOST($this->handshakeUrl, $parameters);
$responseArray = json_decode($postResponse,true);
if(!isset($responseArray['nonce']))
{
throw new Exception('Error in response to handshake response =' . $postResponse);
}
$nonce = $responseArray['nonce'];
$doubleEncrypted = Cryptographer::encrypt($nonce, $keyString, true);
//$this->log("doubleEncrypted=" .$doubleEncrypted );
return $doubleEncrypted;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}

public function listUser($accountId, $userId, $nonce)
{
try{
$listUserUrl = $this->listUserUrl;
$parameters = "id=" . $userId . "&accountId=" . $accountId . "&nonce=" . $nonce;
$response = $this->sendGET($listUserUrl, $parameters);
return $response;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function listResults($accountId, $userId, $nonce, $filters)
{
try
{
$parameters = "user_id=" . $userId . "&accountId=" . $accountId . "&nonce=" . $nonce;
foreach($filters as $key => $value)
{
$parameters .= "&$key=$value";
}
$response = $this->sendGET($this->listResultsUrl, $parameters);
return $response;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function deleteResult($accountId, $resultId, $nonce)
{
try{
$deleteUrl = $this->deleteResultUrl.$resultId.'.json';
$parameters = "accountId=".$accountId."&nonce=".$nonce;
$response = $this->sendDELETE($deleteUrl, $parameters);
return $response;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function deleteUser($accountId, $userId, $nonce)
{
try{
$deleteUrl = $this->deleteUserUrl.$userId.'.json';
$parameters = "accountId=".$accountId."&nonce=".$nonce;
$response = $this->sendDELETE($deleteUrl, $parameters);
return $response;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function updateUser($userId, $accountId, $nonce, $nonEmptyInputValues)
{
try{
$updateUrl = $this->updateUserUrl.$userId.'.json' ;
$content = json_encode($nonEmptyInputValues);
$parameters = "accountId=".$accountId."&nonce=".$nonce.'&content='.$content;
$response = $this->sendPUT($updateUrl, $parameters);
return $response;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function encryptMe($me, $keyString)
{
try{
$encryptedEncodedString = Cryptographer::encrypt($me, $keyString, true);
return $encryptedEncodedString;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
protected function sendPOST($urlString, $parameters)
{
$line ="";
$output = "";
try {
$ch = curl_init( $urlString );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$response = curl_exec( $ch );
return $response;
} catch (Exception $e) {
$this->log($e.getMessage());
throw e;
}
}
protected function sendGET($urlString, $parameters)
{
try {
$ch = curl_init($urlString . "?" . $parameters);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$response = curl_exec($ch);
curl_close($ch);
return $response;
} catch (Exception $e) {
$this->log($e.getMessage());
throw e;
}
}
protected function sendDELETE($urlString, $parameters)
{
try {
$ch = curl_init($urlString);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$response = curl_exec($ch);
curl_close($ch);
return $response;
} catch (Exception $e) {
$this->log($e.getMessage());
throw e;
}
}
public static  function unicode2utf8($str){
        if(!$str) return $str;
        $decode = json_decode($str);
        if($decode) return $decode;
        $str = '["' . $str . '"]';
        $decode = json_decode($str);
        if(count($decode) == 1){
                return $decode[0];
        }
        return $str;
}
function unicode_conv($originalString) {
  // The four \\\\ in the pattern here are necessary to match \u in the original string
  $replacedString = preg_replace("/\\\\u(\w{4})/", "&#$1;", $originalString);
  $unicodeString = mb_convert_encoding($replacedString, 'GBK', 'HTML-ENTITIES');
  return $unicodeString;
}
/**
 * 汉字转Unicode编码
 * @param string $str 原始汉字的字符串
 * @param string $encoding 原始汉字的编码
 * @param boot $ishex 是否为十六进制表示（支持十六进制和十进制）
 * @param string $prefix 编码后的前缀
 * @param string $postfix 编码后的后缀
 */
function unicode_encode($str, $encoding = 'UTF-8', $ishex = false, $prefix = '&#', $postfix = ';') {
    $str = iconv($encoding, 'UCS-2', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = $ishex ? bin2hex($arrstr[$i]) : hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    }
    return $unistr;
}
 
/**
 * Unicode编码转汉字
 * @param string $str Unicode编码的字符串
 * @param string $decoding 原始汉字的编码
 * @param boot $ishex 是否为十六进制表示（支持十六进制和十进制）
 * @param string $prefix 编码后的前缀
 * @param string $postfix 编码后的后缀
 */
function unicode_decode($unistr, $encoding = 'UTF-8', $ishex = false, $prefix = '&#', $postfix = ';') {
    $arruni = explode($prefix, $unistr);
    $unistr = '';
    for($i = 1, $len = count($arruni); $i < $len; $i++) {
        if (strlen($postfix) > 0) {
            $arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
        }
        $temp = $ishex ? hexdec($arruni[$i]) : intval($arruni[$i]);
       // $unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
     $unistr .= implode(",", preg_split("/[\s]+/", ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256)));	}
    return iconv('UCS-2', $encoding, $unistr);
}
public function getkLsiUrl($userId)
{
 			
try{
$configId = 101;  //MI
 $accountId = 1000001;
 $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
 $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
 $kuserId=$userId;
 $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
return $kurl;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function getkMiUrl($userId)
{
 			
try{
$configId = 100;  //MI
 $accountId = 1000001;
 $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
 $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
 $kuserId=$userId;
 $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
return $kurl;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
public function getkResultUrl($userId)
{
 			
try{
	$configId = 104; 
$accountId = 1000001;	
$accountKey = "deI%2BKwrnkhenLX"; 
$accountPassword = "d1SLnDVAbxKxOid5"; 
$environment = "singapore";
$hesClient = new HesClient($environment);
$nonce = $hesClient->handshake($accountId, $accountPassword, $accountKey);
$userId = $hesClient->encryptMe($userId, $accountKey);
$kresult = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce); 
return $kresult;
}
catch (Exception $e){
$this->log($e.getMessage());
}
}
protected function sendPUT($urlString, $parameters)
{
try {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$response = curl_exec($ch);
curl_close($ch);
return $response;
} catch (Exception $e) {
$this->log($e.getMessage());
throw e;
}
}
protected function log($message)
{
echo $message;
echo '<br/>';
}
}