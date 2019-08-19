<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '6vSMB2OI6F8dEdew9+PHWoaheciQZ8UazBlrYZXF/hhT+YWS1QZ5REcCIaLfzOvHtuTWGkHtzGQfxeMGrLVXXIkyFf1zsiJxG+4g0juXKxQc35MW9ug81UkebGZ7dZjExAB8KV7w0zBFhvSCqvEn0QdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '959732dd30782b3750d9ddb46dd9d998';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
    }
}
echo "OK";
function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>
