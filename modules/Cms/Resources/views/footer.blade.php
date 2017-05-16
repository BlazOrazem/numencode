<footer class="footer">
    <div class="container">
        <p class="hidden-xs pull-left">Copyright &copy; {{ date('Y') }}</p>
        <p class="hidden-xs pull-right">Numencode CMS</p>
        <p class="visible-xs text-center">Copyright &copy; {{ date('Y') }} Numencode CMS</p>
    </div>
</footer>

<script src="{{ mix('/themes/default/js/manifest.js') }}"></script>
<script src="{{ mix('/themes/default/js/vendor.js') }}"></script>
<script src="{{ mix('/themes/default/js/app.js') }}"></script>

@include('theme::flash')