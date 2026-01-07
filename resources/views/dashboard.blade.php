<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    @vite[('resources/css/app.css', 'resources/js/app.js')]
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">API Performance monitor</h1>   
        <monitor-chart></monitor-chart>
    </div>
</body></html>