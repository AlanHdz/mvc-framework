@php
    use App\Core\Application; 
@endphp
@if (Application::$app->session->getFlash('success'))
    <div class="alert alert-success mt-1">
        {{ Application::$app->session->getFlash('success') }}
    </div>
@endif 
@if (Application::$app->session->getFlash('error'))
    <div class="alert alert-danger mt-1">
        {{ Application::$app->session->getFlash('error') }}
    </div>
@endif 