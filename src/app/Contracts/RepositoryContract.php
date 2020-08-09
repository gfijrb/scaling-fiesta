<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface RepositoryContract
{
    public function create(Request $request);

    public function read(Request $request);

    public function update(Request $request);

    public function delete(Request $request);
}
