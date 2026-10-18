<script>
    (function () {
        var stored = localStorage.getItem('theme');
        var theme = stored === 'light' || stored === 'dark' ? stored : 'dark';
        document.documentElement.classList.toggle('dark', theme === 'dark');
    })();
</script>
