<?php

namespace App\Repository;

interface AttendanceRepositoryInterface
{
    public function index();

    public function Store($request);

    public function show($id);



}
