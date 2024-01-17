<?php

namespace App\Repository;

interface PromotionRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function destroy($request);


}
