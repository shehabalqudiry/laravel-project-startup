<?php

namespace Modules\MasterData\App\Repositories\Dashboard\ActivityLogs;

interface ActivityLogInterface
{

    public function index($request);


    public function show($activity_log);


    public function destroy($activity_log);

}
