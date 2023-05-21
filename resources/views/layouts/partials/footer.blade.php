<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>

    <strong>Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} <a
            href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.</strong> All rights
    reserved.
</footer>
