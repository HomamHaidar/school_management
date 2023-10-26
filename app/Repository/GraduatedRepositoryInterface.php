<?php

namespace App\Repository;

interface GraduatedRepositoryInterface
{
    public function index();
    public function create();
    public function SoftDelete($request);
    public function RestoreStudent($request);
    public function DeleteStudent($request);
    public function SoftDelete_one_student($request);


}
