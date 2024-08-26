<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Http\JsonResponse;

// TODO: Handling api responses
function responseSuccess($data, $key = 'data', $msg = null, $status_code = 200, $options = ['isView' => false, 'view' => null])
{
    // return if view
    if ($options['isView']) {
        return view($options['view'], compact('data', 'options'));
    }

    $returnData = [
        'status'    => true,
        'message'   => is_array($msg) ? $msg[0] : $msg,
        $key        => $data instanceof LengthAwarePaginator ? $data->items() : $data,
    ];

    if ($data instanceof LengthAwarePaginator and !($data instanceof Illuminate\Database\Eloquent\Collection)) {
        $returnData['paginate'] = [
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'per_page' => $data->perPage(),
            'last_page' => $data->lastPage(),
            'total_pages' => $data->lastPage(),
        ];
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
function uploadFile($file, $path): string
{
    $file_name = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path($path), $file_name);

    return "$path/$file_name";
}
/* *************** end handling upload files *************** */

// TODO: Handling users operations
function notify_user(array $options = []): void
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
        sendNotification($user->fcmTokens()->pluck('token')->toArray(), __('New Notification'), $options['content']);
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
