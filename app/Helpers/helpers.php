<?php

use Illuminate\Support\Facades\Http;

// TODO: Handling api responses
function responseSuccess($data, $key = 'data', $msg = null, $status_code = 200)
{
    $returnData = [
        'status' => true,
        'message' => $msg,
        $key => $data->items(),
    ];

    if (isset($data->resource)) {
        $returnData['links'] = $data->response()->getData(true)['links'];
        $returnData['meta'] = $data->response()->getData(true)['meta'];
    }

    return response()->json($returnData, $status_code);
}

function responseError($msg = "Error", $errorNum = "DATAE0", $status_code = 200)
{
    $returnData = [
        'status'    => false,
        'errorNum'  => $errorNum,
        'message'   => $msg,
    ];

    return response()->json($returnData, $status_code);
}

/* *************** end handling api responses *************** */


// TODO: Handling uploade files
function uploadFile($file, $path)
{
    $file_name = time() . '_' . $file->getClientOriginalName();
    $file->move($path, $file_name);

    return $file_name;
}
/* *************** end handling upload files *************** */

// TODO: Handling users operations
function notify_user(array $options = [])
{
    $options = array_merge([
        'content' => [$options['message'] ?? ""],
        'action_url' => $options['url'] ?? "",
        'methods' => ['database'],
        'image' => $options['image'] ?? "",
        'btn_text' => __("Show Notification")
    ], $options);
    $user = \App\Models\User::where('id', $options['user_id'])->first();
    if ($user != null) {
        $user->notify(
            new \App\Notifications\GeneralNotification([
                'content' => $options['content'],
                'action_url' => $options['action_url'],
                'btn_text' => $options['btn_text'],
                'methods' => $options['methods'],
                'image' => $options['image']
            ])
        );
    }
}

/* *************** end handling users operations *************** */

function sendNotification(array $tokens, string $title, string $body, $receiver = null, $icon = null, $vibrate = 1, $sound = null)
{
    $message = [
        'body' => $body,
        'title' => $title,
        'receiver' => $receiver,
        'icon' => $icon,
        'vibrate' => $vibrate,
        'sound' => $sound,
    ];

    $data = [
        'registration_ids' => $tokens,
        'notification' => $message,
    ];

    $headers = [
        'Authorization: key=' . config('app.fcm_server_key'),
        'Content-Type: application/json',
    ];

    $client = new Http();
    $response = $client->post('https://fcm.googleapis.com/fcm/send', [
        'headers' => $headers,
        'json' => $data,
    ]);

    return $response->successful() ? $response->json() : null;
}


// TODO: Handling content operations

function slug(string $string)
{
    $t = $string;
    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '',
        '&amp;' => '', '&nbsp;' => '',
        '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-',
    );
    foreach ($specChars as $k => $v) {
        $t = str_replace($k, $v, $t);
    }

    return substr($t, 0, 230);
}
