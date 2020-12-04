<script type="text/javascript">
    $(function(){
        var url = document.location.toString();
        if (url.match('#')) {
            var mainUrl = url.split('#')[1];
            if (mainUrl.indexOf('?')) {
                var subUrl = mainUrl.split('?')[0];
                console.log('.nav-tabs a[href="#' + subUrl + '"]');
                $('.nav-tabs a[href="#' + subUrl + '"]').tab('show');
            } else {
                console.log('.nav-tabs a[href="#' + mainUrl + '"]');
                $('.nav-tabs a[href="#' + mainUrl + '"]').tab('show');
            }
        }
    });
</script>
