<?php

namespace App\Http\Middleware;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful as BaseEnsureFrontendRequestsAreStateful;

class EnsureFrontendRequestsAreStateful extends BaseEnsureFrontendRequestsAreStateful
{
    // Tu peux surcharger ici si besoin
}
