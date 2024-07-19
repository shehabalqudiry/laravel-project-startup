<?php

namespace Modules\MasterData\App\Repositories\ActivityLogs;

interface ActivityLogInterface
{

    public function index($request);


    public function api($request);


    public function destroy($activity_log);

}
