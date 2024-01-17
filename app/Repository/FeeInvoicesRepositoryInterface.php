<?php

namespace App\Repository;

interface FeeInvoicesRepositoryInterface
{

    public function index();

    public function Store($request);

    public function show($id);

    public function edit($id);

    public function update($request);

    public function destroy($request);



}
