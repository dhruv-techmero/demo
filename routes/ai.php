<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\WeatherServer;

// Mcp::web('/mcp/demo', \App\Mcp\Servers\PublicServer::class);
Mcp::web('/mcp/weather', WeatherServer::class);

