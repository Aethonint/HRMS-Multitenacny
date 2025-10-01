
<?php
if (!function_exists('tenant_asset')) {
    function tenant_asset($path)
    {
        // Assuming tenant assets are publicly accessible via URL
        return env('APP_URL') . '/storage/' . $path;
    }
}
